<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'BearFur - Nội thất cao cấp'; ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- P5.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.2/p5.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/promo-banner.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/product-section.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sales.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/product_sales.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/product_top.css'); ?>" />
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
    <header class="header">
        <div class="container-fluid">
            <div class="logo">
                <a href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url('assets/img/logo.webp'); ?>" alt="BearFur Logo" />
                </a>
            </div>

            <!-- Navmenu cho desktop -->
            <nav class="navmenu">
                <ul>
                    <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li>
                    <li><a href="<?php echo base_url('introduce'); ?>">Giới thiệu</a></li>
                    <li class="dropdown">
                        <a href="<?php echo base_url('product'); ?>">Sản phẩm</a>
                        <div class="dropdown-menu">
                            <div class="dropdown-column">
                                <span class="column-title">Đèn trang trí</span>
                                <ul>
                                    <li><a href="<?php echo base_url('product?category=Đèn trang trí&type=Đèn chùm'); ?>">Đèn chùm</a></li>
                                    <li><a href="<?php echo base_url('product?category=Đèn trang trí&type=Đèn âm trần'); ?>">Đèn âm trần</a></li>
                                    <li><a href="<?php echo base_url('product?category=Đèn trang trí&type=Đèn thả trần'); ?>">Đèn thả trần</a></li>
                                    <li><a href="<?php echo base_url('product?category=Đèn trang trí&type=Đèn cây - đèn bàn'); ?>">Đèn cây - đèn bàn</a></li>
                                </ul>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title">Đồ trang trí</span>
                                <ul>
                                    <li><a href="<?php echo base_url('product?category=Đồ trang trí&type=Kệ sách'); ?>">Kệ sách</a></li>
                                    <li><a href="<?php echo base_url('product?category=Đồ trang trí&type=Đồng hồ treo tường'); ?>">Đồng hồ treo tường</a></li>
                                    <li><a href="<?php echo base_url('product?category=Đồ trang trí&type=Bàn ghế Sofa'); ?>">Bàn ghế Sofa</a></li>
                                    <li><a href="<?php echo base_url('product?category=Đồ trang trí&type=Khung tranh ảnh'); ?>">Khung tranh ảnh</a></li>
                                </ul>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title">Đồ nội thất</span>
                                <ul>
                                    <li><a href="<?php echo base_url('product?category=Đồ nội thất&type=Nội thất phòng khách'); ?>">Nội thất phòng khách</a></li>
                                    <li><a href="<?php echo base_url('product?category=Đồ nội thất&type=Nội thất phòng bếp'); ?>">Nội thất phòng bếp</a></li>
                                    <li><a href="<?php echo base_url('product?category=Đồ nội thất&type=Nội thất phòng ngủ'); ?>">Nội thất phòng ngủ</a></li>
                                    <li><a href="<?php echo base_url('product?category=Đồ nội thất&type=Nội thất phòng tắm'); ?>">Nội thất phòng tắm</a></li>
                                </ul>
                            </div>
                            <div class="dropdown-column">
                                <span class="column-title">Thiết bị vệ sinh</span>
                                <ul>
                                    <li><a href="<?php echo base_url('product?category=Thiết bị vệ sinh&type=Bồn tắm'); ?>">Bồn tắm</a></li>
                                    <li><a href="<?php echo base_url('product?category=Thiết bị vệ sinh&type=Vòi sen'); ?>">Vòi sen</a></li>
                                    <li><a href="<?php echo base_url('product?category=Thiết bị vệ sinh&type=Vòi Lavabo'); ?>">Vòi Lavabo</a></li>
                                    <li><a href="<?php echo base_url('product?category=Thiết bị vệ sinh&type=Chậu Lavabo'); ?>">Chậu Lavabo</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li><a href="<?php echo base_url('system'); ?>">Hệ thống</a></li>
                    <li><a href="<?php echo base_url('news'); ?>">Tin tức</a></li>
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
                            <li><a href="<?php echo base_url('system'); ?>">Hệ Thống</a></li>
                            <li><a href="<?php echo base_url('news'); ?>">Tin Tức</a></li>
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
</body>
</html>
