<?php
// Dùng lại dữ liệu decor_products và promo_products cho 2 section mới
$furniture_products = $decor_products;
$sanitary_products = $promo_products;
?>

<!-- Banner khuyến mãi -->
<section class="promo-banner position-relative">
    <div class="promo-background"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="promo-content text-center text-md-start p-4 bg-light rounded shadow-sm">
                    <h2 class="text-warning">#FURNITURES</h2>
                    <h1 class="display-4 fw-bold text-dark">XU HƯỚNG NỘI THẤT</h1>
                    <p class="text-muted">
                        Đồ nội thất cao cấp được nâng niu trong từng chi tiết <br />
                        hàng đầu Việt Nam
                    </p>
                    <a href="<?php echo base_url('product'); ?>" class="btn btn-warning rounded-pill px-4 py-2 text-white">
                        MUA NGAY
                    </a>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <div class="promo-image"></div>
            </div>
        </div>
    </div>
</section>

<!-- Sản phẩm nổi bật -->
<section class="grid-container grid-row-1">
    <div class="card card1" style="background-image: url('<?php echo base_url('assets/img/cate_1_img.webp'); ?>')">
        <h2>Sản phẩm bán chạy</h2>
        <p>
            Tiện ích cho nhu cầu sinh hoạt hằng ngày. Giải pháp <br />An toàn - Tiết kiệm
        </p>
        <a href="<?php echo base_url('product?category=bestseller'); ?>">Xem thêm</a>
    </div>

    <div class="card card2" style="background-image: url('<?php echo base_url('assets/img/cate_2_img.webp'); ?>')">
        <h2>Đèn trang trí</h2>
        <p>Thẩm mỹ độc đáo</p>
    </div>

    <div class="card card3" style="background-image: url('<?php echo base_url('assets/img/cate_3_img.webp'); ?>')">
        <h2>Đồ trang trí</h2>
        <p>Không gian nghệ thuật</p>
    </div>

    <div class="card card4" style="background-image: url('<?php echo base_url('assets/img/cate_4_img.webp'); ?>')">
        <h2>Thiết bị vệ sinh</h2>
        <p>Đa dạng mẫu mã</p>
    </div>
</section>

<section class="grid-container grid-row-2">
    <div class="card card5" style="background-image: url('<?php echo base_url('assets/img/cate_6_img.webp'); ?>')">
        <h2>Top sản phẩm hàng đầu</h2>
        <p>Thiết kế đơn giản - Tinh tế - Hiện đại</p>
        <a href="<?php echo base_url('product?category=top'); ?>">Xem thêm</a>
    </div>

    <div class="card card6" style="background-image: url('<?php echo base_url('assets/img/cate_5_img.webp'); ?>')">
        <h2>Đồ nội thất</h2>
        <p>Trang trí không gian</p>
    </div>

    <div class="card card7" style="background-image: url('<?php echo base_url('assets/img/cate_7_img.webp'); ?>')">
        <h2>Sản phẩm thủ công</h2>
        <p>Đường nét chạm khắc tinh tế</p>
        <a href="<?php echo base_url('product?category=handmade'); ?>">Xem thêm</a>
    </div>
</section>

<!-- Khuyến mãi đặc biệt với timer đếm ngược đặt đúng vị trí -->
<div class="container my-5">
    <div class="timer-container">
        <span>
            Khuyến mãi đặc biệt
            <i class="text-success" id="timer">3 ngày 00:00:00</i>
        </span>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
/* Đảm bảo responsive hoạt động đúng */
@media (max-width: 767px) {
  .row .col-6 {
    flex: 0 0 50% !important;
    max-width: 50% !important;
    width: 50% !important;
    padding: 0 3px !important;
  }

  .card_product {
    width: 95% !important;
    max-width: 95% !important;
    margin: 0 auto 15px auto !important;
    padding: 0 !important;
    box-sizing: border-box !important;
  }

  /* Căn giữa các hàng trên mobile */
  .row {
    justify-content: center !important;
    align-items: center !important;
  }

  /* Căn giữa card trong column */
  .col-6 {
    display: flex !important;
    justify-content: center !important;
  }
}

@media (min-width: 768px) and (max-width: 991px) {
  .row .col-md-6 {
    flex: 0 0 50% !important;
    max-width: 50% !important;
    width: 50% !important;
    padding: 0 3px !important;
  }

  .card_product {
    width: 95% !important;
    max-width: 95% !important;
    margin: 0 auto 18px auto !important;
    padding: 0 !important;
    box-sizing: border-box !important;
  }
}

@media (min-width: 992px) {
  .row .col-lg-3 {
    flex: 0 0 25% !important;
    max-width: 25% !important;
    width: 25% !important;
    padding: 0 3px !important;
  }

  .card_product {
    width: 85% !important;
    max-width: 85% !important;
    margin: 0 auto 25px auto !important;
    padding: 0 !important;
    box-sizing: border-box !important;
  }
}

/* Đảm bảo row không có gap quá lớn */
.row {
  margin: 0 !important;
  gap: 0 !important;
}

.row > [class*="col-"] {
  padding: 0 3px !important;
}

