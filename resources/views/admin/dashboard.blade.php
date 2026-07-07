@php
    use Carbon\Carbon;
    Carbon::setLocale('id');
@endphp
@extends('components.master.master')
@vite('resources/js/dashboard.js')
@section('konten')
    @include('components.sidebarAdmin.sidebarAdmin')

    <section class="w-full pt-28">
        <ul class="flex flex-col gap-4">
            <li>
                <a class="flex gap-2 font-semibold bg-primary w-max py-1 px-2 rounded-md shadow-md text-base"
                    href="{{ route('riwayat-pesanan') }}">

                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round" class="shrink-0 opacity-70">
                        <path d="M9 3h6" />
                        <path d="M10 2h4a1 1 0 0 1 1 1v1H9V3a1 1 0 0 1 1-1z" />
                        <rect x="5" y="4" width="14" height="18" rx="2" />
                        <line x1="8" y1="9" x2="16" y2="9" />
                        <line x1="8" y1="13" x2="16" y2="13" />
                        <line x1="8" y1="17" x2="16" y2="17" />
                    </svg>
                    Riwayat Pesanan</a>
            </li>
            <li>
                <a class="flex gap-2 font-semibold bg-primary w-max py-1 px-2 rounded-md shadow-md text-base"
                    href="{{ route('statistik-produk') }}">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                        <!-- Sumbu -->
                        <path d="M3 3V21H21" />

                        <!-- Grafik -->
                        <polyline points="7 15 11 11 15 13 20 7" />

                        <!-- Titik -->
                        <circle cx="7" cy="15" r="1" />
                        <circle cx="11" cy="11" r="1" />
                        <circle cx="15" cy="13" r="1" />
                        <circle cx="20" cy="7" r="1" />
                    </svg>
                    Statistik Produk</a>
            </li>
        </ul>
    </section>
@endsection
