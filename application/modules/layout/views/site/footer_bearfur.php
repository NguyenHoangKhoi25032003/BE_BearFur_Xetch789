    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="footer-section">
                        <h5>Về BearFur</h5>
                        <p>Chuyên cung cấp đồ nội thất cao cấp, đèn trang trí và thiết bị vệ sinh chất lượng cao.</p>
                        <div class="social-links">
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-youtube"></i></a>
                            <a href="#"><i class="bi bi-twitter"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="footer-section">
                        <h5>Danh mục sản phẩm</h5>
                        <ul>
                            <li><a href="<?php echo base_url('product?category=Đèn trang trí'); ?>">Đèn trang trí</a></li>
                            <li><a href="<?php echo base_url('product?category=Đồ trang trí'); ?>">Đồ trang trí</a></li>
                            <li><a href="<?php echo base_url('product?category=Đồ nội thất'); ?>">Đồ nội thất</a></li>
                            <li><a href="<?php echo base_url('product?category=Thiết bị vệ sinh'); ?>">Thiết bị vệ sinh</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="footer-section">
                        <h5>Hỗ trợ khách hàng</h5>
                        <ul>
                            <li><a href="<?php echo base_url('contact'); ?>">Liên hệ</a></li>
                            <li><a href="<?php echo base_url('shipping'); ?>">Vận chuyển</a></li>
                            <li><a href="<?php echo base_url('return'); ?>">Đổi trả</a></li>
                            <li><a href="<?php echo base_url('warranty'); ?>">Bảo hành</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="footer-section">
                        <h5>Thông tin liên hệ</h5>
                        <div class="contact-info">
                            <p><i class="bi bi-geo-alt"></i> 123 Đường ABC, Quận 1, TP.HCM</p>
                            <p><i class="bi bi-telephone"></i> 0909 123 456</p>
                            <p><i class="bi bi-envelope"></i> info@bearfur.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2024 BearFur. Tất cả quyền được bảo lưu.</p>
                </div>
                <div class="col-md-6 text-end">
                    <p>Thanh toán an toàn với:</p>
                    <div class="payment-methods">
                        <i class="bi bi-credit-card"></i>
                        <i class="bi bi-paypal"></i>
                        <i class="bi bi-cash-coin"></i>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>

    <?php if(isset($add_js) && is_array($add_js)): ?>
        <?php foreach($add_js as $js): ?>
            <script src="<?php echo base_url($js); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <script>
        // Initialize cart count
        function initCartCount() {
            let count = localStorage.getItem('cartCount');
            if (!count) {
                count = 0;
                localStorage.setItem('cartCount', count);
            }
            updateCartCountUI(count);
        }

        function updateCartCountUI(count) {
            const cartSpan = document.querySelector('#cart-count');
            if (cartSpan) cartSpan.innerText = count;
        }

        function increaseCartCount() {
            let count = localStorage.getItem('cartCount');
            count = parseInt(count || '0') + 1;
            localStorage.setItem('cartCount', count);
            updateCartCountUI(count);
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', () => {
            initCartCount();
        });
    </script>
</body>
</html>
