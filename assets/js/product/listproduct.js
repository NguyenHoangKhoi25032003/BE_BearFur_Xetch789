function getParamsFromURL() {
    const params = new URLSearchParams(window.location.search);
    const category = params.get("category");
    const type = params.get("type");
    return { category, type };
}

document.addEventListener("DOMContentLoaded", () => {
    const { category, type } = getParamsFromURL();
    if (category) selectedCategory = category;
    if (type) selectedType = type;

    filterProducts();

    // Cập nhật tiêu đề hiển thị theo URL
    if (category && type) {
        updateTitles({
            hero: type,
            section: type,
            breadcrumb: `${category} › ${type}`
        });
    } else if (category) {
        updateTitles({
            hero: category,
            section: category,
            breadcrumb: category
        });
    }

   filterProducts();
});

const productsPerPage = 12;
let currentPage = 1;
let selectedCategory = null;
let selectedType = null;

function updateTitles({ hero, section, breadcrumb }) {
  const heroTitle = document.getElementById("hero-title");
  const breadcrumbTitle = document.getElementById("breadcrumb-title");
  const sectionTitle = document.getElementById("section-title");

  if (heroTitle) heroTitle.textContent = hero;
  if (breadcrumbTitle) breadcrumbTitle.textContent = breadcrumb;
  if (sectionTitle) sectionTitle.textContent = section.toUpperCase();
}

function filterProducts() {
    const productCards = document.querySelectorAll('.product-card');
    let visibleCount = 0;
    productCards.forEach(card => {
        const category = card.getAttribute('data-category');
        const type = card.getAttribute('data-type');
        let show = true;
        if (selectedCategory && category !== selectedCategory) show = false;
        if (selectedType && type !== selectedType) show = false;
        card.style.display = show ? '' : 'none';
        if (show) visibleCount++;
    });
    // Ẩn/hiện thông báo không có sản phẩm
    const emptyMsg = document.getElementById('no-product-message');
    if (emptyMsg) emptyMsg.style.display = visibleCount === 0 ? '' : 'none';
}

document.querySelectorAll(".category-header").forEach(el => {
  el.addEventListener("click", () => {
    selectedCategory = el.dataset.category;
    selectedType = null;
    filterProducts();
    updateTitles({
      hero: selectedCategory,
      section: selectedCategory,
      breadcrumb: selectedCategory
    });
  });
});

document.querySelectorAll(".subcategory-item").forEach(el => {
  el.addEventListener("click", () => {
    selectedCategory = el.dataset.category;
    selectedType = el.dataset.type;
    filterProducts();
    updateTitles({
      hero: selectedType,
      section: selectedType,
      breadcrumb: `${selectedCategory} › ${selectedType}`
    });
  });
});
