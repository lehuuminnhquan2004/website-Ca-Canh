<link rel="stylesheet" href="./assets/blog-list.css">


<?php
session_start();
if (empty($_SESSION['admin_id'])) {
    header("Location: /admin/login.php");
    exit;
}

include __DIR__ . '/../includes/db.php';
$page_title = "Quản lý bài viết";
include __DIR__ . '/admin-header.php';

// Xóa bài viết (kèm ảnh)
if (isset($_GET['delete'])) {
    $deleteId = (int) $_GET['delete'];
    if ($deleteId > 0) {
        $stmt = mysqli_prepare($conn, "SELECT thumbnail FROM blog_posts WHERE id=? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $deleteId);
        mysqli_stmt_execute($stmt);
        $thumb = mysqli_stmt_get_result($stmt)->fetch_assoc();

        $del = mysqli_prepare($conn, "DELETE FROM blog_posts WHERE id=?");
        mysqli_stmt_bind_param($del, "i", $deleteId);
        mysqli_stmt_execute($del);

        if ($thumb && !empty($thumb['thumbnail'])) {
            $file = __DIR__ . '/../images/blog/' . $thumb['thumbnail'];
            if (file_exists($file)) {
                @unlink($file);
            }
        }
        header("Location: blog-list.php");
        exit;
    }
}

// Lấy toàn bộ bài viết
$res = mysqli_query($conn, "SELECT * FROM blog_posts ORDER BY created_at DESC");
?>

<div class="admin-header">
  <h1>Quản lý bài viết</h1>
  <a class="btn" href="blog-form.php">+ Thêm bài viết</a>
</div>

<div class="table-wrapper">
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Ảnh</th>
        <th>Tiêu đề</th>
        <th>Slug</th>
        <th>Ngày tạo</th>
        <th>Hành động</th>
      </tr>
    </thead>

    <tbody>
    <?php while ($row = mysqli_fetch_assoc($res)) : ?>
      <tr>
        <td data-label="ID"><?= $row['id'] ?></td>
        
        <td data-label="Ảnh">
          <?php if ($row['thumbnail']): ?>
            <img src="../images/blog/<?= $row['thumbnail'] ?>" style="max-width: 100px;">
          <?php else: ?> N/A <?php endif; ?>
        </td>

        <td data-label="Tiêu đề"><?= htmlspecialchars($row['title']) ?></td>
        <td data-label="Slug"><?= htmlspecialchars($row['slug']) ?></td>
        <td data-label="Ngày tạo"><?= $row['created_at'] ?></td>

        <td data-label="Hành động">
          <a href="blog-form.php?id=<?= $row['id'] ?>">Sửa</a>
          <a href="blog-list.php?delete=<?= $row['id'] ?>"
             onclick="return confirm('Xóa bài viết này?')">Xóa</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div>