.decor-card-custom {
  border-radius: 20px;
  box-shadow: 0 6px 24px rgba(0,0,0,0.13);
  padding: 24px 16px 28px 16px;
  background: #fff;
  margin: 0 auto;
  max-width: 540px;
  min-width: 400px;
  min-height: 520px;
  transition: box-shadow 0.2s;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.decor-card-custom:hover {
  box-shadow: 0 12px 32px rgba(0,0,0,0.18);
}
.decor-img-big {
  width: 100%;
  height: 380px;
  object-fit: cover;
  border-radius: 14px;
  margin-bottom: 18px;
}

/* Giảm khoảng cách ngang giữa các card Đèn trang trí và Thiết bị vệ sinh */
.decor-page .card_product_decor {
  width: 100% !important;
  max-width: 100% !important;
  min-width: 0 !important;
  margin: 0 0 14px 0 !important; /* chỉ margin dưới, bỏ auto */
}
.decor-page .row > [class*="col-"] {
  padding: 0 2px !important;
}
/* Nếu dùng slick carousel cho thiết bị vệ sinh */
.decor-page .decor-carousel > div {
  padding: 0 2px !important;
}

.product-icons .icon-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  padding: 0;
  background: #fff;
  border-radius: 50%;
  border: none;
  box-shadow: 0 2px 8px rgba(0,0,0,0.10);
  color: #f5a06d;
  font-size: 20px;
  margin-left: 0;
  transition: background 0.2s, color 0.2s, box-shadow 0.2s;
}
.product-icons .icon-btn i.fa-shopping-cart {
  transform: translateY(2px);
}
.product-icons .icon-btn i.fa-search {
  transform: translateY(2px);

}
.new-label {
  display: inline-block;
  background: #ff9800;
  color: white;
  padding: 2px 8px;
  border-radius: 3px;
  font-size: 12px;
  line-height: 1.2;
  min-width: unset;
  width: auto;
  margin-bottom: 4px;
  box-shadow: none;
}

.product-info {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}
.product-info .new-label {
  display: inline-block !important;
  width: auto !important;
  min-width: unset !important;
  max-width: 100%;
  margin-bottom: 4px;
  box-shadow: none;
  background: #ff9800;
  color: #fff;
  padding: 2px 8px;
  border-radius: 3px;
  font-size: 12px;
  line-height: 1.2;
  white-space: nowrap;
}
</style>

<!-- Sản phẩm khuyến mãi -->
<div id="promo-product-list" class="row">
    <?php if(isset($promo_products) && is_array($promo_products) && !empty($promo_products)): ?>
        <?php foreach($promo_products as $product): ?>
            <div class="col-6 col-md-6 col-lg-3 d-flex">
                <div class="card_product flex-fill">
                    <?php if($product['product_price'] > $product['product_sales_price']): ?>
                        <?php $discount = round((($product['product_price'] - $product['product_sales_price']) / $product['product_price']) * 100); ?>
                        <div class="discount">-<?php echo $discount; ?>%</div>
                    <?php endif; ?>
                    <?php
                    $img_file = trim($product['homeimgfile']);
                    $img_path = 'uploads/shops/' . $img_file;
                    $main_img = get_image($img_path, 'uploads/shops/no-image-thumb.png');
                    $hover_img = '';
                    if (!empty($product['otherimage'])) {
                        $imgs = explode(',', $product['otherimage']);
                        if (count($imgs) > 0 && trim($imgs[0]) !== '') {
                            $hover_img = get_image('uploads/shops/' . trim($imgs[0]), 'uploads/shops/pro_2.webp');
                        }
                    }
                    // Nếu không có ảnh hover, hoặc hover_img trùng main_img, gán ảnh test khác biệt để kiểm tra hiệu ứng
                    if (!$hover_img || $hover_img == $main_img) {
                        $hover_img = base_url('assets/img/slider_2.webp'); // hoặc một ảnh test khác biệt
                    }
                    ?>
                    <div style="position:relative;">
                      <img src="<?php echo $main_img; ?>" alt="<?php echo $product['title']; ?>" class="main-img" data-hover-image="<?php echo $hover_img; ?>" >
                      <div class="product-icons">
                        <button class="icon-btn add-to-cart" title="Thêm vào giỏ" data-product-id="<?php echo $product['id']; ?>">
                          <i class="fa fa-shopping-cart"></i>
                        </button>
                        <?php $alias = !empty($product['alias']) ? $product['alias'] : url_title($product['title'], 'dash', true); ?>
                        <button class="icon-btn quick-view" title="Xem nhanh" data-product-id="<?php echo $product['id']; ?>" data-product-alias="<?php echo $alias; ?>">
                          <i class="fa fa-search"></i>
                        </button>
                      </div>
                    </div>
                    <div class="product-info">
                        <span class="new-label">Hàng mới</span>
                        <div class="product-name"><?php echo $product['title']; ?></div>
                        <div class="price">
                            <?php echo formatRice($product['product_sales_price']); ?>đ
                            <?php if($product['product_price'] > $product['product_sales_price']): ?>
                                <span class="original-price"><?php echo formatRice($product['product_price']); ?>đ</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center">
            <p>Không có sản phẩm</p>
        </div>
    <?php endif; ?>
</div>

