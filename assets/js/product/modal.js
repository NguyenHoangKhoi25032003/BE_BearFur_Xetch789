document.addEventListener("DOMContentLoaded", () => {
    document.addEventListener("click", (e) => {
        const zoomBtn = e.target.closest(".zoom-btn");
        const cartBtn = e.target.closest(".more-btn");
        const cardProduct = e.target.closest(".card_product");
        const prodCard = e.target.closest(".prod-card");
        const cardDecor = e.target.closest(".card_product_decor");
        const homepageCard = e.target.closest(".card");
        const xemTatCaBtn = e.target.closest(".btn-xem-tat-ca"); // thêm nút

        const isInsideIcon = e.target.closest(".zoom-btn, .more-btn, button, a");

        // 👉 Nếu click vào kính lúp
        if (zoomBtn) {
            window.location.href = "order_detail.html";
            return;
        }

        // 👉 Nếu click vào icon giỏ hàng
        if (cartBtn) {
            window.location.href = "order.html";
            return;
        }

        // 👉 Nếu click vào nút "XEM TẤT CẢ"
        if (xemTatCaBtn) {
            window.location.href = "product.html";
            return;
        }

        // 👉 Nếu click vào card trang chủ
        if (!isInsideIcon && homepageCard && !cardProduct && !prodCard && !cardDecor) {
            window.location.href = "product.html";
            return;
        }

        // 👉 Nếu click vào card sản phẩm
        if (!isInsideIcon && (cardProduct || prodCard || cardDecor)) {
            window.location.href = "order.html";
        }
    });
});
