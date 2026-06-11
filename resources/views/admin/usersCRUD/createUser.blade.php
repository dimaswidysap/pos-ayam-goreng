@extends('components.master.master')

@section('konten')
<div class="min-h-screen bg-surface p-6 font-sans">
  <div class="bg-base rounded-2xl border border-border p-8 max-w-2xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-7 pb-5 border-b border-border">
      <div class="w-11 h-11 rounded-xl bg-orange-50 flex items-center justify-center">
        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
      </div>
      <div>
        <h1 class="text-lg font-semibold text-text m-0">Tambah User</h1>
        <p class="text-sm text-text-muted mt-0.5">Isi data untuk membuat akun baru</p>
      </div>
    </div>

    <form action="{{ route('addUser') }}" method="POST">
      @csrf

      {{-- Section label --}}
      <p class="text-xs font-semibold text-text-light uppercase tracking-wide mb-3">Informasi Akun</p>

      {{-- Nama --}}
      <div class="mb-5">
        <label class="block text-sm font-medium text-text mb-1.5">Nama lengkap <span class="text-primary">*</span></label>
        <input name="nama_user" type="text" placeholder="Contoh: Dimas Widy Saputra"
          class="w-full h-11 px-3 border border-border rounded-lg text-sm text-text bg-surface focus:outline-none focus:border-primary focus:bg-base transition-colors">
        @error('nama_user')
          <span class="block text-xs text-primary mt-1">{{ $message }}</span>
        @enderror
      </div>

      {{-- Email --}}
      <div class="mb-5">
        <label class="block text-sm font-medium text-text mb-1.5">Alamat email <span class="text-primary">*</span></label>
        <input name="email_user" type="email" placeholder="nama@toko.com"
          class="w-full h-11 px-3 border border-border rounded-lg text-sm text-text bg-surface focus:outline-none focus:border-primary focus:bg-base transition-colors">
        @error('email_user')
          <span class="block text-xs text-primary mt-1">{{ $message }}</span>
        @enderror
      </div>

      {{-- Role & Password --}}
      <div class="grid grid-cols-2 gap-4 mb-1">
        <div>
          <label class="block text-sm font-medium text-text mb-1.5">Role <span class="text-primary">*</span></label>
          <select name="role_user"
            class="w-full h-11 px-3 border border-border rounded-lg text-sm text-text bg-surface focus:outline-none focus:border-primary appearance-none cursor-pointer">
            <option value="" disabled selected>Pilih role</option>
            <option value="admin">Admin</option>
            <option value="kasir">Kasir</option>
          </select>
          @error('role_user')
            <span class="block text-xs text-primary mt-1">{{ $message }}</span>
          @enderror
        </div>
        <div>
          <label class="block text-sm font-medium text-text mb-1.5">Password <span class="text-primary">*</span></label>
          <input name="pass_user" type="password" placeholder="Min. 8 karakter"
            class="w-full h-11 px-3 border border-border rounded-lg text-sm text-text bg-surface focus:outline-none focus:border-primary focus:bg-base transition-colors">
          @error('pass_user')
            <span class="block text-xs text-primary mt-1">{{ $message }}</span>
          @enderror
        </div>
      </div>
      <p class="text-xs text-text-light mb-5">Password minimal 8 karakter, kombinasi huruf dan angka.</p>

      {{-- Divider --}}
      <hr class="border-border my-5">

      {{-- Section label --}}
      <p class="text-xs font-semibold text-text-light uppercase tracking-wide mb-3">Status Akun</p>

      {{-- Status awal --}}
      <div class="mb-5">
        <label class="block text-sm font-medium text-text mb-1.5">Status awal</label>
        <div class="flex items-center gap-3">
          <select name="status_user"
            class="h-11 px-3 border border-border rounded-lg text-sm text-text bg-surface appearance-none cursor-not-allowed opacity-60 w-44">
            <option value="1">Aktif</option>
          </select>
          <span class="inline-flex items-center gap-1.5 text-xs font-medium text-secondary bg-green-50 px-3 py-1.5 rounded-full">
            <span class="w-1.5 h-1.5 rounded-full bg-secondary inline-block"></span>
            User akan langsung aktif
          </span>
        </div>
        <p class="text-xs text-text-light mt-1.5">Status awal selalu Aktif, dapat diubah melalui halaman edit user.</p>
      </div>

      {{-- Footer --}}
      <div class="flex items-center justify-between mt-7 pt-5 border-t border-border">
        <a href="{{ route('users') }}"
          class="h-11 px-5 flex items-center gap-2 text-sm text-text-muted border border-border rounded-lg hover:bg-surface-alt transition-colors">
          ← Kembali
        </a>
        <button type="submit"
          class="h-11 px-6 bg-primary hover:bg-primary-dark text-white text-sm font-semibold rounded-lg transition-colors flex items-center gap-2">
          ✓ Buat User
        </button>
      </div>
    </form>

  </div>
</div>
@endsection
