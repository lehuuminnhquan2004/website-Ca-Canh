<?php
session_start();
if (empty($_SESSION['admin_id'])) {
    header("Location: /admin/login.php");
    exit;
}

$configPath = __DIR__ . '/../includes/site-config.json';
$config = [
    'banners' => []
];

if (file_exists($configPath)) {
    $loaded = json_decode(file_get_contents($configPath), true);
    if (is_array($loaded)) {
        $config = array_merge($config, $loaded);
    }
}

$uploadDir = __DIR__ . '/../images/slider/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Xóa banner
    if (!empty($_POST['delete']) && is_array($_POST['delete'])) {
        foreach ($_POST['delete'] as $fname) {
            $fname = basename($fname);
            $filePath = $uploadDir . $fname;
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
            $config['banners'] = array_values(array_filter(
                $config['banners'],
                fn($b) => $b !== $fname
            ));
        }
    }

    // Upload banner mới (có thể nhiều file)
    if (!empty($_FILES['banners']['name'][0])) {
        $count = count($_FILES['banners']['name']);
        for ($i = 0; $i < $count; $i++) {
            if ($_FILES['banners']['error'][$i] !== UPLOAD_ERR_OK) {
                $error = 'Upload bị lỗi, vui lòng thử lại.';
                continue;
            }
            $tmp = $_FILES['banners']['tmp_name'][$i];
            $ext = strtolower(pathinfo($_FILES['banners']['name'][$i], PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                $error = 'Chỉ nhận jpg, jpeg, png, webp.';
                continue;
            }
            $newName = time() . '_' . uniqid() . '.' . $ext;
            $dest = $uploadDir . $newName;
            if (move_uploaded_file($tmp, $dest)) {
                $config['banners'][] = $newName;
            } else {
                $error = 'Không thể lưu file ' . htmlspecialchars($_FILES['banners']['name'][$i]);
            }
        }
    }

    // Lưu lại config
    file_put_contents(
        $configPath,
        json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
    if (!$error) {
        $success = 'Đã cập nhật banner.';
    }
}

$page_title = 'Quản lý Banner';
include __DIR__ . '/admin-header.php';
?>

<div class="container" style="padding:20px 16px;">
  <h2 style="margin-bottom:15px;">Banner trang chủ</h2>

  <?php if ($success): ?>
    <p style="color:green;"><?= htmlspecialchars($success) ?></p>
  <?php endif; ?>
  <?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form method="post" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:12px;">
    <label>Thêm banner mới (có thể chọn nhiều):</label>
    <input type="file" name="banners[]" accept="image/*" multiple>

    <?php if (!empty($config['banners'])): ?>
      <div style="border:1px solid #eee; padding:10px; border-radius:6px;">
        <p style="margin:0 0 8px 0; font-weight:bold;">Banner hiện tại (tick để xóa):</p>
        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); gap:10px;">
          <?php foreach ($config['banners'] as $b): ?>
            <label style="display:flex; flex-direction:column; gap:6px; border:1px solid #f0f0f0; padding:6px; border-radius:6px;">
              <img src="../images/slider/<?= htmlspecialchars($b) ?>" alt="banner" style="width:100%; height:120px; object-fit:cover;">
              <span style="font-size:12px; word-break:break-all;"><?= htmlspecialchars($b) ?></span>
              <div style="display:flex; align-items:center; gap:6px;">
                <input type="checkbox" name="delete[]" value="<?= htmlspecialchars($b) ?>">
                <span>Xóa</span>
              </div>
            </label>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>

    <button class="btn" type="submit">Lưu banner</button>
  </form>
</div>
