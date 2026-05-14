@extends('components.master.master')

@section('konten')
    @include('components.sidebarAdmin.sidebarAdmin')
    <div class="min-h-screen bg-gray-50 py-8 px-4 mt-[5rem]">
        <div class="max-w-3xl mx-auto flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Tambah <span class="text-[#C0783F]">Kategori</span></h1>
                <p class="text-gray-500 mt-1">Lengkapi formulir di bawah untuk menambah kategori menu baru</p>
            </div>
            <a href="{{ route('kategori') }}" class="flex items-center text-gray-600 hover:text-gray-800 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Batal
            </a>
        </div>

        <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-sm border border-gray-100 p-10">
            <form method="POST" action="{{ route('tambahKategoriForm') }}">
                @csrf

                <div class="mb-8">
                    <label for="nama_kategori" class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">
                        NAMA KATEGORI
                    </label>
                    <input type="text" name="nama_kategori" id="nama_kategori" placeholder="Contoh: Minuman Dingin"
                        value="{{ old('nama_kategori') }}"
                        class="w-full px-6 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#C0783F] focus:border-transparent outline-none transition placeholder-gray-300 @error('nama_kategori') border-red-500 @enderror">
                    @error('nama_kategori')
                        <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-10">
                    <button type="submit"
                        class="w-full bg-[#C0783F] hover:bg-[#A66635] text-white font-bold py-4 rounded-xl shadow-lg shadow-orange-200 transition duration-300 transform active:scale-[0.98]">
                        Simpan Kategori Baru
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
