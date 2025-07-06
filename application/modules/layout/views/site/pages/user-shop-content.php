<style type="text/css">
    .hide{
        display: none !important;
    }
    .show{
        display: block !important;
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
                                        <h2 class="account-structure-page_title">Thông tin sản phẩm <a
                                                href="<?php echo site_url('quan-ly-san-pham'); ?>"
                                                class="float-right"><i class="fa fa-table" aria-hidden="true"></i>
                                                Danh sách sản phẩm</a></h2>
                                        <div class="box-devision-col-mobile">
                                            <?php $this->load->view('layout/notify'); ?>
                                            <div class="account-change-email">
                                                <form id="f-content" action="<?php echo current_full_url(); ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                                                    <?php
                                                    if (isset($row['id'])) {
                                                        echo '<input type="hidden" value="' . $row['id'] . '" id="id" name="id" />';
                                                    }
                                                    ?>
                                                    <input type="hidden" name="alias" id="alias" value="<?php echo isset($row['alias']) ? html_escape($row['alias']) : ''; ?>" maxlength="255">
                                                    <div class="form-group required<?php echo form_error('title') != '' ? ' has-error' : ''; ?>">
                                                        <label class="control-label">Tên sản phẩm</label>
                                                        <input type="text" class="form-control" name="title" id="title" value="<?php echo isset($row['title']) ? html_escape($row['title']) : ''; ?>" maxlength="255">
                                                        <?php echo form_error('title'); ?>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group required<?php echo form_error('product_price') != '' ? ' has-error' : ''; ?>">
                                                                <label class="control-label">Giá sản phẩm</label>
                                                                <input type="text" class="form-control text-right mask-price" name="product_price" value="<?php echo isset($row['product_price']) ? $row['product_price'] : ''; ?>">
                                                                <?php echo form_error('product_price'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group required<?php echo form_error('product_discount_percent') != '' ? ' has-error' : ''; ?>">
                                                                <label class="control-label">Phần trăm giảm giá</label>
                                                                <input class="form-control text-right" type="text" name="product_discount_percent" value="<?php echo isset($row['product_discount_percent']) ? $row['product_discount_percent'] : ''; ?>" maxlength="3">
                                                                <?php echo form_error('product_discount_percent'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Giá khuyến mãi</label>
                                                                <input type="text" class="form-control text-right mask-price" name="product_sales_price" value="<?php echo isset($row['product_sales_price']) ? $row['product_sales_price'] : ''; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group required<?php echo form_error('commission') != '' ? ' has-error' : ''; ?>">
                                                                <label class="control-label">Hoa hồng</label>
                                                                <input type="text" class="form-control text-right" name="commission" value="<?php echo isset($row['commission']) ? $row['commission'] : ''; ?>">
                                                                <?php echo form_error('commission'); ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="catid" class="control-label">Danh mục sản phẩm</label>
                                                                <select class="form-control" name="catid" id="catid">
                                                                    <?php echo multilevel_cat(0, $shops_cat['data_list'], $shops_cat['data_input'], 0, isset($row['listcatid']) ? $row['listcatid'] : 0); ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Mã sản phẩm</label>
                                                                <input type="text" class="form-control" name="product_code" value="<?php echo isset($row['product_code']) ? html_escape($row['product_code']) : ''; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Trạng thái kho hàng</label>
                                                                <select class="form-control" name="stock_status">
                                                                    <?php echo get_option_select($this->config->item('stock_status'), isset($row['stock_status']) ? $row['stock_status'] : ''); ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Thương hiệu</label>
                                                                <select class="form-control" name="filter_id">
                                                                    <?php echo display_option_select($filter, 'id', 'name', isset($row['filter_id']) ? $row['filter_id'] : 0); ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Bộ sưu tập</label>
                                                                <select class="form-control" name="collection_id">
                                                                    <?php echo display_option_select($collection, 'id', 'name', isset($row['collection_id']) ? $row['collection_id'] : 0); ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group<?php echo!isset($row['id']) ? ' required' : ''; ?>">
                                                        <label class="control-label">Hình minh họa</label>
                                                        <input type="file" class="file" name="homeimg[]"<?php echo isset($row['id']) ? '' : ' data-min-file-count="1"'; ?>>
                                                        <?php if(isset($row['homeimgfile']) && trim($row['homeimgfile']) != ''): ?>
                                                        <div style="margin-top: 10px;">
                                                            <img class="img-thumbnail img-responsive" src="<?php echo get_image(get_module_path('shops') . $row['homeimgfile'], get_module_path('shops') . 'no-image.png'); ?>" alt="" width="100">
                                                        </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Chú thích cho hình minh họa (phần chi tiết sản phẩm)</label>
                                                        <input type="text" class="form-control" name="homeimgalt" value="<?php echo isset($row['homeimgalt']) ? html_escape($row['homeimgalt']) : ''; ?>">
                                                    </div>

                                                    <!--
                                                    <div class="form-group" id="remove-image">
                                                        <label class="control-label" for="remove-image">Ảnh khác</label> (Chỉ hiển thị khi xem chi tiết)
                                                        <?php if (isset($row['options']) && is_array($row['options']) && !empty($row['options'])): ?>
                                                            <?php foreach ($row['options'] as $value): ?>
                                                                <div class="row container-element">
                                                                    <input type="hidden" class="option-id" name="option_id[<?php echo $value['id']; ?>]" value="<?php echo $value['id']; ?>">
                                                                    <div class="col-md-2">
                                                                        <input type="text" class="form-control text-right order option-order" name="order[]" value="<?php echo $value['order']; ?>">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <img class="img-thumbnail img-responsive" src="<?php echo get_image(get_module_path('shops') . $value['image'], get_module_path('shops') . 'no-image.png'); ?>" alt="">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control option-alt" name="alt[]" value="<?php echo html_escape($value['alt']); ?>" placeholder="Mô tả" maxlength="255">
                                                                            <span class="input-group-btn">
                                                                                <button type="button" class="btn btn-danger remove-element option-delete"> <i class="fa fa-trash"></i></button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach;?>
                                                        <?php endif;?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="btn btn-primary">
                                                            <i class="fa fa-folder-open-o" aria-hidden="true"></i>&nbsp;Thêm &hellip; <input type="file" accept="image/png, image/jpeg, image/gif" style="display: none;" name="files" id="files" multiple>
                                                        </label>
                                                    </div>
                                                    -->
                                                    <div style="clear:both"></div>
                                                    <div class="form-group progress-bar-upload hide">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
                                                        </div>
                                                        <div class="upload_msg"></div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Mô tả</label>
                                                        <textarea name="hometext" data-autoresize rows="3" class="form-control"><?php echo isset($row['hometext']) ? $row['hometext'] : ''; ?></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Thông tin chi tiết</label> (Chỉ hiển thị khi xem chi tiết)
                                                        <?php
                                                        $bodyhtml = isset($row['bodyhtml']) ? $row['bodyhtml'] : '';
                                                        $config_mini = array();
                                                        $config_mini['toolbar'] = $this->config->item('mini', 'toolbar');
                                                        $config_mini['language'] = 'vi';
                                                        echo $this->ckeditor->editor("bodyhtml", $bodyhtml, $config_mini);
                                                        ?>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-lg-4 col-md-5 col-sm-5 offset-lg-3 offset-md-3 offset-sm-5">
                                                            <a href="<?php echo site_url('quan-ly-san-pham'); ?>" class="btn btn-danger">Hủy</a>
                                                            <?php if (isset($row['id'])) : ?>
                                                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                                            <?php else : ?>
                                                                <button type="submit" class="btn btn-success">Đăng sản phẩm</button>
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