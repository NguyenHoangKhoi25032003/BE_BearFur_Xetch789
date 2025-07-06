/* ===================================
   RESPONSIVE JAVASCRIPT - KHOLANH1 WEBSITE
   =================================== */

(function() {
    'use strict';

    // ===================================
    // MOBILE MENU FUNCTIONALITY
    // ===================================

    class MobileMenu {
        constructor() {
            this.menuToggle = document.querySelector('.mobile-menu-toggle');
            this.menuContainer = document.querySelector('.mobile-menu-container');
            this.menuClose = document.querySelector('.mobile-menu-close');
            this.overlay = document.querySelector('.mobile-menu-overlay');
            this.submenuToggles = document.querySelectorAll('.mobile-nav .has-submenu > a');

            this.init();
        }

        init() {
            if (this.menuToggle) {
                this.menuToggle.addEventListener('click', () => this.toggleMenu());
            }

            if (this.menuClose) {
                this.menuClose.addEventListener('click', () => this.closeMenu());
            }

            if (this.overlay) {
                this.overlay.addEventListener('click', () => this.closeMenu());
            }

            // Handle submenu toggles
            this.submenuToggles.forEach(toggle => {
                toggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.toggleSubmenu(toggle);
                });
            });

            // Close menu on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.menuContainer.classList.contains('active')) {
                    this.closeMenu();
                }
            });
        }

        toggleMenu() {
            this.menuContainer.classList.toggle('active');
            this.menuToggle.classList.toggle('active');
            this.overlay.classList.toggle('active');
            document.body.style.overflow = this.menuContainer.classList.contains('active') ? 'hidden' : '';
        }

        closeMenu() {
            this.menuContainer.classList.remove('active');
            this.menuToggle.classList.remove('active');
            this.overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        toggleSubmenu(toggle) {
            const parent = toggle.parentElement;
            const submenu = parent.querySelector('.submenu');

            parent.classList.toggle('active');
            if (submenu) {
                submenu.classList.toggle('active');
            }
        }
    }

    // ===================================
    // RESPONSIVE PRODUCT GRID
    // ===================================

    class ResponsiveProductGrid {
        constructor() {
            this.productList = document.querySelector('.product-tab-list');
            this.init();
        }

        init() {
            if (this.productList) {
                this.setupGrid();
                window.addEventListener('resize', () => this.setupGrid());
            }
        }

        setupGrid() {
            const width = window.innerWidth;

            if (width <= 575) {
                this.productList.style.gridTemplateColumns = '1fr';
            } else if (width <= 767) {
                this.productList.style.gridTemplateColumns = 'repeat(2, 1fr)';
            } else if (width <= 991) {
                this.productList.style.gridTemplateColumns = 'repeat(auto-fit, minmax(250px, 1fr))';
            } else {
                this.productList.style.gridTemplateColumns = 'repeat(auto-fit, minmax(280px, 1fr))';
            }
        }
    }

    // ===================================
    // RESPONSIVE IMAGES
    // ===================================

    class ResponsiveImages {
        constructor() {
            this.images = document.querySelectorAll('img[data-src]');
            this.init();
        }

        init() {
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            this.loadImage(entry.target);
                            observer.unobserve(entry.target);
                        }
                    });
                });

                this.images.forEach(img => imageObserver.observe(img));
            } else {
                // Fallback for older browsers
                this.images.forEach(img => this.loadImage(img));
            }
        }

        loadImage(img) {
            const src = img.getAttribute('data-src');
            if (src) {
                img.src = src;
                img.removeAttribute('data-src');
                img.classList.add('loaded');
            }
        }
    }

    // ===================================
    // RESPONSIVE SEARCH
    // ===================================

    class ResponsiveSearch {
        constructor() {
            this.searchForms = document.querySelectorAll('.box-search form, .mobile-search form');
            this.init();
        }

        init() {
            this.searchForms.forEach(form => {
                form.addEventListener('submit', (e) => this.handleSearch(e));
            });
        }

        handleSearch(e) {
            const form = e.target;
            const input = form.querySelector('input[type="text"], .input--field');
            const query = input.value.trim();

            if (query.length < 2) {
                e.preventDefault();
                this.showMessage('Vui lòng nhập ít nhất 2 ký tự để tìm kiếm', 'warning');
                return;
            }

            // Add loading state
            const submitBtn = form.querySelector('button[type="submit"], .btn--search');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Đang tìm...';

                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fa fa-search"></i>';
                }, 2000);
            }
        }

        showMessage(message, type = 'info') {
            const messageDiv = document.createElement('div');
            messageDiv.className = `search-message search-message-${type}`;
            messageDiv.textContent = message;
            messageDiv.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 20px;
                border-radius: 5px;
                color: white;
                font-weight: 500;
                z-index: 10000;
                animation: slideInRight 0.3s ease;
            `;

            if (type === 'warning') {
                messageDiv.style.background = '#ff4757';
            } else {
                messageDiv.style.background = '#145A8D';
            }

            document.body.appendChild(messageDiv);

            setTimeout(() => {
                messageDiv.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => {
                    document.body.removeChild(messageDiv);
                }, 300);
            }, 3000);
        }
    }

    // ===================================
    // RESPONSIVE PRODUCT CARDS
    // ===================================

    class ResponsiveProductCards {
        constructor() {
            this.productCards = document.querySelectorAll('.card_product');
            this.init();
        }

        init() {
            this.productCards.forEach(card => {
                this.setupCardInteractions(card);
            });
        }

        setupCardInteractions(card) {
            const addToCartBtn = card.querySelector('.add-to-cart');
            const quickViewBtn = card.querySelector('.quick-view');
            const mainImg = card.querySelector('.main-img');
            const hoverImg = card.querySelector('[data-hover-image]');

            // Add to cart functionality
            if (addToCartBtn) {
                addToCartBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.addToCart(card);
                });
            }

            // Quick view functionality
            if (quickViewBtn) {
                quickViewBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.quickView(card);
                });
            }

            // Image hover effect
            if (mainImg && hoverImg) {
                const hoverImageSrc = mainImg.getAttribute('data-hover-image');
                if (hoverImageSrc) {
                    card.addEventListener('mouseenter', () => {
                        mainImg.src = hoverImageSrc;
                    });

                    card.addEventListener('mouseleave', () => {
                        const originalSrc = mainImg.getAttribute('src');
                        if (originalSrc !== hoverImageSrc) {
                            mainImg.src = originalSrc;
                        }
                    });
                }
            }
        }

        addToCart(card) {
            const productId = card.querySelector('.add-to-cart').getAttribute('data-product-id');
            const productName = card.querySelector('.product-name').textContent;

            // Show loading state
            const btn = card.querySelector('.add-to-cart');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
            btn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                btn.innerHTML = '<i class="fa fa-check"></i> Đã thêm';
                btn.style.background = '#2ed573';

                // Show success message
                this.showNotification(`${productName} đã được thêm vào giỏ hàng!`, 'success');

                // Reset button after 2 seconds
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.style.background = '';
                    btn.disabled = false;
                }, 2000);
            }, 1000);
        }

        quickView(card) {
            const productId = card.querySelector('.quick-view').getAttribute('data-product-id');
            const productName = card.querySelector('.product-name').textContent;
            const productPrice = card.querySelector('.price').textContent;
            const productImage = card.querySelector('img').src;

            // Create modal content
            const modalContent = `
                <div class="quick-view-modal">
                    <div class="modal-header">
                        <h3>Xem nhanh sản phẩm</h3>
                        <button class="modal-close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="product-preview">
                            <img src="${productImage}" alt="${productName}">
                        </div>
                        <div class="product-details">
                            <h4>${productName}</h4>
                            <div class="price">${productPrice}</div>
                            <p>Thông tin chi tiết sản phẩm sẽ được hiển thị ở đây...</p>
                            <button class="btn-add-to-cart" data-product-id="${productId}">
                                <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                            </button>
                        </div>
                    </div>
                </div>
            `;

            this.showModal(modalContent);
        }

        showModal(content) {
            const modal = document.createElement('div');
            modal.className = 'modal-overlay';
            modal.innerHTML = content;
            modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.8);
                z-index: 10000;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            `;

            const modalContent = modal.querySelector('.quick-view-modal');
            modalContent.style.cssText = `
                background: white;
                border-radius: 10px;
                max-width: 600px;
                width: 100%;
                max-height: 80vh;
                overflow-y: auto;
            `;

            document.body.appendChild(modal);

            // Close modal functionality
            const closeBtn = modal.querySelector('.modal-close');
            closeBtn.addEventListener('click', () => {
                document.body.removeChild(modal);
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    document.body.removeChild(modal);
                }
            });
        }

        showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.textContent = message;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 20px;
                border-radius: 5px;
                color: white;
                font-weight: 500;
                z-index: 10001;
                animation: slideInRight 0.3s ease;
            `;

            if (type === 'success') {
                notification.style.background = '#2ed573';
            } else {
                notification.style.background = '#145A8D';
            }

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
    }

    // ===================================
    // RESPONSIVE UTILITIES
    // ===================================

    class ResponsiveUtils {
        constructor() {
            this.init();
        }

        init() {
            this.setupScrollToTop();
            this.setupLazyLoading();
            this.setupTouchGestures();
        }

        setupScrollToTop() {
            const scrollBtn = document.querySelector('.scroll-to-top');
            if (scrollBtn) {
                window.addEventListener('scroll', () => {
                    if (window.pageYOffset > 300) {
                        scrollBtn.style.display = 'block';
                    } else {
                        scrollBtn.style.display = 'none';
                    }
                });

                scrollBtn.addEventListener('click', () => {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        }

        setupLazyLoading() {
            if ('IntersectionObserver' in window) {
                const lazyElements = document.querySelectorAll('[data-lazy]');
                const lazyObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('lazy-loaded');
                            lazyObserver.unobserve(entry.target);
                        }
                    });
                });

                lazyElements.forEach(el => lazyObserver.observe(el));
            }
        }

        setupTouchGestures() {
            let startX = 0;
            let startY = 0;

            document.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                startY = e.touches[0].clientY;
            });

            document.addEventListener('touchend', (e) => {
                const endX = e.changedTouches[0].clientX;
                const endY = e.changedTouches[0].clientY;
                const diffX = startX - endX;
                const diffY = startY - endY;

                // Swipe left to open mobile menu
                if (diffX > 50 && Math.abs(diffY) < 50) {
                    const mobileMenu = document.querySelector('.mobile-menu-container');
                    if (mobileMenu && window.innerWidth <= 991) {
                        mobileMenu.classList.add('active');
                        document.querySelector('.mobile-menu-toggle').classList.add('active');
                    }
                }

                // Swipe right to close mobile menu
                if (diffX < -50 && Math.abs(diffY) < 50) {
                    const mobileMenu = document.querySelector('.mobile-menu-container');
                    if (mobileMenu && mobileMenu.classList.contains('active')) {
                        mobileMenu.classList.remove('active');
                        document.querySelector('.mobile-menu-toggle').classList.remove('active');
                    }
                }
            });
        }
    }

    // ===================================
    // INITIALIZATION
    // ===================================

    document.addEventListener('DOMContentLoaded', () => {
        new MobileMenu();
        new ResponsiveProductGrid();
        new ResponsiveImages();
        new ResponsiveSearch();
        new ResponsiveProductCards();
        new ResponsiveUtils();
    });

    // ===================================
    // CSS ANIMATIONS
    // ===================================

    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }

        .lazy-loaded {
            opacity: 1;
            transform: translateY(0);
        }

        [data-lazy] {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }
    `;
    document.head.appendChild(style);

})();
