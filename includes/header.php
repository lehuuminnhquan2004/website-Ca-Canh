<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$logoFilePath = __DIR__ . '/../images/logo/logo.png';
$logoUrl = './images/logo/logo.png';
if (file_exists($logoFilePath)) {
  $logoUrl .= '?v=' . filemtime($logoFilePath);
} else {
  $logoUrl = './images/icons/icon-zalo.png';
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" href="../images/logo/logo.png">
  <title><?= isset($page_title) ? $page_title : "Cửa hàng cá cảnh" ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> <!-- bắt buộc cho mobile -->
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/header.css">
</head>

<body>
  <header class="site-header">
    <div class="container header-inner">
      <div class="logo">
        <img src="<?= $logoUrl ?>" alt="Cửa hàng cá cảnh">
        <a href="./">Cửa hàng cá cảnh</a>
      </div>


      <!-- Nút menu mobile -->
      <button class="nav-toggle" aria-label="Mở menu điều hướng">
        <span></span>
        <span></span>
        <span></span>
      </button>
      


      <nav class="main-nav">
        <a href="./">Trang chủ</a>
        <div class="nav-dropdown">
          <button type="button" class="dropdown-toggle">Sản phẩm <span class="arrow"></span></button>
          <div class="dropdown-menu">
            <a href="./fishs.php">Cá cảnh</a>
            <a href="./products.php">Phụ kiện cá cảnh</a>
          </div>
        </div>
        <a href="./blog.php">Kiến thức cá cảnh</a>
      </nav>
    </div>
  </header>

  <!-- XỬ LÝ  NÚT HAMBERGU -->
  <script>
        // Lấy nút toggle và menu
    const navToggle = document.querySelector('.nav-toggle');
    const mainNav = document.querySelector('.main-nav');
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

    if (navToggle && mainNav) {
      navToggle.addEventListener('click', () => {
        mainNav.classList.toggle('open');
        navToggle.classList.toggle('active');
      });
    }

    dropdownToggles.forEach(btn => {
      const menu = btn.nextElementSibling;
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        btn.classList.toggle('open');
        if (menu) {
          menu.classList.toggle('show');
        }
      });
    });

    document.addEventListener('click', () => {
      

      dropdownToggles.forEach(btn => {
        const menu = btn.nextElementSibling;
        btn.classList.remove('open');
        if (menu) menu.classList.remove('show');
      });
    });
  </script>


  <main class="container">
