<?php
session_start();
if (empty($_SESSION['admin_id'])) {
    header("Location: /admin/login.php");
    exit;
}
include __DIR__ . '/../includes/db.php';

/* =============================
   XÓA SẢN PHẨM
============================= */
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    $result = mysqli_query($conn, "SELECT thumbnail FROM products WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($row && !empty($row['thumbnail'])) {
        $thumb = $row['thumbnail'];
        // Nếu đã lưu kèm đường dẫn, giữ nguyên; nếu chỉ là tên file, thêm thư mục uploads
        if (!str_contains($thumb, "uploads/") && !str_starts_with($thumb, "../images/")) {
            $thumb = "../images/uploads/" . ltrim($thumb, '/');
        }
        if (file_exists($thumb)) unlink($thumb);
    }

    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header("Location: ./products.php");
    exit;
}

/* =============================
   LẤY DANH MỤC
============================= */
$catRes = mysqli_query($conn, "SELECT * FROM categories ORDER BY name ASC");
$categories = [];
while ($row = mysqli_fetch_assoc($catRes)) {
    $categories[] = $row;
}

/* =============================
   FILTER - SEARCH - SORT
============================= */
$selectedCategoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
$searchKeyword      = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$sortOption         = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
$filterNoImage      = isset($_GET['no_image']) ? (int)$_GET['no_image'] : 0;
$filterStatus       = isset($_GET['status']) ? (int)$_GET['status'] : -1; // -1: tất cả
$currentFilters     = $_GET;
$returnQuery = http_build_query($currentFilters);

/* =============================
   PHÂN TRANG
============================= */
$limit = 20;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1) $page = 1;

$offset = ($page - 1) * $limit;

/* -----------------------------
   Đếm tổng số sản phẩm
----------------------------- */
$countSql = "SELECT COUNT(*) AS total FROM products WHERE 1";

if ($selectedCategoryId > 0) {
    $countSql .= " AND category_id = $selectedCategoryId";
}

if (!empty($searchKeyword)) {
    $searchEscaped = mysqli_real_escape_string($conn, $searchKeyword);
    $countSql .= " AND name LIKE '%$searchEscaped%'";
}
if ($filterNoImage) {
    $countSql .= " AND (thumbnail IS NULL OR thumbnail = '')";
}
if ($filterStatus === 0 || $filterStatus === 1) {
    $countSql .= " AND status = $filterStatus";
}

$countRes = mysqli_query($conn, $countSql);
$totalRows = mysqli_fetch_assoc($countRes)['total'];
$totalPages = ceil($totalRows / $limit);

/* -----------------------------
   SORT
----------------------------- */
$orderBy = "p.created_at DESC"; // default newest

switch ($sortOption) {
    case "price_asc":
        $orderBy = "p.price ASC";
        break;
    case "price_desc":
        $orderBy = "p.price DESC";
        break;
    case "name_asc":
        $orderBy = "p.name ASC";
        break;
    case "name_desc":
        $orderBy = "p.name DESC";
        break;
}

/* -----------------------------
   Truy vấn sản phẩm
----------------------------- */
$sql = "SELECT p.*, c.name AS category_name
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE 1";

if ($selectedCategoryId > 0) {
    $sql .= " AND p.category_id = $selectedCategoryId";
}

if (!empty($searchKeyword)) {
    $searchEscaped = mysqli_real_escape_string($conn, $searchKeyword);
    $sql .= " AND p.name LIKE '%$searchEscaped%'";
}
if ($filterNoImage) {
    $sql .= " AND (p.thumbnail IS NULL OR p.thumbnail = '')";
}
if ($filterStatus === 0 || $filterStatus === 1) {
    $sql .= " AND p.status = $filterStatus";
}

$sql .= " ORDER BY $orderBy LIMIT $limit OFFSET $offset";

$res = mysqli_query($conn, $sql);
?>

<?php include __DIR__ . '/admin-header.php'; ?>
<link rel="stylesheet" href="./assets/products.css">

<div class="container">

    <div style="margin-bottom: 10px;">
        <a class="btn" href="./product-form.php<?= $returnQuery ? ('?return=' . urlencode($returnQuery)) : '' ?>">+ Thêm sản phẩm</a>
    </div>

