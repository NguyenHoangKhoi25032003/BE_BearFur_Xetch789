 const stores = [
    {
      name: "Bean Hồ Chí Minh",
      address: "70 Lữ Gia, Quận 11, TP.HCM",
      query: "70+Lữ+Gia,+TP.HCM"
    },
    {
      name: "Bean Bình Dương",
      address: "169 Nguyễn Hữu Cảnh, TP.Thủ Dầu Một",
      query: "169+Nguyễn+Hữu+Cảnh,+Bình+Dương"
    },
    {
      name: "Bean Cần Thơ",
      address: "81 Phan Huy Chú, Ninh Kiều, Cần Thơ",
      query: "81+Phan+Huy+Chú,+Cần+Thơ"
    },
    {
      name: "Bean Hà Nội",
      address: "266 Đội Cấn, Ba Đình, Hà Nội",
      query: "266+Đội+Cấn,+Hà+Nội"
    }
  ];

  const storeList = document.getElementById("store-list");
  const mapFrame = document.getElementById("map-frame");

  stores.forEach(store => {
    const div = document.createElement("div");
    div.className = "store-item";
    div.innerHTML = `<strong>${store.name}</strong>${store.address}`;
    div.addEventListener("click", () => {
      // Cập nhật bản đồ iframe
      mapFrame.src = `https://www.google.com/maps?q=${store.query}&output=embed`;

      // Highlight item
      document.querySelectorAll(".store-item").forEach(i => i.classList.remove("active"));
      div.classList.add("active");
    });
    storeList.appendChild(div);
  });


  const input = document.getElementById("search-input");
const provinceFilter = document.getElementById("province-filter");
const storeItems = document.querySelectorAll(".store-item");

function filterStores() {
  const keyword = input.value.toLowerCase().trim();
  const selectedProvince = provinceFilter.value;

  storeItems.forEach(item => {
    const name = item.querySelector("strong")?.textContent.toLowerCase() || "";
    const address = item.textContent.toLowerCase();

    const matchName = name.includes(keyword);
    const matchProvince = selectedProvince === "" || address.includes(selectedProvince.toLowerCase());

    if (matchName && matchProvince) {
      item.style.display = "block";
    } else {
      item.style.display = "none";
    }
  });
}

input.addEventListener("input", filterStores);
provinceFilter.addEventListener("change", filterStores);
