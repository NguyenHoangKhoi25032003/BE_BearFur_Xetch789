<?php
/**
 * Layout chính cho BearFur - Tích hợp frontend BearFur với backend CodeIgniter
 */
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'BearFur - Nội thất cao cấp'; ?></title>

    <!-- SEO Meta Tags -->
    <?php if(isset($description)): ?>
        <meta name="description" content="<?php echo $description; ?>">
    <?php endif; ?>
    <?php if(isset($keywords)): ?>
        <meta name="keywords" content="<?php echo $keywords; ?>">
    <?php endif; ?>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- P5.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.2/p5.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/promo-banner.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/product-section.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/product_sales.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/product_top.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/product/product.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/decor.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/decor-page.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/intargamr.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/danhgia.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/tintuc.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/modal.css'); ?>" />

    <?php if(isset($add_css) && is_array($add_css)): ?>
        <?php foreach($add_css as $css): ?>
            <link rel="stylesheet" href="<?php echo base_url($css); ?>" />
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container-fluid">
            <div class="logo">
                <a href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url('assets/img/logo.webp'); ?>" alt="Logo" />
                </a>
            </div>

            <!-- Navmenu cho desktop -->
            <nav class="navmenu">
                <ul>
                    <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li>
                    <li><a href="<?php echo base_url('introduce'); ?>">Giới thiệu</a></li>
                    <li class="dropdown">

                        <a href="<?php echo base_url('product'); ?>">Sản phẩm <span class="arrow-icon"><svg width="14" height="8" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L9 9L17 1" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span></a>
                        <div class="dropdown-menu">
                            <div class="dropdown-column">
                                <span class="column-title"><a href="<?php echo base_url('product?catid=1'); ?>">Đèn trang trí</a></span>
                                <ul>
                                    <li><a href="<?php echo base_url('product?catid=4'); ?>">Đèn chùm</a></li>
                                    <li><a href="<?php echo base_url('product?catid=5'); ?>">Đèn âm trần</a></li>
                                    <li><a href="<?php echo base_url('product?catid=6'); ?>">Đèn thả trần</a></li>
                                    <li><a href="<?php echo base_url('product?catid=7'); ?>">Đèn cây - đèn bàn</a></li>
                                </ul>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title"><a href="<?php echo base_url('product?catid=2'); ?>">Đồ trang trí</a></span>
                                <ul>
                                    <li><a href="<?php echo base_url('product?catid=8'); ?>">Kệ sách</a></li>
                                    <li><a href="<?php echo base_url('product?catid=9'); ?>">Đồng hồ treo tường</a></li>
                                    <li><a href="<?php echo base_url('product?catid=10'); ?>">Bàn ghế Sofa</a></li>
                                    <li><a href="<?php echo base_url('product?catid=11'); ?>">Khung tranh ảnh</a></li>
                                </ul>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title"><a href="<?php echo base_url('product?catid=3'); ?>">Đồ nội thất</a></span>
                                <ul>
                                    <li><a href="<?php echo base_url('product?catid=12'); ?>">Nội thất phòng khách</a></li>
                                    <li><a href="<?php echo base_url('product?catid=13'); ?>">Nội thất phòng bếp</a></li>
                                    <li><a href="<?php echo base_url('product?catid=14'); ?>">Nội thất phòng ngủ</a></li>
                                    <li><a href="<?php echo base_url('product?catid=15'); ?>">Nội thất phòng tắm</a></li>
                                </ul>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title"><a href="<?php echo base_url('product?catid=4'); ?>">Thiết bị vệ sinh</a></span>
                                <ul>
                                    <li><a href="<?php echo base_url('product?catid=16'); ?>">Bồn tắm</a></li>
                                    <li><a href="<?php echo base_url('product?catid=17'); ?>">Vòi sen</a></li>
                                    <li><a href="<?php echo base_url('product?catid=18'); ?>">Vòi Lavabo</a></li>
                                    <li><a href="<?php echo base_url('product?catid=19'); ?>">Chậu Lavabo</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li><a href="<?php echo base_url('he-thong'); ?>">Hệ thống</a></li>
                    <li><a href="<?php echo base_url('tin-tuc'); ?>">Tin tức</a></li>
                    <li><a href="<?php echo base_url('contact'); ?>">Liên hệ</a></li>
                </ul>
            </nav>

            <!-- Mobile Navigation Modal -->
            <div id="mobile-nav-modal" class="modal-overlay">
                <div class="modal-content">
                    <button class="modal-close">×</button>
                    <h3 class="modal-title">Danh Mục Sản Phẩm</h3>
                    <div class="modal-menu">
                        <ul>
                            <li><a href="<?php echo base_url(); ?>">Trang Chủ</a></li>
                            <li><a href="<?php echo base_url('introduce'); ?>">Giới Thiệu</a></li>
                            <li class="modal-dropdown">
                                <div class="modal-product-toggle">
                                    <a href="<?php echo base_url('product'); ?>" class="modal-title-link">Sản Phẩm</a>
                                    <span class="toggle-icon">+</span>
                                </div>
                                <ul class="modal-sub-menu"></ul>
                            </li>
                            <li><a href="<?php echo base_url('he-thong'); ?>">Hệ Thống</a></li>
                            <li><a href="<?php echo base_url('tin-tuc'); ?>">Tin Tức</a></li>
                            <li><a href="<?php echo base_url('contact'); ?>">Liên Hệ</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="header-controls">
                <div class="mobile-nav-toggle">☰</div>
                <div class="header-actions">
                    <a href="#" class="search-icon" title="Tìm kiếm">
                        <i class="bi bi-search"></i>
                    </a>

                    <!-- User Dropdown -->
                    <div class="user-dropdown-wrapper">
                        <?php if($logged_in): ?>
                            <a href="#" class="user-icon" title="Tài khoản">
                                <i class="bi bi-person"></i>
                            </a>
                            <div class="user-dropdown">
                                <a href="<?php echo base_url('profile'); ?>">Tài khoản của tôi</a>
                                <a href="<?php echo base_url('orders'); ?>">Đơn hàng</a>
                                <a href="<?php echo base_url('logout'); ?>">Đăng xuất</a>
                            </div>
                        <?php else: ?>
                            <a href="<?php echo base_url('login'); ?>" class="user-icon" title="Đăng nhập">
                                <i class="bi bi-person"></i>
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Cart -->
                    <a href="<?php echo base_url('cart'); ?>" class="cart-icon" title="Giỏ hàng">
                        <i class="bi bi-cart3"></i>
                        <span id="cart-count">0</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Search Modal -->
    <div id="searchModal" class="search-modal">
        <div class="search-modal-content">
            <button id="closeSearch" class="search-close">×</button>
            <form action="<?php echo base_url('search'); ?>" method="GET">
                <input type="text" name="q" placeholder="Tìm kiếm sản phẩm..." required>
                <button type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        <?php echo isset($content) ? $content : ''; ?>
        <?php if (isset($show_home_blocks) && $show_home_blocks): ?>
            <?php $this->load->view('site/partial/product_sales'); ?>
            <?php $this->load->view('site/partial/product_new'); ?>
            <?php $this->load->view('site/partial/product_featured'); ?>
            <?php $this->load->view('site/partial/product_bestview'); ?>
            <?php $this->load->view('site/partial/product_bestseller'); ?>
            <?php $this->load->view('site/partial/product_home'); ?>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <!-- Cột 1 -->
            <div class="footer-col">
                <h4>BEAN FURNITURE</h4>
                <p>Với sứ mệnh "Khách hàng là ưu tiên số 1" chúng tôi luôn mang lại giá trị tốt nhất</p>
                <p><strong>Địa chỉ:</strong> 70 Lữ Gia, Phường 15, Quận 11, TP.HCM</p>
                <p><strong>Điện thoại:</strong> <span style="color:#f5a06d;">1900 6750</span></p>
                <p><strong>Email:</strong> support@sapo.vn</p>
                <div class="footer-icons">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                </div>
            </div>

            <!-- Cột 2 -->
            <div class="footer-col">
                <h4>CHÍNH SÁCH</h4>
                <a href="#">Chính sách thành viên</a>
                <a href="#">Chính sách thanh toán</a>
                <a href="#">Chính sách đổi sản phẩm</a>
                <a href="#">Chính sách bảo mật</a>
                <a href="#">Chính sách cộng tác viên</a>
            </div>

            <!-- Cột 3 -->
            <div class="footer-col">
                <h4>HƯỚNG DẪN</h4>
                <a href="#">Hướng dẫn mua hàng</a>
                <a href="#">Hướng dẫn đổi trả</a>
                <a href="#">Hướng dẫn thanh toán</a>
                <a href="#">Chương trình cộng tác viên</a>
                <a href="#">Giải đáp thắc mắc</a>
            </div>

            <!-- Cột 4 -->
            <div class="footer-col">
                <h4>ĐĂNG KÝ NHẬN TIN</h4>
                <p>Đăng ký ngay! Để nhận thật nhiều ưu đãi</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Nhập địa chỉ email" required />
                    <button type="submit">ĐĂNG KÝ</button>
                </form>
                <h4>HÌNH THỨC THANH TOÁN</h4>
                <div class="payment-methods">
                    <img src="<?php echo base_url('assets/img/payment_1.webp'); ?>" alt="Tiền mặt" />
                    <img src="<?php echo base_url('assets/img/payment_2.webp'); ?>" alt="Chuyển khoản" />
                    <img src="<?php echo base_url('assets/img/payment_3.webp'); ?>" alt="Visa" />
                    <img src="<?php echo base_url('assets/img/payment_4.webp'); ?>" alt="MasterCard" />
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            © Bản quyền thuộc về <strong>Mr. Bean</strong> | Cung cấp bởi Sapo
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>

    <?php if(isset($add_js) && is_array($add_js)): ?>
        <?php foreach($add_js as $js): ?>
            <script src="<?php echo base_url($js); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <script>
        // Initialize cart count
        function initCartCount() {
            let count = localStorage.getItem('cartCount');
            if (!count) {
                count = 0;
                localStorage.setItem('cartCount', count);
            }
            updateCartCountUI(count);
        }

        function updateCartCountUI(count) {
            const cartSpan = document.querySelector('#cart-count');
            if (cartSpan) cartSpan.innerText = count;
        }

        function increaseCartCount() {
            let count = localStorage.getItem('cartCount');
            count = parseInt(count || '0') + 1;
            localStorage.setItem('cartCount', count);
            updateCartCountUI(count);
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', () => {
            initCartCount();
        });
    </script>
</body>
</html>
