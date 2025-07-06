
<?php 
	$data_src = get_media('posts', $row['homeimgfile'], 'no-image.png','1024x683x1');
	$data_date = date('d', $row['addtime']) . '/' . date('m', $row['addtime']) . '/' . date('Y', $row['addtime']);
?>
<article>
    <section>
        <div class="box-single-post">
            <div class="container">
                <div class="block-wapper--title">
                    <h1>Tin tức</h1>
                </div>
                <div class="row">
                    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 md-order-2">
                        <div class="block-single-post--image">
                            <img src="<?php echo $data_src ?>" alt="./images/img-2275.jpg" class="img-fluid w-100">
                        </div>
                        <div class="block-single-post--title">
                            <div class="single-post-title--left">
                                <div class="single-post--posttime">
                                    <span class="date"><?php echo substr($data_date,0,2) ?></span>
                                    <span class="month">Tháng <?php echo substr($data_date,3,2) ?></span>
                                </div>
                            </div>
                            <div class="single-post-title--right">
                                <div class="single-post--postby">
                                    <span>Đăng bởi: Cool Team </span>
                                </div>
                                <div class="single-post--title">
                                    <h3><?php echo isset($row['title']) ? $row['title'] : ''; ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="block-single-post--content">
                            <?php echo isset($row['bodyhtml']) ? filter_content($row['bodyhtml']) : ''; ?>
                        </div>
					</div>
					<?php $this->load->view('block-right-post'); ?>
                </div>
            </div>
        </div>
    </section>
</article>