<header
    class=" w-full h-20 bg-[#2C2416] fixed top-0 left-0 z-100 px-6 flex justify-between items-center shadow-lg border-b border-[#C8763A]/20">
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



    <a href='{{ route('home') }}'>
        {{-- @csrf --}}
        <button type="submit"
            class="flex items-center gap-2 px-4 py-2 bg-red-900/30 text-red-200 border border-red-800/50 rounded-lg hover:bg-red-800 hover:text-white transition-all text-sm font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            Keluar
        </button>
    </a>
</header>
