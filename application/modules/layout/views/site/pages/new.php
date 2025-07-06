<?php /* Trang tin tức mới BearFur */ ?>
<?php
// Copy nội dung từ BearFur_Xtech789/new.html vào đây và sửa đường dẫn asset nếu có
?>
<!-- Nội dung trang tin tức mới sẽ được đặt ở đây -->

<section
  class="about-hero"
  style="background-image: url('<?php echo base_url('assets/img/breadcrumb.jpg'); ?>')"
>
  <div class="about-hero-content">
    <h1>Tin tức</h1>
    <p><a href="<?php echo base_url(); ?>">Trang chủ</a> &nbsp;›&nbsp; <span>Tin tức</span></p>
  </div>
</section>

<div class="container">
  <div class="news-layout">
    <section class="news-section">
      <div class="container">
        <h2 class="section-title">Tin tức mới nhất</h2>
        <p class="section-subtitle">
          Cập nhật những tin tức nội thất mới nhất hiện nay
        </p>

        <div class="news-list" id="news-list">
          <!-- Dữ liệu sẽ được render từ JS -->
        </div>

        <div class="pagination" id="pagination"></div>
      </div>
    </section>

    <aside class="sidebar">
      <!-- Tìm kiếm -->
      <div class="widget search-widget">
        <h3 class="widget-title">TÌM KIẾM TIN TỨC</h3>
        <div class="search-box">
          <input type="text" placeholder="Tìm kiếm tin tức..." />
          <button><i class="bi bi-search"></i></button>
        </div>
      </div>

      <!-- Danh mục sản phẩm -->
      <div class="widget category-widget">
        <h3 class="widget-title">DANH MỤC SẢN PHẨM</h3>
        <ul class="category-list">
          <li>Đèn trang trí <span>+</span></li>
          <li>Đồ trang trí <span>+</span></li>
          <li>Đồ nội thất <span>+</span></li>
          <li>Thiết bị vệ sinh <span>+</span></li>
        </ul>
      </div>

      <!-- Tags -->
      <div class="widget tags-widget">
        <h3 class="widget-title">TAGS</h3>
        <div class="tags">
          <div class="tags">
            <a href="#">Bàn làm việc thông minh</a>
            <a href="#">Kích thước sofa</a>
            <a href="#">Phòng khách</a>
            <a href="#">Sofa</a>
            <a href="#">Sofa da</a>
            <a href="#">Sofa giá rẻ</a>
            <a href="#">Sofa gỗ</a>
            <a href="#">Vệ sinh tủ đồ</a>
            <a href="#">Xu hướng 2023</a>
          </div>
        </div>
      </div>

      <!-- Tin tức nổi bật -->
      <div class="widget hot-news-widget">
        <h3 class="widget-title">TIN TỨC NỔI BẬT</h3>
        <ul class="hot-news-list">
          <li>
            <img
              src="<?php echo base_url('assets/img/ghe-sofa-gia-re-duoi-2-trieu-14.webp'); ?>"
              alt="News 1"
            />
            <p>5 Mẫu ghế sofa giá rẻ dưới 2 triệu nhỏ gọn bán chạy...</p>
          </li>
          <li>
            <img
              src="<?php echo base_url('assets/img/ghe-sofa-gia-re-duoi-2-trieu-14.webp'); ?>"
              alt="News 2"
            />
            <p>Cách lắp ghế xoay văn phòng nhanh chóng chỉ trong 4 bước</p>
          </li>
          <li>
            <img
              src="<?php echo base_url('assets/img/ghe-sofa-gia-re-duoi-2-trieu-14.webp'); ?>"
              alt="News 3"
            />
            <p>Hướng dẫn chọn kích thước ghế giám đốc phù hợp</p>
          </li>
          <li>
            <img
              src="<?php echo base_url('assets/img/ghe-sofa-gia-re-duoi-2-trieu-14.webp'); ?>"
              alt="News 4"
            />
            <p>5+ mẫu bàn làm việc xoay 360 độ linh hoạt</p>
          </li>
          <li>
            <img
              src="<?php echo base_url('assets/img/ghe-sofa-gia-re-duoi-2-trieu-14.webp'); ?>"
              alt="News 5"
            />
            <p>Cách bố trí phòng làm việc tại nhà đơn giản dễ làm</p>
          </li>
        </ul>
      </div>
    </aside>
  </div>
  <div class="pagination" id="pagination"></div>
</div>
<link rel="stylesheet" href="<?php echo base_url('assets/css/new/new.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/css/tintuc.css'); ?>" />
<script src="<?php echo base_url('assets/js/new/new.js'); ?>"></script>
