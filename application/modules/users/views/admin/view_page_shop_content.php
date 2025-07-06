<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><em class="fa fa-file-text-o">&nbsp;</em>Thông tin cửa hàng</h3>
            </div>
            <div class="box-body">
                <form id="f-content" role="form" action="<?php echo current_full_url(); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="row">
                        <div class="col-md-9">
                           <div class="form-group required<?php echo form_error('shop_name') != '' ? ' has-error' : ''; ?>">
                               <label class="control-label">Tên cửa hàng</label>
                               <input type="text" class="form-control" name="shop_name" value="<?php echo isset($row['shop_name']) ? html_escape($row['shop_name']) : ''; ?>">
                               <?php echo form_error('shop_name'); ?>
                           </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Số điện thoại</label>
                                <input type="text" class="form-control" name="shop_phone" value="<?php echo isset($row['shop_phone']) ? html_escape($row['shop_phone']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Địa chỉ:</label>
                                <input type="text" class="form-control" name="shop_address" value="<?php echo isset($row['shop_address']) ? html_escape($row['shop_address']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group required">
                                <label class="control-label">Logo</label>
                                <input type="file" class="file" name="shop_logo[]">
                                <?php if(isset($row['shop_logo']) && trim($row['shop_logo']) != ''): ?>
                                <div style="margin-top: 10px;">
                                    <img class="img-thumbnail img-responsive" src="<?php echo get_image(get_module_path('users') . $row['shop_logo'], get_module_path('users') . 'no-image.png'); ?>" alt="" width="100">
                                </div>
                                <?php endif; ?>
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
                        <textarea class="form-control" name="shop_keywords" data-autoresize><?php echo isset($row['shop_keywords']) ? html_escape($row['shop_keywords']) : ''; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Mô tả tìm kiếm</label>
                        <textarea class="form-control" name="shop_description" data-autoresize><?php echo isset($row['shop_description']) ? html_escape($row['shop_description']) : ''; ?></textarea>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>