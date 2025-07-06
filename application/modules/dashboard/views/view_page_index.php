<h4 class="text-capitalize">Thông tin hệ thống</h4>
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Sản phẩm</span>
                <span class="info-box-number"><?php echo number_format($num_shops); ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-edit"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Nội dung</span>
                <span class="info-box-number"><?php echo number_format($num_posts); ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-file"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Trang tĩnh</span>
                <span class="info-box-number"><?php echo number_format($num_pages); ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Liên hệ</span>
                <span class="info-box-number"><?php echo number_format($num_contact); ?></span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Doanh thu theo tháng của <strong>năm <?php echo isset($year) ? $year : date('Y'); ?></strong> (Đơn vị tính: triệu vnđ)</h3>
                <div class="box-tools pull-right">
                    <form method="get" action="<?php echo get_admin_url(); ?>" style="width: 120px; float: left; margin: 0; margin-right: 15px;">
                        <div class="input-group">
                            <select class="form-control input-sm" name="year" id="year">
                                <?php echo get_option_select($years, isset($get['year']) ? $get['year'] : date('Y')); ?>
                            </select>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-block btn-primary btn-sm">Xem</button>
                            </span>
                        </div>
                    </form>
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Đơn hàng mới</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Người đặt</th>
                                <th>Tình trạng</th>
                                <th class="text-right">Tổng tiền (vnđ)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($orders as $row) {
                                if ($row['transaction_status'] == 0) {
                                    $tr_view = 'warning';
                                    $transaction_status = display_label('Chờ thanh toán', 'warning');
                                } elseif ($row['transaction_status'] == -1) {
                                    $tr_view = 'danger';
                                    $transaction_status = display_label('Đã hủy', 'danger');
                                } else {
                                    $tr_view = '';
                                    $transaction_status = display_label('Đã thanh toán');
                                }
                            ?>
                            <tr>
                                <td><a href="<?php echo get_admin_url('orders/view/' . $row['order_id']); ?>" target="_blank"><?php echo $row['order_code']; ?></a></td>
                                <td><?php echo $row['customer_full_name'] . ' (' . (trim($row['username']) != '' ? $row['username'] : '<strong style="color: #f00;">Khách</strong>') . ')'; ?></td>
                                <td><?php echo $transaction_status; ?></td>
                                <td class="text-right">
                                    <div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo formatRice($row['order_monetized']); ?></div>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer clearfix">
                <a href="<?php echo get_admin_url('orders'); ?>" class="btn btn-sm btn-default btn-flat pull-right" style="margin-top: 7px; margin-bottom: 6px;">Xem thêm</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Sản phẩm vừa được thêm</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php if (is_array($bestsellers_shops) && !empty($bestsellers_shops)): ?>
                <ul class="products-list product-list-in-box">
                    <?php
                    $i = 0;
                    $array = array('info', 'warning', 'danger', 'success');
                    $count = count($array);
                    ?>
                    <?php foreach ($bestsellers_shops as $value): ?>
                        <?php
                        $i++;
                        $k = array_rand($array);
                        $v = $array[$k];
                        $array = array_diff($array, array($v)); //xoa bo $v ra khoi mang $array sau khi đã lấy $v nên đảm bảo không bị trùng
                        if ($i == $count) {
                            $array = array('info', 'warning', 'danger', 'success');
                            $array = array_diff($array, array($v));
                        }
                        ?>
                        <li class="item">
                            <div class="product-img">
                                <img src="<?php echo get_media('shops', $value['homeimgfile'], 'no-image.png', '50x50x1'); ?>" alt="<?php echo $value['title']; ?>" width="50" height="50" />
                            </div>
                            <div class="product-info">
                                <a href="<?php echo site_url($this->config->item('url_shops_rows') . '/' . $value['cat_alias'] . '/' . $value['alias'] . '-' . $value['id']); ?>" target="_blank" class="product-title"><?php echo word_limiter($value['title'], 7); ?> <span class="label label-success pull-right"><?php echo number_format(get_product_discounts($value['product_price'], $value['product_sales_price'])); ?></span></a>
                                <span class="product-description">
                                    <?php echo $value['hometext']; ?>
                                </span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
            <div class="box-footer text-center">
                <a href="<?php echo get_admin_url('shops/items'); ?>" class="uppercase">Xem tất cả sản phẩm</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var lableChart = [];
    var valueChart = [];
    var backgroundColorChart = [];
    var borderColorChart = [];
    <?php if(isset($chart) && is_array($chart) && !empty($chart)): ?>
        <?php foreach ($chart as $value): ?>
            lableChart.push('<?php echo $value['lable']; ?>');
            valueChart.push(parseInt('<?php echo $value['value']; ?>'));
            backgroundColorChart.push('<?php echo $value['background']; ?>');
            borderColorChart.push('<?php echo $value['border']; ?>');
        <?php endforeach; ?>
    <?php endif; ?>
    var dataChart = {
        labels: lableChart,
        datasets: [{
            label: 'Hoa hồng',
            data: valueChart,
            backgroundColor: backgroundColorChart,
            borderColor: borderColorChart,
            borderWidth: 1
        }]
    };
</script>