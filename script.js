const wrapper = document.querySelector(".wrapper");
const registerLink = document.querySelector(".register-link");
const loginLink = document.querySelector(".login-link");
const btnPopup = document.querySelector(".btnLogin-popup");
const iconClose = document.querySelector(".icon-close");
const join = document.querySelector(".join-btn");
console.log(iconClose.innerHTML);
registerLink.onclick = () => {
  wrapper.classList.add("active");
};

loginLink.onclick = () => {
  wrapper.classList.remove("active");
};

btnPopup.onclick = () => {
  wrapper.classList.add("active-popup");
  console.log("clicked");
  console.log("button clicked");
};

iconClose.onclick = () => {
  console.log("removed");
  wrapper.classList.remove("active-popup");
  wrapper.classList.remove("active");
};

iconClose.addEventListener("click", () => {
  // console.log("removed");
  wrapper.classList.remove("active-popup");
  wrapper.classList.remove("active");
});
join.addEventListener("click", () => {
  wrapper.classList.add("active");
  wrapper.classList.add("active-popup");
});
