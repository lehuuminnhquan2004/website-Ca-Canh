<link rel="stylesheet" href="./assets/css/blog.css">

<?php
include __DIR__ . '/includes/db.php';

// Nhận slug
$slug = $_GET['slug'] ?? '';

$stmt = mysqli_prepare($conn, "SELECT * FROM blog_posts WHERE slug = ?");
mysqli_stmt_bind_param($stmt, "s", $slug);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$blog = mysqli_fetch_assoc($result);

if (!$blog) {
    die("Bài viết không tồn tại!");
}

$page_title = $blog['title'];
include __DIR__ . '/includes/header.php';
?>

<article class="blog-detail">
  <h1><?= $blog['title'] ?></h1>
  <p class="date">Ngày đăng: <?= date("d/m/Y", strtotime($blog['created_at'])) ?></p>

  <?php if (!empty($blog['thumbnail'])): ?>
      <img class="thumb-detail" src="./images/blog/<?= $blog['thumbnail'] ?>" alt="<?= $blog['title'] ?>">
  <?php endif; ?>

  

  <div class="content">
    <?= nl2br($blog['content']) ?>
  </div>


  <!-- Hiển thị video nếu có URL -->
  <?php if (!empty($blog['url'])): ?>
      <?php
          // Tách VIDEO ID từ URL YouTube
          function youtube_id($url) {
            $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|embed|shorts|live)/|.*[?&]v=)|youtu\.be/)([A-Za-z0-9_-]{6,})%';
        
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];   // <— matches có dữ liệu ở đây
            }
        
            return '';
        }
        
        
          $video_id = youtube_id($blog['url']);
      ?>
      
      <?php if (!empty($video_id)): ?>
        <h4>VIDEO HƯỚNG DẪN CHI TIẾT </h4>
          <div class="youtube-video">
              <iframe width="100%" height="315"
                      src="https://www.youtube.com/embed/<?= $video_id ?>"
                      frameborder="0"
                      allowfullscreen>
              </iframe>
          </div>
      <?php endif; ?>
  <?php endif; ?>  
  <p>
    <a class="btn" href="blog.php">⬅ Quay lại</a>
  </p>
</article>


<?php include __DIR__ . '/includes/footer.php'; ?>
