import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Simple parallax for hero background
const hero = document.querySelector('[data-parallax]');
if (hero) {
    window.addEventListener('scroll', () => {
        const y = window.scrollY * 0.15;
        hero.style.backgroundPosition = `center calc(50% + ${y}px)`;
    });
}

// Reveal animations
const revealItems = document.querySelectorAll('.animate-fade-up');
if (revealItems.length) {
    const io = new IntersectionObserver(
        entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.2 }
    );

    revealItems.forEach(el => io.observe(el));
}
