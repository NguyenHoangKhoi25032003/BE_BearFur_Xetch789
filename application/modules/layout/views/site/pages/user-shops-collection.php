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
                                        <h2 class="account-structure-page_title">Quản lý bộ sưu tập
                                            <a href="<?php echo site_url('them-bo-suu-tap'); ?>" class="float-right mr-2 btn btn--button btn--color">Thêm bộ sưu tập</a>
                                        </h2>
                                        <div class="box-devision-col-mobile">
                                            <?php $this->load->view('layout/notify'); ?>
                                            <?php if(isset($rows) && is_array($rows) && !empty($rows)): ?>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Tên bộ sưu tập</th>
                                                                <th class="text-center">Ngày cập nhật</th>
                                                                <th class="text-center">Trạng thái</th>
                                                                <th class="text-center" style="width: 150px;">Chức năng</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($rows as $row):
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $row['name']; ?>
                                                                </td>
                                                                <td class="text-center"><?php echo $row['modified'] > 0 ? display_date($row['modified']) : display_date($row['created']); ?></td>
                                                                <td class="text-center">
                                                                    <?php
                                                                    if ($row['status'] == 1) {
                                                                        echo display_label('Xuất bản', 'success');
                                                                    } else {
                                                                        echo display_label('Đang chờ duyệt', 'danger');
                                                                    }
                                                                ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <i class="far fa-edit">&nbsp;</i> <a href="<?php echo base_url('them-bo-suu-tap/' . $row['id']); ?>">Sửa</a>&nbsp;-&nbsp;
                                                                    <i class="far fa-trash-alt"></i> <a class="action-delete" href="<?php echo site_url('xoa-bo-suu-tap') . '?id=' . $row['id']; ?>">Xóa</a>
                                                                </td>
                                                            </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php else: ?>
                                                <p>Chưa có bộ sưu tập nào!</p>
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