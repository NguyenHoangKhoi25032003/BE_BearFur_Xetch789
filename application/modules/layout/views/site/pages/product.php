<?php /* Trang sản phẩm BearFur */ ?>
<?php
// Sử dụng biến $products nếu có, fallback về $all_products nếu không có
$product_list = isset($products) ? $products : (isset($all_products) ? $all_products : []);
?>
<!-- Nội dung trang sản phẩm sẽ được đặt ở đây -->

<section
  class="about-hero"
  style="background-image: url('<?php echo base_url('assets/img/breadcrumb.jpg'); ?>')"
>
  <div class="about-hero-content">
    <h1 id="hero-title">
      <?php
        if (!empty($category) && !empty($type)) echo htmlspecialchars($type) . ' - ' . htmlspecialchars($category);
        elseif (!empty($category)) echo htmlspecialchars($category);
        else echo "Tất cả sản phẩm";
      ?>
    </h1>
    <p>
      <a href="<?php echo base_url(); ?>">Trang chủ</a> &nbsp;›&nbsp;
      <span id="breadcrumb-title">
        <?php
          if (!empty($category) && !empty($type)) echo htmlspecialchars($type) . ' - ' . htmlspecialchars($category);
          elseif (!empty($category)) echo htmlspecialchars($category);
          else echo "Tất cả sản phẩm";
        ?>
      </span>
    </p>
  </div>
</section>
<div class="product-page">
  <div class="product-sidebar">
    <div class="widget category-widget">
      <h3 class="widget-title">DANH MỤC SẢN PHẨM</h3>
      <ul class="category-list">
        <li class="category-item">
          <div class="category-header">
            <a href="<?php echo base_url('product?catid=1'); ?>">Đèn trang trí</a>
            <span class="toggle">+</span>
          </div>
          <ul class="subcategory-list">
            <li class="subcategory-item"><a href="<?php echo base_url('product?catid=5'); ?>">Đèn âm trần</a></li>
            <li class="subcategory-item"><a href="<?php echo base_url('product?catid=6'); ?>">Đèn thả trần</a></li>
            <li class="subcategory-item"><a href="<?php echo base_url('product?catid=7'); ?>">Đèn cây - đèn bàn</a></li>
          </ul>
        </li>
        <li class="category-item">
          <div class="category-header">
            <a href="<?php echo base_url('product?catid=2'); ?>">Đồ trang trí</a>
            <span class="toggle">+</span>
          </div>
          <ul class="subcategory-list">
            <li class="subcategory-item"><a href="<?php echo base_url('product?catid=8'); ?>">Kệ sách</a></li>
            <li class="subcategory-item"><a href="<?php echo base_url('product?catid=9'); ?>">Đồng hồ treo tường</a></li>
            <li class="subcategory-item"><a href="<?php echo base_url('product?catid=10'); ?>">Bàn ghế Sofa</a></li>
            <li class="subcategory-item"><a href="<?php echo base_url('product?catid=11'); ?>">Khung tranh ảnh</a></li>
          </ul>
        </li>
        <li class="category-item">
          <div class="category-header">
            <a href="<?php echo base_url('product?catid=3'); ?>">Đồ nội thất</a>
            <span class="toggle">+</span>
          </div>
          <ul class="subcategory-list">
            <li class="subcategory-item"><a href="<?php echo base_url('product?catid=12'); ?>">Nội thất phòng khách</a></li>
            <li class="subcategory-item"><a href="<?php echo base_url('product?catid=13'); ?>">Nội thất phòng bếp</a></li>
            <li class="subcategory-item"><a href="<?php echo base_url('product?catid=14'); ?>">Nội thất phòng ngủ</a></li>
            <li class="subcategory-item"><a href="<?php echo base_url('product?catid=15'); ?>">Nội thất phòng tắm</a></li>
          </ul>
        </li>
        <li class="category-item">
          <div class="category-header">
            <a href="<?php echo base_url('product?catid=4'); ?>">Thiết bị vệ sinh</a>
            <span class="toggle">+</span>
          </div>
          <ul class="subcategory-list">
            <li class="subcategory-item"><a href="<?php echo base_url('product?catid=16'); ?>">Bồn tắm</a></li>
            <li class="subcategory-item"><a href="<?php echo base_url('product?catid=17'); ?>">Vòi sen</a></li>
            <li class="subcategory-item"><a href="<?php echo base_url('product?catid=18'); ?>">Vòi Lavabo</a></li>
            <li class="subcategory-item"><a href="<?php echo base_url('product?catid=19'); ?>">Chậu Lavabo</a></li>
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
      <h2 id="section-title">
        <?php
          if (!empty($category) && !empty($type)) echo htmlspecialchars($type) . ' - ' . htmlspecialchars($category);
          elseif (!empty($category)) echo htmlspecialchars($category);
          else echo "Tất cả sản phẩm";
        ?>
      </h2>
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
      <?php if (!empty($product_list)): ?>
        <?php foreach ($product_list as $product): ?>
          <?php $alias = !empty($product['alias']) ? $product['alias'] : url_title($product['title'], 'dash', true); ?>
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
              <button class="icon-btn" title="Thêm vào giỏ" data-product-id="<?php echo $product['id']; ?>"><i class="bi bi-cart"></i></button>
                <button class="icon-btn" title="Xem chi tiết" data-product-id="<?php echo $product['id']; ?>" data-product-alias="<?php echo $alias; ?>"><i class="bi bi-search"></i></button>
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

<script>
document.querySelectorAll('.category-header .toggle').forEach(function(toggleBtn) {
  toggleBtn.addEventListener('click', function() {
    var subList = this.parentElement.nextElementSibling;
    if (subList && subList.classList.contains('subcategory-list')) {
      if (subList.style.display === 'block') {
        subList.style.display = 'none';
        this.textContent = '+';
      } else {
        subList.style.display = 'block';
        this.textContent = '-';
      }
    }
  });
});
// Ẩn tất cả danh mục khi bấm "Ẩn tất cả danh mục"
document.querySelector('.toggle-all')?.addEventListener('click', function() {
  document.querySelectorAll('.subcategory-list').forEach(function(list) {
    list.style.display = 'none';
  });
  document.querySelectorAll('.category-header .toggle').forEach(function(btn) {
    btn.textContent = '+';
  });
});
</script>
