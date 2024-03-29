"use strict";

const header = document.querySelector(".header");
// -----------------------------------------------------------------------------------
const fixedNavbar = () => {
  header.classList.toggle("scrolled", window.pageYOffset > 0);
};

fixedNavbar();
window.addEventListener("scroll", fixedNavbar);
// -------------------home slider-----------------
const leftArrow = document.querySelector(".left-arrow .bxs-left-arrow");
const rightArrow = document.querySelector(".right-arrow .bxs-right-arrow");
const slider = document.querySelector(".slider");

// ---------------testimonial slider----------------
const slides = document.querySelectorAll(".testimonial-item");
let index = 0;

let menu = document.querySelector("#menu-btn");
let userBtn = document.querySelector("#user-btn");

menu.addEventListener("click", () => {
  let nav = document.querySelector(".navbar");
  nav.classList.toggle("active");
});

userBtn.addEventListener("click", () => {
  let userBox = document.querySelector(".user-box");
  userBox.classList.toggle("active");
});

// ---------------------scroll to right --------------------------
const scrollRight = () => {
  if (slider.scrollWidth - slider.clientWidth === slider.scrollLeft) {
    slider.scrollTo({
      left: 0,
      behavior: "smooth",
    });
  } else {
    slider.scrollBy({
      left: window.innerWidth,
      behavior: "smooth",
    });
  }
};

// -----------------------scroll to left----------------------------
const scrollLeft = () => {
  slider.scrollBy({
    left: -window.innerWidth,
    behavior: "smooth",
  });
};
let timerId = setInterval(scrollRight, 70000);

// -----------------reset timer to scroll right-----------------

const resetTimer = () => {
  clearInterval(timerId);
  timerId = setInterval(scrollRight, 70000);
};

// ---------scroll event--------------
slider.addEventListener("click", (ev) => {
  if (ev.target === leftArrow) {
    scrollLeft();
    resetTimer();
  }
});
slider.addEventListener("click", (ev) => {
  if (ev.target === rightArrow) {
    scrollRight();
    resetTimer();
  }
});

// ---------------testimonial slider----------------

function nextSlide() {
  slides[index].classList.remove("active");
  index = (index + 1) % slides.length;
  slides[index].classList.add("active");
}
function prevSlide() {
  slides[index].classList.remove("active");
  index = (index - 1 + slides.length) % slides.length;
  slides[index].classList.add("active");
}