<!-- FILTER FORM -->
<div class="filter-box">
  <form method="get" id="filterForm">
    <div class="filter-row">
      
      <!-- Tìm kiếm -->
      <div class="filter-item">
        <input 
          type="text" 
          name="keyword" 
          placeholder="Tìm sản phẩm..." 
          value="<?= htmlspecialchars($searchKeyword) ?>"
        >
      </div>

      <!-- Chọn danh mục -->
      <div class="filter-item">
        <select name="category_id" onchange="filterForm.submit()">
          <option value="0">-- Tất cả danh mục --</option>
          <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= ($selectedCategoryId == $cat['id']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($cat['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Sắp xếp -->
      <div class="filter-item">
        <select name="sort" onchange="filterForm.submit()">
          <option value="newest"      <?= $sortOption=='newest'?'selected':'' ?>>Mới nhất</option>
          <option value="price_asc"   <?= $sortOption=='price_asc'?'selected':'' ?>>Giá tăng dần</option>
          <option value="price_desc"  <?= $sortOption=='price_desc'?'selected':'' ?>>Giá giảm dần</option>
          <option value="name_asc"    <?= $sortOption=='name_asc'?'selected':'' ?>>Tên A → Z</option>
          <option value="name_desc"   <?= $sortOption=='name_desc'?'selected':'' ?>>Tên Z → A</option>
        </select>
      </div>

      <!-- Lọc chưa có ảnh -->
      <div class="filter-item" style="display:flex; align-items:center; gap:6px;">
        <input type="checkbox" id="no_image" name="no_image" value="1" <?= $filterNoImage ? 'checked' : '' ?> onchange="filterForm.submit()">
        <label for="no_image" style="margin:0;">Chưa có ảnh</label>
      </div>

      <!-- Lọc trạng thái -->
      <div class="filter-item">
        <select name="status" onchange="filterForm.submit()">
          <option value="-1" <?= $filterStatus===-1 ? 'selected' : '' ?>>-- Tất cả trạng thái --</option>
          <option value="1" <?= $filterStatus===1 ? 'selected' : '' ?>>Còn hàng</option>
          <option value="0" <?= $filterStatus===0 ? 'selected' : '' ?>>Hết hàng</option>
        </select>
      </div>

      <button class="btn-filter" type="submit">Lọc</button>

    </div>
  </form>
</div>


    <!-- BẢNG SẢN PHẨM -->
    <div class="table-wrapper">
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Slug</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($res)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>

                    <td>
                        <?php 
                            $thumbnail = $row['thumbnail'];
                            if ($thumbnail) {
                                if (!str_contains($thumbnail, "uploads")) {
                                    $thumbnail = "../images/uploads/" . $thumbnail;
                                }
                        ?>
                            <img src="<?= ".".htmlspecialchars($thumbnail) ?>" 
                                 alt="<?= ".".htmlspecialchars($row['name']) ?>" 
                                 style="width: 90px; border-radius:6px;">
                        <?php } else { echo "N/A"; } ?>
                    </td>

                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['category_name'] ?? 'N/A') ?></td>
                    <td><?= number_format($row['price']) ?></td>
                    <td><?= htmlspecialchars($row['slug']) ?></td>
                    <td><?= ((int)$row['status'] === 1) ? 'Còn hàng' : 'Hết hàng' ?></td>

                    <td>
                        <a class="btn small" href="./product-form.php?id=<?= $row['id'] ?><?= $returnQuery ? ('&return=' . urlencode($returnQuery)) : '' ?>">Sửa</a>
                        <a class="btn small danger" 
                           href="./products.php?delete=<?= $row['id'] ?>"
                           onclick="return confirm('Xóa sản phẩm này?');">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <!-- PHÂN TRANG -->
    <div class="pagination">
        <?php
          $baseQuery = $_GET;
          // Prev
          if ($page > 1) {
            $baseQuery['page'] = $page - 1;
            echo '<a href="?' . http_build_query($baseQuery) . '">« Trước</a>';
          }
          // Numbers
          for ($i = 1; $i <= $totalPages; $i++):
            $baseQuery['page'] = $i;
            $link = '?' . http_build_query($baseQuery);
        ?>
            <a class="<?= ($i == $page) ? 'active' : '' ?>" href="<?= $link ?>"><?= $i ?></a>
        <?php endfor;
          // Next
          if ($page < $totalPages) {
            $baseQuery['page'] = $page + 1;
            echo '<a href="?' . http_build_query($baseQuery) . '">Sau »</a>';
          }
        ?>
    </div>

</div>
