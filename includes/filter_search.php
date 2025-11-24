<div class="container">
  <div style="margin-bottom: 10px;">
    <a class="btn" href="./product-form.php">+ Thêm sản phẩm</a>
  </div>

  <!-- FORM TÌM KIẾM & LỌC -->
  <form method="get" style="margin-bottom: 15px; display:flex; gap:10px; flex-wrap:wrap;">
    <select name="category_id">
      <option value="0">-- Tất cả danh mục --</option>
      <?php foreach ($categories as $cat): ?>
        <option value="<?= $cat['id'] ?>" <?= ($filterCategory == $cat['id']) ? 'selected' : '' ?>>
          <?= htmlspecialchars($cat['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
    <input type="text" name="search" placeholder="Tìm theo tên..." value="<?= htmlspecialchars($searchKeyword) ?>">
    <button type="submit" class="btn">Lọc</button>
  </form>

  <div class="table-wrapper">
    <table class="table">
      <tr>
        <th>ID</th>
        <th>Ảnh</th>
        <th>Tên</th>
        <th>Danh mục</th>
        <th>Giá</th>
        <th>Slug</th>
        <th>Hành động</th>
      </tr>
      <?php while ($row = mysqli_fetch_assoc($res)) : ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td>
            <?php if ($row['thumbnail']): ?>
              <img src="<?= htmlspecialchars($row['thumbnail']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" style="max-width:100px;">
            <?php else: ?>
              N/A
            <?php endif; ?>
          </td>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['category_name'] ?? 'N/A') ?></td>
          <td><?= number_format($row['price']) ?></td>
          <td><?= htmlspecialchars($row['slug']) ?></td>
          <td>
            <a href="/admin/product-form.php?id=<?= $row['id'] ?>">Sửa</a> |
            <a href="/admin/products.php?delete=<?= $row['id'] ?>"
               onclick="return confirm('Xóa sản phẩm này?');">Xóa</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
</div>
