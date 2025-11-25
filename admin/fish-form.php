<?php
session_start();
if (empty($_SESSION['admin_id'])) {
    header("Location: /admin/login.php");
    exit;
}

// CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

include __DIR__ . '/../includes/db.php';

// Lấy danh mục cá
$catRes = mysqli_query($conn, "SELECT * FROM fish_categories ORDER BY name ASC");
if (!$catRes) {
    die("Không tải được danh mục: " . htmlspecialchars(mysqli_error($conn)));
}
$categories = [];
while ($row = mysqli_fetch_assoc($catRes)) {
    $categories[] = $row;
}

// Kiểm tra edit
$product = null;
$isEdit = false;
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $res = mysqli_query($conn, "SELECT * FROM fishs WHERE id=$id");
    if (!$res) {
        die("Không tải được cá: " . htmlspecialchars(mysqli_error($conn)));
    }
    $product = mysqli_fetch_assoc($res);
    if ($product) {
        $isEdit = true;
    } else {
        die("Cá không tồn tại");
    }
}

// Giữ lại query khi quay về list
$returnRaw = isset($_REQUEST['return']) ? $_REQUEST['return'] : '';
$returnQuery = $returnRaw ? urldecode($returnRaw) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("CSRF token không hợp lệ.");
    }

    $name        = mysqli_real_escape_string($conn, $_POST['name']);
    $slug        = mysqli_real_escape_string($conn, $_POST['slug']);
    $price       = (int)$_POST['price'];
    $desc        = mysqli_real_escape_string($conn, $_POST['description']);
    $category_id = (int)$_POST['category_id'];
    $status      = isset($_POST['status']) ? (int)$_POST['status'] : 1;

    // Ảnh cũ
    $thumbnail = $product['thumbnail'] ?? '';

    // Upload ảnh mới
    if (!empty($_FILES['thumbnail']['name'])) {
        $targetDir = __DIR__ . '/../images/uploads/';
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);

        $ext = strtolower(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION));
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($ext, $allowedExt)) {
            die("Định dạng ảnh không hợp lệ!");
        }

        // Giới hạn dung lượng (2MB)
        $maxSize = 2 * 1024 * 1024;
        if ($_FILES['thumbnail']['size'] > $maxSize) {
            die("Ảnh vượt quá dung lượng cho phép (tối đa 2MB).");
        }

        // Kiểm tra MIME thực tế
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($_FILES['thumbnail']['tmp_name']);
        $allowedMime = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($mime, $allowedMime)) {
            die("Nội dung file không phải ảnh hợp lệ.");
        }

        $fileName = time() . '_' . uniqid() . '.' . $ext;
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $targetFile)) {
            if ($isEdit && !empty($product['thumbnail'])) {
                $oldPath = __DIR__ . '/../' . ltrim($product['thumbnail'], '/');
                if (file_exists($oldPath)) unlink($oldPath);
            }
            $thumbnail = './images/uploads/' . $fileName;
        }
    }

    // SQL
    if ($isEdit) {
        $sql = "UPDATE fishs SET 
                    name='$name',
                    slug='$slug',
                    price=$price,
                    thumbnail='$thumbnail',
                    description='$desc',
                    category_id=$category_id,
                    status=$status
                WHERE id=" . (int)$product['id'];
    } else {
        $sql = "INSERT INTO fishs
                    (name, slug, price, thumbnail, description, category_id, status)
                VALUES
                    ('$name','$slug',$price,'$thumbnail','$desc',$category_id,$status)";
    }

    $ok = mysqli_query($conn, $sql);
    if (!$ok) {
        die("Lưu cá thất bại: " . htmlspecialchars(mysqli_error($conn)));
    }
    $redirectUrl = './fishs.php';
    if (!empty($returnQuery)) {
        $redirectUrl .= '?' . $returnQuery;
    }
    header("Location: " . $redirectUrl);
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title><?= $isEdit ? "Sửa cá" : "Thêm cá cảnh" ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="../assets/css/style.css">
<style>
img.preview { margin-top:8px; max-width:150px; border:1px solid #ccc; border-radius:4px; }
button, input, select, textarea { font-size:16px; }
.drop-zone {
    border: 2px dashed #999;
    border-radius: 6px;
    padding: 12px;
    text-align: center;
    cursor: pointer;
    margin-bottom: 8px;
    background: #fafafa;
}
.drop-zone.dragover {
    border-color: #007bff;
    background: #f0f8ff;
}
</style>
</head>
<body>
<div class="container">
<h1><?= $isEdit ? "Sửa cá cảnh" : "Thêm cá cảnh mới" ?></h1>

<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <?php if (!empty($returnRaw)): ?>
      <input type="hidden" name="return" value="<?= htmlspecialchars($returnRaw) ?>">
    <?php endif; ?>

    <div>
        <label>Tên cá</label><br>
        <input type="text" id="name" name="name" required value="<?= htmlspecialchars($product['name'] ?? '') ?>">
    </div>

    <div>
        <label>Slug</label><br>
        <input type="text" id="slug" name="slug" required value="<?= htmlspecialchars($product['slug'] ?? '') ?>">
    </div>

    <div>
        <label>Giá</label><br>
        <input type="number" name="price" min="0" value="<?= htmlspecialchars($product['price'] ?? 0) ?>">
    </div>

    <div>
        <label>Danh mục</label><br>
        <select name="category_id" required>
            <option value="">-- Chọn danh mục --</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= (!empty($product['category_id']) && $product['category_id']==$cat['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label>Trạng thái</label><br>
        <select name="status">
            <option value="1" <?= (!isset($product['status']) || (int)$product['status']===1) ? 'selected' : '' ?>>Còn hàng</option>
            <option value="0" <?= (isset($product['status']) && (int)$product['status']===0) ? 'selected' : '' ?>>Hết hàng</option>
        </select>
    </div>

    <div>
        <label>Mô tả</label><br>
        <textarea name="description" rows="6" style="width:100%; max-width:600px;"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
    </div>

    <div>
        <label>Ảnh đại diện</label><br>
        <div class="drop-zone" id="dropZone">Kéo & thả ảnh vào đây hoặc bấm để chọn</div>
        <div style="margin:6px 0;">
          <button type="button" class="btn" id="chooseBtn" style="padding:6px 10px;">Chọn ảnh</button>
        </div>
        <input type="file" name="thumbnail" id="thumbnail" accept="image/*" style="display:none;">
        <img id="preview" class="preview"
             src="<?= !empty($product['thumbnail']) ? ".".htmlspecialchars($product['thumbnail']) : '' ?>"
             style="<?= !empty($product['thumbnail']) ? '' : 'display:none;' ?>"
             alt="thumbnail">
    </div>

    <button type="submit" class="btn"><?= $isEdit ? "Cập nhật" : "Thêm mới" ?></button>
    <a class="btn" href="./fishs.php<?php echo !empty($returnQuery)?"?".htmlspecialchars($returnQuery):""; ?>">Quay lại</a>
</form>

</div>

<script>
  const dropZone = document.getElementById('dropZone');
  const fileInput = document.getElementById('thumbnail');
  const chooseBtn = document.getElementById('chooseBtn');
  const preview = document.getElementById('preview');
  const nameInput = document.getElementById('name');
  const slugInput = document.getElementById('slug');

  if (dropZone && fileInput) {
    const openPicker = () => fileInput.click();
    dropZone.addEventListener('click', openPicker);
    if (chooseBtn) chooseBtn.addEventListener('click', openPicker);

    dropZone.addEventListener('dragover', (e) => {
      e.preventDefault();
      dropZone.classList.add('dragover');
    });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));
    dropZone.addEventListener('drop', (e) => {
      e.preventDefault();
      dropZone.classList.remove('dragover');
      if (e.dataTransfer.files.length) {
        fileInput.files = e.dataTransfer.files;
        showPreview(fileInput.files[0]);
      }
    });
  }

  if (fileInput) {
    fileInput.addEventListener('change', () => {
      if (fileInput.files && fileInput.files[0]) {
        showPreview(fileInput.files[0]);
      }
    });
  }

  function showPreview(file) {
    if (!preview || !file) return;
    preview.src = URL.createObjectURL(file);
    preview.style.display = 'block';
  }

  // Auto slug from name (giữ slug nếu đã sửa tay)
  if (nameInput && slugInput) {
    let slugEdited = false;

    slugInput.addEventListener('input', () => {
      slugEdited = true;
    });

    const toSlug = (str) => {
      return str
        .replace(/đ/g, 'd').replace(/Đ/g, 'd')
        .normalize('NFD').replace(/[\\u0300-\\u036f]/g, '')
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '')
        .replace(/--+/g, '-');
    };

    nameInput.addEventListener('input', () => {
      if (slugEdited) return;
      slugInput.value = toSlug(nameInput.value);
    });
  }
</script>
</body>
</html>
