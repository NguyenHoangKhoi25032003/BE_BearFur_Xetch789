document.addEventListener('DOMContentLoaded', () => {
  // 🔹 Dữ liệu sản phẩm TOP BÁN CHẠY
  const topSellingProducts = [
    {
      name: 'Bàn chay 6 tầng gỗ thông tự nhiên ròng',
      description: 'Kệ trang trí 6 tầng gỗ thông tự nhiên',
      price: 428000,
      originalPrice: 490000,
      discount: 13,
      sold: 133,
      image: 'assets/img/pr_1.webp',
      hoverImage: 'assets/img/pro_2.webp',
    },
    {
      name: 'Kệ trang trí decor phòng khách văng',
      description: 'Kệ trang trí decor phòng khách',
      price: 500000,
      originalPrice: 730000,
      discount: 32,
      sold: 99,
      image: 'assets/img/pro_2.webp',
      hoverImage: 'assets/img/pro_3.webp',
    },
    {
      name: 'Đèn chùm thạch sàn mạt đá chuên',
      description: 'Đèn chùm thạch sàn mạt đá',
      price: 175000,
      originalPrice: 205500,
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
      description: 'Kệ trang trí 6 tầng gỗ thông tự nhiên',
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
      description: 'Đèn chùm thạch sàn mạt đá',
      price: 175000,
      originalPrice: 205500,
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

  // 🔹 Dữ liệu sản phẩm HÀNG MỚI
  const newProducts = [
    // {
    //     name: "Bàn chay 6 tầng gỗ thông tự nhiên ròng",
    //     description: "Kệ trang trí 6 tầng gỗ thông tự nhiên ròng",
    //     price: 428000,
    //     originalPrice: 490000,
    //     discount: 13,
    //     sold: 133,
    //     image: "/assets/img/pr_1.webp",
    //     hoverImage: "/assets/img/pro_2.webp"
    // },
    // {
    //     name: "Kệ trang trí decor phòng khách văng",
    //     description: "Kệ trang trí decor phòng khách văng",
    //     price: 500000,
    //     originalPrice: 730000,
    //     discount: 32,
    //     sold: 99,
    //     image: "/assets/img/pro_2.webp",
    //     hoverImage: "/assets/img/pro_3.webp"
    // },
    // {
    //     name: "Đèn chùm thạch sàn mạt đá chuên",
    //     description: "Đèn chùm thạch sàn mạt đá chuên",
    //     price: 1750000,
    //     originalPrice: 2055000,
    //     discount: 15,
    //     sold: 174,
    //     image: "/assets/img/pro_3.webp",
    //     hoverImage: "/assets/img/pro_4.webp"
    // },
    //  {
    //     name: "Bàn chay 1 tầng chất liệu MDF",
    //     description: "Kệ treo tường 1 tầng chất liệu MDF",
    //     price: 153000,
    //     originalPrice: 230000,
    //     discount: 34,
    //     sold: 129,
    //     image: "/assets/img/pro_4.webp",
    //     hoverImage: "/assets/img/pro_2.webp"
    // },
  ];

  const formatPrice = (price) => price.toLocaleString('vi-VN') + 'đ';
  const productList = document.getElementById('product-list');

  function renderProducts(products) {
    productList.innerHTML = '';

    if (products.length === 0) {
      productList.innerHTML =
        '<p class="text-center text-muted">Chưa có sản phẩm</p>';
      return;
    }

    let currentRow = document.createElement('div');
    currentRow.className = 'row mb-4';
    productList.appendChild(currentRow);

    products.forEach((product, index) => {
      if (index % 4 === 0 && index !== 0) {
        currentRow = document.createElement('div');
        currentRow.className = 'row mb-4';
        productList.appendChild(currentRow);
      }

      const col = document.createElement('div');
      col.className = 'col-6 col-md-3';

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
                    <img src="${product.image}" class="card-img-top" alt="${
        product.name
      }" data-hover="${product.hoverImage}" data-original="${product.image}">
                    <div class="product-icons">
                        <button class="icon-btn more-btn"><i class="bi bi-cart"></i></button>
                        <button class="icon-btn zoom-btn"><i class="bi bi-search"></i></button>
                    </div>
                    <div class="product-info">
                        <span class="new-label">Hàng mới</span>
                        <h5 class="product-name">${product.name}</h5>
                        <p class="product-description">${
                          product.description
                        }</p>
                        <p class="price">${formatPrice(
                          product.price,
                        )} <span class="original-price">${originalPrice}</span></p>

                    </div>
                </div>
            `;

      currentRow.appendChild(col);
    });

    // Hover image effect
    const images = productList.querySelectorAll('.card_product img');
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

  const tabItems = document.querySelectorAll('.tab-item');

  tabItems.forEach((item, index) => {
    item.addEventListener('click', () => {
      tabItems.forEach((el) => el.classList.remove('active'));
      item.classList.add('active');

      if (index === 0) {
        renderProducts(topSellingProducts);
      } else if (index === 1) {
        renderProducts(newProducts);
      }
    });
  });

  // Mặc định: hiển thị top
  renderProducts(topSellingProducts);
});
