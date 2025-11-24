<?php
$configPath = __DIR__ . '/site-config.json';
$config = [
  'phone' => '0328421191',
  'zalo' => '0328421191',
  'messenger' => 'https://m.me/yourpage',
  'facebook' => 'https://facebook.com/yourpage'
];
if (file_exists($configPath)) {
  $loaded = json_decode(file_get_contents($configPath), true);
  if (is_array($loaded)) {
    $config = array_merge($config, $loaded);
  }
}

$phone = trim($config['phone']);
$telHref = 'tel:' . preg_replace('/[^0-9+]/', '', $phone);

$zaloRaw = trim($config['zalo']);
if ($zaloRaw === '') {
  $zaloLink = '#';
} elseif (preg_match('#^https?://#i', $zaloRaw)) {
  $zaloLink = $zaloRaw;
} elseif (preg_match('#^zalo\\.me#i', $zaloRaw)) {
  $zaloLink = 'https://' . $zaloRaw;
} else {
  $zaloLink = 'https://zalo.me/' . $zaloRaw;
}

$messengerLink = trim($config['messenger']) ?: '#';
$facebookLink = trim($config['facebook']) ?: '#';
?>

<div class="contact-floating">
  <div class="contact-toggle">
    <i class="fa fa-comments"></i>
  </div>

  <div class="contact-options">
    <a href="<?= htmlspecialchars($telHref) ?>" class="contact-btn call">
      <i class="fa fa-phone"></i>
    </a>

    <a href="<?= htmlspecialchars($zaloLink) ?>" target="_blank" class="contact-btn zalo">
      <i class=""><img src="./images/icons/icon-zalo.png"></i>
    </a>

    <a href="<?= htmlspecialchars($messengerLink) ?>" target="_blank" class="contact-btn messenger">
      <i class="fa-brands fa-facebook-messenger"></i>
    </a>

    <a href="<?= htmlspecialchars($facebookLink) ?>" target="_blank" class="contact-btn facebook">
      <i class="fa-brands fa-facebook"></i>
    </a>
  </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">




<style>
   /* Container tổng */
.contact-floating {
  position: fixed;
  bottom: 20px;
  right: 20px; /* nằm góc phải */
  z-index: 9999;
  display: flex;
  flex-direction: column-reverse;
  align-items: center;
}

/* Nút chính */
.contact-toggle {
  width: 60px;
  height: 60px;
  background: #1abc9c;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-size: 26px;
  cursor: pointer;
  transition: 0.3s;
  box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

.contact-toggle:hover {
  transform: scale(1.1);
}

/* Nhóm nút xổ lên */
.contact-options {
  display: flex;
  flex-direction: column;
  align-items: center;

  /* Ẩn mặc định */
  opacity: 0;
  transform: translateY(20px);
  pointer-events: none;

  transition: 0.35s ease;
}

/* Khi active sẽ hiện */
.contact-floating.active .contact-options {
  opacity: 1;
  transform: translateY(0);
  pointer-events: auto;
}

/* Nút từng item */
.contact-btn {
  width: 55px;
  height: 55px;
  background: #3498db;
  border-radius: 50%;
  color: white;
  font-size: 24px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 12px;
  text-decoration: none;
  transition: 0.3s;
  box-shadow: 0 4px 10px rgba(0,0,0,0.25);
}

/* Hiệu ứng hover */
.contact-btn:hover {
  transform: translateY(-4px) scale(1.07);
}

/* màu riêng */
.contact-btn.call       { background: #e74c3c; }
.contact-btn.zalo       { background: #0068ff; }
.contact-btn.messenger  { background: #00b2ff; }
.contact-btn.facebook   { background: #3b5998; }

</style>

<script>
document.querySelector(".contact-toggle")
  .addEventListener("click", function() {
     document.querySelector(".contact-floating").classList.toggle("active");
});
</script>

