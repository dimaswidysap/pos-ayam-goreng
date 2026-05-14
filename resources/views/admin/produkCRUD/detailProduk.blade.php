@extends('components.master.master')

@section('konten')
    @include('components.sidebarAdmin.sidebarAdmin')

    <section class="mt-[60px] px-7 pt-8 pb-12 font-sans bg-surface min-h-screen">

        {{-- ── Breadcrumb / Header ── --}}
        <div class="flex items-center gap-2 mb-6 bg-primary w-max py-3 px-2 rounded-2xl shadow-md">
            <a href="{{ route('produk') }}"
                class="text-surface hover:text-surface/90 font-black transition-colors text-sm flex items-center gap-1">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Kembali ke Daftar
            </a>
        </div>

        <div class="max-w-5xl mx-auto">
            <div class="bg-base border border-border rounded-3xl overflow-hidden shadow-[0_4px_20px_rgba(44,36,22,0.08)]">
                <div class="grid grid-cols-1 md:grid-cols-2">

                    {{-- ── Kolom Kiri: Foto Produk ── --}}
                    <div
                        class="bg-surface-alt p-8 flex items-center justify-center border-b md:border-b-0 md:border-r border-border">
                        <figure class="relative w-full aspect-square max-w-[320px] group">
                            <div
                                class="absolute inset-0 bg-primary/5 rounded-2xl rotate-3 group-hover:rotate-6 transition-transform">
                            </div>
                            <img src="{{ asset('foto_produk/' . $produkDetail->foto) }}" alt="{{ $produkDetail->nama }}"
                                class="relative z-10 w-full h-full object-cover rounded-2xl shadow-lg border border-border">
                        </figure>
                    </div>

                    {{-- ── Kolom Kanan: Informasi Produk ── --}}
                    <div class="p-8 md:p-12">
                        <div class="mb-8">
                            <span
                                class="inline-block px-3 py-1 bg-secondary/10 text-secondary rounded-full text-xs font-bold uppercase tracking-wider mb-3">
                                {{ $produkDetail->kategori->nama ?? 'Tanpa Kategori' }}
                            </span>
                            <h1 class="font-serif text-3xl md:text-4xl font-extrabold text-text leading-tight mb-2">
                                {{ $produkDetail->nama }}
                            </h1>
                            <p class="text-2xl font-semibold text-primary">
                                <span class="text-lg font-medium opacity-70">Rp</span>
                                {{ number_format($produkDetail->harga, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="space-y-5 border-t border-border pt-8">
                            {{-- Info List --}}
                            <div class="flex items-start">
                                <span
                                    class="w-32 shrink-0 text-[0.8rem] uppercase tracking-widest font-bold text-text-muted">ID
                                    Produk</span>
                                <span class="text-text font-medium">#{{ $produkDetail->id_produk }}</span>
                            </div>

                            <div class="flex items-start">
                                <span
                                    class="w-32 shrink-0 text-[0.8rem] uppercase tracking-widest font-bold text-text-muted">Kategori</span>
                                <span class="text-text font-medium">{{ $produkDetail->kategori->nama ?? '-' }}</span>
                            </div>

                            <div class="flex items-start border-t border-border/50 pt-5">
                                <span
                                    class="w-32 shrink-0 text-[0.8rem] uppercase tracking-widest font-bold text-text-muted">Dibuat</span>
                                <div class="text-text">
                                    <p class="font-medium">{{ $produkDetail->created_at->format('d M Y') }}</p>
                                    <p class="text-xs text-text-muted">{{ $produkDetail->created_at->format('H:i') }} WIB
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <span
                                    class="w-32 shrink-0 text-[0.8rem] uppercase tracking-widest font-bold text-text-muted">Terakhir
                                    Update</span>
                                <div class="text-text">
                                    <p class="font-medium">{{ $produkDetail->updated_at->format('d M Y') }}</p>
                                    <p class="text-xs text-text-muted">{{ $produkDetail->updated_at->format('H:i') }} WIB
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-10 flex gap-3">
                            <a href="{{ route('updateProduk', $produkDetail->id_produk) }}"
                                class="flex-1 inline-flex justify-center items-center gap-2 px-6 py-3 bg-primary text-white rounded-xl font-semibold shadow-md hover:bg-primary-dark transition-all">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                                Edit Produk
                            </a>
                            <button onclick="confirmDelete()"
                                class="p-3 border-2 border-[#FAD8D5] bg-[#FFF0EE] text-primary-dark rounded-xl hover:bg-[#FDEAE8] transition-colors">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round">
                                    <polyline points="3 6 5 6 21 6" />
                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                    <path d="M10 11v6M14 11v6" />
                                    <path d="M9 6V4h6v2" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer Info --}}
            <div class="mt-6 text-center">
                <p class="text-xs text-text-light italic">Ayam Goreng Widy Management System v1.0</p>
            </div>
        </div>
    </section>

    {{-- Form Hapus Hidden --}}
    <form id="form-delete-detail" action="{{ route('hapusProdukForm', $produkDetail->id_produk) }}" method="POST"
        class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function confirmDelete() {
            if (confirm('Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.')) {
                document.getElementById('form-delete-detail').submit();
            }
        }
    </script>
@endsection
