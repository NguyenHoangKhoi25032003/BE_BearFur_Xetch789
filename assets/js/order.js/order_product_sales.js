document.addEventListener('DOMContentLoaded', () => {
  // Dữ liệu sản phẩm mẫu
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
      price: 1750000,
      originalPrice: 2055000,
      discount: 15,
      sold: 174,
      image: 'assets/img/pro_3.webp',
      hoverImage: 'assets/img/pro_4.webp',
    },
    {
      name: 'Bàn chay 1 tầng chất liệu MDF',
      description: 'Kệ treo tường 1 tầng chất liệu MDF',
      price: 153000,
      originalPrice: 230000,
      discount: 34,
      sold: 129,
      image: 'assets/img/pro_4.webp',
      hoverImage: 'assets/img/pro_2.webp',
    },
    // Lặp lại để đủ 8 sản phẩm
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
      price: 1750000,
      originalPrice: 2055000,
      discount: 15,
      sold: 174,
      image: 'assets/img/pro_3.webp',
      hoverImage: 'assets/img/pro_4.webp',
    },
    {
      name: 'Bàn chay 1 tầng chất liệu MDF',
      description: 'Kệ treo tường 1 tầng chất liệu MDF',
      price: 153000,
      originalPrice: 230000,
      discount: 34,
      sold: 129,
      image: 'assets/img/pro_4.webp',
      hoverImage: 'assets/img/pro_2.webp',
    },
  ];

  let timeLeft = 3 * 24 * 60 * 60; // 3 ngày tính bằng giây
  const productContainer = document.getElementById('productContainer');
  let timerId;

  // Hàm hiển thị sản phẩm
  function displayProducts() {
    if (!productContainer) {
      console.error('productContainer không được tìm thấy');
      return;
    }

    productContainer.innerHTML = '';

    const isMobile = window.innerWidth <= 768;

    if (timeLeft > 0) {
      let parentContainer = isMobile
        ? productContainer
        : document.createElement('div');

      if (!isMobile) {
        parentContainer.className = 'row mb-4';
        productContainer.appendChild(parentContainer);
      }

      productData.forEach((product, index) => {
        if (!isMobile && index % 4 === 0 && index !== 0) {
          parentContainer = document.createElement('div');
          parentContainer.className = 'row mb-4';
          productContainer.appendChild(parentContainer);
        }

        const col = document.createElement('div');
        col.className = isMobile ? '' : 'col-6 col-md-3';

        const discountPercentage = product.discount
          ? `-${product.discount}%`
          : '';
        const originalPrice = product.originalPrice
          ? `${product.originalPrice.toLocaleString()}đ`
          : '';

        col.innerHTML = `
        <div class="card_product h-100 position-relative">
          ${
            discountPercentage
              ? `<div class="discount">${discountPercentage}</div>`
              : ''
          }
          <img src="${product.image}" class="card-img-top" alt="${product.name}"
            data-hover="${product.hoverImage}" data-original="${product.image}">
          <div class="product-icons">
            <button class="icon-btn more-btn"><i class="bi bi-cart"></i></button>
            <button class="icon-btn zoom-btn" data-product='${JSON.stringify(
              product,
            )}'><i class="bi bi-search"></i></button>
          </div>
          <div class="product-info">
            <span class="new-label">Hàng mới</span>
            <h5 class="product-name">${product.name}</h5>
            <p class="product-description">${product.description}</p>
            <p class="price">${product.price.toLocaleString()}đ
              <span class="original-price">${originalPrice}</span>
            </p>
          </div>
        </div>`;

        parentContainer.appendChild(col);
      });

      // Hover image switch
      const images = document.querySelectorAll('.card_product img');
      images.forEach((img) => {
        img.addEventListener('mouseover', () => {
          const hoverSrc = img.getAttribute('data-hover');
          if (hoverSrc) {
            img.src = hoverSrc;
            img.classList.add('image-transition');
          }
        });
        img.addEventListener('mouseout', () => {
          const originalSrc = img.getAttribute('data-original');
          if (originalSrc) {
            img.src = originalSrc;
            img.classList.remove('image-transition');
          }
        });
      });
    }
  }

  // Hàm cập nhật đồng hồ đếm ngược
  function updateTimer() {
    const timerElement = document.getElementById('timer');
    if (!timerElement) {
      console.error('phần tử timer không được tìm thấy');
      return;
    }
    const days = Math.floor(timeLeft / (24 * 60 * 60));
    const hours = Math.floor((timeLeft % (24 * 60 * 60)) / (60 * 60));
    const minutes = Math.floor((timeLeft % (60 * 60)) / 60);
    const seconds = timeLeft % 60;
    timerElement.textContent = `${days} ngày ${hours
      .toString()
      .padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds
      .toString()
      .padStart(2, '0')}`;

    if (timeLeft <= 0) {
      clearInterval(timerId);
      timerElement.textContent = 'Hết giờ!';
      productContainer.innerHTML = '';
    }
    timeLeft--;
  }

  // Tự động chạy khi tải trang
  console.log('DOM đã tải, khởi tạo timer và sản phẩm');
  displayProducts();
  timerId = setInterval(updateTimer, 1000);
});
