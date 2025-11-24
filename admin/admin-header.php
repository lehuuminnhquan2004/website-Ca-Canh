<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$logoFilePath = __DIR__ . '/../images/logo/logo.png';
$logoUrl = '../images/logo/logo.png';
if (file_exists($logoFilePath)) {
  $logoUrl .= '?v=' . filemtime($logoFilePath);
} else {
  $logoUrl = '../images/icons/icon-zalo.png';
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title><?= isset($page_title) ? $page_title : "Cửa hàng cá cảnh" ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/header.css">
</head>

<body>
  <header class="site-header">
    <div class="container header-inner">
      <div class="logo">
        <img src="<?= $logoUrl ?>" alt="Cửa hàng cá cảnh">
        <a href="./">Trang ADMIN</a>
      </div>


      <!-- Nút menu mobile -->
      <button class="nav-toggle" aria-label="Mở menu điều hướng">
        ☰
      </button>
      


      <nav class="main-nav">
        <a href="./">Trang chủ</a>
        <a href="./products.php">Sản phẩm</a>
        <a href="./categories.php">Danh muc</a>
        <a href="./blog-list.php">Blog</a>
        <a href="./banner-settings.php">Banner</a>


      </nav>
    </div>
  </header>

  <!-- XỬ LÝ  NÚT HAMBERGU -->
  <script>
        // Lấy nút toggle và menu
        const navToggle = document.querySelector('.nav-toggle');
        const mainNav = document.querySelector('.main-nav');

        // Thêm sự kiện click
        navToggle.addEventListener('click', () => {
          mainNav.classList.toggle('open'); // bật/tắt class 'open'
        });
      </script>
