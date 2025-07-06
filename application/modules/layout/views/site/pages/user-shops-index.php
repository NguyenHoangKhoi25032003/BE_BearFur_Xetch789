<article>
    <section class="user-manager-page">
        <div class="bg-brea">
            <div class="box-wapper">
                <div class="container">
                    <div class="users_commission">
                        <div class="row">
                            <?php $this->load->view('block-left-admin-shop'); ?>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <div class="account-structure-page_main-content">
                                    <div class="account-change-email">
                                        <h2 class="account-structure-page_title">Quản lý sản phẩm
                                            <a href="<?php echo base_url('shop/' . get_user_shop_id($userid)); ?>" class="float-right mr-2 btn btn--button btn--color" style="background-color: #fff; color: #ff9897; border: 1px solid #ff9897;" target="_blank">Xem shop</a>
                                            &nbsp;<a href="<?php echo site_url('dang-san-pham'); ?>" class="float-right mr-2 btn btn--button btn--color">Đăng sản phẩm</a>
                                        </h2>
                                        <div class="box-devision-col-mobile">
                                            <?php if(isset($rows) && is_array($rows) && !empty($rows)): ?>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:40px">&nbsp;</th>
                                                                <th>Tên sản phẩm</th>
                                                                <th class="text-right">Hoa hồng(%)</th>
                                                                <th class="text-center">Ngày cập nhật</th>
                                                                <th class="text-center">Trạng thái</th>
                                                                <th class="text-center" style="width: 150px;">Chức năng</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($rows as $row):
                                                            $link = site_url($this->config->item('url_shops_rows') . '/' . $row['cat_alias'] . '/' . $row['alias'] . '-' . $row['id']);
                                                            $src_img = get_image(get_module_path('shops') . $row['homeimgfile'], get_module_path('shops') . 'no-image-thumb.png');
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <a class="img-fancybox" href="<?php echo $src_img; ?>" title="<?php echo $row['title']; ?>"><img width="40" class="img-rounded img-responsive" alt="<?php echo $row['homeimgalt']; ?>" src="<?php echo $src_img; ?>"></a>
                                                                </td>
                                                                <td class="top">
                                                                    <p><a target="_blank" href="<?php echo $link; ?>"><?php echo $row['title']; ?></a></p>
                                                                </td>
                                                                <td class="text-right"><?php echo $row['commission']; ?></td>
                                                                <td class="text-center"><?php echo $row['modified'] > 0 ? display_date($row['modified']) : display_date($row['created']); ?></td>
                                                                <td class="text-center">
                                                                    <?php
                                                                    if ($row['status'] == 1) {
                                                                        echo display_label('Đã duyệt', 'success');
                                                                    } else {
                                                                        echo display_label('Đang chờ duyệt', 'danger');
                                                                    }
                                                                ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <i class="far fa-edit">&nbsp;</i> <a href="<?php echo base_url('dang-san-pham/' . $row['id']); ?>">Sửa</a>&nbsp;-&nbsp;
                                                                    <i class="far fa-trash-alt"></i> <a href="<?php echo site_url('xoa-san-pham') . '?id=' . $row['id']; ?>" class="delete_bootbox">Xóa</a>
                                                                </td>
                                                            </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php else: ?>
                                                <p>Chưa có đơn hàng giới thiệu nào!</p>
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
                </div>
            </div>
        </div>
    </section>
</article>