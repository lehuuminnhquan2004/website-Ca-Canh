<link rel="stylesheet" href="./assets/css/footer.css">
<?php
  $cfg = [
    'facebook' => '#',
    'tiktok' => '#',
    'youtube' => '#'
  ];
  $cfgPath = __DIR__ . '/site-config.json';
  if (file_exists($cfgPath)) {
    $loaded = json_decode(file_get_contents($cfgPath), true);
    if (is_array($loaded)) {
      $cfg = array_merge($cfg, $loaded);
    }
  }
?>
<?php include __DIR__ . '/nutlienhe.php'; ?>
</main class="container">
<footer class="footer">
  <div class="footer-container">

    
    <div class="thongtin">
      <div class="footer-col">
        <h3>Cửa hàng cá cảnh</h3>
        <p>Chuyên cung cấp cá cảnh, hồ cá, phụ kiện và tư vấn chăm sóc cá.</p>
        <p>© <?= date('Y') ?> Cửa hàng cá cảnh</p>
      </div>

      <div class="footer-col">
        <h4>Liên hệ</h4>
        <ul>
          <li>📍 665 Phạm Thế Hiển - Phường 4 - Quận 8 - HCM</li>
          <li>📞 032x xxx xxx</li>
          <li>📧 cacuahang@example.com</li>
          <li>🕒 8:00 - 22:00 (hàng ngày)</li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Kết nối</h4>
        <div class="social-links">
          <a href="<?= htmlspecialchars($cfg['facebook'] ?: '#') ?>"><i class="fab fa-facebook"></i></a>
          <a href="<?= htmlspecialchars($cfg['tiktok'] ?: '#') ?>"><i class="fab fa-tiktok"></i></a>
          <a href="<?= htmlspecialchars($cfg['youtube'] ?: '#') ?>"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
    <div class="footer-col">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31360.251004487403!2d106.63603708418555!3d10.732063472479796!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f31b9155e0d%3A0xa1537680b2cae506!2zQ-G7rWEgSMOgbmcgQ8OhIEPhuqNuaCBROCBBUVVBUklVTSBDT0ZGRUU!5e0!3m2!1svi!2s!4v1763782883839!5m2!1svi!2s" width="100%" max-width="400px" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>


  </div>
</footer>
