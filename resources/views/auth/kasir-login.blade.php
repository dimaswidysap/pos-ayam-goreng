@extends('components.master.master')

@section('konten')
<div class="min-h-screen flex items-center justify-center  py-12 px-4 sm:px-6 lg:px-8 font-sans">
    <div class="max-w-md w-full space-y-8 bg-base p-8 rounded-2xl border border-border">

        {{-- Icon + Header --}}
        <div class="text-center">
            <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-text">Login Kasir</h2>
            <p class="mt-1 text-sm text-text-muted">Selamat datang, silakan masuk untuk memulai shift</p>
        </div>

        {{-- Pesan error --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Login --}}
        <form class="space-y-4" method="POST" action="{{ route('kasir.login') }}">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-text mb-1.5">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    placeholder="kasir@example.com"
                    class="w-full h-11 px-3 bg-surface border border-border rounded-lg text-sm text-text placeholder-text-light focus:outline-none focus:border-secondary focus:bg-base transition-colors">
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-text mb-1.5">Password</label>
                <input id="password" name="password" type="password" required
                    placeholder="••••••••"
                    class="w-full h-11 px-3 bg-surface border border-border rounded-lg text-sm text-text placeholder-text-light focus:outline-none focus:border-secondary focus:bg-base transition-colors">
            </div>

            {{-- Submit --}}
            <div class="pt-1">
                <button type="submit"
                    class="w-full h-11 bg-secondary hover:bg-secondary-dark text-white text-sm font-semibold rounded-lg transition-colors">
                    Masuk
                </button>
            </div>
        </form>

        {{-- Kembali --}}
        <div class="border-t border-border pt-5 text-center">
            <a href="{{ route('home') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-text-muted hover:text-secondary transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke beranda
            </a>
        </div>

    </div>
</div>
@endsection
