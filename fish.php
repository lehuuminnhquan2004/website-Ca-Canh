<?php
include __DIR__ . '/includes/db.php';

$slug = $_GET['slug'] ?? '';
$id   = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($slug) {
  $stmt = mysqli_prepare(
    $conn,
    "SELECT f.*, c.name AS category_name 
         FROM fishs f 
         LEFT JOIN fish_categories c ON c.id = f.category_id
         WHERE f.slug = ? LIMIT 1"
  );
  mysqli_stmt_bind_param($stmt, "s", $slug);
} elseif ($id > 0) {
  $stmt = mysqli_prepare(
    $conn,
    "SELECT f.*, c.name AS category_name 
         FROM fishs f 
         LEFT JOIN fish_categories c ON c.id = f.category_id
         WHERE f.id = ? LIMIT 1"
  );
  mysqli_stmt_bind_param($stmt, "i", $id);
} else {
  die("Cá không tồn tại.");
}

mysqli_stmt_execute($stmt);
$product = mysqli_stmt_get_result($stmt)->fetch_assoc();

if (!$product) {
  die("Cá không tồn tại.");
}

$page_title = $product['name'];
include __DIR__ . '/includes/header.php';

$imgFile = $product['thumbnail'] ?: ($product['image'] ?? '');
if ($imgFile && !preg_match('#^https?://#', $imgFile) && str_starts_with($imgFile, '/') === false) {
  if (!str_starts_with($imgFile, './')) {
    $imgFile = './' . ltrim($imgFile, '/');
  }
}
$imgSrc = $imgFile ?: './images/logo/logo.png';

$shortDesc = trim($product['short_description'] ?? '');
$desc = trim($product['description'] ?? '');
$inactive = (int)($product['status'] ?? 1) === 0;

// Lấy số điện thoại từ cấu hình (nếu có)
$configPath = __DIR__ . '/includes/site-config.json';
$hotline = '';
if (file_exists($configPath)) {
  $cfg = json_decode(file_get_contents($configPath), true);
  if (!empty($cfg['phone'])) {
    $hotline = $cfg['phone'];
  }
}
$telHref = $hotline ? 'tel:' . preg_replace('/[^0-9+]/', '', $hotline) : '#';
?>

<link rel="stylesheet" href="./assets/css/product-detail.css">

<section class="product-detail container">
  <div class="pd-gallery">
    <img src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
  </div>

  <div class="pd-info">
    <p class="pd-breadcrumb">
      <a href="./fishs.php">Cá cảnh</a>
      <?php if (!empty($product['category_name'])): ?>
        <span> / </span>
        <span><?= htmlspecialchars($product['category_name']) ?></span>
      <?php endif; ?>
    </p>

    <h1><?= htmlspecialchars($product['name']) ?></h1>
    <p class="pd-price">
      <?= number_format((int)$product['price'], 0, ',', '.') ?> đ
      <?php if ($inactive): ?><span class="badge-out-of-stock">Tạm hết hàng</span><?php endif; ?>
    </p>

    <?php if ($shortDesc !== ''): ?>
      <div class="pd-shortdesc"><?= nl2br(htmlspecialchars($shortDesc)) ?></div>
    <?php endif; ?>

    <?php
    $config = [
      'phone' => '0328421191',
      'zalo' => '0328421191',
      'messenger' => '#',
      'facebook' => '#'
    ];
    if (file_exists($configPath)) {
      $loaded = json_decode(file_get_contents($configPath), true);
      if (is_array($loaded)) {
        $config = array_merge($config, $loaded);
      }
    }

    $phone = trim($config['phone']);
    $telHref = 'tel:' . preg_replace('/[^0-9+]/', '', $phone);

    $zaloRaw = trim($config['zalo']);
    if ($zaloRaw === '') {
      $zaloLink = '#';
    } elseif (preg_match('#^https?://#i', $zaloRaw)) {
      $zaloLink = $zaloRaw;
    } elseif (preg_match('#^zalo\.me#i', $zaloRaw)) {
      $zaloLink = 'https://' . $zaloRaw;
    } else {
      $zaloLink = 'https://zalo.me/' . $zaloRaw;
    }

    $messengerLink = trim($config['messenger']) ?: '#';
    $facebookLink = trim($config['facebook']) ?: '#';
    ?>


    <div class="pd-actions">
      <span class="pd-contact-label">Liên hệ đặt hàng:</span>
      <div class="lienhe">
        <a href="<?= htmlspecialchars($telHref) ?>" class="contact-btn call">
          <i class="fa fa-phone"></i>
        </a>

        <a href="<?= htmlspecialchars($zaloLink) ?>" target="_blank" class="contact-btn zalo">
          <i class=""><img src="./images/icons/icon-zalo.png" alt="Zalo"></i>
        </a>

        <a href="<?= htmlspecialchars($messengerLink) ?>" target="_blank" class="contact-btn messenger">
          <i class="fa-brands fa-facebook-messenger"></i>
        </a>

        <a href="<?= htmlspecialchars($facebookLink) ?>" target="_blank" class="contact-btn facebook">
          <i class="fa-brands fa-facebook"></i>
        </a>
      </div>
    </div>
  </div>
</section>

<section class="product-description container">
  <h2>Mô tả sản phẩm</h2>
  <?php if ($desc === ''): ?>
    <p>Chưa có mô tả cho sản phẩm này.</p>
  <?php else: ?>
    <div class="pd-content">
      <?= nl2br(htmlspecialchars($desc)) ?>
    </div>
  <?php endif; ?>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
