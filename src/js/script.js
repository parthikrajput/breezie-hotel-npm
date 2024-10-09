window.addEventListener("scroll", function () {
  var header = document.querySelector("header");
  header.classList.toggle("sticky", window.scrollY > 100);
});

document.addEventListener("DOMContentLoaded", function () {
  const tabButtons = document.querySelectorAll(".tab-button");
  const tabContents = document.querySelectorAll(".tab-content");

  function activateTab(tabId) {
    tabButtons.forEach((btn) => btn.classList.remove("active"));
    tabContents.forEach((content) => content.classList.remove("active"));

    document
      .querySelector(`.tab-button[data-tab="${tabId}"]`)
      .classList.add("active");
    document.getElementById(tabId).classList.add("active");
  }

  tabButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const tabId = button.getAttribute("data-tab");
      activateTab(tabId);
    });
  });

  if (tabButtons.length > 0) {
    activateTab(tabButtons[0].getAttribute("data-tab"));
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const seeMoreBtn = document.getElementById("seeMoreBtn");
  const galleryImgs = document.getElementById("galleryImgs");
  const allImgs = galleryImgs.querySelectorAll(".gallery-img");

  function initializeGallery() {
    const visibleCount = 0;
    allImgs.forEach((img, index) => {
      if (index < visibleCount) {
        img.style.display = "block";
        img.style.opacity = 1;
        img.style.height = "auto";
      } else {
        img.style.display = "block";
        img.style.opacity = 0;
        img.style.height = "0";
        img.style.transition = "opacity 0.5s ease-out, height 0.5s ease-out";
      }
    });
  }

  function showExtraImages() {
    allImgs.forEach((img) => {
      img.style.display = "block";
      img.style.transition = "opacity 0.5s ease-out, height 0.5s ease-out";
      img.style.opacity = 1;
      img.style.height = "auto";
    });
  }

  function hideExtraImages() {
    const visibleCount = 0;
    allImgs.forEach((img, index) => {
      if (index >= visibleCount) {
        img.style.transition = "opacity 0.5s ease-out, height 0.5s ease-out";
        img.style.opacity = 0;
        img.style.height = "0";
      }
    });
  }

  initializeGallery();

  seeMoreBtn.addEventListener("click", function (event) {
    event.preventDefault();
    if (galleryImgs.classList.contains("show")) {
      hideExtraImages();
      seeMoreBtn.textContent = "see more";
      galleryImgs.classList.remove("show");
    } else {
      showExtraImages();
      seeMoreBtn.textContent = "see less";
      galleryImgs.classList.add("show");
    }
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const lightbox = document.getElementById("lightbox");
  const lightboxContent = lightbox.querySelector(".lightbox-content");
  const closeBtn = lightbox.querySelector(".close");

  lightbox.style.display = "none";

  document.querySelectorAll("[data-lightbox]").forEach((anchor) => {
    anchor.addEventListener("click", (event) => {
      event.preventDefault();
      const imgSrc = anchor.getAttribute("href");
      lightboxContent.src = imgSrc;
      showLightbox();
    });
  });

  closeBtn.addEventListener("click", () => {
    hideLightbox();
  });

  lightbox.addEventListener("click", (event) => {
    if (event.target === lightbox) {
      hideLightbox();
    }
  });

  function showLightbox() {
    lightbox.style.display = "flex";
  }

  function hideLightbox() {
    lightbox.style.display = "none";
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const faqItems = document.querySelectorAll(".faq-item");

  function handleFaqItemClick() {
    const answer = this.querySelector(".faq-answer");

    if (answer.classList.contains("show")) {
      answer.classList.remove("show");
    } else {
      document
        .querySelectorAll(".faq-answer")
        .forEach((ans) => ans.classList.remove("show"));

      answer.classList.add("show");
    }
  }
  document.querySelectorAll(".faq-answer")[0].classList.add("show");

  faqItems.forEach((item) => {
    item.addEventListener("click", handleFaqItemClick);
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".rqu");
  const requestSection = document.getElementById("requset-from");

  buttons.forEach((button) => {
    button.addEventListener("click", function (event) {
      event.preventDefault();
      requestSection.scrollIntoView({ behavior: "smooth" });
    });
  });
});

window.addEventListener("scroll", function () {
  var backToTopButton = document.getElementById("back-to-top");

  if (window.scrollY > 100) {
    backToTopButton.style.display = "flex";
  } else {
    backToTopButton.style.display = "none";
  }
});
document.getElementById("back-to-top").addEventListener("click", function () {
  var scrollToTop = function () {
    var currentPosition = window.scrollY;
    if (currentPosition > 0) {
      window.scrollTo(0, currentPosition - 20);
      setTimeout(scrollToTop, 5);
    }
  };

  scrollToTop();
  return false;
});

const menuIcon = document.querySelector(".menu-icon");
const closeIcon = document.querySelector(".close-icon");
const nav = document.querySelector("nav");

menuIcon.addEventListener("click", () => {
  nav.classList.add("open");
  menuIcon.style.zIndex = "-3";
});

closeIcon.addEventListener("click", () => {
  nav.classList.remove("open");
  menuIcon.style.zIndex = "1";
});
