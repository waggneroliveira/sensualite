import Swiper from 'swiper/bundle';
import { Fancybox } from "@fancyapps/ui";
Fancybox.bind("[data-fancybox]");

document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.getElementById("menuToggle");
    const mobileMenu = document.getElementById("mobileMenu");
    const header = document.querySelector(".header");

    // Alternar o menu mobile
    menuToggle.addEventListener("click", function () {
        mobileMenu.classList.toggle("active");

        // Alterna entre o ícone ☰ e o ✖
        if (mobileMenu.classList.contains("active")) {
            menuToggle.textContent = "✖";
        } else {
            menuToggle.textContent = "☰";
        }
    });

    // Detectar rolagem para mudar o estilo do menu
    window.addEventListener("scroll", function () {
        if (window.scrollY > 50) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }
    });
});

const swiperOne = new Swiper('.section-one__swiper', {
    slidesPerView: 'auto',
    spaceBetween: 7,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination-one',
        clickable: true,
    },
    breakpoints: {
        1024: {
            slidesPerView: 6,
        },
        768: {
            slidesPerView: 2,
        },
        576: {
            slidesPerView: 2,
        },
    },
});

const swiperTwo = new Swiper('.section-two__swiper', {
    slidesPerView: 'auto',
    spaceBetween: 20,
    autoHeight: true,
    rewind: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    breakpoints: {
        1024: {
            slidesPerView: 12,
        },
        768: {
            slidesPerView: 4,
        },
        576: {
            slidesPerView: 4,
        },
    },
});

const swiperThree = new Swiper('.section-feed__box__right__item__gallery__swiper', {
    slidesPerView: 'auto',
    // spaceBetween: 20,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    // breakpoints: {
    //     1024: {
    //         slidesPerView: 1,
    //     },
    //     768: {
    //         slidesPerView: 1,
    //     },
    //     576: {
    //         slidesPerView: 1,
    //     },
    // },
});

const swiperFour = new Swiper(".lightbox-info__swiper", {
    slidesPerView: 'auto',
    spaceBetween: 30,
    allowTouchMove: false,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

const swiperFive = new Swiper(".lightbox-gallery", {
    slidesPerView: 1,
    allowTouchMove: true,
    pagination: {
        el: ".swiper-pagination",
      },
    // navigation: {
    //     nextEl: ".swiper-button-next",
    //     prevEl: ".swiper-button-prev",
    // },
});

if (window.innerWidth < 768) {
    const swiperSix = new Swiper(".section-feed__box__left__top__swiper", {
        slidesPerView: 1,
        // navigation: {
        //     nextEl: ".swiper-button-next",
        //     prevEl: ".swiper-button-prev",
        // },
    });
    
    const swiperSeven = new Swiper(".section-three__box__swiper", {
        slidesPerView: 'auto',
        // navigation: {
        //     nextEl: ".swiper-button-next",
        //     prevEl: ".swiper-button-prev",
        // },
    });
}

// DROPDOWN
document.addEventListener("DOMContentLoaded", function () {
    function toggleDropdown(headSelector, infoSelector) {
        const head = document.querySelector(headSelector);
        const info = document.querySelector(infoSelector);

        if (head && info) {
            head.addEventListener("click", function () {
                info.style.display = (info.style.display === "none" || info.style.display === "") ? "flex" : "none";
            });
        }
    }

    // Chama a função para cada dropdown
    toggleDropdown('.section-post__box__left__profile__head', '.section-post__box__left__profile__information');
    toggleDropdown('.section-post__box__left__specialties__head', '.section-post__box__left__specialties__item');
    toggleDropdown('.section-post__box__left__service__head', '.section-post__box__left__service__information');
});

document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById("toggle-categorias");
    const parentLi = toggle.closest("li");

    toggle.addEventListener("click", function (e) {
        e.preventDefault();
        parentLi.classList.toggle("show");
    });
});
