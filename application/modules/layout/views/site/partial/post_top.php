<?php
if (isset($data) && is_array($data) && !empty($data)):
    $i = 0;
    echo '<div class="row" style="gap:18px;">';
    foreach ($data as $product):
        $discount = (isset($product['product_price']) && $product['product_price'] > $product['product_sales_price'])
            ? round((($product['product_price'] - $product['product_sales_price']) / $product['product_price']) * 100)
            : 0;
        $main_img = get_image(get_module_path('posts') . $product['homeimgfile'], get_module_path('posts') . 'no-image.png');
        $hover_img = '';
        if (!empty($product['otherimage'])) {
            $imgs = explode(',', $product['otherimage']);
            if (count($imgs) > 0 && trim($imgs[0]) !== '') {
                $hover_img = get_image(get_module_path('posts') . trim($imgs[0]), get_module_path('posts') . 'no-image.png');
            }
        }
        if (!$hover_img) {
            $hover_img = base_url('uploads/shops/no-image-thumb.png');
        }
        $title = word_limiter($product['title' . $_lang], $word_limiter_title_posts);
        $desc = !empty($product['description']) ? $product['description'] : '';
        $price = isset($product['product_sales_price']) ? intval($product['product_sales_price']) : 0;
        $original_price = isset($product['product_price']) ? intval($product['product_price']) : 0;
        $sold = isset($product['sold']) ? intval($product['sold']) : 0;
        $link = site_url($product['categories']['alias' . $_lang] . '/' . $product['alias' . $_lang] . '-' . $product['id']);
        if ($i > 0 && $i % 4 == 0) echo '</div><div class="row" style="gap:18px;">';
?>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
        <div class="card_product flex-fill">
            <div class="product-img-wrap">
                <?php if($discount > 0): ?>
                    <span class="discount-label">-<?php echo $discount; ?>%</span>
                <?php endif; ?>
                <img src="<?php echo $main_img; ?>" alt="<?php echo $title; ?>" class="main-img" data-hover-image="<?php echo $hover_img; ?>">
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
                <div class="product-name"><?php echo $title; ?></div>
                <?php if($desc): ?>
                    <div class="product-desc"><?php echo $desc; ?></div>
                <?php endif; ?>
                <div class="price">
                    <span class="sale-price"><?php echo number_format($price, 0, ',', '.'); ?>đ</span>
                    <?php if($original_price > $price): ?>
                        <span class="original-price"><?php echo number_format($original_price, 0, ',', '.'); ?>đ</span>
                    <?php endif; ?>
                </div>
                <?php if($sold > 0): ?>
                    <div class="sold-bar">
                        <span class="fire">🔥</span>Đã bán <?php echo $sold; ?>
                        <div class="sold-progress">
                            <div class="sold-progress-bar" style="width:<?php echo min(100, $sold); ?>%"></div>
                        </div>
                    </div>
                <?php endif; ?>
                <button class="btn_addcart" data-product-id="<?php echo $product['id']; ?>">Thêm vào giỏ</button>
            </div>
        </div>
    </div>
<?php $i++; endforeach; echo '</div>'; endif; ?>
