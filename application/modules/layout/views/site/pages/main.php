<article>
    <?php if (isset($slideshow_none) && is_array($slideshow_none) && !empty($slideshow_none)) : ?>
        <section>
            <div class="box-banner">
                <div class="block-banner--slider">
                    <?php
                    foreach ($slideshow_none as $key => $value) :
                        $data_src = get_media('images', $value['image'], 'no-image.png');
                    ?>
                        <div class="slide">
                            <a href="<?php echo $value['link']; ?>"><img src="<?php echo $data_src; ?>" alt="<?php echo $value['title']; ?>" class="img-fluid w-100"></a>
                        </div>
                        <div class="slide">
                            <a href="<?php echo $value['link']; ?>"> <img src="<?php echo base_url('assets/images/slider1.png'); ?>" class="img-fluid w-100" alt="<?php echo $value['title']; ?>">
                            </a>
                        </div>
                        <div class="slide">
                            <a href="<?php echo $value['link']; ?>"> <img src="<?php echo base_url('assets/images/slider2.png'); ?>" class="img-fluid w-100" alt="<?php echo $value['title']; ?>">
                            </a>
                        </div>
                        <div class="slide">
                            <a href="<?php echo $value['link']; ?>"> <img src="<?php echo base_url('assets/images/slider3.png'); ?>" class="img-fluid w-100" alt="<?php echo $value['title']; ?>">
                            </a>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <?php if (isset($partner_none) && is_array($partner_none) && !empty($partner_none)) : ?>
        <section>
            <div class="box-partner">
                <div class="container">
                    <div class="row" id="about">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="col-inner">
                                <div class="title-text bg-grey text-left">
                                    <h2>Giới thiệu về chúng tôi</h2>
                                </div>
                                <p class="about__p">
                                    <strong>Công ty TNHH Cơ Điện
                                        Lạnh
                                        Phong Thịnh</strong>
                                    đã hoạt động trong lĩnh vực Cơ
                                    Điện
                                    lạnh từ năm 2018. Lĩnh vực hoạt
                                    động
                                    chính là
                                    tư vấn thiết kế, cung cấp, lắp
                                    đặt,
                                    bảo hành, bảo trì các hệ thống
                                    lạnh,
                                    lạnh công nghiệp, M&E, tự động
                                    hóa,
                                    lò hơi và năng lượng tái tạo
                                </p>
                                <p class="about__p">
                                    Với nhiều năm hoạt động sáng tạo
                                    và
                                    phát triển liên tục cùng với
                                    nồng
                                    cốt
                                    là đội ngũ kĩ sư có chuyên môn
                                    cao.
                                    <strong>Phong Thịnh</strong>
                                    đã khẳng định được vị thế của
                                    mình
                                    trên thương trường, luôn là đối
                                    tác
                                    tin cậy hàng đầu của
                                    các nhà đầu tư trong và ngoài
                                    nước.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="col-inner">
                                <div class="img has-hover" id="image__about1">
                                    <div class="img-inner dark">
                                        <img src="<?php echo base_url('assets/images/about1.jpg'); ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-12">
                            <div class="block--title">
                                <h3 class="main--title">Danh mục</h3>
                                <h4 class="sub--title">Nổi bật</h4>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
                            <div class="mr-15px">
                                <div class="block-partner--slider">
                                    <?php
                                    foreach ($partner_none as $key => $value) :
                                        $data_src = get_media('images', $value['image'], 'no-image.png', '165x75x2');
                                    ?>
                                        <div>
                                            <a href="<?php echo $value['link']; ?>"><img src="<?php echo $data_src; ?>" alt="<?php echo $value['title']; ?>" class="img-fluid"></a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
        <section>
            <div class="section bai_viet_tin_tuc">
                <div class="section-content relative">
                    <div class="row_bai_viet_tin_tuc-1" id="bao_viet_tin_tuc-1">
                        <div class="col_bai_viet_tin_tuc col smaill-12 larget-12 medium-12">
                            <div class="col-inner">
                                <div class="row container div__ttha">
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-inner">
                                        <div class="title-text bg-grey text-left">
                                            <h2>Tin tức</h2>
                                        </div>
                                        <div class="large-columns-1 medium-columns-2 small-columns-1 row-xsmall" style="margin-top: 20px;">
                                            <div class="row">
                                                <div class=" col-lg-12 col-md-12 col-sm-6">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="box-image" style="width: 25%;">
                                                                <div class="image-hover" style=" width: 265px;margin-left: 0;">
                                                                    <img src="<?php echo base_url('uploads/posts/bo-dieu-khien-cho-kho-lanh.jpg'); ?>" alt=""> </a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8 col-md-6 col-sm-12">
                                                            <div class="box-text text-left">
                                                                <div class="box-text-inner blog-post-inner">
                                                                    <h5 class="post-title is-large">
                                                                        <a href=#>CÁCH CHỌN BỘ ĐIỀU KHIỂN CHẤT LƯỢNG CHO KHO LẠNH CỦA BẠN</a>
                                                                    </h5>
                                                                    <p class="form-the-blog-excerpt">
                                                                        Hiện trên thị trường có rất nhiều thiết bị điều khiển kém chất lượng từ Trung Quốc. Để không bị mua nhầm hàng nhái, hàng dởm các bạn nên tìm hiểu kỹ...
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="badge absolute top post-date badge-square">
                                                        <div class="badge-inner">
                                                            <span class="post-date-day">30</span><br>
                                                            <span class="post-date-month is-xsmall">Th8</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-6">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="box-image" style="width: 25%;">
                                                                <div class="image-hover" style="width: 265px;">
                                                                    <img src="<?php echo base_url('uploads/posts/120x90_kho-lanh_77.jpg'); ?>" alt=""> </a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8 col-md-6 col-sm-12">
                                                            <div class="box-text text-left">
                                                                <div class="box-text-inner blog-post-inner">
                                                                    <h5 class="post-title is-large">
                                                                        <a href=#>HƯỚNG DẪN THIẾT KẾ VÀ LỰA CHỌN CỬA KHO LẠNH</a>
                                                                    </h5>
                                                                    <p class="form-the-blog-excerpt">
                                                                        Những hướng dẫn trong thiết kế và lựa chọn cửa để vận tải kho lạnh hiệu quả
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="badge absolute top post-date badge-square">
                                                        <div class="badge-inner">
                                                            <span class="post-date-day">12</span><br>
                                                            <span class="post-date-month is-xsmall">Th12</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-6">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                            <div class="box-image" style="width: 25%;">
                                                                <div class="image-hover" style="width: 265px;">
                                                                    <img src="<?php echo base_url('uploads/posts/120x90_kho-lanh_77.jpg'); ?>" alt=""> </a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8 col-md-6 col-sm-12">
                                                            <div class="box-text text-left">
                                                                <div class="box-text-inner blog-post-inner">
                                                                    <h5 class="post-title is-large">
                                                                        <a href=#>HƯỚNG DẪN THIẾT KẾ VÀ LỰA CHỌN CỬA KHO LẠNH</a>
                                                                    </h5>
                                                                    <p class="form-the-blog-excerpt">
                                                                        Những hướng dẫn trong thiết kế và lựa chọn cửa để vận tải kho lạnh hiệu quả
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="badge absolute top post-date badge-square">
                                                        <div class="badge-inner">
                                                            <span class="post-date-day">12</span><br>
                                                            <span class="post-date-month is-xsmall">Th12</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col div-no-padding section-anh col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="col-inner">
                                            <div class="title-text bg-grey text-left">
                                                <h2>Hình ảnh</h2>
                                            </div>
                                            <div class="row row-small">
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="col-inner">
                                                        <div class="img has-hover x md-x lg-x y md-y ly-d ">
                                                            <a href="#" class="image-lightbox lightbox-gallery">
                                                                <div class="img-inner image-zoom image-cover dark" style="padding-top: 200px;">
                                                                    <img src="<?php echo base_url('uploads/images/kho-lanh-chat-luong-cao-1.jpg'); ?>" alt="">
                                                            </a>

                                                        </div>
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 ">
                                                <div class="col-inner">
                                                    <div class="img has-hover x md-x lg-x y md-y ly-d">
                                                        <a href="#" class="image-lightbox lightbox-gallery">
                                                            <div class="img-inner image-zoom image-cover dark" style="padding-top: 200px;">
                                                                <img src="<?php echo base_url('uploads/images/kho-lanh-chat-luong-cao.jpg'); ?>" alt="">

                                                            </div>
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                                <div class="col-inner">
                                                    <div class="img has-hover x md-x lg-x y md-y ly-d">
                                                        <a href=# class="image-lightbox lightbox-gallery">
                                                            <div class="img-inner image-zoom image-cover dark" style="padding-top: 200px;">
                                                                <img src="<?php echo base_url('uploads/posts/Bang-tinh-cho-tru-lanh-va-cap-dong-thuc-pham.jpg'); ?>" alt="">

                                                            </div>
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                                <div class="col-inner">
                                                    <div class="img has-hover x md-x lg-x y md-y ly-d">
                                                        <a href="#" class="image-lightbox lightbox-gallery">
                                                            <div class="img-inner image-zoom image-cover dark" style="padding-top: 200px;">
                                                                <img src="<?php echo base_url('uploads/posts/bo-dieu-khien-cho-kho-lanh.jpg'); ?>" alt="">

                                                            </div>
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    <?php endif; ?>
    <?php echo isset($products_bestseller) ? $products_bestseller : ''; ?>
    <!-- <?php echo isset($products_cat_home) ? $products_cat_home : ''; ?> -->
    <section class="section thuong-hieu-section" id="section_1061462854">
        <div class="bg section-bg fill bg-fill  bg-loaded">

        </div>

        <div class="section-content container relative">

            <div class="row" id="row-638134631">

                <div id="col-50291299" class="col small-12 large-12">
                    <div class="col-inner">

                        <div id="gap-153123113" class="gap-element clearfix" style="display:block; height:auto;">

                        </div>

                        <div class="title-text title-thanh-tuu bg-grey text-left">
                            <h2>NHỮNG THÀNH TỰU ĐẠT ĐƯỢC</h2>
                        </div>
                        <div class="row" id="row-634934317">

                            <div id="col-1992271483" class="col medium-6 small-12 large-6">
                                <div class="col-inner">

                                    <p><span style="font-size: 85%;">Trở
                                            thành đối tác chiến lược của
                                            Danfoss.</span></p>
                                </div>
                            </div>
                            <div id="col-1784264293" class="col medium-6 small-12 large-6">
                                <div class="col-inner">

                                    <div class="slider-wrapper relative" id="slider-766722110">
                                        <!-- <div id="carouselExample" class="carousel slide"> -->
                                        <div class="block-banner--slider">
                                            <?php
                                            foreach ($slideshow_none as $key => $value) :
                                                $data_src = get_media('images', $value['image'], 'no-image.png');
                                            ?>
                                                <div class="slide">
                                                    <img style="width: 250px; height: 300px;" src="<?php echo base_url('assets/images/thuonghieu.jpg'); ?>" alt="">
                                                </div>
                                                <div class="slide">
                                                    <img style="width: 250px; height: 300px;" src="<?php echo base_url('assets/images/thuonghieu.jpg'); ?>" alt="">
                                                    </a>
                                                </div>

                                            <?php endforeach; ?>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section>
        <div class="section section-du-an">
            <div class="section-content relative container">
                <div class="row">
                    <div class="col small-12 large-12">
                        <div class="col-inner">
                            <div class="title-text bg-grey title-du-an">
                                <h2 style="text-align: center;">DỰ ÁN</h2>
                            </div>
                            <div class="row large-columns-4 medium-columns-1 small-2 ">
                                <div class="col post-item">
                                    <div class="col-inner">
                                        <div class="image-container container">
                                            <div class="box-image">
                                                <div class="image-covers">
                                                    <a class="plan">
                                                        <img src="<?php echo base_url('uploads/images/kho-lanh-chat-luong-cao.jpg'); ?>" alt="">

                                                    </a>
                                                    <div class="shade"></div>
                                                </div>
                                            </div>
                                            <div class="box-text-inner blog-post-inner">
                                                <h5 class="image-overlay">
                                                    <p href="" class="plain">Cách Chọn Bộ Điều Khiến Chất Lượng Cho Kho Lạnh Của Bạn</p>
                                                </h5>
                                                <div class="is-divider"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col post-item">
                                    <div class="col-inner">
                                        <div class="image-container container">
                                            <div class="box-image">
                                                <div class="image-covers">
                                                    <a class="plan">
                                                        <img src="<?php echo base_url('uploads/posts/Bang-tinh-cho-tru-lanh-va-cap-dong-thuc-pham.jpg'); ?>" alt="">

                                                    </a>
                                                    <div class="shade"></div>
                                                </div>
                                            </div>
                                            <div class="box-text-inner blog-post-inner">
                                                <h5 class="image-overlay">
                                                    <p href="" class="plain">HƯỚNG DẪN THIẾT KẾ VÀ LỰA CHỌN CỬA KHO LẠNH</p>
                                                </h5>
                                                <div class="is-divider"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col post-item">
                                    <div class="col-inner">
                                        <div class="image-container container">
                                            <div class="box-image box-image_overlay">
                                                <div class="image-covers">
                                                    <a class="plan">
                                                        <img src="<?php echo base_url('uploads/images/kho-lanh-chat-luong-cao-1.jpg'); ?>" alt="">

                                                    </a>
                                                    <div class="shade"></div>
                                                </div>
                                            </div>
                                            <div class="box-text-inner blog-post-inner">
                                                <h5 class="image-overlay img-overlay">
                                                    <p href="" class="plain">Bảng tính cho trữ lạnh và cấp đông thực phẩm</p>
                                                </h5>
                                                <div class="is-divider"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="box-post">
            <div class="container">
                <div class="block--title">
                    <h3><a href="<?php echo site_url('tin-tuc'); ?>" class="main--title"> Tin tức & khuyến mãi</a></h3>
                </div>
                <div class="mr-15px">
                    <div class="block-post--slider">
                        <?php echo isset($posts_home) ? $posts_home : ''; ?>
                    </div>
                </div>
            </div>
        </div> -->
    </section>

    <div class="float-contact">
        <button id="button" class="chat-zalo">
            <a href="">Chat Zalo</a>
        </button>
        <button id="button" class="chat-face">
            <a href="">Chat
                Facebook</a>
        </button>
        <button id="button" class="hotline">
            <a href="tel:0867592111">Hotline: 0387315384</a>
        </button>
    </div>
</article>