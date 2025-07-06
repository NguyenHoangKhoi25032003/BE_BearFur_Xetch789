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
      description: 'Kệ trang trí decor phòng khách văng ok',
      price: 500000,
      originalPrice: 730000,
      discount: 32,
      sold: 99,
      image: 'assets/img/pro_2.webp',
      hoverImage: 'assets/img/pro_3.webp',
    },
  ];

  const productContainer = document.getElementById('safe-product-list-decor');
  const prevButton = document.querySelector(
    '.decor-nav-btn .bi-arrow-bar-left',
  )?.parentElement;
  const nextButton = document.querySelector(
    '.decor-nav-btn .bi-arrow-bar-right',
  )?.parentElement;

  // Hàm định dạng giá
  function formatPrice(price) {
    return price.toLocaleString('vi-VN') + 'đ';
  }

  // Hàm hiển thị sản phẩm
  function displayProducts() {
    if (!productContainer) {
      console.error('Không tìm thấy container sản phẩm');
      return;
    }

    // Xóa nội dung cũ và thêm các lớp CSS cần thiết
    productContainer.innerHTML = '';
    productContainer.classList.add(
      'd-flex',
      'flex-nowrap',
      'overflow-hidden',
      'gap-3',
    );
    productContainer.style.scrollbarWidth = 'none'; // Ẩn thanh cuộn trên Firefox
    productContainer.style.msOverflowStyle = 'none'; // Ẩn thanh cuộn trên IE/Edge
    productContainer.style.display = 'flex';
    productContainer.style.alignItems = 'center';
    productContainer.style.width = '1152px'; // 4 * (280px + 16px) - 16px (gap cuối)
    productContainer.style.whiteSpace = 'nowrap';

    productData.forEach((product) => {
      const col = document.createElement('div');
      col.className = 'px-2 flex-shrink-0';
      col.style.width = '280px'; // Chiều rộng cố định
      col.style.maxWidth = '280px';
      col.style.flex = '0 0 280px'; // Ngăn co giãn

      const discountPercentage = product.discount
        ? `-${product.discount}%`
        : '';
      const originalPrice = product.originalPrice
        ? formatPrice(product.originalPrice)
        : '';

      col.innerHTML = `
                <div class="prod-card h-100 position-relative" style="width: 100%;">
                    ${
                      discountPercentage
                        ? `<div class="prod-discount">${discountPercentage}</div>`
                        : ''
                    }
                    <img src="${product.image}" class="prod-img-top" alt="${
        product.name
      }"
                         data-hover="${product.hoverImage}" data-original="${
        product.image
      }" style="width: 100%; height: auto; object-fit: cover;">
                    <div class="prod-icons">
                        <button class="prod-btn more-btn"><i class="bi bi-cart"></i></button>
                        <button class="prod-btn zoom-btn"><i class="bi bi-search"></i></button>
                    </div>
                    <div class="decor-prod-info">
                        <span class="prod-new-label">Hàng mới</span>
                        <h5 class="decor-prod-name">${product.name}</h5>
                        <p class="decor-prod-description">${
                          product.description
                        }</p>
                        <p class="prod-price">${formatPrice(product.price)}
                           <span class="prod-original-price">${originalPrice}</span>
                        </p>
                    </div>
                </div>
            `;
      productContainer.appendChild(col);
    });

    // Thêm sự kiện hover cho ảnh
    const images = document.querySelectorAll('.prod-img-top');
    images.forEach((img) => {
      img.addEventListener('mouseover', () => {
        const hoverSrc = img.getAttribute('data-hover');
        if (hoverSrc) {
          img.src = hoverSrc;
          img.classList.add('decor-image-transition');
        }
      });

      img.addEventListener('mouseout', () => {
        const originalSrc = img.getAttribute('data-original');
        if (originalSrc) {
          img.src = originalSrc;
          img.classList.remove('decor-image-transition');
        }
      });
    });
  }

  // Hàm xử lý nút điều hướng
  function setupNavigation() {
    if (!prevButton || !nextButton) {
      console.error('Không tìm thấy nút điều hướng');
      return;
    }

    let currentIndex = 0;
    const productWidth = 280 + 16; // Chiều rộng sản phẩm (280px) + gap (16px)
    const totalProducts = productData.length;
    const maxIndex = totalProducts - 4; // Chỉ số tối đa để hiển thị 4 sản phẩm

    // Hàm cập nhật trạng thái nút
    function updateButtonStates() {
      prevButton.disabled = currentIndex <= 0;
      nextButton.disabled = currentIndex >= maxIndex;
    }

    // Xử lý nút Tiếp theo
    nextButton.addEventListener('click', () => {
      if (currentIndex < maxIndex) {
        currentIndex++;
        productContainer.scrollTo({
          left: currentIndex * productWidth,
          behavior: 'smooth',
        });
        updateButtonStates();
      }
    });

    // Xử lý nút Trước
    prevButton.addEventListener('click', () => {
      if (currentIndex > 0) {
        currentIndex--;
        productContainer.scrollTo({
          left: currentIndex * productWidth,
          behavior: 'smooth',
        });
        updateButtonStates();
      }
    });

    // Cập nhật trạng thái nút ban đầu
    updateButtonStates();
  }

  // Khởi tạo
  displayProducts();
  setupNavigation();
});
