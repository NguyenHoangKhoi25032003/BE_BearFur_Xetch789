<div class="row">
    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">Thông tin cửa hàng</h3>
            </div>
            <div class="box-body">
                <div id="accordion" class="box-group">
                    <div class="panel box box-primary">
                        <div class="box-header">
                            <h4 class="box-title">
                                Thông tin cơ bản
                            </h4>
                        </div>
                        <div class="box-body">
                            <p>ID: <?php echo $row['userid']; ?></p>
                            <p>Tài khoản: <?php echo $row['username']; ?></p>
                            <p>Họ tên: <?php echo $row['full_name']; ?></p>
                            <p>Cửa hàng: <?php echo $row['shop_name']; ?></p>
                            <?php if(trim($row['shop_phone'])): ?>
                            <p>Điện thoại: <?php echo $row['shop_phone']; ?></p>
                            <?php endif; ?>
                            <?php if(trim($row['shop_address'])): ?>
                            <p>Địa chỉ: <?php echo $row['shop_address']; ?></p>
                            <?php endif; ?>
                            <?php if(trim($row['shop_description'])): ?>
                            <p>Mô tả (SEO): <?php echo $row['shop_description']; ?></p>
                            <?php endif; ?>
                            <?php if(trim($row['shop_keywords'])): ?>
                            <p>Từ khóa tìm kiếm (SEO): <?php echo $row['shop_keywords']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="panel box box-success">
                        <div class="box-header">
                            <h4 class="box-title">
                                Thông tin giới thiệu
                            </h4>
                        </div>
                        <div class="box-body">
                            <?php echo $row['shop_info']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>