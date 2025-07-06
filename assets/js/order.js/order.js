const params = new URLSearchParams(window.location.search);
const data = {
  name: params.get('name'),
  price: params.get('price'),
  oldPrice: params.get('oldPrice'),
  discount: params.get('discount'),
  image: params.get('image'),
  category: params.get('category'),
  type: params.get('type'),
  badge: params.get('badge'),
};

// Đổ dữ liệu vào HTML
document.getElementById('product-name').textContent = data.name;
document.getElementById('product-price').textContent = data.price;
document.getElementById('product-old-price').textContent = data.oldPrice;
document.getElementById('product-discount').textContent = data.discount || '';
document.getElementById('product-category').textContent = data.category;
document.getElementById('product-type').textContent = data.type;
document.getElementById('product-badge').textContent = data.badge;
document.getElementById('main-img').src = data.image;
document.getElementById('main-img').alt = data.name;

// Khởi tạo bộ đếm giỏ hàng
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
document.addEventListener('DOMContentLoaded', () => {
  initCartCount();

  document.querySelector('.add-to-cart')?.addEventListener('click', () => {
    increaseCartCount();
  });
});
