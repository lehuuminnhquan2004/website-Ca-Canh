<?php
session_start();
if (empty($_SESSION['admin_id'])) {
    header("Location: /admin/login.php");
    exit;
}
include __DIR__ . '/../includes/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$category = null;

// Lấy thông tin danh mục nếu đang sửa
if ($id > 0) {
    $res = mysqli_query($conn, "SELECT * FROM categories WHERE id=$id");
    $category = mysqli_fetch_assoc($res);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug = mysqli_real_escape_string($conn, $_POST['slug']);

    if ($id > 0) {
        $sql = "UPDATE categories SET name='$name', slug='$slug' WHERE id=$id";
    } else {
        $sql = "INSERT INTO categories (name, slug) VALUES ('$name', '$slug')";
    }

    mysqli_query($conn, $sql);
    header("Location: ./categories.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?= $id ? 'Sửa' : 'Thêm' ?> danh mục</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
  <h1><?= $id ? 'Sửa' : 'Thêm' ?> danh mục</h1>
  <form method="post">
    <label>Tên danh mục</label>
    <input type="text" name="name" id="name" required
           value="<?= htmlspecialchars($category['name'] ?? '') ?>">

    <label>Slug</label>
    <input type="text" name="slug" id="slug" required
           value="<?= htmlspecialchars($category['slug'] ?? '') ?>">

    <button type="submit">Lưu</button>
    <a class="btn" href="./categories.php">Quay lại</a>
  </form>
</div>

<script>
// Hàm tạo slug từ tên
function createSlug(str) {
    str = str.toLowerCase();
    str = str.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
    str = str.replace(/[^a-z0-9\s-]/g, '');
    str = str.replace(/\s+/g, '-').replace(/-+/g, '-');
    str = str.replace(/^-+|-+$/g, '');
    return str;
}

// Tự động cập nhật slug khi nhập tên
document.getElementById('name').addEventListener('input', function() {
    document.getElementById('slug').value = createSlug(this.value);
});
</script>
</body>
</html>
