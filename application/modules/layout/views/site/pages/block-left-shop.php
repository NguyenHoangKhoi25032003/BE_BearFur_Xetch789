<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 order-md-0 order-sm-1">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 ">
            <div class="box-list-categories">
                <div class="block-wapper--title">
                    <h3>Danh mục sản phẩm</h3>
                </div>
                <ul class="block-list-categories--content">
                    <?php echo isset($html_category_product) ? $html_category_product : ''; ?>
                </ul>
            </div>
        </div>
        <?php if(isset($filter) && is_array($filter) && !empty($filter)): ?>
        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 md-order-1">
            <div class="box-filter">
                <div class="block-wapper--title">
                    <h3>Thương hiệu</h3>
                </div>
                <div class="block-filter-list">
                    <ul>
                        <?php 
                        $i = 0;
                        foreach ($filter as $value):
                        $i++; ?>
                        <li>
                            <div class="box-filter-item">
                                <input id="brand-<?php echo $i ;?>" type="checkbox" class="check-filter"
                                    value="<?php echo $value['id']; ?>" name="brands[]"
                                    <?php echo (isset($in_brands) && is_array($in_brands) && in_array($value['id'], $in_brands)) ? ' checked="checked"' : ''; ?>>
                                <label for="brand-<?php echo $i ;?>"><?php echo $value['name']; ?></label>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <!--<?php $price = $this->config->item('filter_shops_price'); ?>
        <?php if(is_array($price) && !empty($price)): ?>
        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 md-order-2">
            <div class="box-filter">
                <div class="block-wapper--title">
                    <h3>Khoảng giá</h3>
                </div>
                <div class="block-filter-list">
                    <ul>
                        <?php 
                        $i = 0;
                        foreach ($price as $key => $value):
                        $i++; ?>
                        <li>
                            <div class="box-filter-item">
                                <input id="price-<?php echo $i ;?>" type="checkbox" class="check-filter-price"
                                    value="<?php echo $key; ?>" name="prices[]"
                                    <?php echo (isset($in_prices) && is_array($in_prices) && in_array($key, $in_prices)) ? ' checked="checked"' : ''; ?>>
                                <label for="price-<?php echo $i ;?>"><?php echo $value; ?></label>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php endif; ?>-->
        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12">
            <?php echo isset($products_featured) ? $products_featured : ''; ?>
        </div>
    </div>
</div>