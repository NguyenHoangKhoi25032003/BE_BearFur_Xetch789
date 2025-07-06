<section
  class="about-hero"
  style="background-image: url('<?php echo base_url('assets/img/breadcrumb.jpg'); ?>')"
>
  <div class="about-hero-content">
    <h1>Hệ thống</h1>
    <p><a href="<?php echo base_url(); ?>">Trang chủ</a> &nbsp;›&nbsp; <span>Hệ thống</span></p>
  </div>
</section>

<section class="store-locator">
  <!-- 🔍 Thanh tìm kiếm ở đầu -->
  <div class="store-search">
    <input type="text" id="search-input" placeholder="Nhập tên cửa hàng" />
    <select id="province-filter">
      <option value="">Chọn tỉnh thành</option>
      <option value="Hồ Chí Minh">Hồ Chí Minh</option>
      <option value="Bình Dương">Bình Dương</option>
      <option value="Cần Thơ">Cần Thơ</option>
      <option value="Hà Nội">Hà Nội</option>
    </select>
    <select id="district-filter">
      <option value="">Chọn quận/huyện</option>
    </select>
  </div>
  <div class="store-content" style="display: flex; gap: 24px; flex-wrap: wrap">
    <div class="store-sidebar" id="store-list">
      <!-- Mỗi .store-item sẽ được render hoặc thêm từ JS -->
    </div>
    <div class="store-map">
      <iframe
        id="map-frame"
        src="https://www.google.com/maps?q=70+Lữ+Gia,+TP.HCM&output=embed"
      ></iframe>
    </div>
  </div>
</section>
