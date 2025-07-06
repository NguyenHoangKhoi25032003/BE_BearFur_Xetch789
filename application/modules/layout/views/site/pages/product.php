<?php /* Trang sản phẩm BearFur */ ?>
<?php
// Copy nội dung từ BearFur_Xtech789/product.html vào đây và sửa đường dẫn asset nếu có
?>
<!-- Nội dung trang sản phẩm sẽ được đặt ở đây -->

<section
  class="about-hero"
  style="background-image: url('<?php echo base_url('assets/img/breadcrumb.jpg'); ?>')"
>
  <div class="about-hero-content">
    <h1 id="hero-title">Tất cả sản phẩm</h1>
    <p>
      <a href="<?php echo base_url(); ?>">Trang chủ</a> &nbsp;›&nbsp;
      <span id="breadcrumb-title">Tất cả sản phẩm</span>
    </p>
  </div>
</section>
<div class="product-page">
  <div class="product-sidebar">
    <div class="widget category-widget">
      <h3 class="widget-title">DANH MỤC SẢN PHẨM</h3>
      <ul class="category-list">
        <li class="category-item">
          <div class="category-header" data-category="Đèn trang trí">
            Đèn trang trí <span class="toggle">+</span>
          </div>
          <ul class="subcategory-list">
            <li class="subcategory-item" data-category="Đèn trang trí" data-type="Đèn chùm">Đèn chùm</li>
            <li class="subcategory-item" data-category="Đèn trang trí" data-type="Đèn âm trần">Đèn âm trần</li>
            <li class="subcategory-item" data-category="Đèn trang trí" data-type="Đèn thả trần">Đèn thả trần</li>
            <li class="subcategory-item" data-category="Đèn trang trí" data-type="Đèn cây - đèn bàn">Đèn cây - đèn bàn</li>
          </ul>
        </li>
        <li class="category-item">
          <div class="category-header" data-category="Đồ trang trí">
            Đồ trang trí <span class="toggle">+</span>
          </div>
          <ul class="subcategory-list">
            <li class="subcategory-item" data-category="Đồ trang trí" data-type="Kệ sách">Kệ sách</li>
            <li class="subcategory-item" data-category="Đồ trang trí" data-type="Đồng hồ treo tường">Đồng hồ treo tường</li>
            <li class="subcategory-item" data-category="Đồ trang trí" data-type="Bàn ghế Sofa">Bàn ghế Sofa</li>
            <li class="subcategory-item" data-category="Đồ trang trí" data-type="Khung tranh ảnh">Khung tranh ảnh</li>
          </ul>
        </li>
        <li class="category-item">
          <div class="category-header" data-category="Đồ nội thất">
            Đồ nội thất <span class="toggle">+</span>
          </div>
          <ul class="subcategory-list">
            <li class="subcategory-item" data-category="Đồ nội thất" data-type="Nội thất phòng khách">Nội thất phòng khách</li>
            <li class="subcategory-item" data-category="Đồ nội thất" data-type="Nội thất phòng bếp">Nội thất phòng bếp</li>
            <li class="subcategory-item" data-category="Đồ nội thất" data-type="Nội thất phòng ngủ">Nội thất phòng ngủ</li>
            <li class="subcategory-item" data-category="Đồ nội thất" data-type="Nội thất phòng tắm">Nội thất phòng tắm</li>
          </ul>
        </li>
        <li class="category-item">
          <div class="category-header" data-category="Thiết bị vệ sinh">
            Thiết bị vệ sinh <span class="toggle">+</span>
          </div>
          <ul class="subcategory-list">
            <li class="subcategory-item" data-category="Thiết bị vệ sinh" data-type="Bồn tắm">Bồn tắm</li>
            <li class="subcategory-item" data-category="Thiết bị vệ sinh" data-type="Vòi sen">Vòi sen</li>
            <li class="subcategory-item" data-category="Thiết bị vệ sinh" data-type="Vòi Lavabo">Vòi Lavabo</li>
          </ul>
        </li>
      </ul>
      <div class="toggle-all">
        Ẩn tất cả danh mục <span class="toggle-all-icon">▲</span>
      </div>
    </div>
    <!-- BỘ LỌC SẢN PHẨM -->
    <div class="widget filter-widget">
      <div class="selected-filters" id="selected-filters">
        <div class="selected-header">
          <strong>Bạn chọn</strong>
          <a href="#" id="clear-filters">Bỏ hết ✖</a>
        </div>
        <div id="selected-tags"></div>
      </div>
      <h3 class="widget-title">CHỌN MỨC GIÁ</h3>
      <div class="filter-scroll">
        <label><input type="checkbox" /> Dưới 100.000đ</label>
        <label><input type="checkbox" /> Từ 100.000đ - 200.000đ</label>
        <label><input type="checkbox" /> Từ 200.000đ - 300.000đ</label>
        <label><input type="checkbox" /> Từ 300.000đ - 500.000đ</label>
        <label><input type="checkbox" /> Từ 500.000đ - 1 triệu</label>
        <label><input type="checkbox" /> Từ 1 triệu - 2 triệu</label>
      </div>
      <h3 class="widget-title">LOẠI</h3>
      <div class="filter-scroll">
        <label><input type="checkbox" /> Bàn trang trí</label>
        <label><input type="checkbox" /> Chậu trang trí</label>
        <label><input type="checkbox" /> Kệ trang trí</label>
        <label><input type="checkbox" /> Đôn lục bình</label>
        <label><input type="checkbox" /> Thiết bị vệ sinh</label>
        <label><input type="checkbox" /> Ghế ăn</label>
      </div>
      <h3 class="widget-title">THƯƠNG HIỆU</h3>
      <div class="filter-scroll">
        <label><input type="checkbox" /> HomeLand</label>
        <label><input type="checkbox" /> Bean Eden</label>
        <label><input type="checkbox" /> Bean Violight</label>
        <label><input type="checkbox" /> Bean Homewat</label>
        <label><input type="checkbox" /> Bean Plywood</label>
        <label><input type="checkbox" /> Bean Furniture</label>
      </div>
      <h3 class="widget-title">MÀU SẮC</h3>
      <div class="filter-scroll">
        <label><input type="checkbox" /> Đen</label>
        <label><input type="checkbox" /> Đen Cam</label>
        <label><input type="checkbox" /> Đỏ</label>
        <label><input type="checkbox" /> Đồng Xám</label>
        <label><input type="checkbox" /> Nâu Đậm</label>
        <label><input type="checkbox" /> Xanh Rêu</label>
      </div>
      <h3 class="widget-title">CHẤT LIỆU</h3>
      <div class="filter-scroll">
        <label><input type="checkbox" /> Kim loại</label>
        <label><input type="checkbox" /> Da</label>
        <label><input type="checkbox" /> Nhựa</label>
        <label><input type="checkbox" /> Gỗ công nghiệp</label>
        <label><input type="checkbox" /> Sắt</label>
      </div>
    </div>
  </div>
  <div class="product-main">
    <div class="product-header">
      <h2 id="section-title">TẤT CẢ SẢN PHẨM</h2>
      <div class="sort">
        <i class="bi bi-filter"></i> Sắp xếp:
        <select id="sortSelect" class="op">
          <option>Mặc định</option>
          <option>Giá tăng dần</option>
          <option>Giá giảm dần</option>
        </select>
      </div>
    </div>
    <div id="product-list" class="product-list">
      <?php if (!empty($all_products)): ?>
        <?php foreach ($all_products as $product): ?>
          <div class="product-card"
               data-price="<?php echo $product['product_sales_price'] ?? $product['product_price']; ?>"
               data-category="<?php echo $product['listcatid']; ?>"
               data-type="<?php echo htmlspecialchars($product['type'] ?? ''); ?>"
               data-brand="<?php echo htmlspecialchars($product['brand'] ?? ''); ?>"
               data-color="<?php echo htmlspecialchars($product['color'] ?? ''); ?>"
               data-material="<?php echo htmlspecialchars($product['material'] ?? ''); ?>">
            <div class="product-image">
              <img src="<?php echo base_url('uploads/shops/' . ($product['homeimgfile'] ?? 'no-image-thumb.png')); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>" class="main">
              <?php if (!empty($product['homeimgalt'])): ?>
                <img src="<?php echo base_url('uploads/shops/' . $product['homeimgalt']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>" class="hover">
              <?php endif; ?>
              <div class="product-icons">
              <button class="icon-btn" title="Thêm vào giỏ"><i class="bi bi-cart"></i></button>
                <button class="icon-btn" title="Xem chi tiết"><i class="bi bi-search"></i></button>

              </div>
            </div>
            <div class="product-info">
              <h4 class="product-title"><?php echo htmlspecialchars($product['title']); ?></h4>
              <div class="product-price">
                <span class="current"><?php echo number_format($product['product_sales_price'] ?? $product['product_price'], 0, ',', '.'); ?> đ</span>
                <?php if (!empty($product['product_price']) && !empty($product['product_sales_price']) && $product['product_price'] > $product['product_sales_price']): ?>
                  <span class="old">
                    <?php echo number_format($product['product_price'], 0, ',', '.'); ?> đ
                  </span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Không có sản phẩm nào.</p>
      <?php endif; ?>
    </div>
    <div id="pagination" class="pagination"></div>
  </div>
</div>
