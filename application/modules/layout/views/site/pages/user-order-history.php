<article>
  	<section class="user-manager-page">
	    <div class="container">
	      	<div class="row">
		  		<div class="col-lg-12 col-md-12 col-sm-12">
		          	<div class="account-structure-page_main-content">
                        <div class="account-change-email">
            				<h2 class="account-structure-page_title">Đơn đặt hàng</h2>
            				<div class="box-devision-col-mobile">
            					<?php if(isset($rows) && is_array($rows) && !empty($rows)): ?>
            			        <div class="table-responsive">
            			            <table class="table table-striped table-bordered table-hover">
            			                <thead>
            			                    <tr>
                                                <th>#ID</th>
                                                <th>Mã đơn hàng</th>
                                                <th>Người đặt</th>
                                                <th class="text-right">Tổng tiền (vnđ)</th>
                                                <th class="text-center">Trạng thái thanh toán</th>
                                                <th class="text-center">Thời gian</th>
                                                <th class="text-center">Chức năng</th>
            			                    </tr>
            			                </thead>
                                        <tbody>
            			                    <?php
                                            foreach ($rows as $row) {
                                                if ($row['transaction_status'] == 0) {
                                                    $tr_view = 'warning';
                                                    $transaction_status = display_label('Chờ thanh toán', 'warning');
                                                } elseif ($row['transaction_status'] == -1) {
                                                    $tr_view = 'danger';
                                                    $transaction_status = display_label('Đã hủy', 'warning');
                                                } else {
                                                    $tr_view = '';
                                                    $transaction_status = display_label('Đã thanh toán');
                                                }
                                                ?>
                                                <tr class="<?php echo $tr_view; ?>">
                                                    <td class="text-right"><?php echo $row['order_id']; ?></td>
                                                    <td><?php echo $row['order_code']; ?></td>
                                                    <td><?php echo $row['customer_full_name'] . (trim($row['username']) != '' ? ' (' . $row['username'] . ')' : ''); ?></td>
                                                    <td class="text-right"><?php echo formatRice($row['order_monetized']); ?></td>
                                                    <td class="text-center">
                                                        <?php echo $transaction_status; ?>
                                                    </td>
                                                    <td class="text-center"><?php echo display_date($row['created']); ?></td>
                                                    <td class="text-center">
                                                        <em class="fa fa-eye fa-lg">&nbsp;</em> <a href="<?php echo site_url('xem-don-hang/' . $row['order_id']); ?>">Xem</a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
            			                </tbody>
            			            </table>
            			        </div>
            					<?php else: ?>
                                    <p>Chưa có đơn đặt hàng nào!</p>
                                <?php endif; ?>
            				</div>
            				<div class="clearfix"></div>
            				<div class="box-pagination">
            					<?php if (isset($pagination) && $pagination != ''): ?>
            						<?php echo $pagination; ?>
            					<?php endif; ?>
            				</div>
                        </div>
		          	</div>
		        </div>
	      	</div>
	    </div>
  	</section>
</article>