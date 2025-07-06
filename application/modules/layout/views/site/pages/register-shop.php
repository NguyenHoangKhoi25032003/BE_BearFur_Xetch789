<style type="text/css">
    .hide{
        display: none !important;
    }
    .show{
        display: block !important;
    }
</style>
<article>
    <section>
        <div class="box-user">
            <div class="container">
                <div class="block-wapper--title">
                    <h2>Đăng ký bán hàng</h2>
                </div>
				<p class="note">
                    Vui lòng điền đầy đủ thông tin để trở thành đối tác bán hàng của chúng tôi!
                </p>
                <div class="block-user--form">
                    <?php $this->load->view('layout/notify'); ?>
                    <?php if(isset($shop_status) && $shop_status == -1): ?>
                    <form id="f-register" action="<?php echo current_full_url(); ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <div class="form-group required<?php echo form_error('shop_name') != '' ? ' has-error' : ''; ?>">
                                    <label class="control-label">Tên cửa hàng</label>
                                    <input type="text" class="form-control" name="shop_name">
                                    <?php echo form_error('shop_name'); ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Số điện thoại</label>
                                    <input type="text" class="form-control" name="shop_phone">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Địa chỉ:</label>
                                    <input type="text" class="form-control" name="shop_address">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group required">
                                    <label class="control-label">Logo</label>
                                    <input type="file" class="file" name="shop_logo[]" data-min-file-count="1">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Thông tin cửa hàng</label>
                            <?php
                            $shop_info = isset($row['shop_info']) ? $row['shop_info'] : '';
                            $config_mini = array();
                            $config_mini['toolbar'] = $this->config->item('mini', 'toolbar');
                            $config_mini['language'] = 'vi';
                            echo $this->ckeditor->editor("shop_info", $shop_info, $config_mini);
                            ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Từ khóa tìm kiếm</label>
                            <textarea class="form-control" name="shop_keywords" data-autoresize></textarea>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Mô tả tìm kiếm</label>
                            <textarea class="form-control" name="shop_description" data-autoresize></textarea>
                        </div>
						<button type="submit" class="btn btn--button btn--hover-color">Đăng ký bán hàng</button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</article>