<!-- Top sản phẩm bán chạy & Hàng mới về với tab -->
<div class="container_top py-4">
    <div class="tabs-wrapper mb-4" style="display:flex;justify-content:center;gap:18px;">
        <div class="tab-item active" data-tab="top">Top sản phẩm</div>
        <div class="tab-item" data-tab="new">Hàng mới về</div>
    </div>
    <div id="top-product-list" class="row product-tab-list" data-tab="top" style="justify-content:flex-center">
        <?php if(isset($top_products) && is_array($top_products) && !empty($top_products)): ?>
            <?php foreach($top_products as $product): ?>
                <div class="col-6 col-md-6 col-lg-3 d-flex">
                <div class="card_product flex-fill">
                <?php if($product['product_price'] > $product['product_sales_price']): ?>
                    <?php $discount = round((($product['product_price'] - $product['product_sales_price']) / $product['product_price']) * 100); ?>
                    <div class="discount">-<?php echo $discount; ?>%</div>
                <?php endif; ?>
                <?php
                $img_file = trim($product['homeimgfile']);
                $img_path = 'uploads/shops/' . $img_file;
                $main_img = get_image($img_path, 'uploads/shops/no-image-thumb.png');
                $hover_img = '';
                if (!empty($product['otherimage'])) {
                    $imgs = explode(',', $product['otherimage']);
                    if (count($imgs) > 0 && trim($imgs[0]) !== '') {
                        $hover_img = get_image('uploads/shops/' . trim($imgs[0]), 'uploads/shops/pro_2.webp');
                    }
                }
                // Nếu không có ảnh hover, hoặc hover_img trùng main_img, gán ảnh test khác biệt để kiểm tra hiệu ứng
                if (!$hover_img || $hover_img == $main_img) {
                    $hover_img = base_url('assets/img/slider_2.webp'); // hoặc một ảnh test khác biệt
                }
                ?>
                <div style="position:relative;">
                  <img src="<?php echo $main_img; ?>" alt="<?php echo $product['title']; ?>" class="main-img" data-hover-image="<?php echo $hover_img; ?>" >
                  <div class="product-icons">
                    <button class="icon-btn add-to-cart" title="Thêm vào giỏ" data-product-id="<?php echo $product['id']; ?>">
                      <i class="fa fa-shopping-cart"></i>
                    </button>
                    <?php $alias = !empty($product['alias']) ? $product['alias'] : url_title($product['title'], 'dash', true); ?>
                    <button class="icon-btn quick-view" title="Xem nhanh" data-product-id="<?php echo $product['id']; ?>" data-product-alias="<?php echo $alias; ?>">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
                <div class="product-info">
                    <span class="new-label">Hàng mới</span>
                    <div class="product-name"><?php echo $product['title']; ?></div>
                    <div class="price">
                        <?php echo formatRice($product['product_sales_price']); ?>đ
                        <?php if($product['product_price'] > $product['product_sales_price']): ?>
                            <span class="original-price"><?php echo formatRice($product['product_price']); ?>đ</span>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p>Không có sản phẩm</p>
            </div>
        <?php endif; ?>
    </div>
    <div id="new-product-list" class="row product-tab-list" data-tab="new" style="display:none;justify-content:flex-start;gap:18px;">
        <?php if(isset($new_products) && is_array($new_products) && !empty($new_products)): ?>
            <?php foreach($new_products as $product): ?>
                <div class="col-6 col-md-6 col-lg-3 d-flex">
                    <div class="card_product flex-fill">
                        <div class="product-img-wrap" style="position:relative;">
                          <?php if($product['product_price'] > $product['product_sales_price']): ?>
                            <?php $discount = round((($product['product_price'] - $product['product_sales_price']) / $product['product_price']) * 100); ?>
                            <span class="discount-label">-<?php echo $discount; ?>%</span>
                          <?php endif; ?>
                          <?php
                          $img_file = trim($product['homeimgfile']);
                          $img_path = 'uploads/shops/' . $img_file;
                          $main_img = get_image($img_path, 'uploads/shops/no-image-thumb.png');
                          $hover_img = '';
                          if (!empty($product['otherimage'])) {
                              $imgs = explode(',', $product['otherimage']);
                              if (count($imgs) > 0 && trim($imgs[0]) !== '') {
                                  $hover_img = get_image('uploads/shops/' . trim($imgs[0]), 'uploads/shops/no-image-thumb.png');
                              }
                          }
                          if (!$hover_img || $hover_img == $main_img) {
                              $hover_img = base_url('assets/img/slider_2.webp');
                          }
                          ?>
                          <img src="<?php echo $main_img; ?>" alt="<?php echo $product['title']; ?>" class="main-img" data-hover-image="<?php echo $hover_img; ?>">
                          <div class="product-icons">
                            <button class="icon-btn add-to-cart" title="Thêm vào giỏ" data-product-id="<?php echo $product['id']; ?>">
                              <i class="fa fa-shopping-cart"></i>
                            </button>
                            <?php $alias = !empty($product['alias']) ? $product['alias'] : url_title($product['title'], 'dash', true); ?>
                            <button class="icon-btn quick-view" title="Xem nhanh" data-product-id="<?php echo $product['id']; ?>" data-product-alias="<?php echo $alias; ?>">
                              <i class="fa fa-search"></i>
                            </button>
                          </div>
                        </div>
                        <div class="product-info">
                            <span class="new-label">Hàng mới</span>
                            <div class="product-name"><?php echo $product['title']; ?></div>
                            <?php if(!empty($product['description'])): ?>
                              <div class="product-desc"><?php echo $product['description']; ?></div>
                            <?php endif; ?>
                            <div class="price">
                                <span class="sale-price"><?php echo formatRice($product['product_sales_price']); ?>đ</span>
                                <?php if($product['product_price'] > $product['product_sales_price']): ?>
                                    <span class="original-price"><?php echo formatRice($product['product_price']); ?>đ</span>
                                <?php endif; ?>
                            </div>
                            <?php if(isset($product['sold']) && $product['sold'] > 0): ?>
                            <div class="sold-bar">
                              <span class="fire">🔥</span>Đã bán <?php echo $product['sold']; ?>
                              <div class="sold-progress">
                                <div class="sold-progress-bar" style="width:<?php echo min(100, $product['sold']); ?>%"></div>
                              </div>
                            </div>
                            <?php endif; ?>
                            <button class="btn_addcart" data-product-id="<?php echo $product['id']; ?>">Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p>Không có sản phẩm</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Section Đồ trang trí -->
