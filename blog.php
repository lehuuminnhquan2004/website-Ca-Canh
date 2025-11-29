<?php
$page_title = "Kiến thức hữu ích";
$page_description = "Blog chia sẻ kinh nghiệm nuôi cá, chăm sóc hồ, xử lý bệnh và setup hồ cá cảnh.";
include __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/header.php';

$res = mysqli_query($conn, "SELECT * FROM blog_posts ORDER BY created_at DESC");
?>
<main class="container">
<link rel="stylesheet" href="./assets/css/blog.css">
<h1 class="blog-title">Kiến thức hữu ích</h1>
<p class="blog-sub">Các bài viết chia sẻ kinh nghiệm nuôi cá, xử lý bệnh và setup hồ đẹp.</p>

<div class="blog-list">
  <?php while ($row = mysqli_fetch_assoc($res)): ?>
  <a class="blog-item" href="blog_detail.php?slug=<?= urlencode($row['slug']) ?>">
    <div class="thumb">
      <img loading="lazy" src="./images/blog/<?= htmlspecialchars($row['thumbnail']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
    </div>
    <div class="info">
      <h3><?= htmlspecialchars($row['title']) ?></h3>
      <p><?= htmlspecialchars(mb_substr($row['summary'], 0, 120)) ?>...</p>
      <span class="more">Xem chi tiết</span>
    </div>
  </a>
  <?php endwhile; ?>
</div>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
