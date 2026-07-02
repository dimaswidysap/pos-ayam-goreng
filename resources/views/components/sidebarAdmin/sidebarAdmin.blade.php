@vite(['resources/views/components/sidebarAdmin/header.js'])

<header id="agw-header" class="fixed top-0 left-0 right-0 h-[60px] bg-white border-b border-[#EDE8DF] flex items-center justify-between px-[1.4rem] z-[900] transition-shadow duration-300">

    <a href="{{ route('home') }}" class="font-['Playfair_Display'] text-[1.15rem] font-extrabold text-[#2C2416] no-underline tracking-[0.01em]">
        Ayam Goreng <span class="italic text-[#C8763A]">Widy</span>
    </a>

    <div class="flex gap-4 h-full items-center">
        @include('components.sidebarAdmin.profilAdmin')

        <button id="agw-ham" aria-label="Buka menu" aria-expanded="false" aria-controls="agw-sidebar"
            class="w-10 h-10 flex flex-col items-center justify-center gap-[5px] bg-[#FAFAF8] border-[1.5px] border-[#EDE8DF] rounded-[10px] cursor-pointer p-0 transition-[border-color,background] duration-200 hover:border-[#C8763A] hover:bg-[#FFF8F2]">
            <span class="agw-bar block w-[18px] h-[2px] bg-[#7A6A55] rounded-[2px] origin-center transition-transform duration-[350ms] ease-[cubic-bezier(.77,0,.18,1)]"></span>
            <span class="agw-bar block w-[18px] h-[2px] bg-[#7A6A55] rounded-[2px] origin-center transition-[transform,opacity,width] duration-[350ms] ease-[cubic-bezier(.77,0,.18,1)]"></span>
            <span class="agw-bar block w-[18px] h-[2px] bg-[#7A6A55] rounded-[2px] origin-center transition-transform duration-[350ms] ease-[cubic-bezier(.77,0,.18,1)]"></span>
        </button>
    </div>

</header>

<style>
    #agw-header.agw-up { box-shadow: 0 2px 20px rgba(44,36,22,.08); }
    #agw-ham.open .agw-bar:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    #agw-ham.open .agw-bar:nth-child(2) { opacity: 0; width: 0; }
    #agw-ham.open .agw-bar:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
    #agw-sidebar.open .agw-a, #agw-sidebar.open .agw-out { animation: agw-in .3s ease both; }
    #agw-sidebar.open .agw-a:nth-child(1) { animation-delay: .04s; }
    #agw-sidebar.open .agw-a:nth-child(2) { animation-delay: .09s; }
    #agw-sidebar.open .agw-a:nth-child(3) { animation-delay: .14s; }
    #agw-sidebar.open .agw-out { animation-delay: .17s; }
    @keyframes agw-in {
        from { opacity: 0; transform: translateX(14px); }
        to { opacity: 1; transform: translateX(0); }
    }
</style>

<div id="agw-overlay" aria-hidden="true"
    class="fixed inset-0 z-[910] bg-[rgba(30,20,10,0.28)] backdrop-blur-[3px] opacity-0 pointer-events-none transition-opacity duration-[350ms] [&.open]:opacity-100 [&.open]:pointer-events-auto"></div>

<aside id="agw-sidebar" aria-label="Menu navigasi"
    class="fixed top-0 right-0 w-[272px] h-dvh bg-white z-[920] flex flex-col translate-x-full transition-transform duration-[380ms] ease-[cubic-bezier(.77,0,.18,1)] shadow-[-4px_0_28px_rgba(44,36,22,.1)] [&.open]:translate-x-0">

    <div class="h-[60px] flex items-center justify-between px-[1.2rem] border-b border-[#EDE8DF] shrink-0">
        <span class="font-['Playfair_Display'] text-[.9rem] font-bold text-[#2C2416]">
            Ayam Goreng <em class="italic text-[#C8763A]">Widy</em>
        </span>
        <button id="agw-close" aria-label="Tutup menu"
            class="w-8 h-8 border-[1.5px] border-[#EDE8DF] rounded-lg bg-transparent cursor-pointer flex items-center justify-center text-[#7A6A55] p-0 transition-[border-color,color,background] duration-200 hover:border-[#C8763A] hover:text-[#C8763A] hover:bg-[#FFF8F2]">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto py-[.9rem] px-[.7rem] flex flex-col gap-[.2rem]">
        <p class="font-['DM_Sans'] text-[.63rem] font-semibold tracking-[.13em] uppercase text-[#B8A898] px-[.8rem] pt-[.55rem] pb-[.25rem]">Menu Utama</p>

        <a href="{{ route('index') }}"
            class="agw-a flex items-center gap-[.75rem] px-[.85rem] py-[.62rem] rounded-[10px] font-['DM_Sans'] text-[.88rem] font-medium text-[#7A6A55] no-underline relative transition-[background,color,transform] duration-150 hover:bg-[#FFF4EB] hover:text-[#C8763A] hover:translate-x-[3px] {{ request()->routeIs('index') ? 'bg-[#FFF0E4] text-[#C8763A] font-semibold act' : '' }}">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 opacity-70">
                <rect x="3" y="3" width="7" height="7" rx="1.5" />
                <rect x="14" y="3" width="7" height="7" rx="1.5" />
                <rect x="3" y="14" width="7" height="7" rx="1.5" />
                <rect x="14" y="14" width="7" height="7" rx="1.5" />
            </svg>
            Dashboard
        </a>

        <a href="{{ route('produk') }}"
            class="agw-a flex items-center gap-[.75rem] px-[.85rem] py-[.62rem] rounded-[10px] font-['DM_Sans'] text-[.88rem] font-medium text-[#7A6A55] no-underline relative transition-[background,color,transform] duration-150 hover:bg-[#FFF4EB] hover:text-[#C8763A] hover:translate-x-[3px] {{ request()->routeIs('produk') ? 'bg-[#FFF0E4] text-[#C8763A] font-semibold act' : '' }}">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 opacity-70">
                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" />
                <line x1="7" y1="7" x2="7.01" y2="7" />
            </svg>
            Produk
        </a>

        <a href="{{ route('kategori') }}"
            class="agw-a flex items-center gap-[.75rem] px-[.85rem] py-[.62rem] rounded-[10px] font-['DM_Sans'] text-[.88rem] font-medium text-[#7A6A55] no-underline relative transition-[background,color,transform] duration-150 hover:bg-[#FFF4EB] hover:text-[#C8763A] hover:translate-x-[3px] {{ request()->routeIs('kategori') ? 'bg-[#FFF0E4] text-[#C8763A] font-semibold act' : '' }}">
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
            class="agw-a flex items-center gap-[.75rem] px-[.85rem] py-[.62rem] rounded-[10px] font-['DM_Sans'] text-[.88rem] font-medium text-[#7A6A55] no-underline relative transition-[background,color,transform] duration-150 hover:bg-[#FFF4EB] hover:text-[#C8763A] hover:translate-x-[3px] {{ request()->routeIs('users') ? 'bg-[#FFF0E4] text-[#C8763A] font-semibold act' : '' }}">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 opacity-70">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
            Users
        </a>
    </nav>

    <div class="p-[.7rem] border-t border-[#EDE8DF]">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit"
                class="agw-out w-full flex items-center gap-[.75rem] px-[.85rem] py-[.62rem] rounded-[10px] font-['DM_Sans'] text-[.88rem] font-medium text-[#B05840] no-underline transition-[background,transform] duration-150 hover:bg-[#FFF0EE] hover:translate-x-[3px] bg-transparent border-0 cursor-pointer">
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