<div class="decor-section">
  <div class="decor-image-wrapper">
    <img src="<?php echo base_url('assets/img/image_set_1.webp'); ?>" alt="Phòng khách decor" />
    <div class="hotspot" data-product-index="2" style="top: 70%; left: 15%"></div>
    <div class="hotspot" data-product-index="1" style="top: 58%; left: 45%"></div>
    <div class="hotspot" data-product-index="0" style="top: 26%; left: 87%"></div>
    <!-- Popups cho hotspot decor -->
    <?php $decor_products = array_slice($decor_products, 0, 3); foreach($decor_products as $i => $product): ?>
      <div class="product-popup decor-popup" id="decor-popup-<?php echo $i; ?>" style="display:none;">
        <img src="<?php echo get_image(get_module_path('shops') . $product['homeimgfile'], get_module_path('shops') . 'no-image-thumb.png'); ?>" alt="<?php echo $product['title']; ?>">
        <div class="popup-product-details">
          <h4><?php echo $product['title']; ?></h4>
          <p><?php echo formatRice($product['product_sales_price']); ?>đ</p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="decor-info">
    <h2>Đồ trang trí</h2>
    <p>Khám phá những ý tưởng mới để biến đổi căn phòng của bạn</p>
    <div class="decor-carousel-wrapper" style="position:relative;">
      <div class="decor-carousel-slider" id="decor-slider" style="overflow:hidden;">
        <?php if(isset($decor_products) && is_array($decor_products) && !empty($decor_products)): ?>
          <?php $decor_products = array_slice($decor_products, 0, 3); ?>
          <?php foreach($decor_products as $i => $product): ?>
            <div class="decor-slide" style="display:<?php echo $i === 0 ? 'block' : 'none'; ?>;">
              <div class="card_product_decor decor-card-custom h-100 position-relative">
                <?php if($product['product_price'] > $product['product_sales_price']): ?>
                  <?php $discount = round((($product['product_price'] - $product['product_sales_price']) / $product['product_price']) * 100); ?>
                  <div class="discount">-<?php echo $discount; ?>%</div>
                <?php endif; ?>
                <img src="<?php echo get_image(get_module_path('shops') . $product['homeimgfile'], get_module_path('shops') . 'no-image-thumb.png'); ?>" class="card-img-top decor-img-big" alt="<?php echo $product['title']; ?>">
                <div class="product-icons_decor">
                  <button class="icon-btn_decor more-btn" data-product-id="<?php echo $product['id']; ?>"><i class="bi bi-cart"></i></button>
                  <button class="icon-btn_decor zoom-btn" data-product='<?php echo json_encode($product); ?>'><i class="bi bi-search"></i></button>
                </div>
                <div class="product-info p-2 bg-light rounded text-center">
                  <h5 class="product-name mb-1" style="font-size:1.2rem;font-weight:600;min-height:2.8em;max-height:2.8em;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;"> <?php echo $product['title']; ?> </h5>
                  <p class="price text-danger fw-bold mb-0" style="font-size:1.1rem;margin-top:8px;">
                    <?php echo formatRice($product['product_sales_price']); ?>đ
                    <?php if($product['product_price'] > $product['product_sales_price']): ?>
                      <span class="original-price text-decoration-line-through text-muted"> <?php echo formatRice($product['product_price']); ?>đ </span>
                    <?php endif; ?>
                  </p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="decor-slide"><p>Không có sản phẩm</p></div>
        <?php endif; ?>
      </div>
      <div id="decor-pagination-dots" class="pagination-dots" style="margin-top:18px;display:flex;justify-content:center;gap:16px;"></div>
    </div>
  </div>
