<?php
$page_title = "Sản phẩm - Cửa hàng cá cảnh";
include __DIR__ . '/includes/db.php';
include __DIR__ . '/includes/header.php';

// Đọc cấu hình thứ tự danh mục
$configPath = __DIR__ . '/includes/site-config.json';
$catOrder = [];
if (file_exists($configPath)) {
    $cfg = json_decode(file_get_contents($configPath), true);
    if (!empty($cfg['categories_order']) && is_array($cfg['categories_order'])) {
        $catOrder = array_map('intval', $cfg['categories_order']);
    }
}

// Lấy danh sách danh mục
$sql_categories = "SELECT * FROM categories";
if (!empty($catOrder)) {
    $orderIds = implode(',', $catOrder);
    $sql_categories .= " ORDER BY FIELD(id, $orderIds), name ASC";
} else {
    $sql_categories .= " ORDER BY name ASC";
}
$cat_res = mysqli_query($conn, $sql_categories);
$categories = [];
while ($row = mysqli_fetch_assoc($cat_res)) {
    $categories[] = $row;
}

// --- Lấy danh mục được chọn ---
$selectedCategoryId = isset($_GET['category_id']) ? (int) $_GET['category_id'] : 0;

// Lấy tên danh mục được chọn
$selectedCategoryName = '';
if ($selectedCategoryId > 0) {
    foreach ($categories as $c) {
        if ((int)$c['id'] === $selectedCategoryId) {
            $selectedCategoryName = $c['name'];
            break;
        }
    }
}

// Tìm kiếm theo tên
$searchKeyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

// Sắp xếp
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
$sortLabels = [
    'newest' => 'Mới nhất',
    'price_asc' => 'Giá tăng dần',
    'price_desc' => 'Giá giảm dần',
    'name_asc' => 'Tên A -> Z',
    'name_desc' => 'Tên Z -> A',
];
$sortText = $sortLabels[$sortOption] ?? $sortLabels['newest'];

// PHÂN TRANG
$perPage = 20;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $perPage;

// Base query (dùng lại cho đếm)
$baseWhere = "WHERE 1";

// Lọc theo danh mục
if ($selectedCategoryId > 0) {
    $baseWhere .= " AND category_id = $selectedCategoryId";
}

// Tìm kiếm theo tên
if ($searchKeyword !== '') {
    $keywordEscaped = mysqli_real_escape_string($conn, $searchKeyword);
    $baseWhere .= " AND name LIKE '%$keywordEscaped%'";
}

// Sắp xếp (ưu tiên status=1 lên trước)
$orderClauses = ["status DESC"];
switch ($sortOption) {
    case 'price_asc':
        $orderClauses[] = "price ASC";
        break;
    case 'price_desc':
        $orderClauses[] = "price DESC";
        break;
    case 'name_asc':
        $orderClauses[] = "name ASC";
        break;
    case 'name_desc':
        $orderClauses[] = "name DESC";
        break;
    default: // newest
        $orderClauses[] = "created_at DESC";
        break;
}

// Đếm tổng
$countSql = "SELECT COUNT(*) AS total FROM products $baseWhere";
$totalRows = (int)mysqli_fetch_assoc(mysqli_query($conn, $countSql))['total'];
$totalPages = max(1, (int)ceil($totalRows / $perPage));
if ($page > $totalPages) {
    $page = $totalPages;
    $offset = ($page - 1) * $perPage;
}
$buildPageLink = function($pageNum) {
    $params = $_GET;
    $params['page'] = $pageNum;
    return '?' . http_build_query($params);
};

// Lấy sản phẩm
$sql_products = "SELECT * FROM products $baseWhere ORDER BY " . implode(', ', $orderClauses) . " LIMIT $perPage OFFSET $offset";

$prod_res = mysqli_query($conn, $sql_products);
$products = [];
while ($p = mysqli_fetch_assoc($prod_res)) {
    $products[] = $p;
}
?>

<h2>Sản phẩm</h2>
<link rel="stylesheet" href="./assets/css/products.css">

