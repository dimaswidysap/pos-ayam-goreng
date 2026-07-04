@extends('components.master.master')
@vite(['resources/js/admin/produk/index.js'])
@section('konten')
    @include('components.sidebarAdmin.sidebarAdmin')

    <section class="mt-[60px] px-7 pt-8 pb-12 font-sans">

        {{-- ── Page header ── --}}
        <div class="flex flex-wrap items-end justify-between gap-4 mb-7">
            <div>
                <h1 class="font-serif text-[1.65rem] font-extrabold text-text leading-tight">
                    Data <em class="not-italic text-primary">Produk</em>
                </h1>
                <p class="text-[0.82rem] text-text-muted mt-1">Kelola semua produk yang tersedia di warung</p>
            </div>
            <a href="{{ route('tambahProduk') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-[10px] text-[0.85rem] font-semibold no-underline shadow-[0_3px_12px_rgba(200,118,58,0.28)] transition-all duration-200 hover:bg-primary-dark hover:-translate-y-0.5 hover:shadow-[0_5px_16px_rgba(160,90,40,0.35)] whitespace-nowrap">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Tambah Produk
            </a>
        </div>

        {{-- ── Card + Tabel ── --}}
        <div class="bg-base border border-border rounded-2xl overflow-hidden shadow-[0_2px_16px_rgba(44,36,22,0.05)]">

            {{-- Toolbar --}}
            <div class="flex flex-wrap items-center justify-between gap-3 p-4 border-b border-border bg-surface">
                <span class="text-[0.8rem] text-text-muted">
                    Total <strong class="text-text font-semibold">{{ $dataProduk->count() }} produk</strong>
                </span>
                <div
                    class="flex items-center gap-2 bg-base border-[1.5px] border-border rounded-lg px-3 py-1.5 focus-within:border-primary transition-colors">
                    <svg class="text-text-muted shrink-0" width="14" height="14" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <input type="text" id="produk-search-input" placeholder="Cari produk..."
                        class="border-none outline-none text-[0.83rem] text-text bg-transparent w-[180px] placeholder:text-[#C0B0A0]">
                </div>
            </div>

            {{-- Tabel --}}
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-[0.875rem]" id="produk-table">
                    <thead>
                        <tr class="bg-surface border-b-2 border-border">
                            <th
                                class="px-[1.1rem] py-[0.85rem] text-left text-[0.68rem] font-bold tracking-widest uppercase text-text-muted whitespace-nowrap">
                                ID</th>
                            <th
                                class="px-[1.1rem] py-[0.85rem] text-left text-[0.68rem] font-bold tracking-widest uppercase text-text-muted whitespace-nowrap">
                                Nama Produk</th>
                            <th
                                class="px-[1.1rem] py-[0.85rem] text-left text-[0.68rem] font-bold tracking-widest uppercase text-text-muted whitespace-nowrap">
                                Harga</th>
                            <th
                                class="px-[1.1rem] py-[0.85rem] text-left text-[0.68rem] font-bold tracking-widest uppercase text-text-muted whitespace-nowrap">
                                Kategori</th>
                            <th
                                class="px-[1.1rem] py-[0.85rem] text-center text-[0.68rem] font-bold tracking-widest uppercase text-text-muted whitespace-nowrap">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border font-montserrat">
                        @forelse ($dataProduk as $item)
                            <tr id="row-{{ $item->id_produk }}" class="transition-colors hover:bg-[#FFFBF7]">
                                {{-- ID --}}
                                <td class="px-[1.1rem] py-[0.9rem] align-middle">
                                    <span
                                        class="text-[0.75rem] font-semibold text-text-muted bg-surface border border-border rounded-md px-2 py-1">
                                        #{{ $item->id_produk }}
                                    </span>
                                </td>

                                {{-- Nama --}}
                                <td class="px-[1.1rem] py-[0.9rem] align-middle font-semibold text-text">
                                    {{ $item->nama }}
                                </td>

                                {{-- Harga --}}
                                <td
                                    class="px-[1.1rem] py-[0.9rem] align-middle font-semibold text-primary-dark whitespace-nowrap">
                                    <span
                                        class="font-normal text-text-muted text-[0.8rem]">Rp&nbsp;</span>{{ number_format($item->harga, 0, ',', '.') }}
                                </td>

                                {{-- Kategori --}}
                                <td class="px-[1.1rem] py-[0.9rem] align-middle">
                                    <span class="bg-secondary h-2 aspect-square inline-flex rounded-full"></span>
                                    <span class="">
                                        {{ $item->kategori->nama }}
                                    </span>
                                </td>

                                {{-- Aksi --}}
                                <td class="px-[1.1rem] py-[0.9rem] align-middle">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('detailProduk', $item->id_produk) }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-[0.78rem] font-medium border-[1.5px] border-border bg-surface text-text-muted transition-all hover:text-primary hover:border-primary hover:bg-primary/5 whitespace-nowrap">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                            Detail
                                        </a>

                                        <a href="{{ route('updateProduk', $item->id_produk) }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-[0.78rem] font-medium border-[1.5px] border-[#DAEAF8] bg-[#F3F8FD] text-[#4A7AB5] transition-all hover:text-[#2C5F9A] hover:border-[#A8CDE8] hover:bg-[#E8F2FA] whitespace-nowrap">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                            </svg>
                                            Edit
                                        </a>

                                        {{-- <form method="post" action="{{ route('hapusProdukForm', $item->id_produk) }}"
                                            class="inline-flex"
                                            onsubmit="return confirm('Hapus produk \'{{ addslashes($item->nama) }}\'?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-[0.78rem] font-medium border-[1.5px] border-[#FAD8D5] bg-[#FFF0EE] text-primary-dark transition-all hover:text-[#9B2318] hover:border-[#E8A8A0] hover:bg-[#FDEAE8] hover:-translate-y-0.5 whitespace-nowrap">
                                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                                    <polyline points="3 6 5 6 21 6" />
                                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                                    <path d="M10 11v6M14 11v6" />
                                                    <path d="M9 6V4h6v2" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form> --}}
                                        <button  data-id="{{ $item->id_produk }}"
                                            class="btn-delete inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-[0.78rem] font-medium border-[1.5px] border-[#FAD8D5] bg-[#FFF0EE] text-primary-dark transition-all hover:text-[#9B2318] hover:border-[#E8A8A0] hover:bg-[#FDEAE8] hover:-translate-y-0.5 whitespace-nowrap">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                                <polyline points="3 6 5 6 21 6" />
                                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                                <path d="M10 11v6M14 11v6" />
                                                <path d="M9 6V4h6v2" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-14 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="opacity-25 mb-3" width="48" height="48" viewBox="0 0 24 24"
                                            fill="none" stroke="#C8763A" stroke-width="1.2" stroke-linecap="round">
                                            <path
                                                d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" />
                                            <line x1="7" y1="7" x2="7.01" y2="7" />
                                        </svg>
                                        <p class="text-[0.9rem] text-text-muted">Belum ada produk. <a
                                                href="{{ route('tambahProduk') }}"
                                                class="text-primary font-semibold">Tambah sekarang →</a></p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer tabel --}}
            @if ($dataProduk->count() > 0)
                <div
                    class="flex items-center justify-between p-4 border-t border-border bg-surface text-[0.78rem] text-text-muted">
                    <span>Menampilkan {{ $dataProduk->count() }} data</span>
                    <span class="text-[0.72rem] text-[#C0B0A0]">Ayam Goreng Widy</span>
                </div>
            @endif

        </div>
    </section>

    {{-- Search filter JS (Tetap sama) --}}
    <script>
        (function() {
            const input = document.getElementById('produk-search-input');
            const rows = document.querySelectorAll('#produk-table tbody tr');
            if (!input) return;
            input.addEventListener('input', function() {
                const q = this.value.toLowerCase().trim();
                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = (!q || text.includes(q)) ? '' : 'none';
                });
            });
        })();
    </script>
@endsection
<script>
    window.routes = {
        deleteProduk: "{{ route('hapus-produk', ':id') }}"
    };
</script>
