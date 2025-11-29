<?php
$page_title = "Trang chủ - Cá cảnh Q8 Aquarium Coffee";
$page_description = "Cá cảnh Q8 Aquarium Coffee, cá cảnh - phụ kiện hồ cá, tư vấn chăm sóc cá cảnh, kinh nghiệm nuôi cá tại nhà.";
include __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/banner.php';

// Đọc cấu hình sản phẩm nổi bật
$configPath = __DIR__ . '/includes/site-config.json';
$featuredIds = [];
$featuredFishIds = [];
$cfg = [];
if (file_exists($configPath)) {
    $cfg = json_decode(file_get_contents($configPath), true);
    if (!empty($cfg['featured_products']) && is_array($cfg['featured_products'])) {
        $featuredIds = array_values(array_unique(array_map('intval', $cfg['featured_products'])));
    }
    if (!empty($cfg['featured_fish']) && is_array($cfg['featured_fish'])) {
        $featuredFishIds = array_values(array_unique(array_map('intval', $cfg['featured_fish'])));
    }
}

// Lấy danh sách sản phẩm cho mục "Sản phẩm mới"
if (!empty($featuredIds)) {
    $idList = implode(',', $featuredIds);
    $productRes = mysqli_query(
        $conn,
        "SELECT * FROM products WHERE id IN ($idList) ORDER BY FIELD(id, $idList)"
    );
} else {
    $productRes = mysqli_query($conn, "SELECT * FROM products ORDER BY created_at DESC LIMIT 6");
}
$products = [];
if ($productRes) {
    while ($row = mysqli_fetch_assoc($productRes)) {
        $products[] = $row;
    }
}

// Lấy danh sách cá cho mục "Cá cảnh mới"
if (!empty($featuredFishIds)) {
    $fishIdList = implode(',', $featuredFishIds);
    $fishRes = mysqli_query(
        $conn,
        "SELECT * FROM fishs WHERE id IN ($fishIdList) ORDER BY FIELD(id, $fishIdList)"
    );
} else {
    $fishRes = mysqli_query($conn, "SELECT * FROM fishs ORDER BY created_at DESC LIMIT 6");
}
$fishList = [];
if ($fishRes) {
    while ($row = mysqli_fetch_assoc($fishRes)) {
        $fishList[] = $row;
    }
}

// Lấy 3 bài viết mới nhất
$blogRes = mysqli_query($conn, "SELECT * FROM blog_posts ORDER BY created_at DESC LIMIT 3");
$blogs = [];
if ($blogRes) {
    while ($row = mysqli_fetch_assoc($blogRes)) {
        $blogs[] = $row;
    }
}
?>

<main class="container">
<h1 class="page-title">Cửa hàng cá cảnh Quận 8 Aquarium Coffee</h1>
<p class="page-intro">Chọn lọc cá cảnh đẹp, tư vấn setup hồ cá và chăm sóc cá cảnh miễn phí tại nhà.</p>

<section class="sanphammoi fish-section">
  <h2>Cá cảnh mới</h2>
  <?php if (empty($fishList)): ?>
    <p>Chưa có cá cảnh.</p>
  <?php else: ?>
    <div class="product-grid-wrapper">
      <button class="nav-arrow prev" type="button" aria-label="Xem trước">&#8249;</button>
      <div class="product-grid">
        <?php foreach ($fishList as $row): ?>
          <?php
            $imgFile = !empty($row['image']) ? $row['image'] : ($row['thumbnail'] ?? '');
            $imgSrc = $imgFile ? $imgFile : "./images/logo/logo.png";
          ?>
          <a class="product-card" href="fish.php?slug=<?= urlencode($row['slug']) ?>">
            <div class="thumb">
              <img loading="lazy" src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
            </div>
            <div class="info">
              <h3><?= htmlspecialchars($row['name']) ?></h3>
              <p class="price"><?= number_format($row['price'], 0, ',', '.') ?> VND</p>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
      <button class="nav-arrow next" type="button" aria-label="Xem tiếp">&#8250;</button>
    </div>
  <?php endif; ?>

  <p style="text-align: center; margin-top: 20px; margin-bottom: 40px;">
    <a class="button-outline primary" href="fishs.php">Xem tất cả cá cảnh</a>
  </p>
