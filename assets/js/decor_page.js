document.addEventListener('DOMContentLoaded', () => {
  const productData = [
    {
      name: 'Bàn chay 6 tầng gỗ thông tự nhiên ròng',
      description: 'Kệ trang trí 6 tầng gỗ thông tự nhiên ròng',
      price: 428000,
      originalPrice: 490000,
      discount: 13,
      sold: 133,
      image: 'assets/img/pr_1.webp',
      hoverImage: 'assets/img/pro_2.webp',
    },
    {
      name: 'Kệ trang trí decor phòng khách văng',
      description: 'Kệ trang trí decor phòng khách văng',
      price: 500000,
      originalPrice: 730000,
      discount: 32,
      sold: 99,
      image: 'assets/img/pro_2.webp',
      hoverImage: 'assets/img/pro_3.webp',
    },
    {
      name: 'Đèn chùm thạch sàn mạt đá chuên',
      description: 'Đèn chùm thạch sàn mạt đá chuên',
      price: 175000,
      originalPrice: 205500,
      discount: 15,
      sold: 174,
      image: 'assets/img/pro_3.webp',
      hoverImage: 'assets/img/pro_4.webp',
    },
    {
      name: 'Bàn chay 1 tầng chất liệu MDF',
      description: 'Kệ treo tường 1 tầng chất liệu MDF cvd',
      price: 153000,
      originalPrice: 230000,
      discount: 34,
      sold: 129,
      image: 'assets/img/pro_4.webp',
      hoverImage: 'assets/img/pro_2.webp',
    },
  ];

  function formatPrice(price) {
    return price.toLocaleString('vi-VN') + 'đ';
  }

  function renderProductList(containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;

    container.innerHTML = '';

    productData.forEach((product) => {
      const col = document.createElement('div');
      col.className = 'px-2 flex-shrink-0';
      col.innerHTML = `
        <div class="prod-card h-100 position-relative">
            ${
              product.discount
                ? `<div class="prod-discount">-${product.discount}%</div>`
                : ''
            }
            <img src="${product.image}" class="prod-img-top" alt="${
        product.name
      }"
                 data-hover="${product.hoverImage}" data-original="${
        product.image
      }">
            <div class="prod-icons">
                <button class="prod-btn more-btn"><i class="bi bi-cart"></i></button>
                <button class="prod-btn zoom-btn"><i class="bi bi-search"></i></button>
            </div>
            <div class="decor-prod-info">
                <span class="prod-new-label">Hàng mới</span>
                <h5 class="decor-prod-name">${product.name}</h5>
                <p class="decor-prod-description">${product.description}</p>
                <p class="prod-price">${formatPrice(product.price)}
                   <span class="prod-original-price">${formatPrice(
                     product.originalPrice,
                   )}</span>
                </p>
            </div>
        </div>
      `;
      container.appendChild(col);
    });

    // hover ảnh
    const images = container.querySelectorAll('.prod-img-top');
    images.forEach((img) => {
      img.addEventListener('mouseover', () => {
        const hoverSrc = img.getAttribute('data-hover');
        if (hoverSrc) img.src = hoverSrc;
      });
      img.addEventListener('mouseout', () => {
        const originalSrc = img.getAttribute('data-original');
        if (originalSrc) img.src = originalSrc;
      });
    });
  }

  function setupScrollNavigation(decorSectionSelector, containerId) {
    const section = document.querySelector(decorSectionSelector);
    const container = document.getElementById(containerId);

    if (!section || !container) return;

    const prevBtn = section
      .querySelector('.bi-arrow-bar-left')
      ?.closest('button');
    const nextBtn = section
      .querySelector('.bi-arrow-bar-right')
      ?.closest('button');

    const scrollStep = 280 + 16;

    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        container.scrollBy({ left: -scrollStep, behavior: 'smooth' });
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        container.scrollBy({ left: scrollStep, behavior: 'smooth' });
      });
    }
  }

  // Áp dụng cho từng section riêng
  renderProductList('product-list-decor');
  setupScrollNavigation('.decor-page:nth-of-type(1)', 'product-list-decor');

  renderProductList('safe-product-list-decor');
  setupScrollNavigation(
    '.decor-page:nth-of-type(2)',
    'safe-product-list-decor',
  );
});
