<style type="text/css">
    .has-error .help-block, .has-error .control-label, .has-error .radio, .has-error .checkbox, .has-error .radio-inline, .has-error .checkbox-inline, .has-error.radio label, .has-error.checkbox label, .has-error.radio-inline label, .has-error.checkbox-inline label {
        color: #a94442;
    }
</style>
<article>
    <section class="user-manager-page">
        <div class="bg-brea">
            <div class="box-wapper">
                <div class="container">
                    <div class="users_cash-drawing">
                        <div class="row">
                            <?php $this->load->view('block-left-admin-shop'); ?>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <div class="account-structure-page_main-content">
                                    <div class="account-change-email">
                                        <h2 class="account-structure-page_title">Thông tin bộ sưu tập <a
                                                href="<?php echo site_url('quan-ly-san-pham'); ?>"
                                                class="float-right"><i class="fa fa-table" aria-hidden="true"></i>
                                                Danh sách bộ sưu tập</a></h2>
                                        <div class="box-devision-col-mobile">
                                            <?php $this->load->view('layout/notify'); ?>
                                            <div class="account-change-email">
                                                <form id="f-content" action="<?php echo current_full_url(); ?>" method="post" autocomplete="off">
                                                    <div class="form-group required<?php echo form_error('name') != '' ? ' has-error' : ''; ?>">
                                                        <label class="control-label">Tên bộ sưu tập</label>
                                                        <input type="text" class="form-control" name="name" value="<?php echo isset($row['name']) ? html_escape($row['name']) : ''; ?>" maxlength="255">
                                                        <?php echo form_error('name'); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-lg-4 col-md-5 col-sm-5 offset-lg-3 offset-md-3 offset-sm-5">
                                                            <a href="<?php echo site_url('quan-ly-bo-suu-tap'); ?>" class="btn btn-danger">Hủy</a>
                                                            <?php if (isset($row['id'])) : ?>
                                                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                                            <?php else : ?>
                                                                <button type="submit" class="btn btn-success">Đăng bộ sưu tập</button>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
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