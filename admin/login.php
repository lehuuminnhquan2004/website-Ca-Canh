<?php
session_start();

if (isset($_SESSION['admin_id'])) {
  header("Location: products.php");
    exit;
}
?>
<?php

include __DIR__ . '/../includes/db.php';

$error = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM admins WHERE username='$username' LIMIT 1";
    $res = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($res);

    if ($user && $user['password'] === md5($password)) {
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        header('Location: ./index.php');
        exit;
    } else {
        $error = "Sai tài khoản hoặc mật khẩu";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng nhập admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="login-box">
  <h2>Đăng nhập Admin</h2>
  <?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>
  <form method="post">
    <label>Tài khoản</label>
    <input type="text" name="username" required>
    <label>Mật khẩu</label>
    <input type="password" name="password" required>
    <button type="submit">Đăng nhập</button>
  </form>
</div>
</body>
</html>
