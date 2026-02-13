import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
console.log('Global JS loaded');

document.addEventListener('DOMContentLoaded', () => {
    const toast = document.getElementById('toast');

    if (!toast) return;

    // Show
    setTimeout(() => {
        toast.classList.remove('translate-y-6', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');
    }, 100);

    // Hide after 3s
    setTimeout(() => {
        toast.classList.remove('translate-y-0', 'opacity-100');
        toast.classList.add('translate-y-6', 'opacity-0');
    }, 3000);

    // Remove from DOM after animation
    setTimeout(() => {
        toast.remove();
    }, 3600);
});



