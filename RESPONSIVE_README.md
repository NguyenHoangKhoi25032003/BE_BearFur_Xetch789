# KHOLANH1 - Responsive CSS Framework

## Tổng quan

Bộ CSS responsive được thiết kế đặc biệt cho website KHOLANH1, đảm bảo trải nghiệm người dùng tốt nhất trên mọi thiết bị từ desktop đến mobile.

## Các file CSS đã tạo

### 1. `assets/css/responsive.css`
- CSS responsive chính cho toàn bộ website
- Grid system linh hoạt
- Product cards responsive
- Header responsive
- Utility classes

### 2. `assets/css/mobile-menu.css`
- Mobile menu với hamburger button
- Slide-in navigation
- Submenu support
- Touch gestures

### 3. `assets/js/responsive.js`
- JavaScript xử lý mobile menu
- Product interactions
- Lazy loading
- Touch gestures

## Breakpoints

| Device | Width | Description |
|--------|-------|-------------|
| Extra Large | ≥1200px | Desktop lớn |
| Large | 992px - 1199px | Desktop thường |
| Medium | 768px - 991px | Tablet |
| Small | 576px - 767px | Mobile lớn |
| Extra Small | <576px | Mobile nhỏ |

## Cách sử dụng

### 1. Thêm CSS vào HTML

```html
<!-- Thêm vào <head> -->
<link rel="stylesheet" href="assets/css/responsive.css">
<link rel="stylesheet" href="assets/css/mobile-menu.css">
```

### 2. Thêm JavaScript

```html
<!-- Thêm vào cuối <body> -->
<script src="assets/js/responsive.js"></script>
```

### 3. HTML Structure cho Mobile Menu

```html
<!-- Mobile Menu Toggle -->
<button class="mobile-menu-toggle d-mobile-flex">
    <span></span>
    <span></span>
    <span></span>
</button>

<!-- Mobile Menu Container -->
<div class="mobile-menu-container">
    <div class="mobile-menu-content">
        <!-- Menu content -->
    </div>
</div>

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay"></div>
```

### 4. Product Cards

```html
<div class="card_product">
    <div class="discount">-20%</div>
    <div style="position:relative;">
        <img src="product-image.jpg" alt="Product" class="main-img" data-hover-image="hover-image.jpg">
        <div class="product-icons">
            <button class="icon-btn add-to-cart" data-product-id="1">
                <i class="fa fa-shopping-cart"></i>
            </button>
            <button class="icon-btn quick-view" data-product-id="1">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
    <div class="product-info">
        <span class="new-label">Hàng mới</span>
        <div class="product-name">Tên sản phẩm</div>
        <div class="price">
            1,500,000đ
            <span class="original-price">1,800,000đ</span>
        </div>
    </div>
</div>
```

## Tính năng chính

### 1. Responsive Grid System
- Flexbox-based grid
- Auto-adjusting columns
- Mobile-first approach

### 2. Mobile Menu
- Hamburger menu
- Slide-in animation
- Touch gestures support
- Submenu support

### 3. Product Cards
- Hover effects
- Image zoom
- Action buttons
- Discount badges
- Responsive text

### 4. Search Functionality
- Responsive search bar
- Mobile-optimized input
- Loading states

### 5. Accessibility
- Keyboard navigation
- Screen reader support
- Focus indicators
- High contrast mode

## Utility Classes

### Display Classes
```css
.d-none          /* Hide element */
.d-block         /* Show as block */
.d-flex          /* Show as flex */
.d-mobile-none   /* Hide on mobile */
.d-mobile-block  /* Show on mobile */
```

### Text Alignment
```css
.text-center     /* Center text */
.text-left       /* Left align */
.text-right      /* Right align */
```

### Flexbox Utilities
```css
.justify-content-center
.justify-content-between
.align-items-center
.flex-column
.flex-wrap
```

## Customization

### Colors
```css
:root {
    --primary-color: #145A8D;
    --secondary-color: #2ed573;
    --accent-color: #ff4757;
    --text-color: #333;
    --light-gray: #f8f9fa;
}
```

### Breakpoints
```css
/* Custom breakpoints */
@media (min-width: 1400px) {
    /* Extra large screens */
}

@media (max-width: 480px) {
    /* Extra small screens */
}
```

## Browser Support

- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+
- iOS Safari 12+
- Android Chrome 60+

## Performance

- CSS được tối ưu hóa
- Lazy loading cho images
- Minimal JavaScript
- Smooth animations
- Touch-friendly interactions

## Troubleshooting

### Mobile menu không hoạt động
1. Kiểm tra JavaScript đã được load
2. Đảm bảo HTML structure đúng
3. Kiểm tra console errors

### Product cards không responsive
1. Đảm bảo class `card_product` được áp dụng
2. Kiểm tra CSS responsive.css đã load
3. Verify grid container structure

### Search không hoạt động trên mobile
1. Kiểm tra form structure
2. Verify input field có class đúng
3. Test touch events

## Demo

Xem file `responsive-demo.html` để xem demo hoàn chỉnh của responsive framework.

## Changelog

### Version 1.0.0
- Initial release
- Mobile menu functionality
- Responsive product cards
- Touch gestures
- Accessibility features

## License

MIT License - Sử dụng tự do cho dự án KHOLANH1