<div class="filter-box">
  <form method="get" id="filterForm">
    <div class="form-loc">
        <div class="timkiem">
            <!-- Tìm kiếm -->
            <input 
            type="text" 
            name="keyword" 
            placeholder="Tìm sản phẩm..." 
            value="<?= htmlspecialchars($searchKeyword) ?>"
            >
        </div>

        <!-- Chọn danh mục -->
        <div class="chondanhmuc custom-select" data-field="category_id">
            <input type="hidden" name="category_id" value="<?= $selectedCategoryId ?>">
            <div class="select-selected">
                <span class="select-text">
                    <?= $selectedCategoryId > 0 ? htmlspecialchars($selectedCategoryName) : 'Tất cả danh mục' ?>
                </span>
                <span class="select-arrow">▼</span>
            </div>
            <div class="select-items">
                <div data-value="0" <?= $selectedCategoryId === 0 ? 'class="active"' : '' ?>>Tất cả danh mục</div>
                <?php foreach ($categories as $cat): ?>
                    <div 
                        data-value="<?= $cat['id'] ?>" 
                        <?= ($selectedCategoryId == $cat['id']) ? 'class="active"' : '' ?>
                    >
                        <?= htmlspecialchars($cat['name']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Sắp xếp -->
        <div class="sapxep custom-select" data-field="sort">
            <input type="hidden" name="sort" value="<?= htmlspecialchars($sortOption) ?>">
            <div class="select-selected">
                <span class="select-text"><?= $sortText ?></span>
                <span class="select-arrow">▼</span>
            </div>
            <div class="select-items">
                <?php foreach ($sortLabels as $value => $label): ?>
                    <div 
                        data-value="<?= $value ?>"
                        <?= ($sortOption === $value) ? 'class="active"' : '' ?>
                    >
                        <?= $label ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <button type="submit">Lọc</button>
    </div>

  </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('filterForm');
  const allSelects = document.querySelectorAll('.custom-select');

  const closeAll = (exceptEl) => {
    allSelects.forEach(select => {
      if (select === exceptEl) return;
      const selectedEl = select.querySelector('.select-selected');
      const menuEl = select.querySelector('.select-items');
      if (selectedEl) selectedEl.classList.remove('active');
      if (menuEl) menuEl.classList.remove('show');
    });
  };

  allSelects.forEach(select => {
    const trigger = select.querySelector('.select-selected');
    const dropdown = select.querySelector('.select-items');
    const text = select.querySelector('.select-text');
    const input = select.querySelector('input[type="hidden"]');
    if (!trigger || !dropdown || !text || !input) return;

    const setActive = (value) => {
      dropdown.querySelectorAll('[data-value]').forEach(item => {
        item.classList.toggle('active', item.dataset.value === String(value));
      });
    };
    setActive(input.value);

    trigger.addEventListener('click', (e) => {
      e.stopPropagation();
      const willOpen = !dropdown.classList.contains('show');
      closeAll(select);
      trigger.classList.toggle('active', willOpen);
      dropdown.classList.toggle('show', willOpen);
    });

    dropdown.querySelectorAll('[data-value]').forEach(item => {
      item.addEventListener('click', () => {
        const value = item.dataset.value || '';
        input.value = value;
        text.textContent = item.textContent.trim();
        setActive(value);
        trigger.classList.remove('active');
        dropdown.classList.remove('show');
        if (form) {
          form.submit();
        }
      });
    });
  });

  document.addEventListener('click', () => closeAll());
});
</script>

<?php if (empty($products)): ?>
    <p>Hiện chưa có sản phẩm nào.</p>
<?php else: ?>
    <?php if ($selectedCategoryId > 0): ?>
        <h2>Sản phẩm trong danh mục: <?= htmlspecialchars($selectedCategoryName) ?></h2>
    <?php endif; ?>
    <div class="grid">
        <?php foreach ($products as $row): ?>
            <?php
                $imgFile = !empty($row['thumbnail']) ? $row['thumbnail'] : ($row['image'] ?? '');
                if ($imgFile && !preg_match('#^https?://#', $imgFile) && !str_starts_with($imgFile, '/')) {
                    if (!str_starts_with($imgFile, './')) {
                        $imgFile = './' . ltrim($imgFile, '/');
                    }
                }
                $imgSrc = $imgFile ?: './images/logo/logo.png';
                $inactive = (int)($row['status'] ?? 1) === 0;
            ?>
            <a class="card" href="product.php?slug=<?= urlencode($row['slug']) ?>">
                <?php if ($imgSrc): ?>
                    <img src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                <?php endif; ?>
                <h3><?= htmlspecialchars($row['name']) ?></h3>
                <p class="price-line">
                    <strong><?= number_format((int)$row['price'], 0, ',', '.') ?> đ</strong>
                    <?php if ($inactive): ?><span class="badge-out-of-stock">Tạm hết hàng</span><?php endif; ?>
                </p>
            </a>
        <?php endforeach; ?>
    </div>
    <?php if ($totalPages > 1): ?>
        <div class="pagination">
            <a class="page-link prev <?= $page <= 1 ? 'disabled' : '' ?>" href="<?= $page > 1 ? $buildPageLink($page - 1) : '#' ?>">&#171; Prev</a>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a class="page-link <?= $i == $page ? 'active' : '' ?>" href="<?= $buildPageLink($i) ?>"><?= $i ?></a>
            <?php endfor; ?>
            <a class="page-link next <?= $page >= $totalPages ? 'disabled' : '' ?>" href="<?= $page < $totalPages ? $buildPageLink($page + 1) : '#' ?>">Next &#187;</a>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
