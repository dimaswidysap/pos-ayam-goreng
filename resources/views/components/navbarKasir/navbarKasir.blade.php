@vite(['resources/views/components/navbarKasir/navbar.js']);

<header
    class=" w-full h-20 bg-base fixed top-0 left-0 z-100 px-6 flex justify-between items-center shadow-lg border-b border-[#C8763A]/20">



    <div class="flex items-center gap-3">
        <div
            class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white font-bold border-2 border-accent">
            {{ strtoupper(substr(Auth::user()->name ?? 'K', 0, 1)) }}
        </div>
        <div class="flex flex-col">
            <span
                class="text-[#D4C8B0] text-sm font-semibold leading-none">{{ Auth::user()->name ?? 'Kasir Widy' }}</span>
            <span class="text-primary-light text-[10px] uppercase tracking-wider mt-1">Petugas Kasir</span>
        </div>
    </div>



    <button id="agw-ham-kasir"
        class="w-10 h-10 flex flex-col items-center justify-center gap-[5px] bg-[#FAFAF8] border-[1.5px] border-[#EDE8DF] rounded-[10px] cursor-pointer p-0 transition-[border-color,background] duration-200 hover:border-[#C8763A] hover:bg-[#FFF8F2]">
        <span
            class="agw-bar block w-4.5 h-0.5 bg-primary rounded-md origin-center transition-transform duration-[350ms] ease-[cubic-bezier(.77,0,.18,1)]"></span>
        <span
            class="agw-bar block w-4.5 h-0.5 bg-primary rounded-md origin-center transition-[transform,opacity,width] duration-[350ms] ease-[cubic-bezier(.77,0,.18,1)]"></span>
        <span
            class="agw-bar block w-4.5 h-0.5 bg-primary rounded-md origin-center transition-transform duration-[350ms] ease-[cubic-bezier(.77,0,.18,1)]"></span>
    </button>




    <section id='sidebar' class="fixed h-screen right-0 top-0 w-full translate-x-full ">
        <section class="shadow-xl w-1/4 h-full bg- absolute z-10 right-0 bg-base flex flex-col border-l border-primary">
            <header class="w-full flex justify-end items-center h-20 pr-4">
                <button id="agw-close-kasir"
                    class="h-[50%] aspect-square border-[1.5px] border-[#EDE8DF] rounded-lg bg-base cursor-pointer flex items-center justify-center text-primary p-0 transition-[border-color,color,background] duration-200 hover:border-[#C8763A] hover:text-[#C8763A] hover:bg-[#FFF8F2]">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </header>

            <div class="w-full flex-1 flex flex-col justify-between relative px-4 py-4">

                <ul class="flex flex-col gap-4">
                    <li>
                        <a href="{{ route('kasir') }}"
                            class="agw-a cursor-pointer flex items-center gap-[.75rem] px-[.85rem] py-[.62rem] rounded-[10px] text-[.88rem] font-medium text-[#7A6A55] no-underline relative transition-[background,color,transform] duration-150 hover:bg-[#FFF4EB] hover:text-[#C8763A] hover:translate-x-[3px] {{ request()->routeIs('kasir') ? 'bg-[#FFF0E4] text-[#C8763A] font-semibold act' : '' }}">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                class="shrink-0 opacity-70">
                                <rect x="7" y="3" width="10" height="5" rx="1" />
                                <rect x="4" y="8" width="16" height="10" rx="2" />
                                <line x1="8" y1="12" x2="8" y2="12" />
                                <line x1="11" y1="12" x2="11" y2="12" />
                                <line x1="14" y1="12" x2="14" y2="12" />
                                <line x1="8" y1="15" x2="8" y2="15" />
                                <line x1="11" y1="15" x2="11" y2="15" />
                                <line x1="6" y1="18" x2="18" y2="18" />
                            </svg>
                            Kasir
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ordersKasir') }}"
                            class="agw-a cursor-pointer flex items-center gap-[.75rem] px-[.85rem] py-[.62rem] rounded-[10px] text-[.88rem] font-medium text-[#7A6A55] no-underline relative transition-[background,color,transform] duration-150 hover:bg-[#FFF4EB] hover:text-[#C8763A] hover:translate-x-[3px] {{ request()->routeIs('ordersKasir') ? 'bg-[#FFF0E4] text-[#C8763A] font-semibold act' : '' }}">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                class="shrink-0 opacity-70">
                                <path d="M9 3h6" />
                                <path d="M10 2h4a1 1 0 0 1 1 1v1H9V3a1 1 0 0 1 1-1z" />
                                <rect x="5" y="4" width="14" height="18" rx="2" />
                                <line x1="8" y1="9" x2="16" y2="9" />
                                <line x1="8" y1="13" x2="16" y2="13" />
                                <line x1="8" y1="17" x2="16" y2="17" />
                            </svg>
                            Riwyat pesanan
                        </a>
                    </li>
                </ul>

                <form method="POST" action="{{ route('kasir.logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center cursor-pointer justify-center gap-2 w-full py-2 bg-red-900/80 text-red-200 border border-red-800/50 rounded-lg hover:bg-red-800 hover:text-white transition-all text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Keluar
                    </button>
                </form>

            </div>
        </section>
        <div class="relative h-full w-full  backdrop-blur-[3px] "></div>
    </section>
</header>
