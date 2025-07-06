<?php
$current_user = get_current_user_logged_in();
?>
<footer>
    <div class="box-newsletter">

        <div class="block-footer--logo">
            <img src="<?php echo base_url('assets/images/footer.png'); ?>" alt="">
        </div>
        <!-- <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 align-seft-center">
                    <div class="block--title">
                        <h3 class="main--title">Đăng kí nhận tin khuyến mãi</h3>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="block-newsletter--form">
                        <form method="POST" action="<?php echo base_url('newsletter'); ?>" id="newsletter-signup">
                            <div class="input-group">
                                <input type="email" id="signup_email" name="signup_email"
                                    class="form-control input--field" placeholder="Nhập email của bạn ...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn--newsletter">Đăng ký</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <div class="box-footer">
        <div class="container">
            <div class="block-footer">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 cot1">
                        <div class="block-footer--title">
                            <div class="block-footer--title">
                                <h3>CÔNG TY TNHH KHO LẠNH HƯNG TÍN</h3>
                            </div>
                            <ul>
                                <li>
                                    <p>
                                        <?php echo isset($info_address_none['title']) ? $info_address_none['title'] : ''; ?>:
                                        <?php echo isset($info_address_none['content']) ? $info_address_none['content'] : ''; ?>
                                    </p>
                                </li>
                                <li>
                                    <p> <?php echo isset($info_hotline_none['title']) ? $info_hotline_none['title'] : ''; ?>:
                                        <?php echo isset($current_user['phone']) ? $current_user['phone'] : (isset($info_hotline_none['content']) ? $info_hotline_none['content'] : ''); ?></p>
                                </li>
                                <li>
                                    <p><?php echo isset($info_email_none['title']) ? $info_email_none['title'] : ''; ?>:
                                        <?php echo isset($current_user['email']) ? $current_user['email'] : (isset($info_email_none['content']) ? $info_email_none['content'] : ''); ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="block-footer--title">
                            <h3>LIÊN KẾT</h3>
                        </div>
                        <div class="block-footer--list">
                            <ul>
                                <?php echo isset($html_menu_bottom) ? $html_menu_bottom : ''; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="block-footer--title">
                            <div class="block-footer--title">
                                <h3>ĐĂNG KÝ NHẬN TIN</h3>
                            </div>
                            <p style="color:#fff">Mỗi tháng chúng tối đều có đợt giảm giá dịch
                                vụ và sản phẩm nhầm chi
                                ân khách hàng. Để có thể cập nhật kịp thời
                                những đợt giảm giá này,
                                vui lòng nhập địa chỉ email bạn vào ô dưới
                                đây.
                            </p>
                            <div class="block-newsletter--form">
                                <form method="POST" action="<?php echo base_url('newsletter'); ?>" id="newsletter-signup">
                                    <div class="input-group">
                                        <input type="email" id="signup_email" name="signup_email" class="form-control input--field" placeholder="Nhập email của bạn ...">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn--newsletter">GỬI ĐI</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                        <div class="block-footer--logo">
                            <a href="<?php echo site_url(); ?>"><img src="<?php echo base_url(get_module_path('logo') . $site_logo_footer); ?>" alt="./images/logo_footer.png" class="img-fluid"></a>
                        </div>
                        <div class="block-footer--address">
                            <h3>
                                <?php echo isset($info_infomation_none['content']) ? $info_infomation_none['content'] : ''; ?>
                            </h3>
                            <ul>
                                <li><?php echo isset($info_address_none['title']) ? $info_address_none['title'] : ''; ?>:
                                    <?php echo isset($info_address_none['content']) ? $info_address_none['content'] : ''; ?>
                                </li>
                                <li><?php echo isset($info_hotline_none['title']) ? $info_hotline_none['title'] : ''; ?>:
                                    <?php echo isset($current_user['phone']) ? $current_user['phone'] : (isset($info_hotline_none['content']) ? $info_hotline_none['content'] : ''); ?>
                                </li>
                                <li><?php echo isset($info_email_none['title']) ? $info_email_none['title'] : ''; ?>:
                                    <?php echo isset($current_user['email']) ? $current_user['email'] : (isset($info_email_none['content']) ? $info_email_none['content'] : ''); ?>
                                </li>
                            </ul>
                        </div>
                    </div> -->
                    <!-- <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                            <div class="row"> -->
                    <!-- <div class="col-xl-4 col-lg-4 col-md-3 col-sm-12 col-6">
                                <div class="block-footer--title">
                                    <h3>LIÊN KẾT</h3>
                                </div>
                                <div class="block-footer--list">
                                    <ul>
                                        <?php echo isset($html_menu_bottom) ? $html_menu_bottom : ''; ?>
                                    </ul>
                                </div>
                            </div> -->

                    <!--<div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                                <div class="block-footer--contact">
                                    <div class="block-footer--title">
                                        <h3>Kết nối với chúng tôi</h3>
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="<?php echo isset($facebook_fanpage) ? $facebook_fanpage : ''; ?>"><i
                                                    class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo isset($twitter_page) ? $twitter_page : ''; ?>"><i
                                                    class="fab fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo isset($google_plus) ? $google_plus : ''; ?>"><i
                                                    class="fab fa-google"></i></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo isset($instagram_page) ? $instagram_page : ''; ?>"><i
                                                    class="fab fa-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo isset($youtube_page) ? $youtube_page : ''; ?>"><i
                                                    class="fab fa-youtube"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <?php if (isset($payment_methods_none) && is_array($payment_methods_none) && !empty($payment_methods_none)) :
                                    $data_src = get_image(get_module_path('images') . $payment_methods_none['image'], get_module_path('images') . 'no-image.png');
                                ?>
                                  <div class="block-footer--payment">
                                      <div class="block-footer--title">
                                          <h3><?php echo $payment_methods_none['title'] ?></h3>
                                      </div>
                                      <a href="<?php echo $payment_methods_none['link'] ?>"><img
                                              src="<?php echo $data_src ?>" alt="./images/i_payment.png"
                                              class="img-fluid">
                                      </a>
                                  </div>
                                <?php endif; ?>
                            </div>-->

                    <!-- <div class="col-xl-8 col-lg-8 col-md-6 col-sm-12 ">
                                <div class="block-footer--title">
                                    <h3>fANPAGE</h3>
                                </div>
                                <div class="embed-responsivee overflow-hidden">
                                    <?php echo isset($fb_page) ? $fb_page : ''; ?>
                                </div>

                            </div> -->
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="absolute-footer">
        <div class="container clearfix">
            <div class="footer-secondary pull-right">
                <?php echo isset($info_hotline_none['title']) ? $info_hotline_none['title'] : ''; ?>:
                <?php echo isset($current_user['phone']) ? $current_user['phone'] : (isset($info_hotline_none['content']) ? $info_hotline_none['content'] : ''); ?></p>
            </div>
            <div class="footer-primary pull-left">
                <?php echo isset($info_copyright_none['content']) ? $info_copyright_none['content'] : ''; ?>

            </div>
        </div>
    </div>
    <!-- <div class="box-copyright">
        <?php echo isset($info_copyright_none['content']) ? $info_copyright_none['content'] : ''; ?>
    </div> -->
    </div>
    <div class="hotline-footer">
        <div class="left">
            <a href="">Chat với tư vấn
                viên</a>
        </div>
        <div class="right">
            <a href="">Gọi ngay</a>
        </div>
        <div class="clearboth"></div>
        </body>
</footer>