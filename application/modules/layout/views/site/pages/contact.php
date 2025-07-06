<?php /* Trang liên hệ BearFur */ ?>
<?php
// Copy nội dung từ BearFur_Xtech789/contac.html vào đây và sửa đường dẫn asset nếu có
?>
<!-- Nội dung trang liên hệ sẽ được đặt ở đây -->

<section
  class="about-hero"
  style="background-image: url('<?php echo base_url('assets/img/breadcrumb.jpg'); ?>')"
>
  <div class="about-hero-content">
    <h1>Liên hệ</h1>
    <p><a href="<?php echo base_url(); ?>">Trang chủ</a> &nbsp;›&nbsp; <span>Liên hệ</span></p>
  </div>
</section>

<section class="contact-section">
  <!-- Cột trái -->
  <div class="contact-left">
    <h3>Nơi giải đáp toàn bộ mọi thắc mắc của bạn?</h3>
    <p class="desc">
      Với sứ mệnh "Khách hàng là ưu tiên số 1" chúng tôi luôn mang lại giá
      trị tốt nhất
    </p>

    <div class="info-group">
      <div class="info-item">
        <i class="fas fa-map-marker-alt"></i>
        <div>
          <b>Địa chỉ</b>
          70 Lữ Gia, Phường 15, Quận 11, TP.HCM
        </div>
      </div>
      <div class="info-item">
        <i class="fas fa-clock"></i>
        <div>
          <b>Thời gian làm việc</b>
          8h - 22h từ thứ 2 đến chủ nhật
        </div>
      </div>
      <div class="info-item">
        <i class="fas fa-phone"></i>
        <div>
          <b>Hotline</b>
          1900 6750
        </div>
      </div>
      <div class="info-item">
        <i class="fas fa-envelope"></i>
        <div>
          <b>Email</b>
          support@sapo.vn
        </div>
      </div>
    </div>

    <h3>Liên hệ với chúng tôi</h3>
    <p class="desc">
      Nếu bạn có thắc mắc gì, có thể gửi yêu cầu cho chúng tôi, và chúng tôi
      sẽ liên lạc lại với bạn sớm nhất có thể.
    </p>

    <form>
      <input type="text" placeholder="Họ và tên" required />
      <input type="email" placeholder="Email" required />
      <input type="tel" placeholder="Điện thoại*" required />
      <textarea rows="4" placeholder="Nội dung"></textarea>
      <button class="btn_send" type="submit">Gửi thông tin</button>
    </form>
  </div>

  <!-- Cột phải (bản đồ) -->
  <div class="contact-right">
    <iframe
      src="https://www.google.com/maps?q=266+Đội+Cấn,+Ba+Đình,+Hà+Nội&output=embed"
      allowfullscreen
      loading="lazy"
    >
    </iframe>
  </div>
</section>
<link rel="stylesheet" href="<?php echo base_url('assets/css/contac/contac.css'); ?>" />
