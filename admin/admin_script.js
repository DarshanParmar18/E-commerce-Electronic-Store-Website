"use strict";

// admin
let userBtn2 = document.querySelector("#user-btn2");
userBtn2.addEventListener("click", () => {
  let userBox = document.querySelector(".user-box");
  userBox.classList.toggle("active");
});
