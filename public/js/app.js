
// let sideMenu = document.querySelectorAll(".nav-link");
// sideMenu.forEach((item) => {
//   let li = item.parentElement;

//   item.addEventListener("click", () => {
//     sideMenu.forEach((link) => {
//       link.parentElement.classList.remove("active");
//     });
//     li.classList.add("active");
//   });
// });

document.addEventListener("DOMContentLoaded", function() {
  let sideMenu = document.querySelectorAll(".nav-link");

  // Hàm để xác định menu đang được chọn
  function setActiveMenu() {
    let currentURL = window.location.href;
    sideMenu.forEach((item) => {
      if (item.href === currentURL) {
        item.parentElement.classList.add("active");
      } else {
        item.parentElement.classList.remove("active");
      }
    });
  }

  // Gọi hàm để xác định menu đang được chọn khi trang tải
  setActiveMenu();

  // Xử lý sự kiện click để đặt lại trạng thái menu khi click
  sideMenu.forEach((item) => {
    item.addEventListener("click", () => {
      // Lưu trạng thái menu đã chọn vào localStorage
      localStorage.setItem('selectedMenu', item.href);
      setActiveMenu(); // Đặt lại trạng thái menu
    });
  });
});



let menuBar = document.querySelector(".menu-btn");
let sideBar = document.querySelector(".sidebar");
menuBar.addEventListener("click", () => {
  sideBar.classList.toggle("hide");
});

let switchMode = document.getElementById("switch-mode");
switchMode.addEventListener("change", (e) => {
  if (e.target.checked) {
    document.body.classList.add("dark");
  } else {
    document.body.classList.remove("dark");
  }
});

let searchFrom = document.querySelector(".content nav form");
let searchBtn = document.querySelector(".search-btn");
let searchIcon = document.querySelector(".search-icon");
searchBtn.addEventListener("click", (e) => {
  if (window.innerWidth < 576) {
    e.preventDefault();
    searchFrom.classList.toggle("show");
    if (searchFrom.classList.contains("show")) {
      searchIcon.classList.replace("fa-search", "fa-times");
    } else {
      searchIcon.classList.replace("fa-times", "fa-search");
    }
  }
});

window.addEventListener("resize", () => {
  if (window.innerWidth > 576) {
    searchIcon.classList.replace("fa-times", "fa-search");
    searchFrom.classList.remove("show");
  }
  if (window.innerWidth < 768) {
    sideBar.classList.add("hide");
  }
});

if (window.innerWidth < 768) {
  sideBar.classList.add("hide");
}

