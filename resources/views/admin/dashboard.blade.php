@php
    use Carbon\Carbon;
    Carbon::setLocale('id');
@endphp
@extends('components.master.master')
@vite('resources/js/dashboard.js')
@section('konten')
    @include('components.sidebarAdmin.sidebarAdmin')

        <section class="w-full pt-[7rem]">
            <a href="{{ route('riwayat-pesanan') }}">Riwaya Transaksi</a>
        </section>
@endsection
