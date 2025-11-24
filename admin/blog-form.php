<?php
session_start();
if (empty($_SESSION['admin_id'])) {
    header("Location: /admin/login.php");
    exit;
}

include __DIR__ . '/../includes/db.php';

// Hàm tạo slug
function create_slug($str)
{
    $unicode = [
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd' => 'đ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i' => 'í|ì|ỉ|ĩ|ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ'
    ];

    foreach ($unicode as $nonUnicode => $pattern) {
        $str = preg_replace("/($pattern)/i", $nonUnicode, $str);
    }

    $str = strtolower($str);
    $str = preg_replace('/[^a-z0-9]+/', '-', $str);
    return trim($str, '-');
}


// Kiểm tra xem có đang sửa bài không
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$editing = $id > 0;

// Nếu sửa → lấy dữ liệu
if ($editing) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM blog_posts WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $post = mysqli_stmt_get_result($stmt)->fetch_assoc();

    if (!$post) die("Bài viết không tồn tại!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title   = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $url     = $_POST['url'];
    $slug    = create_slug($title);

    // Upload ảnh
    $thumbnail = $editing ? $post['thumbnail'] : null;

    $uploadDir = __DIR__ . '/../images/blog/';
    if (!empty($_FILES['thumbnail']['name'])) {
        $fileName = time() . "_" . basename($_FILES['thumbnail']['name']);
        $target = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target)) {
            $thumbnail = $fileName;
        } else {
            echo "<p style='color:red'>Lỗi upload ảnh!</p>";
        }
    }


    if ($editing) {
        // Cập nhật
        $stmt = mysqli_prepare(
            $conn,
            "UPDATE blog_posts 
            SET title=?, slug=?, summary=?, content=?, thumbnail=?, url=? 
            WHERE id=?"
        );
        mysqli_stmt_bind_param(
            $stmt,
            "ssssssi",
            $title,
            $slug,
            $summary,
            $content,
            $thumbnail,
            $url,
            $id
        );
    } else {
        // Thêm mới
        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO blog_posts (title, slug, summary, content, thumbnail, url)
     VALUES (?, ?, ?, ?, ?, ?)"
        );
        mysqli_stmt_bind_param(
            $stmt,
            "ssssss",
            $title,
            $slug,
            $summary,
            $content,
            $thumbnail,
            $url
        );
    }

    mysqli_stmt_execute($stmt);
    header("Location: blog-list.php");
    exit;
}

$page_title = $editing ? "Sửa bài viết" : "Thêm bài viết";
include __DIR__ . '/admin-header.php';
?>

<h1><?= $page_title ?></h1>

<form method="POST" enctype="multipart/form-data" class="admin-form">
    <label>Tiêu đề</label>
    <input type="text" name="title" required value="<?= $post['title'] ?? '' ?>">

    <label>Mô tả ngắn</label>
    <textarea name="summary" rows="3"><?= $post['summary'] ?? '' ?></textarea>

    <label>Nội dung</label>
    <textarea name="content" rows="10"><?= $post['content'] ?? '' ?></textarea>

    <label>Ảnh Thumbnail</label>
    <?php if ($editing && $post['thumbnail']): ?>
        <img src="../images/blog/<?= $post['thumbnail'] ?>" style="max-width:150px;">
    <?php endif; ?>
    <input type="file" name="thumbnail">
    <label>URL video Youtube</label>
    <input type="text" name="url" value="<?= $post['url'] ?? '' ?>">


    <button class="btn" type="submit">Lưu bài viết</button>
</form>
