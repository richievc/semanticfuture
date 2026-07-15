// SemanticFuture — vanilla JS interactions
// Mobile nav, accordions, animated counters, smooth scroll, toasts.

document.addEventListener('DOMContentLoaded', () => {
    initMobileMenu();
    initAccordions();
    initCounters();
    initSmoothScroll();
    initTabs();
});

/* ---------------------------------------------------------
 * Mobile navigation toggle
 * ------------------------------------------------------- */
function initMobileMenu() {
    const button = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');
    const iconOpen = document.getElementById('menu-icon-open');
    const iconClose = document.getElementById('menu-icon-close');

    if (!button || !menu) return;

    button.addEventListener('click', () => {
        const willOpen = menu.classList.contains('hidden');

        menu.classList.toggle('hidden');
        button.setAttribute('aria-expanded', String(willOpen));
        iconOpen?.classList.toggle('hidden');
        iconClose?.classList.toggle('hidden');
    });
}

/* ---------------------------------------------------------
 * Accordion (FAQ) — supports multiple independent accordions
 * ------------------------------------------------------- */
function initAccordions() {
    const triggers = document.querySelectorAll('[data-accordion-trigger]');

    triggers.forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const item = trigger.closest('[data-accordion-item]');
            const panel = item.querySelector('[data-accordion-panel]');
            const icon = item.querySelector('[data-accordion-icon]');
            const isOpen = trigger.getAttribute('aria-expanded') === 'true';

            trigger.setAttribute('aria-expanded', String(!isOpen));
            panel.style.gridTemplateRows = isOpen ? '0fr' : '1fr';
            icon?.classList.toggle('rotate-180', !isOpen);
        });
    });
}

/* ---------------------------------------------------------
 * Animated counters — triggers when scrolled into view
 * ------------------------------------------------------- */
function initCounters() {
    const counters = document.querySelectorAll('[data-counter]');
    if (!counters.length) return;

    const animate = (el) => {
        const target = parseFloat(el.dataset.counterTarget);
        const duration = 1200;
        const start = performance.now();

        const step = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            const current = target * eased;
            el.textContent = target % 1 === 0 ? Math.round(current).toLocaleString() : current.toFixed(1);

            if (progress < 1) requestAnimationFrame(step);
        };

        requestAnimationFrame(step);
    };

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    animate(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.4 }
    );

    counters.forEach((counter) => observer.observe(counter));
}

/* ---------------------------------------------------------
 * Smooth scroll for in-page anchor links
 * ------------------------------------------------------- */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach((link) => {
        link.addEventListener('click', (e) => {
            const targetId = link.getAttribute('href');
            if (targetId.length <= 1) return;

            const target = document.querySelector(targetId);
            if (!target) return;

            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });
}

/* ---------------------------------------------------------
 * Simple tabs component (used on Features/Pricing pages)
 * ------------------------------------------------------- */
function initTabs() {
    document.querySelectorAll('[data-tabs]').forEach((tabGroup) => {
        const buttons = tabGroup.querySelectorAll('[data-tab-trigger]');
        const panels = tabGroup.querySelectorAll('[data-tab-panel]');

        buttons.forEach((btn) => {
            btn.addEventListener('click', () => {
                const target = btn.dataset.tabTrigger;

                buttons.forEach((b) => {
                    const active = b.dataset.tabTrigger === target;
                    b.classList.toggle('bg-accent-500/10', active);
                    b.classList.toggle('text-accent-300', active);
                    b.classList.toggle('text-slate-400', !active);
                });

                panels.forEach((panel) => {
                    panel.classList.toggle('hidden', panel.dataset.tabPanel !== target);
                });
            });
        });
    });
}

/* ---------------------------------------------------------
 * Toast notifications — window.showToast(message, type)
 * ------------------------------------------------------- */
window.showToast = function (message, type = 'info') {
    const container = document.getElementById('toast-container');
    if (!container) return;

    const colors = {
        info: 'border-accent-400/30 text-accent-200',
        success: 'border-emerald-400/30 text-emerald-200',
        error: 'border-rose-400/30 text-rose-200',
    };

    const toast = document.createElement('div');
    toast.className = `glass ${colors[type] || colors.info} pointer-events-auto flex items-center gap-2 rounded-xl px-4 py-3 text-sm shadow-lg opacity-0 translate-y-2 transition-all duration-200`;
    toast.textContent = message;

    container.appendChild(toast);

    requestAnimationFrame(() => {
        toast.classList.remove('opacity-0', 'translate-y-2');
    });

    setTimeout(() => {
        toast.classList.add('opacity-0', 'translate-y-2');
        setTimeout(() => toast.remove(), 200);
    }, 3500);
};
