<?php
$page_title = "Kiến thức hữu ích";
include __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/header.php';


// Lấy tất cả bài viết
$res = mysqli_query($conn, "SELECT * FROM blog_posts ORDER BY created_at DESC");
?>
<link rel="stylesheet" href="./assets/css/blog.css">
<h2 class="blog-title">Kiến thức hữu ích</h2>
<p class="blog-sub">Các bài viết chia sẻ kinh nghiệm nuôi cá, xử lý bệnh và setup hồ đẹp.</p>

<div class="blog-list">
  <?php while ($row = mysqli_fetch_assoc($res)): ?>
  <a class="blog-item" href="blog_detail.php?slug=<?= $row['slug'] ?>">
    <div class="thumb">
      <img src="./images/blog/<?= $row['thumbnail'] ?>" alt="<?= $row['title'] ?>">
    </div>
    <div class="info">
      <h3><?= $row['title'] ?></h3>
      <p><?= mb_substr($row['summary'], 0, 120) ?>...</p>
      <span class="more">Xem chi tiết</span>
    </div>
  </a>
  <?php endwhile; ?>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
