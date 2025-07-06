<?php
$current_user = get_current_user_logged_in();
?>
<header>
    <!-- <div class="box-scroll-top">
        <i class="fas fa-arrow-up"></i>
    </div> -->
    <div class="box-header" >
        <div class="block-header-top">
            <div class="container">
                <div class="row">
                    <!-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <ul class="header-top-left">
                            <li>
                                <a
                                    href="tel:<?php echo isset($current_user['phone']) ? $current_user['phone'] : (isset($info_hotline_none['content']) ? $info_hotline_none['content'] : ''); ?>"><span
                                        class="icon--border">
                                        <i
                                            class="fas fa-phone-volume"></i></span><?php echo isset($current_user['phone']) ? $current_user['phone'] : (isset($info_hotline_none['content']) ? $info_hotline_none['content'] : ''); ?></a>
                            </li>
                            <li>
                                <a
                                    href="mailto:<?php echo isset($current_user['email']) ? $current_user['email'] : (isset($info_email_none['content']) ? $info_email_none['content'] : ''); ?>">
                                    <span class="icon--border"><i
                                            class="far fa-envelope"></i></span><?php echo isset($current_user['email']) ? $current_user['email'] : (isset($info_email_none['content']) ? $info_email_none['content'] : ''); ?></a>
                            </li>
                        </ul>
                    </div> -->
                    <!--
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <ul class="header-top-right">
                            <li>
                                <a href="#">
                                    <span class="icon--border"><i class="fas fa-clipboard-list"></i></span>Kiểm tra đơn
                                    hàng
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="icon--border"><i class="fas fa-map-marker-alt"></i></span>Hệ thống cửa
                                    hàng
                                </a>
                            </li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="block-header-center">
            <div class="container">
                <div class="row">
                    <!-- <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <div class="block-header--logo">
                            <a href="<?php echo site_url(); ?>"><img
                                    src="<?php echo base_url(get_module_path('logo') . $site_logo); ?>"
                                    alt="./images/logo.png" class="img-fluid"></a> 
                        </div>
                    </div> -->
                    <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 align-seft-center">
                        <div class="box-search">
                            <form action="<?php echo base_url('search'); ?>" method="GET" autocomplete="off">
                                <div class="input-group">
                                    <input type="text" class="form-control input--field search" name="q" value="<?php echo isset($q) ? $q : ''; ?>" placeholder="Tìm kiếm sản phẩm ...">
                                    <div class="input-group-append">
                                        <button class="btn btn--search" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 align-seft-center">
                        <div class="block-header-center-right">
                            <ul>
                                <li class="block-header--account">
                                    <a href="javascript:void(0)" rel="nofollow">
                                        <img src="<?php echo get_asset('img_path'); ?>businessman.svg" alt="" class="img-fluid">
                                    </a>
                                    <ul class="sub-account">
                                        <?php if ($logged_in) : ?>
                                            <li><a href="<?php echo site_url('trang-ca-nhan'); ?>">Trang cá nhân</a></li>
                                            <li><a href="<?php echo site_url('doi-mat-khau'); ?>">Đổi mật khẩu</a></li>
                                            <li><a href="<?php echo site_url('chia-se-san-pham'); ?>">Chia sẻ sản phẩm</a></li>
                                            <li><a href="<?php echo site_url('hoa-hong'); ?>">Hoa hồng</a></li>
                                            <?php $shop_status = get_user_shop_status($userid); ?>
                                            <?php if ($shop_status == -1) : ?>
                                                <li><a class="btn btn--login mt-2" style="color: #fff; background: #007bff; border: 1px solid #007bff;" href="<?php echo site_url('dang-ky-ban-hang'); ?>">Đăng ký bán hàng</a></li>
                                            <?php elseif ($shop_status == 1) : ?>
                                                <li><a class="btn btn--login mt-2" style="color: #fff; background: #007bff; border: 1px solid #007bff;" href="<?php echo site_url('quan-ly-san-pham'); ?>">Cửa hàng</a></li>
                                            <?php endif; ?>
                                            <li><a class="btn btn--login mt-2" href="<?php echo site_url('dang-xuat'); ?>" onclick="if(!confirm('Bạn có muốn đăng xuất?')){return false;}">Đăng xuất</a></li>
                                        <?php else : ?>
                                            <li><a href="<?php echo site_url('dang-nhap'); ?>" class="btn btn--login">Đăng nhập</a></li>
                                            <li><a href="<?php echo site_url('dang-ky'); ?>" class="btn btn--register">Đăng ký</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <li class="box-cart">
                                    <div class="wsminicart wsminicartmobile clearfix">
                                        <div class="minicart mini-cart">
                                            <?php $this->load->view('partial/mini-cart'); ?>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-header-bottom">
            <div class="container">
                <div class="box-menu">
                    <div class="wsmobileheader clearfix ">
                        <a href="#" id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
                        <span class="smllogo"><a href="<?php echo site_url(); ?>"><img src="<?php echo base_url(get_module_path('logo') . $site_logo); ?>" width="80" alt="" /></a></span>
                        <div class="box-cart callusbtn">
                            <div class="wsminicart wsminicartmobile clearfix">
                                <div class="minicart mini-cart">
                                    <?php $this->load->view('partial/mini-cart'); ?>
                                </div>
                            </div>
                            <ul>
                                <li class="block-header--account">
                                    <a href="javascript:void(0)">
                                        <img src="<?php echo get_asset('img_path'); ?>businessman.svg" alt="./images/businessman.svg" width=35px class="img-fluid">
                                    </a>
                                    <ul class="sub-account">
                                        <?php if ($logged_in) : ?>
                                            <li><a href="<?php echo site_url('trang-ca-nhan'); ?>">Trang cá nhân</a></li>
                                            <li><a href="<?php echo site_url('doi-mat-khau'); ?>">Đổi mật khẩu</a></li>
                                            <li><a href="<?php echo site_url('chia-se-san-pham'); ?>">Chia sẻ sản phẩm</a>
                                            </li>
                                            <li><a href="<?php echo site_url('hoa-hong'); ?>">Hoa hồng</a></li>
                                            <li><a class="btn btn--login mt-2" href="<?php echo site_url('dang-xuat'); ?>" onclick="if(!confirm('Bạn có muốn đăng xuất?')){return false;}">Đăng
                                                    xuất</a></li>
                                        <?php else : ?>
                                            <li><a href="<?php echo site_url('dang-nhap'); ?>" class="btn btn--login">Đăng
                                                    nhập</a></li>
                                            <li><a href="<?php echo site_url('dang-ky'); ?>" class="btn btn--register">Đăng
                                                    ký</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="wsmainwp clearfix">
                        <nav class="wsmenu clearfix">
                            <ul class="wsmenu-list">
                                <?php echo isset($html_menu_main) ? $html_menu_main : ''; ?>
                                <?php //echo menu_main(0, $menu_main_list, $menu_main_data, 0); 
                                ?>
                            </ul>
                        </nav>

                    </div>

                </div>
            </div>
        </div>
        <div id="masthead" class="header-main hide-for-sticky">
            <div class="header-inner flex-row container logo-left medium-logo-center" role="navigation">

                <!-- Logo -->
                <div id="logo" class="flex-col logo">

                    <!-- Header logo -->

                    <a href="<?php echo site_url(); ?>"><img src="<?php echo base_url(get_module_path('logo') . $site_logo); ?>" alt="./images/logo.png" class="img-fluid"></a>
                </div>
            </div>

        </div>
    </div>
</header>