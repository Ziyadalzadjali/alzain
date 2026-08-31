// Al Zain — lightweight front-end behaviour (no framework needed)

document.addEventListener('click', (e) => {
    const toggle = e.target.closest('[data-toggle]');
    if (toggle) {
        const target = document.querySelector(toggle.getAttribute('data-toggle'));
        if (target) target.classList.toggle('hidden');
    }

    const dismiss = e.target.closest('[data-dismiss]');
    if (dismiss) {
        const el = dismiss.closest('[data-flash]');
        if (el) el.remove();
    }
});

// auto-hide flash messages
setTimeout(() => {
    document.querySelectorAll('[data-flash]').forEach((el) => {
        el.style.transition = 'opacity .4s ease';
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 400);
    });
}, 4500);
