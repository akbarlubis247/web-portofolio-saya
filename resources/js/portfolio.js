/**
 * Portfolio scroll animations and mobile navigation
 */

document.addEventListener('DOMContentLoaded', () => {
    initScrollReveal();
    initNavbar();
    initMobileMenu();
    initActiveNavLink();
});

/** Fade-in elements on scroll */
function initScrollReveal() {
    const reveals = document.querySelectorAll('.reveal');

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        },
        { threshold: 0.1, rootMargin: '0px 0px -50px 0px' }
    );

    reveals.forEach((el) => observer.observe(el));
}

/** Navbar background on scroll */
function initNavbar() {
    const navbar = document.getElementById('navbar');
    if (!navbar) return;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
            navbar.style.background = 'rgba(248, 250, 252, 0.9)';
            navbar.style.backdropFilter = 'blur(12px)';
            navbar.style.borderBottom = '1px solid rgba(15, 23, 42, 0.06)';
        } else {
            navbar.classList.remove('scrolled');
            navbar.style.background = 'transparent';
            navbar.style.backdropFilter = 'none';
            navbar.style.borderBottom = 'none';
        }
    });
}

/** Mobile menu toggle */
function initMobileMenu() {
    const toggle = document.getElementById('mobile-toggle');
    const menu = document.getElementById('mobile-menu');
    const close = document.getElementById('mobile-close');
    const links = menu?.querySelectorAll('a');

    if (!toggle || !menu) return;

    toggle.addEventListener('click', () => menu.classList.add('open'));
    close?.addEventListener('click', () => menu.classList.remove('open'));

    links?.forEach((link) => {
        link.addEventListener('click', () => menu.classList.remove('open'));
    });
}

/** Highlight active nav link based on scroll position */
function initActiveNavLink() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');

    window.addEventListener('scroll', () => {
        let current = '';

        sections.forEach((section) => {
            const top = section.offsetTop - 100;
            if (window.scrollY >= top) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach((link) => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    });
}
