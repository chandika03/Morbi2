var swiper = new Swiper(".mySwiper", {
  slidesPerView: 3,
  spaceBetween: 30,
  slidesPerGroup: 3,
  loop: true,
  loopFillGroupWithBlank: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

const dropBtn = document.querySelector(".profile");

const dropContent = document.querySelector(".drop");
const dropIcon = document.querySelector(".drop-icon");

dropBtn.addEventListener("click", () => {
  if (dropContent.style.display === "none") dropContent.style.display = "block";
  else dropContent.style.display = "none";
  //   console.log("drop");
});
// dropIcon.addEventListener("click", () => {
//   dropContent.style.display = "none";
// });