</section>

<section class="sanphammoi product-section">
  <h2>Phụ kiện cá cảnh mới</h2>
  <?php if (empty($products)): ?>
    <p>Chưa có sản phẩm.</p>
  <?php else: ?>
    <div class="product-grid-wrapper">
      <button class="nav-arrow prev" type="button" aria-label="Xem trước">&#8249;</button>
      <div class="product-grid">
        <?php foreach ($products as $row): ?>
          <?php
            $imgFile = !empty($row['image']) ? $row['image'] : ($row['thumbnail'] ?? '');
            $imgSrc = $imgFile ? $imgFile : "./images/logo/logo.png";
          ?>
          <a class="product-card" href="product.php?slug=<?= urlencode($row['slug']) ?>">
            <div class="thumb">
              <img loading="lazy" src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
            </div>
            <div class="info">
              <h3><?= htmlspecialchars($row['name']) ?></h3>
              <p class="price"><?= number_format($row['price'], 0, ',', '.') ?> VND</p>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
      <button class="nav-arrow next" type="button" aria-label="Xem tiếp">&#8250;</button>
    </div>
  <?php endif; ?>

  <p style="text-align: center; margin-top: 20px;">
    <a class="button-outline primary" href="products.php">Xem tất cả phụ kiện</a>
  </p>
</section>

<section class="knowledge-section">
  <h2>Kiến thức hữu ích</h2>
  <p class="sub">Tổng hợp bài viết hướng dẫn nuôi cá, chăm sóc hồ, xử lý bệnh, setup thủy sinh...</p>

  <div class="knowledge-grid">
    <?php if (empty($blogs)): ?>
      <p>Chưa có bài viết.</p>
    <?php else: ?>
      <?php foreach ($blogs as $row): ?>
        <?php
          $thumbFile = !empty($row['thumbnail']) ? $row['thumbnail'] : '';
          $thumbSrc = $thumbFile ? "./images/blog/" . $thumbFile : "./images/icons/icon-zalo.png";
          $summary = trim($row['summary']);
          if (mb_strlen($summary) > 90) {
              $summary = mb_substr($summary, 0, 90) . '...';
          }
        ?>
        <a class="knowledge-card" href="blog_detail.php?slug=<?= urlencode($row['slug']) ?>">
          <div class="thumb">
            <img loading="lazy" src="<?= htmlspecialchars($thumbSrc) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
          </div>
          <div class="info">
            <h3><?= htmlspecialchars($row['title']) ?></h3>
            <p><?= htmlspecialchars($summary) ?></p>
          </div>
        </a>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <p style="text-align: center; margin-top: 20px;">
    <a class="button-outline primary" href="blog.php">Xem tất cả bài viết</a>
  </p>
</section>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Cửa hàng cá cảnh Q8",
  "url": "<?= htmlspecialchars($canonical ?? '') ?>",
  "logo": "/images/logo/logo.png",
  "sameAs": [
    "<?= htmlspecialchars($cfg['facebook'] ?? '#') ?>",
    "<?= htmlspecialchars($cfg['youtube'] ?? '#') ?>"
  ]
}
</script>
<script>
(() => {
  document.querySelectorAll('.product-grid-wrapper').forEach(wrapper => {
    const box = wrapper.querySelector('.product-grid');
    const prevBtn = wrapper.querySelector('.nav-arrow.prev');
    const nextBtn = wrapper.querySelector('.nav-arrow.next');
    if (!box || !prevBtn || !nextBtn) return;

    const step = () => (box.querySelector('.product-card')?.offsetWidth || 260) + 16;

    prevBtn.addEventListener('click', () => {
      box.scrollBy({ left: -step(), behavior: 'smooth' });
    });
    nextBtn.addEventListener('click', () => {
      box.scrollBy({ left: step(), behavior: 'smooth' });
    });
  });
})();
</script>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
</main>
