@extends('components.master.master')

@section('konten')
    @include('components.sidebarAdmin.sidebarAdmin')

    <section class="mt-[60px] px-7 pt-8 pb-12 font-sans bg-surface min-h-screen">

        {{-- ── Header & Navigasi ── --}}
        <div class="max-w-xl mx-auto mb-6 flex items-center justify-between">
            <div>
                <h1 class="font-serif text-2xl font-extrabold text-text">Edit <em
                        class="not-italic text-secondary">Kategori</em></h1>
                <p class="text-xs text-text-muted mt-1">Ubah nama kategori menu Anda</p>
            </div>
            <a href="{{ route('kategori') }}"
                class="flex items-center gap-2 text-sm font-semibold text-text-muted hover:text-secondary transition-colors group">
                <svg class="group-hover:-translate-x-1 transition-transform" width="18" height="18" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Kembali
            </a>
        </div>

        <div class="max-w-xl mx-auto">
            {{-- ── Form Card ── --}}
            <div class="bg-base border border-border rounded-3xl shadow-[0_8px_30px_rgba(44,36,22,0.05)] overflow-hidden">
                <form action="{{ route('updateKategoriForm', $updateKategori->id_kategori) }}" method="post"
                    class="p-8 md:p-10">
                    @csrf

                    <div class="space-y-6">
                        {{-- Nama Kategori --}}
                        <div class="space-y-2">
                            <label class="text-[0.7rem] uppercase tracking-widest font-bold text-text-muted ml-1">Nama
                                Kategori</label>
                            <div class="relative">
                                <input type="text" name="nama_kategori"
                                    value="{{ old('nama_kategori', $updateKategori->nama) }}"
                                    placeholder="Contoh: Minuman Segar"
                                    class="w-full px-5 py-4 bg-surface border @error('nama_kategori') border-danger @else border-border @enderror rounded-2xl focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none transition-all text-text font-medium">

                                {{-- Icon Kategori --}}
                                <div class="absolute right-5 top-1/2 -translate-y-1/2 text-text-light opacity-30">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                        <path
                                            d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z" />
                                    </svg>
                                </div>
                            </div>

                            @error('nama_kategori')
                                <p class="text-danger text-xs mt-1 ml-1 font-medium flex items-center gap-1">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="3" stroke-linecap="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="12" y1="8" x2="12" y2="12" />
                                        <line x1="12" y1="16" x2="12.01" y2="16" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Info metadata sederhana --}}
                        <div class="p-4 bg-surface rounded-2xl border border-border/50">
                            <div
                                class="flex items-center justify-between text-[0.65rem] uppercase tracking-tighter font-bold text-text-light">
                                <span>ID Kategori: #{{ $updateKategori->id_kategori }}</span>
                                <span>Dibuat: {{ $updateKategori->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="pt-4 flex flex-col gap-3">
                            <button type="submit"
                                class="w-full bg-secondary text-white py-4 rounded-2xl font-bold shadow-[0_6px_20px_rgba(92,122,78,0.25)] hover:bg-secondary-dark hover:-translate-y-1 transition-all duration-300">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('kategori') }}"
                                class="w-full text-center py-4 text-text-muted text-sm font-bold hover:text-text transition-colors">
                                Batalkan dan Keluar
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Tips --}}
            <div class="mt-8 flex items-start gap-3 px-4 py-3 bg-secondary/5 rounded-2xl border border-secondary/10">
                <svg class="text-secondary shrink-0 mt-0.5" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 16v-4" />
                    <path d="M12 8h.01" />
                </svg>
                <p class="text-[0.7rem] text-secondary-dark leading-relaxed font-medium">
                    Tips: Gunakan nama kategori yang singkat dan jelas agar mudah dibaca oleh pelanggan pada struk atau
                    daftar menu.
                </p>
            </div>
        </div>
    </section>
@endsection
