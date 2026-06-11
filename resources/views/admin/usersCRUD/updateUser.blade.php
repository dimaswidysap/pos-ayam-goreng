@extends('components.master.master')

@section('konten')
    <div class="min-h-screen bg-surface p-6 font-sans">
        <div class="bg-base rounded-2xl border border-border p-8 max-w-2xl mx-auto">

            {{-- Header --}}
            @php
                $initials = collect(explode(' ', $userUpdate->name))
                    ->take(2)
                    ->map(fn($w) => strtoupper($w[0]))
                    ->join('');
            @endphp
            <div class="flex items-center gap-3 mb-7 pb-5 border-b border-border">
                <div
                    class="w-11 h-11 rounded-full bg-orange-50 flex items-center justify-center text-primary font-semibold text-sm">
                    {{ $initials }}
                </div>
                <div class="flex-1">
                    <h1 class="text-lg font-semibold text-text m-0">Edit User</h1>
                    <p class="text-sm text-text-muted mt-0.5">Ubah data akun yang sudah ada</p>
                </div>
                @if ($userUpdate->status === 1)
                    <span
                        class="inline-flex items-center gap-1 text-xs font-medium text-secondary bg-green-50 px-3 py-1 rounded-full">●
                        Aktif</span>
                @else
                    <span
                        class="inline-flex items-center gap-1 text-xs font-medium text-primary bg-orange-50 px-3 py-1 rounded-full">○
                        Nonaktif</span>
                @endif
            </div>

            <form method="POST" action="{{ route('saveUpdate', $userUpdate->id) }}" >
                @csrf

                {{-- Nama --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-text mb-1.5">Nama lengkap <span
                            class="text-primary">*</span></label>
                    <input name="nama_user_update" type="text" value="{{ $userUpdate->name }}"
                        class="w-full h-11 px-3 border border-border rounded-lg text-sm text-text bg-surface focus:outline-none focus:border-secondary focus:bg-base transition-colors">
                    @error('nama_user_update')
                        <span class="block text-xs text-primary mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-text mb-1.5">Alamat email <span
                            class="text-primary">*</span></label>
                    <input name="email_user_update" type="email" value="{{ $userUpdate->email }}"
                        class="w-full h-11 px-3 border border-border rounded-lg text-sm text-text bg-surface focus:outline-none focus:border-secondary focus:bg-base transition-colors">
                    @error('email_user_update')
                        <span class="block text-xs text-primary mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Role & Status --}}
                <div class="grid grid-cols-2 gap-4 mb-5">
                    <div>
                        <label class="block text-sm font-medium text-text mb-1.5">Role <span
                                class="text-primary">*</span></label>
                        <select name="role_user_update"
                            class="w-full h-11 px-3 border border-border rounded-lg text-sm text-text bg-surface focus:outline-none focus:border-secondary appearance-none cursor-pointer">
                            <option value="admin" {{ $userUpdate->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="kasir" {{ $userUpdate->role === 'kasir' ? 'selected' : '' }}>Kasir</option>
                        </select>
                        @error('role_user_update')
                            <span class="block text-xs text-primary mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text mb-1.5">Status <span
                                class="text-primary">*</span></label>
                        <select name="status_user_update"
                            class="w-full h-11 px-3 border border-border rounded-lg text-sm text-text bg-surface focus:outline-none focus:border-secondary appearance-none cursor-pointer">
                            <option value="1" {{ $userUpdate->status === 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $userUpdate->status === 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status_user_update')
                            <span class="block text-xs text-primary mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Footer --}}
                <div class="flex items-center justify-between mt-7 pt-5 border-t border-border">
                    <a href="{{ route('users') }}"
                        class="h-11 px-5 flex items-center gap-2 text-sm text-text-muted border border-border rounded-lg hover:bg-surface-alt transition-colors">
                        ← Kembali
                    </a>
                    <button type="submit" onclick=" return confirm('apakah anda yakin dengen perubahan ini?');"
                        class="h-11 px-6 bg-secondary hover:bg-secondary-dark text-white text-sm font-semibold rounded-lg transition-colors flex items-center gap-2">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">

                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                <path d="M17 21v-8H7v8" />
                                <path d="M7 3v5h8" />
                            </svg></span> <span>Simpan perubahan</span>
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
