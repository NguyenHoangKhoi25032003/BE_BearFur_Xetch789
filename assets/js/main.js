// ✅ Hover hoặc giữ trạng thái active ở desktop
document.querySelectorAll('.dropdown').forEach((dropdown) => {
  dropdown.addEventListener('mouseenter', () => {
    dropdown.classList.add('active');
  });
  dropdown.addEventListener('mouseleave', () => {
    dropdown.classList.remove('active');
  });
});

// ✅ Không chặn click link ở desktop
document.querySelectorAll('.dropdown > a').forEach((link) => {
  link.addEventListener('click', (e) => {
    // Cho phép chuyển trang
    // Không cần preventDefault
  });
});

// ✅ Toggle modal khi nhấn nút ☰ trên mobile
document.querySelector('.mobile-nav-toggle').addEventListener('click', () => {
  if (window.innerWidth <= 768) {
    document.querySelector('#mobile-nav-modal').classList.toggle('active');
  }
});

// ✅ Đóng modal khi nhấn nút X
document.querySelector('.modal-close').addEventListener('click', () => {
  document.querySelector('#mobile-nav-modal').classList.remove('active');
});

// ✅ Đóng modal khi click ra ngoài
document.querySelector('.modal-overlay').addEventListener('click', (e) => {
  if (e.target === document.querySelector('.modal-overlay')) {
    document.querySelector('#mobile-nav-modal').classList.remove('active');
  }
});

// ✅ Toggle danh mục Sản Phẩm cấp 1 (ở mobile)
document.querySelector('.toggle-icon').addEventListener('click', (e) => {
  e.preventDefault();
  e.stopPropagation();

  const dropdown = e.target.closest('.modal-dropdown');
  const subMenu = dropdown.querySelector('.modal-sub-menu');
  const toggleIcon = e.target;
  const isActive = dropdown.classList.contains('active');

  if (!isActive) {
    subMenu.innerHTML = `
      ${generateCategoryItem('Đèn trang trí', [
        'Đèn chùm',
        'Đèn âm trần',
        'Đèn thả trần',
        'Đèn cây - đèn bàn',
      ])}
      ${generateCategoryItem('Đồ trang trí', [
        'Kệ sách',
        'Đồng hồ treo tường',
        'Bàn ghế Sofa',
        'Khung tranh ảnh',
      ])}
      ${generateCategoryItem('Đồ nội thất', [
        'Nội thất phòng khách',
        'Nội thất phòng bếp',
        'Nội thất phòng ngủ',
        'Nội thất phòng tắm',
      ])}
      ${generateCategoryItem('Thiết bị vệ sinh', [
        'Bồn tắm',
        'Vòi sen',
        'Vòi Lavabo',
        'Chậu Lavabo',
      ])}
    `;

    // Gắn sự kiện toggle cho từng dấu +
    document.querySelectorAll('.modal-toggle-icon').forEach((icon) => {
      icon.addEventListener('click', toggleSubSubMenu);
    });

    dropdown.classList.add('active');
    toggleIcon.textContent = '-';
  } else {
    subMenu.innerHTML = '';
    dropdown.classList.remove('active');
    toggleIcon.textContent = '+';
  }
});

// ✅ Tạo từng mục danh mục lớn + con
function generateCategoryItem(category, subItems) {
  const subList = subItems
    .map(
      (item) =>
        `<li><a href="product.html?subcategory=${encodeURIComponent(
          item,
        )}">${item}</a></li>`,
    )
    .join('');

  return `
    <li class="modal-sub-dropdown">
      <div class="modal-sub-toggle">
        <a href="product.html?category=${encodeURIComponent(
          category,
        )}">${category}</a>
        <span class="modal-toggle-icon">+</span>
      </div>
      <ul class="modal-sub-sub-menu">${subList}</ul>
    </li>
  `;
}

// ✅ Toggle danh mục cấp 2 trong mobile modal
function toggleSubSubMenu(e) {
  e.preventDefault();
  e.stopPropagation();

  const parent = e.target.closest('.modal-sub-dropdown');
  const menu = parent.querySelector('.modal-sub-sub-menu');
  const isOpen = parent.classList.contains('active');

  if (!isOpen) {
    menu.style.display = 'block';
    parent.classList.add('active');
    e.target.textContent = '-';
  } else {
    menu.style.display = 'none';
    parent.classList.remove('active');
    e.target.textContent = '+';
  }
}
// Toggle dropdown user
document.querySelector('.user-icon').addEventListener('click', (e) => {
  e.preventDefault();
  const dropdown = document.querySelector('.user-dropdown');
  dropdown.style.display =
    dropdown.style.display === 'block' ? 'none' : 'block';
});

// Tự động đóng dropdown khi click ra ngoài
document.addEventListener('click', (e) => {
  const icon = e.target.closest('.user-icon');
  const dropdown = document.querySelector('.user-dropdown');

  if (!icon && !e.target.closest('.user-dropdown')) {
    dropdown.style.display = 'none';
  }
});
// Khởi tạo bộ đếm khi header được tải
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

// Gọi lại sau khi header load xong
document.addEventListener('DOMContentLoaded', () => {
  initCartCount();

  document.querySelector('.add-to-cart')?.addEventListener('click', () => {
    increaseCartCount();
  });

  // Cho nút trong product sales
  document.querySelectorAll('.more-btn').forEach((btn) => {
    btn.addEventListener('click', () => {
      increaseCartCount();
    });
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const searchIcon = document.querySelector('.search-icon');
  const searchModal = document.getElementById('searchModal');
  const closeSearch = document.getElementById('closeSearch');

  searchIcon.addEventListener('click', (e) => {
    e.preventDefault();
    searchModal.classList.add('show');
  });

  closeSearch.addEventListener('click', () => {
    searchModal.classList.remove('show');
  });

  // Đóng modal nếu click ngoài vùng modal
  searchModal.addEventListener('click', (e) => {
    if (e.target === searchModal) {
      searchModal.classList.remove('show');
    }
  });
});

setTimeout(() => {
  const searchIcon = document.querySelector('.search-icon');
  const searchModal = document.getElementById('searchModal');
  const closeSearch = document.getElementById('closeSearch');

  if (searchIcon && searchModal && closeSearch) {
    searchIcon.addEventListener('click', (e) => {
      e.preventDefault();
      searchModal.classList.add('show');
    });

    closeSearch.addEventListener('click', () => {
      searchModal.classList.remove('show');
    });

    searchModal.addEventListener('click', (e) => {
      if (e.target === searchModal) {
        searchModal.classList.remove('show');
      }
    });
  }
}, 500);
