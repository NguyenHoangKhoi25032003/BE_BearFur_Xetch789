<div id="promo-product-list" class="row product-tab-list" data-tab="top">
    <?php if(isset($promo_products) && is_array($promo_products) && !empty($promo_products)): ?>
        <?php foreach($promo_products as $product): ?>
            <div class="card_product">
                <?php if($product['product_price'] > $product['product_sales_price']): ?>
                    <?php $discount = round((($product['product_price'] - $product['product_sales_price']) / $product['product_price']) * 100); ?>
                    <div class="discount">-<?php echo $discount; ?>%</div>
                <?php endif; ?>
                <?php
                $img_file = trim($product['homeimgfile']);
                $img_path = 'uploads/shops/' . $img_file;
                $main_img = get_image($img_path, 'uploads/shops/no-image-thumb.png');
                $hover_img = '';
                if (!empty($product['otherimage'])) {
                    $imgs = explode(',', $product['otherimage']);
                    if (count($imgs) > 0 && trim($imgs[0]) !== '') {
                        $hover_img = get_image('uploads/shops/' . trim($imgs[0]), 'uploads/shops/pro_2.webp');
                    }
                }
                if (!$hover_img || $hover_img == $main_img) {
                    $hover_img = base_url('assets/img/slider_2.webp');
                }
                ?>
                <div style="position:relative;">
                  <img src="<?php echo $main_img; ?>" alt="<?php echo $product['title']; ?>" class="main-img" data-hover-image="<?php echo $hover_img; ?>" >
                  <div class="product-icons">
                    <button class="icon-btn add-to-cart" title="Thêm vào giỏ" data-product-id="<?php echo $product['id']; ?>">
                      <i class="fa fa-shopping-cart"></i>
                    </button>
                    <button class="icon-btn quick-view" title="Xem nhanh" data-product-id="<?php echo $product['id']; ?>">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
                <div class="product-info">
                    <span class="new-label">Hàng mới</span>
                    <div class="product-name"><?php echo $product['title']; ?></div>
                    <div class="price">
                        <?php echo formatRice($product['product_sales_price']); ?>đ
                        <?php if($product['product_price'] > $product['product_sales_price']): ?>
                            <span class="original-price"><?php echo formatRice($product['product_price']); ?>đ</span>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center">
            <p>Không có sản phẩm</p>
        </div>
    <?php endif; ?>
</div>
