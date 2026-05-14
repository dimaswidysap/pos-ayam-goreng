@extends('components.master.master')

@section('konten')
    @include('components.sidebarAdmin.sidebarAdmin')

    <section class="mt-[60px] px-7 pt-8 pb-12 font-sans bg-surface min-h-screen">

        {{-- ── Header & Kembali ── --}}
        <div class="max-w-3xl mx-auto mb-6 flex items-center justify-between">
            <div>
                <h1 class="font-serif text-2xl font-extrabold text-text">Tambah <em
                        class="not-italic text-primary">Produk</em></h1>
                <p class="text-xs text-text-muted mt-1">Lengkapi formulir di bawah untuk menambah stok menu</p>
            </div>
            <a href="{{ route('produk') }}"
                class="flex items-center gap-2 text-sm font-semibold text-text-muted hover:text-primary transition-colors">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Batal
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
                        Terjadi Kesalahan Validasi:
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
                <form action="{{ route('simpanProduk') }}" method="post" enctype="multipart/form-data" class="p-8 md:p-10">
                    @csrf

                    <div class="grid grid-cols-1 gap-8">

                        {{-- Nama Produk --}}
                        <div class="space-y-2">
                            <label class="text-[0.7rem] uppercase tracking-widest font-bold text-text-muted ml-1">Nama
                                Produk</label>
                            <input type="text" name="nama_produk" value="{{ old('nama_produk') }}"
                                placeholder="Contoh: Ayam Bakar Madu"
                                class="w-full px-5 py-3.5 bg-surface border border-border rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all text-text font-medium placeholder:text-text-light/50">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Kategori --}}
                            <div class="space-y-2">
                                <label
                                    class="text-[0.7rem] uppercase tracking-widest font-bold text-text-muted ml-1">Kategori</label>
                                <div class="relative">
                                    <select name="kategori_produk"
                                        class="w-full px-5 py-3.5 bg-surface border border-border rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all text-text font-medium appearance-none cursor-pointer">
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        @foreach ($dataKategori as $item)
                                            <option value="{{ $item->id_kategori }}"
                                                {{ old('kategori_produk') == $item->id_kategori ? 'selected' : '' }}>
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-text-muted">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Harga --}}
                            <div class="space-y-2">
                                <label class="text-[0.7rem] uppercase tracking-widest font-bold text-text-muted ml-1">Harga
                                    Satuan (Rp)</label>
                                <div class="relative">
                                    <span
                                        class="absolute left-5 top-1/2 -translate-y-1/2 text-text-muted font-medium text-sm">Rp</span>
                                    <input type="number" name="harga_produk" value="{{ old('harga_produk') }}"
                                        min="0" placeholder="0"
                                        class="w-full pl-12 pr-5 py-3.5 bg-surface border border-border rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all text-text font-bold">
                                </div>
                            </div>
                        </div>

                        {{-- Upload Foto --}}
                        <div class="space-y-2">
                            <label class="text-[0.7rem] uppercase tracking-widest font-bold text-text-muted ml-1">Foto
                                Produk</label>
                            <div class="relative group">
                                <label for="foto_produk"
                                    class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-border rounded-3xl bg-surface hover:bg-surface-alt hover:border-primary/50 transition-all cursor-pointer overflow-hidden">
                                    <div id="preview-container" class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-3 text-text-light group-hover:text-primary transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                            </path>
                                        </svg>
                                        <p class="mb-1 text-sm text-text-muted font-medium">Klik untuk unggah foto</p>
                                        <p class="text-xs text-text-light">PNG, JPG atau WEBP (Max. 2MB)</p>
                                    </div>
                                    <img id="image-preview" class="hidden absolute inset-0 w-full h-full object-cover">
                                </label>
                                <input id="foto_produk" name="foto_produk" type="file" class="hidden"
                                    accept="image/*" onchange="previewImage(this)">
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="pt-4 flex items-center gap-4">
                            <button type="submit"
                                class="flex-1 bg-primary text-white py-4 rounded-2xl font-bold shadow-[0_6px_20px_rgba(200,118,58,0.3)] hover:bg-primary-dark hover:-translate-y-1 transition-all duration-300">
                                Simpan Produk Baru
                            </button>
                        </div>

                    </div>
                </form>
            </div>

            <p class="mt-8 text-center text-xs text-text-light">Pastikan data yang dimasukkan sudah benar sebelum menekan
                tombol simpan.</p>
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
