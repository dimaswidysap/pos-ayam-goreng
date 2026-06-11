@extends('components.master.master')

@section('konten')
<div class="min-h-screen flex items-center justify-center  py-12 px-4 sm:px-6 lg:px-8 font-sans">
    <div class="max-w-md w-full space-y-8 bg-base p-8 rounded-2xl border border-border">

        {{-- Icon + Header --}}
        <div class="text-center">
            <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-text">Login Admin</h2>
            <p class="mt-1 text-sm text-text-muted">Silakan masuk untuk mengelola sistem</p>
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
        <form class="space-y-4" method="POST" action="{{ route('admin.login') }}">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-text mb-1.5">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    placeholder="admin@example.com"
                    class="w-full h-11 px-3 bg-surface border border-border rounded-lg text-sm text-text placeholder-text-light focus:outline-none focus:border-primary focus:bg-base transition-colors">
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-text mb-1.5">Password</label>
                <input id="password" name="password" type="password" required
                    placeholder="••••••••"
                    class="w-full h-11 px-3 bg-surface border border-border rounded-lg text-sm text-text placeholder-text-light focus:outline-none focus:border-primary focus:bg-base transition-colors">
            </div>

            {{-- Submit --}}
            <div class="pt-1">
                <button type="submit"
                    class="w-full h-11 bg-primary hover:bg-primary-dark text-white text-sm font-semibold rounded-lg transition-colors">
                    Masuk
                </button>
            </div>
        </form>

        {{-- Kembali --}}
        <div class="border-t border-border pt-5 text-center">
            <a href="{{ route('home') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-text-muted hover:text-primary transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke beranda
            </a>
        </div>

    </div>
</div>
@endsection
