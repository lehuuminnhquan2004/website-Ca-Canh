<?php
session_start();
if (empty($_SESSION['admin_id'])) {
    header("Location: ./login.php");
    exit;
}

include __DIR__ . '/../includes/db.php';

$configPath = __DIR__ . '/../includes/site-config.json';
$config = [
    'phone' => '0328421191',
    'zalo' => '0328421191',
    'messenger' => 'https://m.me/yourpage',
    'facebook' => 'https://facebook.com/yourpage',
    'tiktok' => '',
    'youtube' => '',
    'featured_products' => [],
    'banners' => []
];

if (file_exists($configPath)) {
    $loaded = json_decode(file_get_contents($configPath), true);
    if (is_array($loaded)) {
        $config = array_merge($config, $loaded);
    }
}

$featuredSelected = [];
if (!empty($config['featured_products']) && is_array($config['featured_products'])) {
    $featuredSelected = array_map('intval', $config['featured_products']);
}

$featuredInput = implode(', ', $featuredSelected);

$uploadDir = __DIR__ . '/../images/logo/';
$logoFile = $uploadDir . 'logo.png';
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $config['phone'] = trim($_POST['phone'] ?? '');
    $config['zalo'] = trim($_POST['zalo'] ?? '');
    $config['messenger'] = trim($_POST['messenger'] ?? '');
    $config['facebook'] = trim($_POST['facebook'] ?? '');
    $config['tiktok'] = trim($_POST['tiktok'] ?? '');
    $config['youtube'] = trim($_POST['youtube'] ?? '');
    $featuredInput = trim($_POST['featured_ids'] ?? '');
    $config['featured_products'] = [];

    if ($featuredInput !== '') {
        $parts = preg_split('/[\\s,;]+/', $featuredInput);
        foreach ($parts as $p) {
            $id = (int) $p;
            if ($id > 0 && !in_array($id, $config['featured_products'], true)) {
                $config['featured_products'][] = $id;
            }
        }
        $featuredSelected = $config['featured_products'];
    }

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    if (isset($_FILES['logo']) && $_FILES['logo']['error'] !== UPLOAD_ERR_NO_FILE) {
        if ($_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $tmp = $_FILES['logo']['tmp_name'];
            $mime = mime_content_type($tmp);
            if ($mime !== 'image/png') {
                $error = 'Logo phải là file PNG.';
            } else {
                if (!move_uploaded_file($tmp, $logoFile)) {
                    $error = 'Không thể lưu logo, vui lòng thử lại.';
                }
            }
        } else {
            $error = 'Upload logo bị lỗi, vui lòng thử lại.';
        }
    }

    if (!$error) {
        file_put_contents(
            $configPath,
            json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
        $success = 'Đã lưu cấu hình.';
    }
}

$currentLogo = file_exists($logoFile) ? '../images/logo/logo.png?v=' . filemtime($logoFile) : null;
$page_title = 'Cấu hình website';
include __DIR__ . '/admin-header.php';
?>

<div class="container" style="padding:20px 16px; max-width:800px;">
    <h2 style="margin-bottom:15px;">Cấu hình logo và liên hệ</h2>

    <?php if ($success): ?>
        <p style="color:green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>
    <?php if ($error): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if ($currentLogo): ?>
        <div style="margin-bottom:15px;">
            <p>Logo hiện tại:</p>
            <img src="<?= $currentLogo ?>" alt="Logo hiện tại" style="max-height:100px;">
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:12px;">
        <label for="logo">Logo (PNG):</label>
        <input type="file" name="logo" id="logo" accept="image/png">

        <label for="phone">Số điện thoại (dùng cho nút gọi):</label>
        <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($config['phone']) ?>" >

        <label for="zalo">Zalo (điền số hoặc link zalo.me):</label>
        <input type="text" id="zalo" name="zalo" value="<?= htmlspecialchars($config['zalo']) ?>" >

        <label for="messenger">Messenger (link m.me hoặc inbox):</label>
        <input type="text" id="messenger" name="messenger" value="<?= htmlspecialchars($config['messenger']) ?>" >

        <label for="facebook">Facebook (link fanpage/profile):</label>
        <input type="text" id="facebook" name="facebook" value="<?= htmlspecialchars($config['facebook']) ?>" >
        <label for="tiktok">Tiktok (link kênh tiktok):</label>
        <input type="text" id="tiktok" name="tiktok" value="<?= htmlspecialchars($config['tiktok']) ?>" >
        <label for="youtube">Youtube (link kênh youtube):</label>
        <input type="text" id="youtube" name="youtube" value="<?= htmlspecialchars($config['youtube']) ?>" >

        <div style="border:1px solid #eee; padding:10px; border-radius:6px;">
            <p style="margin:0 0 8px 0; font-weight:bold;">Nhập ID sản phẩm cho mục "Sản phẩm mới" (cách nhau bởi dấu phẩy hoặc khoảng trắng):</p>
            <input type="text" name="featured_ids" value="<?= htmlspecialchars($featuredInput) ?>" placeholder="ví dụ: 12, 5, 9">
            <small>Thứ tự ID bạn nhập sẽ là thứ tự hiển thị. Để trống sẽ tự lấy 6 sản phẩm mới nhất.</small>
        </div>

        <button type="submit" class="btn">Lưu cấu hình</button>
    </form>
</div>
