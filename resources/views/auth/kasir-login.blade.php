@extends('components.master.master')

@section('konten')
<div class="min-h-screen flex items-center justify-center bg-[var(--color-surface-alt)] py-12 px-4 sm:px-6 lg:px-8 font-sans">
    <div class="max-w-md w-full space-y-8 bg-[var(--color-base)] p-8 rounded-2xl shadow-sm border border-[var(--color-border)]">

        {{-- Header Form --}}
        <div class="text-center">
            <h2 class="text-3xl font-bold text-[var(--color-text)]">Login Kasir</h2>
            <p class="mt-2 text-sm text-[var(--color-text-muted)]">Selamat datang, silakan masuk untuk memulai shift</p>
        </div>

        {{-- Tampilkan pesan error jika ada --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                <div class="flex">
                    <div class="ml-3">
                        <ul class="list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Form Login --}}
        <form class="mt-8 space-y-6" method="POST" action="{{ route('kasir.login') }}">
            @csrf

            <div class="space-y-4 shadow-sm">
                {{-- Input Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-[var(--color-text)] mb-1">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                        class="block w-full px-4 py-2.5 bg-[var(--color-surface)] border border-[var(--color-border)] rounded-lg text-[var(--color-text)] placeholder-[var(--color-text-light)] focus:outline-none focus:ring-2 focus:ring-[var(--color-secondary-light)] focus:border-[var(--color-secondary)] transition-colors duration-200 sm:text-sm"
                        placeholder="kasir@example.com">
                </div>

                {{-- Input Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-[var(--color-text)] mb-1">Password</label>
                    <input id="password" name="password" type="password" required
                        class="block w-full px-4 py-2.5 bg-[var(--color-surface)] border border-[var(--color-border)] rounded-lg text-[var(--color-text)] placeholder-[var(--color-text-light)] focus:outline-none focus:ring-2 focus:ring-[var(--color-secondary-light)] focus:border-[var(--color-secondary)] transition-colors duration-200 sm:text-sm"
                        placeholder="••••••••">
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div>
                <button type="submit"
                    class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[var(--color-secondary)] hover:bg-[var(--color-secondary-dark)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--color-secondary)] transition-all duration-200">
                    Masuk
                </button>
            </div>
        </form>

        {{-- Link Kembali --}}
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="text-sm font-medium text-[var(--color-text-muted)] hover:text-[var(--color-secondary)] transition-colors duration-200 flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

    </div>
</div>
@endsection
