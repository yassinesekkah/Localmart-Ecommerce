import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
console.log('Global JS loaded');

import 'preline/preline';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';

// Initialize Swiper
const swiper = new Swiper('#swiper-1', {
    modules: [Navigation, Pagination, Autoplay, EffectFade],
    speed: 400,
    spaceBetween: 100,
    effect: 'fade',
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        480: { slidesPerView: 1 },
        768: { slidesPerView: 1 },
        1024: { slidesPerView: 1 },
    },
});
// Initialize Swiper
document.addEventListener('DOMContentLoaded', function () {

    const swiper = new Swiper('#swiper-1', {
        modules: [Pagination, Autoplay, EffectFade], // حيّد Navigation من هنا
        speed: 800,
        spaceBetween: 100,
        effect: 'fade',
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        // احذف navigation أولا درها false
        // navigation: false,
        breakpoints: {
            480: { slidesPerView: 1 },
            768: { slidesPerView: 1 },
            1024: { slidesPerView: 1 },
        },
    });

    // Categories Slider
  const categoriesSwiper = new Swiper('#swiper-categories', {
    modules: [Navigation, Autoplay],
    speed: 400,
    spaceBetween: 20,
    loop: true,
    slidesPerView: 2,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      480: { 
        slidesPerView: 2,
        spaceBetween: 10,
      },
      768: { 
        slidesPerView: 3,
        spaceBetween: 15,
      },
      1024: { 
        slidesPerView: 6,
        spaceBetween: 20,
      },
    },
  });

});