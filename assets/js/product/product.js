
document.querySelectorAll('.category-header').forEach(header => {
    header.addEventListener('click', () => {
        const parent = header.parentElement;
        parent.classList.toggle('active');
        const icon = header.querySelector('.toggle');
        icon.textContent = parent.classList.contains('active') ? '−' : '+';
    });
});

document.querySelector('.toggle-all')?.addEventListener('click', () => {
    const all = document.querySelectorAll('.category-item');
    const isExpanded = [...all].some(item => item.classList.contains('active'));
    all.forEach(item => {
        item.classList.toggle('active', !isExpanded);
        const toggle = item.querySelector('.toggle');
        toggle.textContent = !isExpanded ? '−' : '+';
    });

    const toggleText = document.querySelector('.toggle-all');
    const icon = document.querySelector('.toggle-all-icon');
    toggleText.innerHTML = !isExpanded ? 'Ẩn tất cả danh mục <span class="toggle-all-icon">▲</span>'
        : 'Hiện tất cả danh mục <span class="toggle-all-icon">▼</span>';
});


document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll(".filter-scroll input[type='checkbox']");
    const selectedTagsContainer = document.getElementById("selected-tags");
    const clearBtn = document.getElementById("clear-filters");

    function updateSelectedTags() {
        selectedTagsContainer.innerHTML = "";

        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                const tag = document.createElement("div");
                tag.classList.add("selected-tag");
                tag.textContent = checkbox.parentNode.textContent.trim();

                const closeBtn = document.createElement("button");
                closeBtn.textContent = "✖";
                closeBtn.onclick = () => {
                    checkbox.checked = false;
                    updateSelectedTags();
                };

                tag.appendChild(closeBtn);
                selectedTagsContainer.appendChild(tag);
            }
        });

        document.getElementById("selected-filters").style.display =
            selectedTagsContainer.children.length > 0 ? "block" : "none";
    }

    checkboxes.forEach((cb) => cb.addEventListener("change", updateSelectedTags));

    clearBtn.addEventListener("click", (e) => {
        e.preventDefault();
        checkboxes.forEach((cb) => (cb.checked = false));
        updateSelectedTags();
    });

    updateSelectedTags(); // init
});

