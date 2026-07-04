@extends('components.master.master')
@vite(['resources/js/kategori.js','resources/js/admin/kategori/index.js'])
@section('konten')
    @include('components.sidebarAdmin.sidebarAdmin')

    <section class="mt-16 px-7 pt-8 pb-12 font-montserrat">

        {{-- ── Page Header ── --}}
        <div class="flex flex-wrap items-end justify-between gap-4 mb-7">
            <div>
                <h1 class="font-serif text-3xl font-extrabold text-text leading-tight">
                    Manajemen <em class="not-italic text-secondary">Kategori</em>
                </h1>
                <p class="text-sm text-text-muted mt-1">Kelola kelompok menu dan kategori produk warung</p>
            </div>
            <a href="{{ route('tambahKategori') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-secondary text-white rounded-xl text-sm font-semibold shadow-lg shadow-secondary/20 transition-all duration-200 hover:bg-secondary-dark hover:-translate-y-0.5 whitespace-nowrap">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Tambah Kategori
            </a>
        </div>

        {{-- ── Table Card ── --}}
        <div class="bg-base border border-border rounded-2xl overflow-hidden shadow-xl shadow-text/5">

            <div class="produk-toolbar flex items-center justify-between p-4 bg-surface border-b border-border">
                <span class="text-sm text-text-muted">
                    Total <strong class="text-text font-semibold">{{ $dataKategori->count() }} Kategori</strong>
                </span>
                <div
                    class="flex items-center gap-2 bg-base border-2 border-border rounded-lg px-3 py-1.5 focus-within:border-primary transition-colors">
                    <svg class="text-text-muted shrink-0" width="14" height="14" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <input type="text" id="kategori-search-input" placeholder="Cari kategori..."
                        class="border-none outline-none text-sm text-text bg-transparent w-44 placeholder:text-text-light">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-sm" id="produk-table">
                    <thead>
                        <tr
                            class="bg-surface border-b-2 border-border text-text-muted uppercase text-xs font-bold tracking-widest">
                            <th class="px-6 py-4 text-left">ID</th>
                            <th class="px-6 py-4 text-left">Nama Kategori</th>
                            <th class="px-6 py-4 text-left">Dibuat Pada</th>
                            <th class="px-6 py-4 text-left">Terakhir Update</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @foreach ($dataKategori as $item)
                            <tr id="row-{{ $item->id_kategori }}" class="transition-colors hover:bg-surface-alt/50">
                                {{-- ID --}}
                                <td class="px-6 py-4">
                                    <span
                                        class="text-xs font-semibold text-text-muted bg-surface-alt border border-border rounded px-2 py-0.5">
                                        #{{ $item->id_kategori }}
                                    </span>
                                </td>

                                {{-- Nama --}}
                                <td class="px-6 py-4 font-bold text-text">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-secondary"></div>
                                        {{ $item->nama }}
                                    </div>
                                </td>

                                {{-- Created --}}
                                <td class="px-6 py-4 text-text-muted text-xs">
                                    {{ $item->created_at->format('d M Y') }}
                                    <span class="block opacity-60 text-xs">{{ $item->created_at->format('H:i') }}
                                        WIB</span>
                                </td>

                                {{-- Updated --}}
                                <td class="px-6 py-4 text-text-muted text-xs">
                                    {{ $item->updated_at->format('d M Y') }}
                                    <span class="block opacity-60 text-xs">{{ $item->updated_at->format('H:i') }}
                                        WIB</span>
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Edit --}}
                                        <a href="{{ route('kategoriUpdate', $item->id_kategori) }}"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium border border-border bg-base text-text-muted transition-all hover:text-secondary hover:border-secondary hover:bg-secondary/5 whitespace-nowrap">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                            </svg>
                                            Edit
                                        </a>

                                        {{-- Hapus --}}
                                        {{-- <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus Kategori ini?');"
                                            action="{{ route('hapusKategoriForm', $item->id_kategori) }}" method="post"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium border border-red-200 bg-red-50 text-red-600 transition-all hover:bg-red-600 hover:text-white hover:border-red-600 whitespace-nowrap group">
                                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                                    <polyline points="3 6 5 6 21 6" />
                                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                                    <path d="M10 11v6M14 11v6" />
                                                    <path d="M9 6V4h6v2" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form> --}}
                                         <button  data-id="{{ $item->id_kategori }}"
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
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Footer --}}
            <div
                class="px-6 py-4 bg-surface border-t border-border flex justify-between items-center text-xs text-text-light italic font-medium">
                <span>Kelola kategori dengan bijak untuk memudahkan navigasi menu</span>
                <span>Ayam Goreng Widy</span>
            </div>
        </div>
        <script></script>
    </section>
@endsection
<script>
    window.routes = {
        deleteKategori: "{{ route('hapus-kategori', ':id') }}"
    };
</script>
