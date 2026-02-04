import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
console.log('Global JS loaded');

// Les imports Swiper et Preline sont commentés car les packages ne sont pas installés
// import 'preline/preline';
// import Swiper from 'swiper';
// import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper/modules';
// import 'swiper/css';
// import 'swiper/css/navigation';
// import 'swiper/css/pagination';
// import 'swiper/css/effect-fade';
