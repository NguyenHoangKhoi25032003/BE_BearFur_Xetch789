<style type="text/css">
    .btn-action .dropdown-menu {
        left: auto;
        right: 0;
    }
</style>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form name="filter" method="get" action="<?php echo get_admin_url('users/shop'); ?>">
            <nav class="search_bar navbar navbar-default" role="search">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#filter-bar-7adecd427b033de80d2a0e30cf74e735">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="filter-bar-7adecd427b033de80d2a0e30cf74e735">
                    <div class="navbar-form">
                        <div class="form-group search_title">
                            Trạng thái
                        </div>
                        <div class="form-group search_input">
                            <select class="form-control input-sm" name="status">
                                <option value="">Tất cả</option>
                                <?php echo get_option_select($this->config->item('shop_status'), isset($get['status']) ? $get['status'] : ''); ?>
                            </select>
                        </div>

                        <div class="form-group search_title">
                            Hiển thị
                        </div>
                        <div class="form-group search_input">
                            <select class="form-control input-sm" name="per_page">
                                <?php echo get_option_per_page(isset($get['per_page']) ? (int) $get['per_page'] : $this->config->item('item', 'admin_list')); ?>
                            </select>
                        </div>

                        <div class="form-group search_title">
                            Từ khóa tìm kiếm
                        </div>
                        <div class="form-group search_input">
                            <input class="form-control input-sm" type="text" name="q" value="<?php echo isset($get['q']) ? $get['q'] : ''; ?>" placeholder="Từ khóa tìm kiếm">
                        </div>
                        <div class="form-group search_action pull-right">
                            <button type="submit" class="btn btn-primary btn-sm">Tìm kiếm</button>
                        </div>
                        <br>
                        <label><em>Từ khóa tìm kiếm không ít hơn 3 ký tự, không lớn hơn 64 ký tự, không dùng các mã html</em></label>
                    </div>
                </div>
            </nav>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><em class="fa fa-table">&nbsp;</em>Danh sách cửa hàng</h3>
            </div>
            <div class="box-body">
                <?php if (empty($rows)): ?>
                    <div class="callout callout-warning">
                        <h4>Thông báo!</h4>
                        <p><b>Không</b> tìm thấy cửa hàng nào!</p>
                    </div>
                <?php else: ?>
                    <form class="form-inline" name="block_list" action="#">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th>Tài khoản</th>
                                        <th>Họ tên</th>
                                        <th>Cửa hàng</th>
                                        <th>Điện thoại (bán hàng)</th>
                                        <th class="text-center">Ngày đăng ký</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center" style="width: 215px;">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rows as $row): ?>
                                    <tr>
                                        <td class="text-right"><?php echo $row['userid']; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['full_name']; ?></td>
                                        <td><a href="<?php echo base_url('shop/' . $row['shop_id']); ?>" target="_blank"><?php echo $row['shop_name']; ?></a></td>
                                        <td><?php echo $row['shop_phone']; ?></td>
                                        <td class="text-center"><?php echo display_date($row['shop_created']); ?></td>
                                        <td class="text-center">
                                            <div class="btn-group btn-action shop-status-container" data-id="<?php echo $row['userid']; ?>">
                                                <button type="button" class="btn btn-sm btn-<?php echo display_value_array($this->config->item('shop_status_label'), $row['shop_status']); ?>"><?php echo display_value_array($this->config->item('shop_status'), $row['shop_status']); ?></button>
                                                <button type="button" class="btn btn-sm btn-<?php echo display_value_array($this->config->item('shop_status_label'), $row['shop_status']); ?> dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <?php echo get_shop_action_by_status($row['shop_status']); ?>
                                                </ul>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-action">
                                                <button type="button" class="btn btn-sm btn-primary">Chọn chức năng</button>
                                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="<?php echo get_admin_url('users/shop/content/' . $row['userid']); ?>"><i class="fa fa-edit"></i> Sửa</a></li>
                                                    <!-- <li><a href="<?php echo get_admin_url('users/shop/delete?id=' . $row['userid']); ?>" class="confirm_bootstrap"><i class="fa fa-trash"></i> Xóa</a></li> -->
                                                    <li><a target="_blank" href="<?php echo get_admin_url('login-by/' . $row['userid']); ?>"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
            <?php if ($pagination != ''): ?>
                <div class="box-footer clearfix">
                    <?php echo $pagination; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>