</div>
<script>
(function(){
  var slides = document.querySelectorAll('.decor-slide');
  var dotsContainer = document.getElementById('decor-pagination-dots');
  var current = 0;
  function showSlide(idx) {
    slides.forEach(function(slide, i){
      slide.style.display = (i === idx) ? 'block' : 'none';
      if(dotsContainer.children[i]) {
        dotsContainer.children[i].classList.toggle('active', i === idx);
      }
    });
  }
  // Tạo dot
  dotsContainer.innerHTML = '';
  for(var i=0;i<slides.length;i++){
    var dot = document.createElement('div');
    dot.className = 'dot';
    if(i===0) dot.classList.add('active');
    dot.onclick = (function(idx){ return function(){ current=idx; showSlide(current); }; })(i);
    dotsContainer.appendChild(dot);
  }
  showSlide(current);
})();
</script>
<style>
.decor-card-custom {
  border-radius: 20px;
  box-shadow: 0 6px 24px rgba(0,0,0,0.13);
  padding: 24px 16px 28px 16px;
  background: #fff;
  margin: 0 auto;
  max-width: 540px;
  min-width: 400px;
  min-height: 520px;
  transition: box-shadow 0.2s;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.decor-card-custom:hover {
  box-shadow: 0 12px 32px rgba(0,0,0,0.18);
}
.decor-img-big {
  width: 100%;
  height: 380px;
  object-fit: cover;
  border-radius: 14px;
  margin-bottom: 18px;
}
.pagination-dots {
  margin-top: 18px;
  display: flex;
  justify-content: center;
  gap: 16px;
}
.dot {
  width: 40px;
  height: 12px;
  border-radius: 6px;
  background: #e2e3e7;
  transition: background 0.2s;
  display: inline-block;
}
.dot.active {
  background: #f5a06d;
}
</style>

<!-- Đèn trang trí (dạng lưới ngang giống Thiết bị vệ sinh) -->
<div class="decor-page">
  <div class="decor-title-wrapper">
    <span>Đèn trang trí</span>
  </div>
  <div class="decor-carousel">
    <?php if(isset($promo_products) && is_array($promo_products) && !empty($promo_products)): ?>
      <?php foreach($promo_products as $product): ?>
        <div>
          <div class="card_product_decor h-100 position-relative">
            <?php if($product['product_price'] > $product['product_sales_price']): ?>
              <?php $discount = round((($product['product_price'] - $product['product_sales_price']) / $product['product_price']) * 100); ?>
              <div class="discount">-<?php echo $discount; ?>%</div>
            <?php endif; ?>
            <img src="<?php echo get_image(get_module_path('shops') . $product['homeimgfile'], get_module_path('shops') . 'no-image-thumb.png'); ?>" class="card-img-top decor-img-big" alt="<?php echo $product['title']; ?>">
            <div class="product-icons_decor">
              <button class="icon-btn_decor more-btn" data-product-id="<?php echo $product['id']; ?>"><i class="bi bi-cart"></i></button>
              <button class="icon-btn_decor zoom-btn" data-product='<?php echo json_encode($product); ?>'><i class="bi bi-search"></i></button>
            </div>
            <div class="product-info">
              <h5 class="product-name mb-1"><?php echo $product['title']; ?></h5>
              <p class="price">
                <?php echo formatRice($product['product_sales_price']); ?>đ
                <?php if($product['product_price'] > $product['product_sales_price']): ?>
                  <span class="original-price"><?php echo formatRice($product['product_price']); ?>đ</span>
                <?php endif; ?>
              </p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div><p>Không có sản phẩm</p></div>
    <?php endif; ?>
  </div>
  <div class="btn-wrapper text-center">
    <button class="btn-xem-tat-ca">XEM TẤT CẢ</button>
  </div>
</div>

<!-- Section Đồ nội thất (giống Đồ trang trí, có hotspot) -->
<div class="decor-section">
  <div class="decor-image-wrapper">
    <img src="assets/img/image_set_2.webp" alt="Phòng khách nội thất" />
    <div class="hotspot" data-product-index="2" style="top: 70%; left: 13%"></div>
    <div class="hotspot" data-product-index="1" style="top: 19%; left: 28%"></div>
    <div class="hotspot" data-product-index="0" style="top: 50%; left: 80%"></div>
    <!-- Popups cho hotspot nội thất -->
    <?php $furniture_products = array_slice($furniture_products, 0, 3); foreach($furniture_products as $i => $product): ?>
      <div class="product-popup furniture-popup" id="furniture-popup-<?php echo $i; ?>" style="display:none;">
        <img src="<?php echo get_image(get_module_path('shops') . $product['homeimgfile'], get_module_path('shops') . 'no-image-thumb.png'); ?>" alt="<?php echo $product['title']; ?>">
        <div class="popup-product-details">
          <h4><?php echo $product['title']; ?></h4>
          <p><?php echo formatRice($product['product_sales_price']); ?>đ</p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="decor-info">
    <h2>Đồ nội thất</h2>
    <p>Khám phá những thiết kế nội thất hiện đại, tinh tế cho không gian sống của bạn</p>
    <div class="decor-carousel-wrapper" style="position:relative;">
      <div class="decor-carousel-slider" id="furniture-slider" style="overflow:hidden;">
        <?php if(isset($furniture_products) && is_array($furniture_products) && !empty($furniture_products)): ?>
          <?php $furniture_products = array_slice($furniture_products, 0, 3); ?>
          <?php foreach($furniture_products as $i => $product): ?>
            <div class="decor-slide" style="display:<?php echo $i === 0 ? 'block' : 'none'; ?>;">
              <div class="card_product_decor decor-card-custom h-100 position-relative">
                <?php if($product['product_price'] > $product['product_sales_price']): ?>
                  <?php $discount = round((($product['product_price'] - $product['product_sales_price']) / $product['product_price']) * 100); ?>
                  <div class="discount">-<?php echo $discount; ?>%</div>
                <?php endif; ?>
                <img src="<?php echo get_image(get_module_path('shops') . $product['homeimgfile'], get_module_path('shops') . 'no-image-thumb.png'); ?>" class="card-img-top decor-img-big" alt="<?php echo $product['title']; ?>">
                <div class="product-icons_decor">
                  <button class="icon-btn_decor more-btn" data-product-id="<?php echo $product['id']; ?>"><i class="bi bi-cart"></i></button>
                  <button class="icon-btn_decor zoom-btn" data-product='<?php echo json_encode($product); ?>'><i class="bi bi-search"></i></button>
                </div>
                <div class="product-info p-2 bg-light rounded text-center">
                  <h5 class="product-name mb-1" style="font-size:1.2rem;font-weight:600;min-height:2.8em;max-height:2.8em;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;"> <?php echo $product['title']; ?> </h5>
                  <p class="price text-danger fw-bold mb-0" style="font-size:1.1rem;margin-top:8px;">
                    <?php echo formatRice($product['product_sales_price']); ?>đ
                    <?php if($product['product_price'] > $product['product_sales_price']): ?>
                      <span class="original-price text-decoration-line-through text-muted"> <?php echo formatRice($product['product_price']); ?>đ </span>
                    <?php endif; ?>
                  </p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="decor-slide"><p>Không có sản phẩm</p></div>
        <?php endif; ?>
      </div>
      <div id="furniture-pagination-dots" class="pagination-dots" style="margin-top:18px;display:flex;justify-content:center;gap:16px;"></div>
    </div>
  </div>
</div>
<script>
(function(){
  var slides = document.querySelectorAll('#furniture-slider .decor-slide');
  var dotsContainer = document.getElementById('furniture-pagination-dots');
  var current = 0;
  function showSlide(idx) {
    slides.forEach(function(slide, i){
      slide.style.display = (i === idx) ? 'block' : 'none';
      if(dotsContainer.children[i]) {
        dotsContainer.children[i].classList.toggle('active', i === idx);
      }
    });
  }
  // Tạo dot
  dotsContainer.innerHTML = '';
  for(var i=0;i<slides.length;i++){
    var dot = document.createElement('div');
    dot.className = 'dot';
    if(i===0) dot.classList.add('active');
    dot.onclick = (function(idx){ return function(){ current=idx; showSlide(current); }; })(i);
    dotsContainer.appendChild(dot);
  }
  showSlide(current);
})();
</script>

<!-- Section Thiết bị vệ sinh -->
<div class="decor-page">
  <div class="decor-title-wrapper">
    <span>Thiết bị vệ sinh</span>
  </div>
  <div class="decor-carousel">
    <?php if(isset($sanitary_products) && is_array($sanitary_products) && !empty($sanitary_products)): ?>
      <?php foreach($sanitary_products as $product): ?>
        <div>
          <div class="card_product_decor h-100 position-relative">
            <?php if($product['product_price'] > $product['product_sales_price']): ?>
              <?php $discount = round((($product['product_price'] - $product['product_sales_price']) / $product['product_price']) * 100); ?>
              <div class="discount">-<?php echo $discount; ?>%</div>
            <?php endif; ?>
            <img src="<?php echo get_image(get_module_path('shops') . $product['homeimgfile'], get_module_path('shops') . 'no-image-thumb.png'); ?>" class="card-img-top decor-img-big" alt="<?php echo $product['title']; ?>">
            <div class="product-icons_decor">
              <button class="icon-btn_decor more-btn" data-product-id="<?php echo $product['id']; ?>"><i class="bi bi-cart"></i></button>
              <button class="icon-btn_decor zoom-btn" data-product='<?php echo json_encode($product); ?>'><i class="bi bi-search"></i></button>
            </div>
            <div class="product-info">
              <h5 class="product-name mb-1"><?php echo $product['title']; ?></h5>
              <p class="price">
                <?php echo formatRice($product['product_sales_price']); ?>đ
                <?php if($product['product_price'] > $product['product_sales_price']): ?>
                  <span class="original-price"><?php echo formatRice($product['product_price']); ?>đ</span>
                <?php endif; ?>
              </p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div><p>Không có sản phẩm</p></div>
    <?php endif; ?>
  </div>
  <div class="btn-wrapper text-center">
    <button class="btn-xem-tat-ca">XEM TẤT CẢ</button>
  </div>
</div>

<section class="review-section">
  <div class="review-wrapper">
    <!-- Cột trái -->
    <div class="review-left">
      <div class="review-title">
        <h2>Đánh giá khách hàng</h2>
        <p>
          Những lời đánh giá chân thật từ những khách hàng đã đặt niềm tin ở
          <span>Bean Furniture</span>
        </p>
      </div>
      <div class="review-card">
        <img src="assets/img/image_danh_gia_1.webp" alt="Đặng Chinh Đức" />
        <div class="review-info">
          <div>
            <h4>Đặng Chinh Đức</h4>
            <small>Developer</small>
            <p>
              Sản phẩm được thiết kế chi tiết, nhiều mẫu mã và đặc biệt nhân
              viên tư vấn nhiệt tình. Tôi rất hài lòng với trải nghiệm tại
              đây!
            </p>
          </div>
          <div class="quote">❝</div>
        </div>
      </div>
    </div>

    <!-- Cột phải -->
    <div class="review-right">
      <div class="review-card">
        <img src="assets/img/image_danh_gia_1.webp" alt="Nguyễn Ngọc Sơn" />
        <div class="review-info">
          <div>
            <h4>Nguyễn Ngọc Sơn</h4>
            <small>Đầu bếp</small>
            <p>
              Sản phẩm được thiết kế chi tiết, nhiều mẫu mã và đặc biệt nhân
              viên tư vấn nhiệt tình. Tôi rất hài lòng với trải nghiệm tại
              đây!
            </p>
          </div>
          <div class="quote">❝</div>
        </div>
      </div>
      <div class="review-card">
        <img src="assets/img/image_danh_gia_1.webp" alt="Lê Quang Hải" />
        <div class="review-info">
          <div>
            <h4>Lê Quang Hải</h4>
            <small>Giáo viên</small>
            <p>
              Sản phẩm được thiết kế chi tiết, nhiều mẫu mã và đặc biệt nhân
              viên tư vấn nhiệt tình. Tôi rất hài lòng với trải nghiệm tại
              đây!
            </p>
          </div>
          <div class="quote">❝</div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="news-section">
  <h2>Tin tức mới nhất</h2>
  <p class="subtitle">Cập nhật những tin tức nội thất mới nhất hiện nay</p>

  <div class="news-list">
    <!-- Card 1 -->
    <div class="news-card">
      <div class="news-image-wrapper">
        <img
          src="assets/img/ghe-sofa-gia-re-duoi-2-trieu-14.webp"
          alt="Sofa"
        />
      </div>
      <div class="news-content">
        <div class="news-title">
          5 Mẫu Ghế Sofa Giá Rẻ Dưới 2 Triệu Nhỏ Gọn Bán Chạy Nhất 2023
        </div>
        <div class="news-date">27/08/2023</div>
        <div class="news-description">
          Mẫu ghế sofa giá rẻ dưới 2 triệu hiện đang được nhiều người "săn
          lùng" nhờ giá thành rẻ, chất lượng tốt...
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="news-card">
      <div class="news-image-wrapper">
        <img
          src="assets/img/ghe-sofa-gia-re-duoi-2-trieu-14.webp"
          alt="Sofa"
        />
      </div>
      <div class="news-content">
        <div class="news-title">
          Cách Lắp Ghế Xoay Văn Phòng Nhanh Chóng Chỉ Trong 4 Bước
        </div>
        <div class="news-date">26/08/2023</div>
        <div class="news-description">
          Bạn đang loay hoay tìm cách lắp ghế xoay văn phòng? Chúc mừng bạn,
          bạn đã tìm đúng nơi rồi đấy...
        </div>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="news-card">
      <div class="news-image-wrapper">
        <img
          src="assets/img/ghe-sofa-gia-re-duoi-2-trieu-14.webp"
          alt="Sofa"
        />
      </div>
      <div class="news-content">
        <div class="news-title">
          Hướng Dẫn Chọn Kích Thước Ghế Giám Đốc Phù Hợp Cho Lãnh Đạo
        </div>
        <div class="news-date">25/08/2023</div>
        <div class="news-description">
          Ghế giám đốc là lựa chọn số một mang lại uy thế cho các nhà lãnh
          đạo. Hãy lựa chọn đúng kiểu dáng...
        </div>
      </div>
    </div>
    <div class="news-card">
      <div class="news-image-wrapper">
        <img
          src="assets/img/ghe-sofa-gia-re-duoi-2-trieu-14.webp"
          alt="Sofa"
        />
      </div>
      <div class="news-content">
        <div class="news-title">
          Hướng Dẫn Chọn Kích Thước Ghế Giám Đốc Phù Hợp Cho Lãnh Đạo
        </div>
        <div class="news-date">25/08/2023</div>
        <div class="news-description">
          Ghế giám đốc là lựa chọn số một mang lại uy thế cho các nhà lãnh
          đạo. Hãy lựa chọn đúng kiểu dáng...
        </div>
      </div>
    </div>
    <div class="news-card">
      <div class="news-image-wrapper">
        <img
          src="assets/img/ghe-sofa-gia-re-duoi-2-trieu-14.webp"
          alt="Sofa"
        />
      </div>
      <div class="news-content">
        <div class="news-title">
          Hướng Dẫn Chọn Kích Thước Ghế Giám Đốc Phù Hợp Cho Lãnh Đạo
        </div>
        <div class="news-date">25/08/2023</div>
        <div class="news-description">
          Ghế giám đốc là lựa chọn số một mang lại uy thế cho các nhà lãnh
          đạo. Hãy lựa chọn đúng kiểu dáng...
        </div>
      </div>
    </div>
  </div>
</section>

<section class="insta-section">
  <h2>Theo dõi instagram của chúng tôi</h2>
  <span>@BeanFurniture</span>
  <div class="insta-gallery">
    <!-- Ảnh 1 -->
    <div class="insta-item">
      <img src="assets/img/cate_1_img.webp" alt="Ảnh 1" />
      <div class="insta-overlay">
        <img
          src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png"
          alt="Instagram"
        />
      </div>
    </div>
    <!-- Ảnh 2 -->
    <div class="insta-item">
      <img src="assets/img/cate_2_img.webp" alt="Ảnh 2" />
      <div class="insta-overlay">
        <img
          src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png"
          alt="Instagram"
        />
      </div>
    </div>
    <!-- Ảnh 3 -->
    <div class="insta-item">
      <img src="assets/img/cate_3_img.webp" alt="Ảnh 3" />
      <div class="insta-overlay">
        <img
          src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png"
          alt="Instagram"
        />
      </div>
    </div>
    <!-- Ảnh 4 -->
    <div class="insta-item">
      <img src="assets/img/cate_4_img.webp" alt="Ảnh 4" />
      <div class="insta-overlay">
        <img
          src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png"
          alt="Instagram"
        />
      </div>
    </div>
    <!-- Ảnh 5 -->
    <div class="insta-item">
      <img src="assets/img/cate_5_img.webp" alt="Ảnh 5" />
      <div class="insta-overlay">
        <img
          src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png"
          alt="Instagram"
        />
      </div>
    </div>
  </div>
</section>

<!-- Modal hiển thị chi tiết sản phẩm -->
<div class="modal" id="product-modal">
  <div class="modal-content">
    <span class="close-btn">&times;</span>
    <div class="modal-body">
      <div class="modal-image">
        <img id="modal-image" src="" alt="Sản phẩm" />
      </div>
      <div class="modal-info">
        <h2 id="modal-title"></h2>
        <p class="modal-price">
          <span id="modal-price"></span>
          <span id="modal-original-price" class="old-price"></span>
        </p>
        <p class="modal-description" id="modal-description"></p>
        <div class="modal-quantity">
          <label>Số lượng:</label>
          <button id="decrease-qty">-</button>
          <span id="modal-quantity">1</span>
          <button id="increase-qty">+</button>
        </div>
        <button class="add-to-cart-btn">Thêm vào giỏ hàng</button>
      </div>
    </div>
  </div>
</div>

<script>
function isMobile() {
  return window.matchMedia && window.matchMedia('(max-width: 768px)').matches;
}

function positionPopupMobile(popup, hotspot) {
  // Giới hạn chiều rộng popup trên mobile
  popup.style.maxWidth = '90vw';
  popup.style.width = 'auto';
  popup.style.left = '0';
  popup.style.right = 'auto';
  popup.style.position = 'absolute';
  popup.style.zIndex = 1002;
  // Tính toán vị trí
  var parent = hotspot.parentElement;
  var parentRect = parent.getBoundingClientRect();
  var hsRect = hotspot.getBoundingClientRect();
  var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
  var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  // Lấy vị trí hotspot so với parent
  var hsTop = hotspot.offsetTop;
  var hsLeft = hotspot.offsetLeft;
  // Hiện tạm để lấy kích thước popup
  popup.style.visibility = 'hidden';
  popup.style.display = 'flex';
  var popupW = popup.offsetWidth;
  var popupH = popup.offsetHeight;
  popup.style.visibility = '';
  popup.style.display = 'flex';
  // Ưu tiên hiển thị phía dưới
  var top = hsTop + hotspot.offsetHeight + 8;
  // Nếu không đủ chỗ phía dưới thì hiển thị phía trên
  if (top + popupH > parent.offsetHeight) {
    top = hsTop - popupH - 8;
    if (top < 0) top = 0;
  }
  // Căn giữa theo hotspot
  var left = hsLeft + hotspot.offsetWidth/2 - popupW/2;
  // Nếu bị tràn trái
  if (left < 0) left = 4;
  // Nếu bị tràn phải
  if (left + popupW > parent.offsetWidth) left = parent.offsetWidth - popupW - 4;
  popup.style.top = top + 'px';
  popup.style.left = left + 'px';
}

// Decor Hotspot Popup
function setupHotspotPopup(sectionClass, popupPrefix) {
  var section = document.querySelector(sectionClass);
  if (!section) return;
  var hotspots = section.querySelectorAll('.hotspot');
  hotspots.forEach(function(hotspot) {
    var idx = hotspot.getAttribute('data-product-index');
    var popup = document.getElementById(popupPrefix + idx);
    if (!popup) return;
    // Reset popup state
    popup.style.display = 'none';
    // Remove old listeners
    hotspot.onmouseenter = hotspot.onmouseleave = hotspot.onclick = null;
    if (isMobile()) {
      // Mobile: click to toggle popup
      hotspot.addEventListener('click', function(e) {
        e.stopPropagation();
        // Ẩn tất cả popup khác
        section.querySelectorAll('.product-popup').forEach(function(p) { if(p!==popup) p.style.display='none'; });
        // Toggle popup
        if (popup.style.display === 'flex') {
          popup.style.display = 'none';
        } else {
          popup.style.display = 'flex';
          positionPopupMobile(popup, hotspot);
        }
      });
      // Ẩn popup khi click ra ngoài
      document.addEventListener('click', function hidePopup(e) {
        if (!section.contains(e.target)) {
          popup.style.display = 'none';
        }
      });
    } else {
      // Desktop: hover
      hotspot.addEventListener('mouseenter', function(e) {
        popup.style.display = 'flex';
        // Vị trí phía trên, căn giữa như cũ
        popup.style.top = (hotspot.offsetTop - popup.offsetHeight - 12) + 'px';
        popup.style.left = (hotspot.offsetLeft - popup.offsetWidth/2 + hotspot.offsetWidth/2) + 'px';
        popup.style.position = 'absolute';
        popup.style.zIndex = 1002;
      });
      hotspot.addEventListener('mouseleave', function(e) {
        popup.style.display = 'none';
      });
    }
  });
}

function setupAllHotspotPopups() {
  setupHotspotPopup('.decor-section', 'decor-popup-');
  var furnitureSection = document.querySelectorAll('.decor-section')[1];
  if (furnitureSection) {
    setupHotspotPopupSection(furnitureSection, 'furniture-popup-');
  }
}

// Thêm hàm setupHotspotPopupSection cho section truyền vào trực tiếp
function setupHotspotPopupSection(section, popupPrefix) {
  if (!section) return;
  var hotspots = section.querySelectorAll('.hotspot');
  hotspots.forEach(function(hotspot) {
    var idx = hotspot.getAttribute('data-product-index');
    var popup = document.getElementById(popupPrefix + idx);
    if (!popup) return;
    popup.style.display = 'none';
    hotspot.onmouseenter = hotspot.onmouseleave = hotspot.onclick = null;
    if (isMobile()) {
      hotspot.addEventListener('click', function(e) {
        e.stopPropagation();
        section.querySelectorAll('.product-popup').forEach(function(p) { if(p!==popup) p.style.display='none'; });
        if (popup.style.display === 'flex') {
          popup.style.display = 'none';
        } else {
          popup.style.display = 'flex';
          positionPopupMobile(popup, hotspot);
        }
      });
      document.addEventListener('click', function hidePopup(e) {
        if (!section.contains(e.target)) {
          popup.style.display = 'none';
        }
      });
    } else {
      hotspot.addEventListener('mouseenter', function(e) {
        popup.style.display = 'flex';
        popup.style.top = (hotspot.offsetTop - popup.offsetHeight - 12) + 'px';
        popup.style.left = (hotspot.offsetLeft - popup.offsetWidth/2 + hotspot.offsetWidth/2) + 'px';
        popup.style.position = 'absolute';
        popup.style.zIndex = 1002;
      });
      hotspot.addEventListener('mouseleave', function(e) {
        popup.style.display = 'none';
      });
    }
  });
}

window.addEventListener('DOMContentLoaded', setupAllHotspotPopups);
window.addEventListener('resize', function() {
  // Re-setup listeners on resize (for orientation/mobile/desktop switch)
  setupAllHotspotPopups();
});

document.querySelectorAll('.card_product .main-img').forEach(function(img) {
  img.addEventListener('mouseenter', function() {
    var hover = img.getAttribute('data-hover-image');
    if (hover && hover !== img.src) {
      img.dataset.original = img.src;
      img.src = hover;
    }
  });
  img.addEventListener('mouseleave', function() {
    if (img.dataset.original) {
      img.src = img.dataset.original;
    }
  });
});

// Countdown timer cho khuyến mãi đặc biệt
(function() {
    // Đặt thời gian kết thúc (ví dụ: 3 ngày từ bây giờ)
    var endTime = new Date();
    endTime.setDate(endTime.getDate() + 3); // 3 ngày
    endTime.setHours(0, 0, 0, 0);

    function updateTimer() {
        var now = new Date();
        var distance = endTime - now;
        if (distance < 0) {
            document.getElementById('timer').innerText = 'Đã kết thúc';
            return;
        }
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        document.getElementById('timer').innerText = days + ' ngày ' +
            (hours < 10 ? '0' : '') + hours + ':' +
            (minutes < 10 ? '0' : '') + minutes + ':' +
            (seconds < 10 ? '0' : '') + seconds;
    }
    setInterval(updateTimer, 1000);
    updateTimer();
})();

document.querySelectorAll('.tab-item').forEach(function(tab) {
  tab.addEventListener('click', function() {
    document.querySelectorAll('.tab-item').forEach(function(t) { t.classList.remove('active'); });
    tab.classList.add('active');
    var tabName = tab.getAttribute('data-tab');
    document.querySelectorAll('.product-tab-list').forEach(function(list) {
      if(list.getAttribute('data-tab') === tabName) {
        list.style.display = '';
      } else {
        list.style.display = 'none';
      }
    });
  });
});
</script>
