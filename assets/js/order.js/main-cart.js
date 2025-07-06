function initCartCount() {
  let count = localStorage.getItem('cartCount') || '0';
  updateCartCountUI(count);
}

function updateCartCountUI(count) {
  const cartSpan = document.querySelector('#cart-count');
  if (cartSpan) cartSpan.innerText = count;
}

function increaseCartCount() {
  let count = localStorage.getItem('cartCount') || '0';
  count = parseInt(count) + 1;
  localStorage.setItem('cartCount', count);
  updateCartCountUI(count);
}

function setupCartListeners() {
  document.querySelector('.add-to-cart')?.addEventListener('click', () => {
    increaseCartCount();
  });

  document.querySelectorAll('.more-btn').forEach((btn) => {
    btn.addEventListener('click', () => {
      increaseCartCount();
    });
  });
}

document.addEventListener('DOMContentLoaded', () => {
  initCartCount();
  setupCartListeners();
});
