<?php
$page_title = "Giới thiệu - Cửa hàng Cá Cảnh Q8 Aquarium Coffee";
$page_description = "Giới thiệu cửa hàng cá cảnh Quận 8 Aquarium Coffee – chuyên cá cảnh đẹp, hồ cá, phụ kiện thủy sinh, vật liệu lọc và dịch vụ setup hồ cá tại Quận 8. Cam kết cá khỏe – tư vấn tận tâm – giá tốt.";

include __DIR__ . '/includes/db.php';

// Đọc config
$config = json_decode(file_get_contents(__DIR__ . '/includes/site-config.json'), true);
$phone   = $config['phone'] ?? '';
$email   = $config['email'] ?? '';
$address = $config['address'] ?? '';



include __DIR__ . '/includes/header.php';
?>
<link rel="stylesheet" href="./assets/css/about.css">

<section class="container" style="margin-top:20px; margin-bottom:32px;">
  <div class="about-hero">
    <h1>Giới thiệu Cửa hàng Cá Cảnh Quận 8</h1>
    <p>
      <strong>Q8 Aquarium Coffee</strong> là cửa hàng cá cảnh uy tín tại Quận 8, chuyên cung cấp cá cảnh đẹp,
      tép cảnh, hồ cá, phụ kiện thủy sinh, vật liệu lọc và các giải pháp chăm sóc hồ cá trọn gói. 
      Chúng tôi cam kết cá khỏe mạnh – tư vấn tận tâm – giá cả minh bạch.
    </p>
    <p>
    Cửa hàng luôn cập nhật nhiều dòng cá cảnh phổ biến như cá 7 màu, betta, cá vàng, koi mini, neon…
    cùng đa dạng phụ kiện: máy oxy, lọc nước, đèn hồ cá, thức ăn, thuốc trị bệnh, trang trí hồ.
    Dù bạn là người mới chơi hay người chơi lâu năm, chúng tôi luôn sẵn sàng hỗ trợ setup hồ cá đẹp, ổn định, dễ chăm sóc.
  </p>
  </div>

  

  <div class="about-grid">
    <div class="about-card">
      <h2>Sản phẩm</h2>
      <p>Sản phẩm đa dạng chất lượng cao - Cá cảnh khỏe đẹp.</p>
      <a class="button-outline primary" href="products.php">Xem phụ kiện</a>
      <br><br>
      <a class="button-outline primary" href="fishs.php">Xem cá cảnh</a>
    </div>

    <div class="about-card">
      <h2>Dịch vụ</h2>
      <p>
        Tư vấn setup hồ cá miễn phí – giải pháp lọc nước – thiết kế ánh sáng – xử lý nước – trị bệnh cá – 
        chăm sóc và bảo trì hồ cá định kỳ.
      </p>
    </div>

    <div class="about-card">
      <h2>Liên hệ</h2>
      <p>Hotline: <?= htmlspecialchars($phone) ?></p>
      <p>Địa chỉ: <?= htmlspecialchars($address) ?></p>
      <p>Email: <?= htmlspecialchars($email) ?></p>
      <p>Zalo/Facebook: xem tại nút Liên Hệ ở góc màn hình.</p>
    </div>
  </div>

  <div class="about-list">
    <h2>Cam kết</h2>
    <ul>
      <li>Cá cảnh khỏe mạnh – rõ nguồn gốc – tư vấn chọn cá phù hợp.</li>
      <li>Hỗ trợ kỹ thuật nuôi cá, xử lý nước và setup thủy sinh.</li>
      <li>Giao hàng nhanh – đóng gói an toàn – hỗ trợ sau bán hàng.</li>
    </ul>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
