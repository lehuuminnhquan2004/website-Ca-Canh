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

// Basic SEO meta
$siteName = 'Cá cảnh Q8 Aquarium Coffee';
$pageTitle = isset($page_title) ? $page_title : $siteName;
$pageDesc = isset($page_description) && $page_description !== ''
  ? $page_description
  : 'Cửa hàng cá cảnh Quận 8 Aquarium Coffee - Nơi cung cấp cá cảnh và phụ kiện cá cảnh chất lượng cao với giá cả hợp lý. Tư vấn chăm sóc cá cảnh tận tình. Giao hàng toàn quốc.';

// Canonical
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? '';
$uri  = strtok($_SERVER['REQUEST_URI'] ?? '', '#');
$canonical = ($host && $uri) ? $scheme . '://' . $host . $uri : '';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" href="/images/logo/logo.png">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="description" content="<?= htmlspecialchars($pageDesc) ?>">
  <?php if ($canonical): ?>
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
  <?php endif; ?>
  <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($pageDesc) ?>">
  <meta property="og:image" content="<?= htmlspecialchars(str_replace('./', '/', $logoUrl)) ?>">
  <meta property="og:type" content="website">
  <?php if ($canonical): ?>
    <meta property="og:url" content="<?= htmlspecialchars($canonical) ?>">
  <?php endif; ?>
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle) ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($pageDesc) ?>">
  <meta name="twitter:image" content="<?= htmlspecialchars(str_replace('./', '/', $logoUrl)) ?>">
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/header.css">
</head>

<body>
  <header class="site-header">
    <div class="container header-inner">
      <div class="logo">
        <img src="<?= $logoUrl ?>" alt="Cá cảnh Q8 Aquarium Coffee">
        <a href="./">Cá cảnh Q8 Aquarium Coffee</a>
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
        <a href="./about.php">Giới thiệu</a>
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

