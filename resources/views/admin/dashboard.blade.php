@php
    use Carbon\Carbon;
    Carbon::setLocale('id');
@endphp
@extends('components.master.master')
@vite('resources/js/dashboard.js')
@section('konten')
    @include('components.sidebarAdmin.sidebarAdmin')

    <section class="w-full pt-28">
        <ul>
            <li>
                <a href="{{ route('riwayat-pesanan') }}">Riwayat Transaksi</a>
            </li>
            <li>
                <a href="{{ route('statistik-produk') }}">Statistik Produk</a>
            </li>
        </ul>
    </section>
@endsection
