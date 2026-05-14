{{--
    Ayam Goreng Widy — Header & Sidebar
    Cara pakai di layout: @include('components.header')
    JS ada di level yang sama: resources/views/components/header.js
--}}

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,800;1,700&family=DM+Sans:wght@400;500;600&display=swap');

    :root {
        --agw-primary: #C8763A;
        --agw-primary-dk: #A05A28;
        --agw-text: #2C2416;
        --agw-muted: #7A6A55;
        --agw-border: #EDE8DF;
        --agw-surface: #FAFAF8;
        --agw-h: 60px;
    }

    /* ── Header ──────────────────────────────────────────────── */
    #agw-header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: var(--agw-h);
        background: #fff;
        border-bottom: 1px solid var(--agw-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1.4rem;
        z-index: 900;
        transition: box-shadow .3s;
    }

    #agw-header.agw-up {
        box-shadow: 0 2px 20px rgba(44, 36, 22, .08);
    }

    .agw-brand {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--agw-text);
        text-decoration: none;
        letter-spacing: .01em;
    }

    .agw-brand i {
        font-style: italic;
        color: var(--agw-primary);
    }

    /* Tombol hamburger */
    #agw-ham {
        width: 40px;
        height: 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 5px;
        background: var(--agw-surface);
        border: 1.5px solid var(--agw-border);
        border-radius: 10px;
        cursor: pointer;
        padding: 0;
        transition: border-color .2s, background .2s;
    }

    #agw-ham:hover {
        border-color: var(--agw-primary);
        background: #FFF8F2;
    }

    .agw-bar {
        display: block;
        width: 18px;
        height: 2px;
        background: var(--agw-muted);
        border-radius: 2px;
        transform-origin: center;
        transition: transform .35s cubic-bezier(.77, 0, .18, 1), opacity .2s, width .25s;
    }

    #agw-ham.open .agw-bar:nth-child(1) {
        transform: translateY(7px) rotate(45deg);
    }

    #agw-ham.open .agw-bar:nth-child(2) {
        opacity: 0;
        width: 0;
    }

    #agw-ham.open .agw-bar:nth-child(3) {
        transform: translateY(-7px) rotate(-45deg);
    }

    /* ── Overlay ─────────────────────────────────────────────── */
    #agw-overlay {
        position: fixed;
        inset: 0;
        z-index: 910;
        background: rgba(30, 20, 10, .28);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        opacity: 0;
        pointer-events: none;
        transition: opacity .35s;
    }

    #agw-overlay.open {
        opacity: 1;
        pointer-events: auto;
    }

    /* ── Sidebar ─────────────────────────────────────────────── */
    #agw-sidebar {
        position: fixed;
        top: 0;
        right: 0;
        width: 272px;
        height: 100dvh;
        background: #fff;
        z-index: 920;
        display: flex;
        flex-direction: column;
        transform: translateX(100%);
        transition: transform .38s cubic-bezier(.77, 0, .18, 1);
        box-shadow: -4px 0 28px rgba(44, 36, 22, .1);
    }

    #agw-sidebar.open {
        transform: translateX(0);
    }

    /* Sidebar head */
    .agw-sb-top {
        height: var(--agw-h);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1.2rem;
        border-bottom: 1px solid var(--agw-border);
        flex-shrink: 0;
    }

    .agw-sb-name {
        font-family: 'Playfair Display', serif;
        font-size: .9rem;
        font-weight: 700;
        color: var(--agw-text);
    }

    .agw-sb-name em {
        font-style: italic;
        color: var(--agw-primary);
    }

    #agw-close {
        width: 32px;
        height: 32px;
        border: 1.5px solid var(--agw-border);
        border-radius: 8px;
        background: transparent;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--agw-muted);
        padding: 0;
        transition: border-color .2s, color .2s, background .2s;
    }

    #agw-close:hover {
        border-color: var(--agw-primary);
        color: var(--agw-primary);
        background: #FFF8F2;
    }

    /* Nav */
    .agw-nav {
        flex: 1;
        overflow-y: auto;
        padding: .9rem .7rem;
        display: flex;
        flex-direction: column;
        gap: .2rem;
    }

    .agw-nav-lbl {
        font-family: 'DM Sans', sans-serif;
        font-size: .63rem;
        font-weight: 600;
        letter-spacing: .13em;
        text-transform: uppercase;
        color: #B8A898;
        padding: .55rem .8rem .25rem;
    }

    .agw-a {
        display: flex;
        align-items: center;
        gap: .75rem;
        padding: .62rem .85rem;
        border-radius: 10px;
        font-family: 'DM Sans', sans-serif;
        font-size: .88rem;
        font-weight: 500;
        color: var(--agw-muted);
        text-decoration: none;
        position: relative;
        transition: background .18s, color .15s, transform .15s;
    }

    .agw-a:hover {
        background: #FFF4EB;
        color: var(--agw-primary);
        transform: translateX(3px);
    }

    .agw-a.act {
        background: #FFF0E4;
        color: var(--agw-primary);
        font-weight: 600;
    }

    .agw-a.act::before {
        content: '';
        position: absolute;
        left: 0;
        top: 22%;
        bottom: 22%;
        width: 3px;
        border-radius: 2px;
        background: var(--agw-primary);
    }

    .agw-a svg {
        flex-shrink: 0;
        opacity: .7;
    }

    .agw-a:hover svg,
    .agw-a.act svg {
        opacity: 1;
    }

    /* Logout */
    .agw-foot {
        padding: .7rem;
        border-top: 1px solid var(--agw-border);
    }

    .agw-out {
        display: flex;
        align-items: center;
        gap: .75rem;
        padding: .62rem .85rem;
        border-radius: 10px;
        font-family: 'DM Sans', sans-serif;
        font-size: .88rem;
        font-weight: 500;
        color: #B05840;
        text-decoration: none;
        transition: background .18s, transform .15s;
    }

    .agw-out:hover {
        background: #FFF0EE;
        transform: translateX(3px);
    }

    .agw-out svg {
        opacity: .8;
    }

    /* Stagger masuk */
    #agw-sidebar.open .agw-a,
    #agw-sidebar.open .agw-out {
        animation: agw-in .3s ease both;
    }

    #agw-sidebar.open .agw-a:nth-child(1) {
        animation-delay: .04s;
    }

    #agw-sidebar.open .agw-a:nth-child(2) {
        animation-delay: .09s;
    }

    #agw-sidebar.open .agw-a:nth-child(3) {
        animation-delay: .14s;
    }

    #agw-sidebar.open .agw-out {
        animation-delay: .17s;
    }

    @keyframes agw-in {
        from {
            opacity: 0;
            transform: translateX(14px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>

@vite(['resources/views/components/sidebarAdmin/header.js'])

{{-- ╔══════════════════════════════════╗
     ║           H E A D E R           ║
     ╚══════════════════════════════════╝ --}}
<header id="agw-header">

    <a href="{{ route('home') }}" class="agw-brand">
        Ayam Goreng <i>Widy</i>
    </a>

    <button id="agw-ham" aria-label="Buka menu" aria-expanded="false" aria-controls="agw-sidebar">
        <span class="agw-bar"></span>
        <span class="agw-bar"></span>
        <span class="agw-bar"></span>
    </button>

</header>


{{-- ╔══════════════════════════════════╗
     ║          O V E R L A Y          ║
     ╚══════════════════════════════════╝ --}}
<div id="agw-overlay" aria-hidden="true"></div>


{{-- ╔══════════════════════════════════╗
     ║         S I D E B A R           ║
     ╚══════════════════════════════════╝ --}}
<aside id="agw-sidebar" aria-label="Menu navigasi">

    {{-- Top --}}
    <div class="agw-sb-top">
        <span class="agw-sb-name">Ayam Goreng <em>Widy</em></span>
        <button id="agw-close" aria-label="Tutup menu">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2.5" stroke-linecap="round">
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
        </button>
    </div>

    {{-- Nav links --}}
    <nav class="agw-nav">
        <p class="agw-nav-lbl">Menu Utama</p>

        <a href="{{ route('index') }}" class="agw-a {{ request()->routeIs('index') ? 'act' : '' }}">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7" rx="1.5" />
                <rect x="14" y="3" width="7" height="7" rx="1.5" />
                <rect x="3" y="14" width="7" height="7" rx="1.5" />
                <rect x="14" y="14" width="7" height="7" rx="1.5" />
            </svg>
            Dashboard
        </a>

        <a href="{{ route('produk') }}" class="agw-a {{ request()->routeIs('produk') ? 'act' : '' }}">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" />
                <line x1="7" y1="7" x2="7.01" y2="7" />
            </svg>
            Produk
        </a>

        <a href="{{ route('kategori') }}" class="agw-a {{ request()->routeIs('kategori') ? 'act' : '' }}">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <line x1="8" y1="6" x2="21" y2="6" />
                <line x1="8" y1="12" x2="21" y2="12" />
                <line x1="8" y1="18" x2="21" y2="18" />
                <circle cx="3" cy="6" r=".8" fill="currentColor" stroke="none" />
                <circle cx="3" cy="12" r=".8" fill="currentColor" stroke="none" />
                <circle cx="3" cy="18" r=".8" fill="currentColor" stroke="none" />
            </svg>
            Kategori
        </a>
    </nav>

    {{-- Logout --}}
    <div class="agw-foot">
        <a href="{{ route('home') }}" class="agw-out">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                <polyline points="16 17 21 12 16 7" />
                <line x1="21" y1="12" x2="9" y2="12" />
            </svg>
            Logout
        </a>
    </div>

</aside>

{{-- Script satu level dengan blade ini --}}
{{-- <script src="{{ asset('resources/views/components/sidebarAdmin/header.js') }}"></script> --}}
