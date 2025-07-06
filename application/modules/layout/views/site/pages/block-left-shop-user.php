<style type="text/css">
    .test {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image {
        width: 100%;
        height: 100%;
    }

    .test:before {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background: rgba(208,1,27,0.08);
    }
    .text {
        font-size: 2em;
        color: white;
        text-shadow: 0.1em 0.1em 0.5em rgba(0,0,0,0.5);
        margin: 0;
        position: absolute;
    }
</style>
<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 order-md-0 order-sm-1">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 ">
            <div class="box-list-categories">
                <div class="test">
                    <img class="image" src="<?php echo get_image(get_module_path('users') . $row['shop_logo'], get_module_path('users') . 'no-image.png'); ?>" alt="">
                    <h1 class="text"><?php echo $row['shop_name']; ?></h1>
                </div>
                <div class="block-wapper--title" style="margin-top: 15px;">
                    <h3>DANH MỤC SHOP</h3>
                </div>
                <ul class="block-list-categories--content">
                    <li>
                        <a href="<?php echo base_url('shop/' . $row['shop_id']); ?>">Sản phẩm</a>
                    </li>
                    <?php if(isset($shop_collection) && is_array($shop_collection) && !empty($shop_collection)): ?>
                        <?php foreach($shop_collection as $value): ?>
                            <li>
                                <a href="<?php echo base_url('shop/' . $row['shop_id']) . '?collection=' . $value['id']; ?>"><?php echo $value['name']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
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
        <!--
		<?php $price = $this->config->item('filter_shops_price'); ?>
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
    </div>
</div>