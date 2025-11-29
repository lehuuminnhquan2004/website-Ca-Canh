<?php
include __DIR__ . '/includes/db.php';

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
$page_description = trim($blog['summary'] ?? $blog['title']);
include __DIR__ . '/includes/header.php';
?>

<main class="container">
<link rel="stylesheet" href="./assets/css/blog.css">
<article class="blog-detail">
  <h1><?= htmlspecialchars($blog['title']) ?></h1>
  <p class="date">Ngày đăng: <?= date("d/m/Y", strtotime($blog['created_at'])) ?></p>

  <?php if (!empty($blog['thumbnail'])): ?>
      <img class="thumb-detail" src="./images/blog/<?= htmlspecialchars($blog['thumbnail']) ?>" alt="<?= htmlspecialchars($blog['title']) ?>">
  <?php endif; ?>

  <div class="content">
    <?php
      $allowedTags = '<p><br><br/><ul><ol><li><h2><h3><h4><strong><b><em><i><a>';
      $contentSafe = strip_tags($blog['content'], $allowedTags);
      echo $contentSafe;
    ?>
  </div>

  <?php if (!empty($blog['url'])): ?>
      <?php
          function youtube_id($url) {
            $pattern = '%(?:youtube(?:-nocookie)?\\.com/(?:[^/]+/.+/|(?:v|embed|shorts|live)/|.*[?&]v=)|youtu\\.be/)([A-Za-z0-9_-]{6,})%';
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
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
    <a class="btn" href="blog.php">&#8592; Quay lại</a>
  </p>
</article>

<?php
  $thumbUrl = !empty($blog['thumbnail']) ? "./images/blog/" . $blog['thumbnail'] : '';
  $canonical = ($_SERVER['HTTP_HOST'] ?? '') ? (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) : '';
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "<?= htmlspecialchars($blog['title']) ?>",
  "description": "<?= htmlspecialchars($page_description) ?>",
  "datePublished": "<?= htmlspecialchars($blog['created_at']) ?>",
  <?php if ($thumbUrl): ?>
  "image": "<?= htmlspecialchars($thumbUrl) ?>",
  <?php endif; ?>
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?= htmlspecialchars($canonical) ?>"
  }
}
</script>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
