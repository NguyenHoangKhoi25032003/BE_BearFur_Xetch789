<?php if (isset($data) && is_array($data) && !empty($data)) : ?>
    <section>
        <div class="box-product">
            <div class="container">
                <div class="block--title">
                    <div class="title-text space-20">
                        <div class="title-text bg-grey title-du-an">
                            <h2 style="text-align: center;">SẢN PHẨM</h2>
                        </div>
                    </div>
                    <!-- <h3><a href="#" class="main--title">Sản phẩm bán chạy</a></h3> -->
                </div>
                <div class="mr-15px">
                    <div class="block-product--slider">
                        <?php
                        $current_user_level = get_current_user_level();
                        $user_level_percent = get_user_level_percent($current_user_level);
                        foreach ($data as $value) :
                            $data_id = $value['id'];
                            $data_title = $value['title'];
                            $data_link = site_url($this->config->item('url_shops_rows') . '/' . $value['cat_alias'] . '/' . $value['alias'] . '-' . $data_id);
                            $data_image = array(
                                'src' => get_media('shops', $value['homeimgfile'], 'no-image.png', '480x480x1'),
                                'alt' => ''
                            );
                            $data_discount_percent = $value['product_discount_percent'];
                            $data_price = $value['product_price'];
                            $data_sales_price = get_product_discounts($value['product_price'], $value['product_sales_price']);
                            if ($user_level_percent > 0) {
                                $data_price = get_discount_price_by_percent($data_price, $user_level_percent);
                                $data_sales_price = get_discount_price_by_percent($data_sales_price, $user_level_percent);
                            }
                        ?>
                            <div>
                                <div class="box-product-item">
                                    <div class="block-product--image">
                                        <a href="<?php echo $data_link; ?>"><img src="<?php echo $data_image['src']; ?>" alt="<?php echo $data_image['alt']; ?>" class="img-fluid"></a>
                                        <div class="block-product--button">
                                            <button type="button" href="#" class="btn btn--add btn-add-to-cart" data-id="<?php echo $data_id; ?>" data-url="<?php echo $data_link; ?>">
                                                Thêm vào giỏ hàng
                                            </button>
                                        </div>
                                    </div>
                                    <div class="block-product--content">
                                        <div class="block-product--title">
                                            <h3><a href="<?php echo $data_link; ?>"><?php echo $data_title; ?></a></h3>
                                        </div>
                                        <div class="block-product--rating">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <div class="block-product--price">
                                            <?php if ($data_sales_price > 0) : ?>
                                                <?php if ($data_sales_price == $data_price) : ?>
                                                    <span class="price--sale"><?php echo formatRice($data_price); ?>đ</span>
                                                <?php else : ?>
                                                    <span class="price--sale"><?php echo formatRice($data_sales_price); ?>
                                                        đ</span>
                                                    <span class="price--origin"><?php echo  formatRice($data_price); ?> đ</span>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <span class="price--sale">Liên hệ</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if ($data_sales_price != 0 && $data_sales_price != $data_price) : ?>
                                        <div class="block-product--tag">
                                            <img src="<?php echo get_asset('img_path'); ?>label_sale.png" alt="./images/label_sale.png" class="img-fluid">
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>