@vite(['resources/views/components/sidebarAdmin/header.js','resources/views/components/sidebarAdmin/index.css'])

<header id="agw-header" class="fixed top-0 left-0 right-0 h-16 bg-base border-b border-border flex items-center justify-between px-5 z-40 transition-shadow duration-300">

    <a href="{{ route('home') }}" class="text-lg font-extrabold text-text no-underline tracking-normal">
        Ayam Goreng <span class="italic text-primary">Widy</span>
    </a>

    <div class="flex gap-4 h-full items-center">
        @include('components.sidebarAdmin.profilAdmin')

        <button id="agw-ham" aria-label="Buka menu" aria-expanded="false" aria-controls="agw-sidebar"
            class="w-10 h-10 flex flex-col items-center justify-center gap-1 bg-surface border-2 border-border rounded-xl cursor-pointer p-0 transition-all duration-300 hover:border-primary hover:bg-surface-alt">
            <span class="agw-bar block w-5 h-0.5 bg-text-muted rounded-sm origin-center transition-all duration-300 ease-in-out"></span>
            <span class="agw-bar block w-5 h-0.5 bg-text-muted rounded-sm origin-center transition-all duration-300 ease-in-out"></span>
            <span class="agw-bar block w-5 h-0.5 bg-text-muted rounded-sm origin-center transition-all duration-300 ease-in-out"></span>
        </button>
    </div>

</header>

<div id="agw-overlay" aria-hidden="true"
    class="fixed inset-0 z-40 bg-text/30 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300 [&.open]:opacity-100 [&.open]:pointer-events-auto"></div>

<aside id="agw-sidebar" aria-label="Menu navigasi"
    class="fixed top-0 right-0 w-72 h-screen bg-base z-50 flex flex-col translate-x-full transition-transform duration-300 ease-in-out shadow-2xl shadow-text/10 [&.open]:translate-x-0">

    <div class="h-16 flex items-center justify-between px-5 border-b border-border shrink-0">
        <span class="text-sm font-bold text-text">
            Ayam Goreng <em class="italic text-primary">Widy</em>
        </span>
        <button id="agw-close" aria-label="Tutup menu"
            class="w-8 h-8 border-2 border-border rounded-lg bg-transparent cursor-pointer flex items-center justify-center text-text-muted p-0 transition-all duration-300 hover:border-primary hover:text-primary hover:bg-surface-alt">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto py-4 px-3 flex flex-col gap-1">
        <p class="font-montserrat text-xs font-semibold tracking-widest uppercase text-text-light px-3 pt-2 pb-1">Menu Utama</p>

        <a href="{{ route('index') }}"
            class="agw-a flex items-center gap-3 px-3 py-2.5 rounded-xl font-montserrat text-sm font-medium text-text-muted no-underline relative transition-all duration-150 hover:bg-surface-alt hover:text-primary hover:translate-x-1 {{ request()->routeIs('index') ? 'bg-surface-alt text-primary font-semibold act' : '' }}">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 opacity-70">
                <rect x="3" y="3" width="7" height="7" rx="1.5" />
                <rect x="14" y="3" width="7" height="7" rx="1.5" />
                <rect x="3" y="14" width="7" height="7" rx="1.5" />
                <rect x="14" y="14" width="7" height="7" rx="1.5" />
            </svg>
            Dashboard
        </a>

        <a href="{{ route('produk') }}"
            class="agw-a flex items-center gap-3 px-3 py-2.5 rounded-xl font-montserrat text-sm font-medium text-text-muted no-underline relative transition-all duration-150 hover:bg-surface-alt hover:text-primary hover:translate-x-1 {{ request()->routeIs('produk') ? 'bg-surface-alt text-primary font-semibold act' : '' }}">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 opacity-70">
                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" />
                <line x1="7" y1="7" x2="7.01" y2="7" />
            </svg>
            Produk
        </a>

        <a href="{{ route('kategori') }}"
            class="agw-a flex items-center gap-3 px-3 py-2.5 rounded-xl font-montserrat text-sm font-medium text-text-muted no-underline relative transition-all duration-150 hover:bg-surface-alt hover:text-primary hover:translate-x-1 {{ request()->routeIs('kategori') ? 'bg-surface-alt text-primary font-semibold act' : '' }}">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 opacity-70">
                <line x1="8" y1="6" x2="21" y2="6" />
                <line x1="8" y1="12" x2="21" y2="12" />
                <line x1="8" y1="18" x2="21" y2="18" />
                <circle cx="3" cy="6" r=".8" fill="currentColor" stroke="none" />
                <circle cx="3" cy="12" r=".8" fill="currentColor" stroke="none" />
                <circle cx="3" cy="18" r=".8" fill="currentColor" stroke="none" />
            </svg>
            Kategori
        </a>

        <a href="{{ route('users') }}"
            class="agw-a flex items-center gap-3 px-3 py-2.5 rounded-xl font-montserrat text-sm font-medium text-text-muted no-underline relative transition-all duration-150 hover:bg-surface-alt hover:text-primary hover:translate-x-1 {{ request()->routeIs('users') ? 'bg-surface-alt text-primary font-semibold act' : '' }}">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 opacity-70">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
            Users
        </a>
    </nav>

    <div class="p-3 border-t border-border">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit"
                class="agw-out w-full flex items-center gap-3 px-3 py-2.5 rounded-xl font-montserrat text-sm font-medium text-primary-dark no-underline transition-all duration-150 hover:bg-surface-alt hover:translate-x-1 bg-transparent border-0 cursor-pointer">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="opacity-80">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
                Logout
            </button>
        </form>
    </div>

</aside>
