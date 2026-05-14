@extends('components.master.master')
@vite('resources/js/kasir.js')

@section('konten')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('components.navbarKasir.navbarKasir')
    <main class="mt-20 w-full flex bg-surface min-h-[calc(100vh-5rem)]">

        {{-- ===== KONTEN PRODUK (Kiri) ===== --}}
        <section class="w-[65%] flex flex-col p-6 overflow-y-auto">

            <div class="flex flex-col gap-4 mb-8">
                <div class="flex justify-between items-end">
                    <h2 class="text-2xl font-bold text-text">Daftar <span class="text-primary">Menu</span></h2>
                    <div class="relative w-72">
                        <input id="input-search" type="text" placeholder="Cari menu favorit..."
                            class="w-full bg-white border border-border rounded-xl px-4 py-2.5 pl-10 text-sm outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                        <span class="absolute left-3 top-3 text-text-light">🔍</span>
                    </div>
                </div>

                <div id="filter-kategori" class="flex flex-wrap gap-2">
                    <button data-kategori="semua"
                        class="filter-btn bg-primary text-white px-5 py-2 rounded-xl text-sm font-semibold shadow-sm shadow-primary/30 transition-all hover:scale-105 active:scale-95">
                        Semua Menu
                    </button>
                    @php
                        $kategoriList = $dataProduk->pluck('id_kategori')->unique()->filter()->values();
                    @endphp
                    @foreach ($kategoriList as $kat)
                        <button data-kategori="{{ $kat }}"
                            class="filter-btn bg-white text-text-muted px-5 py-2 rounded-xl text-sm font-semibold border border-border hover:border-primary hover:text-primary transition-all shadow-sm">
                            {{ ucfirst($kat) }}
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Grid Produk --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4" id="grid-produk">
                @foreach ($dataProduk as $item)
                    <div data-id="{{ $item->id_produk }}" data-name="{{ $item->nama }}" data-price="{{ $item->harga }}"
                        data-category="{{ $item->id_kategori }}" data-foto="{{ $item->foto }}"
                        class="add-to-cart-btn group flex flex-col bg-white border border-border rounded-2xl p-3 cursor-pointer hover:border-primary hover:shadow-xl hover:shadow-primary/5 transition-all active:scale-95">

                        <figure class="w-full aspect-square bg-surface-alt rounded-xl overflow-hidden mb-3">
                            <img alt="{{ $item->nama }}" src="{{ asset('foto_produk/' . $item->foto) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </figure>

                        <h3 class="text-sm font-bold text-text truncate mb-1">{{ $item->nama }}</h3>
                        <div class="flex justify-between items-center mt-auto">
                            <span
                                class="text-xs text-text-muted bg-surface-alt px-2 py-0.5 rounded-md">{{ $item->id_kategori }}</span>
                            <span class="text-sm font-bold text-secondary">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ===== KERANJANG (Kanan) ===== --}}
        <section
            class="w-[35%] h-[calc(100vh-5rem)] sticky top-20 bg-white border-l border-border flex flex-col shadow-2xl shadow-black/5">

            <header class="p-5 border-b border-border flex justify-between items-center bg-surface-alt/50">
                <div class="flex items-center gap-2">
                    <span class="text-xl">🧾</span>
                    <h1 class="font-bold text-text uppercase tracking-tight">Pesanan Saat Ini</h1>
                </div>
                <a href="{{ route('resetCart') }}" onclick="return confirm('Kosongkan keranjang?')"
                    class="text-[10px] font-bold text-red-500 border border-red-200 px-3 py-1.5 rounded-lg hover:bg-red-50 text-center transition-colors">
                    RESET
                </a>
            </header>

            {{-- List Cart --}}
            <div class="flex-1 overflow-y-auto p-4">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-text-light text-[10px] uppercase tracking-widest border-b border-border-dark/30">
                            <th class="pb-3 text-left font-semibold">Item</th>
                            <th class="pb-3 text-center font-semibold uppercase">Qty</th>
                            <th class="pb-3 text-right font-semibold">Total</th>
                            <th class="pb-3 text-center font-semibold italic">X</th>
                        </tr>
                    </thead>
                    <tbody id="cart-table-body" class="divide-y divide-border/50 text-text">
                        {{-- Diisi via kasir.js --}}
                    </tbody>
                </table>

                <div id="empty-cart-msg" class="flex flex-col items-center justify-center py-20 text-text-light opacity-50"
                    style="display:none">
                    <div class="text-5xl mb-4 text-surface-alt bg-border rounded-full p-6 italic">🛒</div>
                    <p class="text-sm font-medium">Belum ada menu dipilih</p>
                </div>
            </div>

            {{-- Ringkasan & Pembayaran --}}
            <footer class="p-6 bg-surface-alt border-t border-border-dark/50 flex flex-col gap-4">
                <div class="space-y-2">
                    <div class="flex justify-between text-sm text-text-muted font-medium">
                        <span>Total Item</span>
                        <span id="total-item" class="text-text">0 item</span>
                    </div>
                    <div class="flex justify-between items-center pt-2">
                        <span class="text-base font-bold text-text uppercase">Total Akhir</span>
                        <span class="text-2xl font-black text-secondary tracking-tighter">Rp <span
                                id="grand-total">0</span></span>
                    </div>
                </div>

                <div class="space-y-3 mt-2">
                    <div class="space-y-1.5">
                        <label class="text-[10px] text-text-muted font-bold uppercase tracking-widest">Tunai dari
                            Pelanggan</label>
                        <div class="flex gap-2">
                            <div class="relative flex-1">
                                <span class="absolute left-3 top-3 text-text-light text-xs font-bold">Rp</span>
                                <input id="input-bayar" type="number"
                                    class="w-full bg-white border border-border rounded-xl px-4 py-3 pl-10 text-sm font-bold text-text outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary">
                            </div>
                            <button id="btn-uang-pas"
                                class="px-4 py-3 bg-white border border-border rounded-xl text-xs font-bold text-text hover:bg-surface transition-all">
                                PAS
                            </button>
                        </div>
                    </div>

                    <div id="kembalian-info"
                        class="flex justify-between items-center px-4 py-2 bg-secondary/5 rounded-lg text-secondary font-bold text-sm min-h-[36px]">
                    </div>

                    <button id="btn-bayar" disabled
                        class="w-full py-4 bg-primary hover:bg-primary-dark text-white rounded-2xl font-bold text-lg shadow-xl shadow-primary/20 transition-all disabled:bg-border-dark disabled:shadow-none disabled:cursor-not-allowed transform active:scale-95">
                        Proses Transaksi
                    </button>
                </div>
            </footer>
        </section>
    </main>

    {{-- MODAL STRUK (Disesuaikan dengan nuansa warm) --}}
    <div id="modal-struk"
        class="hidden fixed inset-0 bg-[#2C2416]/80 z-[60] flex items-center justify-center backdrop-blur-sm">
        <div class="bg-white rounded-3xl w-[380px] max-h-[90vh] overflow-hidden shadow-2xl">
            <div class="p-6 bg-surface-alt flex justify-center border-b border-dashed border-border-dark">
                <div class="text-center">
                    <h2 class="font-black text-text italic text-xl">AYAM GORENG WIDY</h2>
                    <p class="text-[10px] text-text-muted uppercase tracking-tighter">Kenikmatan Autentik Setiap Gigitan</p>
                </div>
            </div>

            <div id="struk-content" class="px-8 py-6 font-mono text-xs leading-relaxed text-text"></div>

            <div class="p-6 pt-0 flex gap-3">
                <button id="btn-cetak-struk"
                    class="flex-1 py-3 bg-secondary text-white rounded-xl font-bold hover:bg-secondary-dark transition-all">
                    Cetak Struk
                </button>
                <button id="btn-tutup-modal"
                    class="flex-1 py-3 bg-surface-alt text-text border border-border rounded-xl font-bold hover:bg-border transition-all">
                    Tutup
                </button>
            </div>
        </div>
    </div>
@endsection
