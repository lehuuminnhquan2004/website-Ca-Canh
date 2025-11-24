</main>
<?php
  $bannerCfg = [];
  $cfgPath = __DIR__ . '/site-config.json';
  if (file_exists($cfgPath)) {
    $loaded = json_decode(file_get_contents($cfgPath), true);
    if (!empty($loaded['banners']) && is_array($loaded['banners'])) {
      $bannerCfg = $loaded['banners'];
    }
  }
  $bannerFiles = $bannerCfg ?: ['banner3.jpg','banner1.jpg','banner2.jpg'];
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
<link rel="stylesheet" href="./assets/css/banner.css">

<div class="section_slider swiper-container">
    <div class="swiper-wrapper">
        <?php foreach ($bannerFiles as $b): ?>
          <?php
            $src = "./images/slider/" . $b;
            $title = pathinfo($b, PATHINFO_FILENAME);
          ?>
          <div class="swiper-slide">
              <a href="#" title="<?= htmlspecialchars($title) ?>">
                  <picture>
                      <source media="(min-width:1200px)" srcset="<?= htmlspecialchars($src) ?>">
                      <source media="(max-width:480px)" srcset="<?= htmlspecialchars($src) ?>">
                      <img src="<?= htmlspecialchars($src) ?>" alt="<?= htmlspecialchars($title) ?>" class="img-responsive center-block">
                  </picture>
              </a>
          </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<div class="section_services">
	<div class="container">
		<div class="row">
			
			<div class="card">
				<div class="promo-item">
					<div class="icon">
						<img width="50" height="50" class="lazyload loaded" src="https://cdn.shopvnb.com/themes/images/policy_image_2.svg" data-src="https://cdn.shopvnb.com/themes/images/policy_image_2.svg" alt="Vận chuyển toàn quốc" data-was-processed="true">
					</div>
					<div class="info">
						Vận chuyển <span><strong>TOÀN QUỐC</strong></span> <br> Thanh toán khi nhận hàng
					</div>
				</div>
			</div>
			
			<div class="card">
				<div class="promo-item">
					<div class="icon">
						<img width="50" height="50" class="lazyload loaded" src="https://cdn.shopvnb.com/themes/images/policy_image_1.svg" data-src="https://cdn.shopvnb.com/themes/images/policy_image_1.svg" alt="" data-was-processed="true">
					</div>
					<div class="info">
						<span>Bảo đảm <strong>cất lượng</strong></span> <br> chất lượng, uy tín.
					</div>
				</div>
			</div>


			<div class="card">
				<div class="promo-item">
					<div class="icon">
						<img width="50" height="50" class="lazyload loaded" src="https://cdn.shopvnb.com/themes/images/thanh_toan.svg" data-src="https://cdn.shopvnb.com/themes/images/thanh_toan.svg" alt="" data-was-processed="true">
					</div>
					<div class="info">
						Tiến hành <span><strong>THANH TOÁN</strong></span> <br> Với nhiều <span>PHƯƠNG THỨC</span>
					</div>
				</div>
			</div>


			
			<div class="card">
				<div class="promo-item">
					<div class="icon">
						<img width="50" height="50" class="lazyload loaded" src="https://cdn.shopvnb.com/themes/images/doi_san_pham.svg" data-src="https://cdn.shopvnb.com/themes/images/doi_san_pham.svg" alt="" data-was-processed="true">
					</div>
					<div class="info">
						<span><strong>Đổi sản phẩm mới</strong></span><br> nếu sản phẩm lỗi
					</div>
				</div>
			</div>

			
		</div>
	</div>
</div>

<script>
var swiper = new Swiper('.section_slider', {
    loop: true,
    autoplay: {
        delay: 3000,
    },
    speed: 800,
    slidesPerView: 1,
    spaceBetween: 0,
});
</script>

<main class="container">