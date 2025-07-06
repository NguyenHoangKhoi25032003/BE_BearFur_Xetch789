<?php
/**
 * Trang danh sách sản phẩm BearFur
 */
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($category) ? $category : 'Tất cả sản phẩm'; ?> - BearFur</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/product-section.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/modal.css'); ?>" />
</head>

<body>
    <!-- Header -->
    <?php $this->load->view('layout/site/header_bearfur'); ?>

    <!-- Breadcrumb -->
    <section class="about-hero" style="background-image: url('<?php echo base_url('assets/img/breadcrumb.jpg'); ?>')">
        <div class="about-hero-content">
            <h1 id="hero-title"><?php echo isset($category) ? $category : 'Tất cả sản phẩm'; ?></h1>
            <p>
                <a href="<?php echo base_url(); ?>">Trang chủ</a> &nbsp;›&nbsp;
                <span id="breadcrumb-title"><?php echo isset($category) ? $category : 'Tất cả sản phẩm'; ?></span>
            </p>
        </div>
    </section>

    <!-- Product Page -->
    <div class="product-page">
        <div class="product-sidebar">
            <!-- Category Widget -->
            <div class="widget category-widget">
                <h3 class="widget-title">DANH MỤC SẢN PHẨM</h3>
                <ul class="category-list">
                    <?php if(isset($categories) && is_array($categories)): ?>
                        <?php foreach($categories as $cat): ?>
                            <li class="category-item">
                                <div class="category-header" data-category="<?php echo $cat['name']; ?>">
                                    <?php echo $cat['name']; ?> <span class="toggle">+</span>
                                </div>
                                <ul class="subcategory-list">
                                    <?php if(isset($cat['subcategories'])): ?>
                                        <?php foreach($cat['subcategories'] as $sub): ?>
                                            <li class="subcategory-item"
                                                data-category="<?php echo $cat['name']; ?>"
                                                data-type="<?php echo $sub['name']; ?>">
                                                <?php echo $sub['name']; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Filter Widget -->
            <div class="widget filter-widget">
                <div class="selected-filters" id="selected-filters">
                    <div class="selected-header">
                        <strong>Bạn chọn</strong>
                        <a href="#" id="clear-filters">Bỏ hết ✖</a>
                    </div>
                    <div id="selected-tags"></div>
                </div>

                <h3 class="widget-title">CHỌN MỨC GIÁ</h3>
                <div class="filter-scroll">
                    <label><input type="checkbox" value="0-100000" /> Dưới 100.000đ</label>
                    <label><input type="checkbox" value="100000-200000" /> Từ 100.000đ - 200.000đ</label>
                    <label><input type="checkbox" value="200000-300000" /> Từ 200.000đ - 300.000đ</label>
                    <label><input type="checkbox" value="300000-500000" /> Từ 300.000đ - 500.000đ</label>
                    <label><input type="checkbox" value="500000-1000000" /> Từ 500.000đ - 1 triệu</label>
                    <label><input type="checkbox" value="1000000-2000000" /> Từ 1 triệu - 2 triệu</label>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="product-main">
            <div class="product-header">
                <div class="product-count">
                    Hiển thị <?php echo count($products); ?> sản phẩm
                </div>
                <div class="product-sort">
                    <select id="sort-select">
                        <option value="newest">Mới nhất</option>
                        <option value="price-low">Giá tăng dần</option>
                        <option value="price-high">Giá giảm dần</option>
                        <option value="name">Tên A-Z</option>
                    </select>
                </div>
            </div>

            <div class="product-grid" id="product-grid">
                <?php if(isset($products) && is_array($products)): ?>
                    <?php foreach($products as $product): ?>
                        <div class="product-item">
                            <div class="product-image">
                                <a href="<?php echo base_url('product/detail/' . $product['id']); ?>">
                                    <img src="<?php echo base_url('uploads/shops/' . $product['image']); ?>"
                                         alt="<?php echo $product['name']; ?>">
                                </a>
                            </div>
                            <div class="product-details">
                                <h6>
                                    <a href="<?php echo base_url('product/detail/' . $product['id']); ?>">
                                        <?php echo $product['name']; ?>
                                    </a>
                                </h6>
                                <p class="price">
                                    <?php echo number_format($product['price']); ?>đ
                                    <?php if(isset($product['old_price']) && $product['old_price'] > $product['price']): ?>
                                        <span class="old-price"><?php echo number_format($product['old_price']); ?>đ</span>
                                    <?php endif; ?>
                                </p>
                                <button class="add-to-cart-btn" data-product-id="<?php echo $product['id']; ?>">
                                    Thêm vào giỏ
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-products">
                        <p>Không tìm thấy sản phẩm nào.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if(isset($pagination)): ?>
                <div class="pagination-wrapper">
                    <?php echo $pagination; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <?php $this->load->view('layout/site/footer_bearfur'); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>

    <script>
        // Category toggle
        document.querySelectorAll('.category-header').forEach(header => {
            header.addEventListener('click', function() {
                const item = this.closest('.category-item');
                const subList = item.querySelector('.subcategory-list');
                const toggle = this.querySelector('.toggle');

                if (subList.style.display === 'block') {
                    subList.style.display = 'none';
                    toggle.textContent = '+';
                } else {
                    subList.style.display = 'block';
                    toggle.textContent = '-';
                }
            });
        });

        // Subcategory click
        document.querySelectorAll('.subcategory-item').forEach(item => {
            item.addEventListener('click', function() {
                const category = this.dataset.category;
                const type = this.dataset.type;
                window.location.href = `<?php echo base_url('product'); ?>?category=${encodeURIComponent(category)}&type=${encodeURIComponent(type)}`;
            });
        });

        // Sort functionality
        document.getElementById('sort-select').addEventListener('change', function() {
            const sortBy = this.value;
            const currentUrl = new URL(window.location);
            currentUrl.searchParams.set('sort', sortBy);
            window.location.href = currentUrl.toString();
        });

        // Add to cart
        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.dataset.productId;
                addToCart(productId);
            });
        });

        function addToCart(productId) {
            fetch('<?php echo base_url('cart/add'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    increaseCartCount();
                    alert('Đã thêm sản phẩm vào giỏ hàng!');
                } else {
                    alert('Có lỗi xảy ra!');
                }
            });
        }
    </script>
</body>
</html>
