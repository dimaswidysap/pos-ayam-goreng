@extends('components.master.master')

@section('konten')
    @include('components.sidebarAdmin.sidebarAdmin')

    <section class="mt-[60px] px-7 pt-8 pb-12 font-sans bg-surface min-h-screen">

        {{-- ── Header & Navigasi ── --}}
        <div class="max-w-3xl mx-auto mb-6 flex items-center justify-between">
            <div>
                <h1 class="font-serif text-2xl font-extrabold text-text">Update <em class="not-italic text-primary">Data
                        Produk</em></h1>
                <p class="text-xs text-text-muted mt-1">Lakukan perubahan pada informasi produk di bawah ini</p>
            </div>
            <a href="{{ route('produk') }}"
                class="flex items-center gap-2 text-sm font-semibold text-text-muted hover:text-primary transition-colors">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Kembali
            </a>
        </div>

        <div class="max-w-3xl mx-auto">
            {{-- ── Alert Error ── --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-[#FFF0EE] border-l-4 border-danger text-danger rounded-r-xl shadow-sm">
                    <div class="flex items-center gap-2 mb-2 font-bold text-sm">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        Mohon periksa kembali:
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1 ml-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ── Form Card ── --}}
            <div class="bg-base border border-border rounded-3xl shadow-[0_8px_30px_rgba(44,36,22,0.05)] overflow-hidden">
                <form action="{{ route('updateProdukForm', $updateProduk->id_produk) }}" method="post"
                    enctype="multipart/form-data" class="p-8 md:p-10">
                    @csrf

                    <div class="grid grid-cols-1 gap-8">

                        {{-- Nama Produk --}}
                        <div class="space-y-2">
                            <label class="text-[0.7rem] uppercase tracking-widest font-bold text-text-muted ml-1">Nama
                                Produk</label>
                            <input type="text" name="nama_produk" value="{{ old('nama_produk', $updateProduk->nama) }}"
                                class="w-full px-5 py-3.5 bg-surface border border-border rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all text-text font-medium">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Kategori --}}
                            <div class="space-y-2">
                                <label
                                    class="text-[0.7rem] uppercase tracking-widest font-bold text-text-muted ml-1">Kategori</label>
                                <div class="relative">
                                    <select name="kategori_produk"
                                        class="w-full px-5 py-3.5 bg-surface border border-border rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all text-text font-medium appearance-none cursor-pointer">
                                        @foreach ($updateKategori as $item)
                                            <option value="{{ $item->id_kategori }}"
                                                {{ old('kategori_produk', $updateProduk->id_kategori) == $item->id_kategori ? 'selected' : '' }}>
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-text-muted">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Harga --}}
                            <div class="space-y-2">
                                <label class="text-[0.7rem] uppercase tracking-widest font-bold text-text-muted ml-1">Harga
                                    (Rp)</label>
                                <div class="relative">
                                    <span
                                        class="absolute left-5 top-1/2 -translate-y-1/2 text-text-muted font-medium text-sm">Rp</span>
                                    <input type="number" name="harga_produk"
                                        value="{{ old('harga_produk', $updateProduk->harga) }}" min="0"
                                        class="w-full pl-12 pr-5 py-3.5 bg-surface border border-border rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all text-text font-bold">
                                </div>
                            </div>
                        </div>

                        {{-- Update Foto --}}
                        <div class="space-y-3">
                            <label
                                class="text-[0.7rem] uppercase tracking-widest font-bold text-text-muted ml-1 flex justify-between">
                                <span>Foto Produk</span>
                                <span class="normal-case font-medium text-text-light">Kosongkan jika tidak ingin
                                    ganti</span>
                            </label>

                            <div class="flex flex-col md:flex-row gap-6 items-start">
                                {{-- Thumbnail Lama --}}
                                <div class="shrink-0">
                                    <p class="text-[0.65rem] font-bold text-text-light uppercase mb-2 ml-1">Foto Saat Ini:
                                    </p>
                                    <div class="w-32 h-32 rounded-2xl border border-border overflow-hidden bg-surface-alt">
                                        <img src="{{ asset('foto_produk/' . $updateProduk->foto) }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                </div>

                                {{-- Upload Baru --}}
                                <div class="flex-1 w-full group">
                                    <p class="text-[0.65rem] font-bold text-text-light uppercase mb-2 ml-1">Unggah Foto
                                        Baru:</p>
                                    <label for="foto_produk"
                                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-border rounded-2xl bg-surface hover:bg-surface-alt hover:border-primary/50 transition-all cursor-pointer overflow-hidden relative">
                                        <div id="preview-container" class="flex flex-col items-center justify-center">
                                            <svg class="w-6 h-6 mb-2 text-text-light group-hover:text-primary transition-colors"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                </path>
                                            </svg>
                                            <p class="text-xs text-text-muted font-medium">Klik untuk ganti foto</p>
                                        </div>
                                        <img id="image-preview"
                                            class="hidden absolute inset-0 w-full h-full object-cover">
                                    </label>
                                    <input id="foto_produk" name="foto_produk" type="file" class="hidden"
                                        accept="image/*" onchange="previewImage(this)">
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="pt-6 flex flex-col md:flex-row gap-4">
                            <button type="submit"
                                class="flex-1 bg-primary text-white py-4 rounded-2xl font-bold shadow-[0_6px_20px_rgba(200,118,58,0.3)] hover:bg-primary-dark hover:-translate-y-1 transition-all duration-300">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('produk') }}"
                                class="inline-flex justify-center items-center px-8 py-4 bg-surface border border-border text-text-muted rounded-2xl font-bold hover:bg-surface-alt transition-all">
                                Batalkan
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- Script Preview Gambar --}}
    <script>
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const container = document.getElementById('preview-container');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    container.classList.add('opacity-0');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
