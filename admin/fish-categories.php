<?php
session_start();
if (empty($_SESSION['admin_id'])) {
    header("Location: /admin/login.php");
    exit;
}
include __DIR__ . '/../includes/db.php';
$configPath = __DIR__ . '/../includes/site-config.json';
$config = ['fish_categories_order' => []];
if (file_exists($configPath)) {
    $loaded = json_decode(file_get_contents($configPath), true);
    if (is_array($loaded)) {
        $config = array_merge($config, $loaded);
    }
}
$orderSaved = false;

// Lưu thứ tự kéo thả
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_ids'])) {
    $ids = array_filter(array_map('intval', explode(',', $_POST['order_ids'])), fn($v) => $v > 0);
    $config['fish_categories_order'] = array_values(array_unique($ids));
    file_put_contents(
        $configPath,
        json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
    $orderSaved = true;
}

// Xóa danh mục
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    mysqli_query($conn, "DELETE FROM fish_categories WHERE id=$id");
    header("Location: ./fish-categories.php");
    exit;
}

// Lấy giá trị tìm kiếm nếu có
$searchKeyword = isset($_GET['search']) ? trim($_GET['search']) : '';

// Lấy danh sách danh mục
$sql = "SELECT * FROM fish_categories WHERE 1";
if ($searchKeyword !== '') {
    $searchEscaped = mysqli_real_escape_string($conn, $searchKeyword);
    $sql .= " AND name LIKE '%$searchEscaped%'";
}
$orderList = $config['fish_categories_order'] ?? [];
if (!empty($orderList)) {
    $orderIds = implode(',', array_map('intval', $orderList));
    $sql .= " ORDER BY FIELD(id, $orderIds), name ASC";
} else {
    $sql .= " ORDER BY name ASC";
}

$res = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý danh mục cá</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    .drag-hint { font-size: 18px; cursor: grab; user-select: none; opacity: 0.6; }
    tr.dragging { background: #f0f7ff; }
    .table th, .table td { vertical-align: middle; }
    .order-note { font-size: 13px; color: #555; margin: 6px 0; }
  </style>
</head>
<body>
  
<?php include __DIR__ . '/admin-header.php'; ?>

<div class="container">
  <div style="margin-bottom:10px; display:flex; justify-content:space-between; flex-wrap:wrap;">
    <a class="btn" href="./fish-category-form.php">+ Thêm danh mục cá</a>
    <form method="get" style="display:flex; gap:5px;">
      <input type="text" name="search" placeholder="Tìm theo tên..." value="<?= htmlspecialchars($searchKeyword) ?>">
      <button type="submit" class="btn">Tìm</button>
      <?php if ($searchKeyword !== ''): ?>
        <a href="./fish-categories.php" class="btn">Reset</a>
      <?php endif; ?>
    </form>
  </div>

  <?php if ($orderSaved): ?>
    <p style="color:green;">Đã lưu thứ tự danh mục cá.</p>
  <?php endif; ?>
  <p class="order-note">Kéo thả cột "↕" để sắp xếp thứ tự danh mục hiển thị, sau đó bấm "Lưu thứ tự".</p>

  <form method="post" id="orderForm">
    <input type="hidden" name="order_ids" id="orderInput" value="">
  <div class="table-wrapper">
    <table class="table">
      <tr>
        <th style="width:50px;">↕</th>
        <th>ID</th>
        <th>Tên danh mục</th>
        <th>Slug</th>
        <th>Hành động</th>
      </tr>
      <?php if(mysqli_num_rows($res) === 0): ?>
        <tr>
          <td colspan="5">Không tìm thấy danh mục nào.</td>
        </tr>
      <?php else: ?>
        <?php while ($row = mysqli_fetch_assoc($res)) : ?>
          <tr draggable="true" data-id="<?= $row['id'] ?>">
            <td class="drag-hint">⋮⋮</td>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['slug']) ?></td>
            <td>
              <a href="./fish-category-form.php?id=<?= $row['id'] ?>">Sửa</a> |
              <a href="./fish-categories.php?delete=<?= $row['id'] ?>"
                 onclick="return confirm('Xóa danh mục này?');">Xóa</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php endif; ?>
    </table>
  </div>

    <div style="margin-top:10px;">
      <button type="submit" class="btn">Lưu thứ tự</button>
    </div>
  </form>
</div>
<script>
(() => {
  const rows = Array.from(document.querySelectorAll('table.table tbody tr[draggable]'));
  const orderInput = document.getElementById('orderInput');
  let dragSrc = null;

  const updateOrder = () => {
    const ids = Array.from(document.querySelectorAll('table.table tbody tr[draggable]')).map(r => r.dataset.id);
    orderInput.value = ids.join(',');
  };
  updateOrder();

  rows.forEach(row => {
    row.addEventListener('dragstart', (e) => {
      dragSrc = row;
      row.classList.add('dragging');
      e.dataTransfer.effectAllowed = 'move';
    });
    row.addEventListener('dragend', () => {
      row.classList.remove('dragging');
      dragSrc = null;
      updateOrder();
    });
    row.addEventListener('dragover', (e) => {
      e.preventDefault();
      const target = e.currentTarget;
      if (!dragSrc || dragSrc === target) return;
      const tbody = target.parentNode;
      const bounding = target.getBoundingClientRect();
      const offset = e.clientY - bounding.top;
      const half = bounding.height / 2;
      if (offset > half) {
        tbody.insertBefore(dragSrc, target.nextSibling);
      } else {
        tbody.insertBefore(dragSrc, target);
      }
    });
  });
})();
</script>
</body>
</html>
