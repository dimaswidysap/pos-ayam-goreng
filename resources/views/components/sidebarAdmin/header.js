/**
 * Ayam Goreng Widy — Header & Sidebar
 * resources/views/components/header.js
 */
(function () {
    const header = document.getElementById('agw-header');
    const sidebar = document.getElementById('agw-sidebar');
    const overlay = document.getElementById('agw-overlay');
    const ham = document.getElementById('agw-ham');
    const close = document.getElementById('agw-close');

    if (!sidebar || !ham) return;

    /* ── buka ──────────────────────────────────────────── */
    function open() {
        sidebar.classList.add('open');
        overlay.classList.add('open');
        ham.classList.add('open');
        ham.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
        close?.focus();
    }

    /* ── tutup ─────────────────────────────────────────── */
    function shut() {
        sidebar.classList.remove('open');
        overlay.classList.remove('open');
        ham.classList.remove('open');
        ham.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
        ham.focus();
    }

    /* ── event ─────────────────────────────────────────── */
    ham.addEventListener('click', () =>
        sidebar.classList.contains('open') ? shut() : open()
    );
    close?.addEventListener('click', shut);
    overlay.addEventListener('click', shut);
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && sidebar.classList.contains('open')) shut();
    });

    /* ── shadow on scroll ──────────────────────────────── */
    window.addEventListener('scroll', () => {
        header?.classList.toggle('agw-up', window.scrollY > 8);
    }, { passive: true });

})();