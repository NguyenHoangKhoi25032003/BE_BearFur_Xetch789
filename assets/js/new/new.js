
  const newsData = [
    {
      title: "5 Mẫu Ghế Sofa Giá Rẻ Dưới 2 Triệu Nhỏ Gọn Bán Chạy Nhất 2023",
      date: "27/08/2023",
      image: "assets/img/ghe-sofa-gia-re-duoi-2-trieu-14.webp",
      description: "Mẫu ghế sofa giá rẻ dưới 2 triệu hiện đang được nhiều người săn lùng nhờ giá thành rẻ, chất lượng tốt..."
    },
    {
      title: "Cách Lắp Ghế Xoay Văn Phòng Nhanh Chóng Chỉ Trong 4 Bước",
      date: "26/08/2023",
      image: "assets/img/ghe-sofa-gia-re-duoi-2-trieu-14.webp",
      description: "Bạn đang loay hoay tìm cách lắp ghế xoay văn phòng? Đây là hướng dẫn đầy đủ và dễ hiểu nhất cho bạn..."
    },
    {
      title: "Hướng Dẫn Chọn Kích Thước Ghế Giám Đốc Phù Hợp Cho Lãnh Đạo",
      date: "25/08/2023",
      image: "assets/img/ghe-sofa-gia-re-duoi-2-trieu-14.webp",
      description: "Ghế giám đốc là lựa chọn số một mang lại uy thế cho các nhà lãnh đạo. Hãy lựa chọn đúng kiểu dáng và kích cỡ..."
    },
     {
      title: "Cách Lắp Ghế Xoay Văn Phòng Nhanh Chóng Chỉ Trong 4 Bước",
      date: "26/08/2023",
      image: "assets/img/ghe-sofa-gia-re-duoi-2-trieu-14.webp",
      description: "Bạn đang loay hoay tìm cách lắp ghế xoay văn phòng? Đây là hướng dẫn đầy đủ và dễ hiểu nhất cho bạn..."
    },
    {
      title: "Hướng Dẫn Chọn Kích Thước Ghế Giám Đốc Phù Hợp Cho Lãnh Đạo",
      date: "25/08/2023",
      image: "assets/img/ghe-sofa-gia-re-duoi-2-trieu-14.webp",
      description: "Ghế giám đốc là lựa chọn số một mang lại uy thế cho các nhà lãnh đạo. Hãy lựa chọn đúng kiểu dáng và kích cỡ..."
    },
     {
      title: "Cách Lắp Ghế Xoay Văn Phòng Nhanh Chóng Chỉ Trong 4 Bước",
      date: "26/08/2023",
      image: "assets/img/ghe-sofa-gia-re-duoi-2-trieu-14.webp",
      description: "Bạn đang loay hoay tìm cách lắp ghế xoay văn phòng? Đây là hướng dẫn đầy đủ và dễ hiểu nhất cho bạn..."
    },
    {
      title: "Hướng Dẫn Chọn Kích Thước Ghế Giám Đốc Phù Hợp Cho Lãnh Đạo",
      date: "25/08/2023",
      image: "assets/img/ghe-sofa-gia-re-duoi-2-trieu-14.webp",
      description: "Ghế giám đốc là lựa chọn số một mang lại uy thế cho các nhà lãnh đạo. Hãy lựa chọn đúng kiểu dáng và kích cỡ..."
    },
    // ✅ Thêm nhiều dữ liệu tùy ý
  ];

  const newsList = document.getElementById("news-list");
  const pagination = document.getElementById("pagination");
  const cardsPerPage = 6;
  let currentPage = 1;
  const totalPages = Math.ceil(newsData.length / cardsPerPage);

  function renderCards() {
    newsList.innerHTML = "";

    const start = (currentPage - 1) * cardsPerPage;
    const end = start + cardsPerPage;
    const pageItems = newsData.slice(start, end);

    pageItems.forEach(item => {
      const card = document.createElement("div");
      card.className = "news-card";
      card.innerHTML = `
        <div class="news-image-wrapper">
          <img src="${item.image}" alt="${item.title}">
        </div>
        <div class="news-content">
          <div class="news-title_new">${item.title}</div>
          <div class="news-date_new">${item.date}</div>
          <div class="news-description_new">${item.description}</div>
        </div>
      `;
      newsList.appendChild(card);
    });
  }

  function renderPagination() {
    pagination.innerHTML = "";

    for (let i = 1; i <= totalPages; i++) {
      const btn = document.createElement("button");
      btn.textContent = i;
      btn.className = i === currentPage ? "active" : "";
      btn.addEventListener("click", () => {
        currentPage = i;
        renderCards();
        renderPagination();
      });
      pagination.appendChild(btn);
    }
  }

  // Init
  renderCards();
  renderPagination();

