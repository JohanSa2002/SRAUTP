import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

/* ──────────────────────────────────────────────────────
   Alpine Component: countUp
   Animates a number from 0 to `target` when it enters
   the viewport.
────────────────────────────────────────────────────── */
Alpine.data('countUp', (target) => ({
    current: 0,
    target: parseInt(target) || 0,
    suffix: '',

    init() {
        const observer = new IntersectionObserver(
            ([entry]) => {
                if (entry.isIntersecting) {
                    this.animate();
                    observer.disconnect();
                }
            },
            { threshold: 0.5 }
        );
        observer.observe(this.$el);
    },

    animate() {
        const duration = 1800;
        const start    = performance.now();
        const tick = (now) => {
            const t    = Math.min((now - start) / duration, 1);
            const ease = 1 - Math.pow(1 - t, 3); /* ease-out-cubic */
            this.current = Math.floor(ease * this.target);
            if (t < 1) {
                requestAnimationFrame(tick);
            } else {
                this.current = this.target;
            }
        };
        requestAnimationFrame(tick);
    },
}));

/* ──────────────────────────────────────────────────────
   Alpine Component: navScroll
   Adds a shadow/border to the nav on scroll
────────────────────────────────────────────────────── */
Alpine.data('navScroll', () => ({
    scrolled: false,
    init() {
        window.addEventListener('scroll', () => {
            this.scrolled = window.scrollY > 20;
        }, { passive: true });
    },
}));

/* ──────────────────────────────────────────────────────
   Alpine Component: parallax
   Applies a gentle parallax offset to an element.
────────────────────────────────────────────────────── */
Alpine.data('parallax', (factor = 0.3) => ({
    offset: 0,
    init() {
        const update = () => {
            this.offset = window.scrollY * factor;
        };
        window.addEventListener('scroll', update, { passive: true });
        update();
    },
}));

Alpine.start();

/* ──────────────────────────────────────────────────────
   Scroll-Reveal System
   Adds `.is-revealed` to [data-reveal] elements when
   they enter the viewport.
────────────────────────────────────────────────────── */
function initScrollReveal() {
    const elements = document.querySelectorAll('[data-reveal]');
    if (!elements.length) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-revealed');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.08, rootMargin: '0px 0px -40px 0px' }
    );

    elements.forEach((el) => observer.observe(el));
}

/* ──────────────────────────────────────────────────────
   Typing effect for hero subtitle (optional decoration)
────────────────────────────────────────────────────── */
function initHeroTyping() {
    const el = document.getElementById('hero-typing');
    if (!el) return;
    const words = el.dataset.words ? JSON.parse(el.dataset.words) : [];
    if (!words.length) return;

    let wIndex = 0, cIndex = 0, deleting = false;

    const type = () => {
        const word = words[wIndex];
        el.textContent = deleting
            ? word.substring(0, cIndex--)
            : word.substring(0, cIndex++);

        if (!deleting && cIndex > word.length) {
            deleting = true;
            setTimeout(type, 2200);
            return;
        }
        if (deleting && cIndex < 0) {
            deleting = false;
            wIndex = (wIndex + 1) % words.length;
        }
        setTimeout(type, deleting ? 60 : 110);
    };
    setTimeout(type, 1800);
}

document.addEventListener('DOMContentLoaded', () => {
    initScrollReveal();
    initHeroTyping();
});
