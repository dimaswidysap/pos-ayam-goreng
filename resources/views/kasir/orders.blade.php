@extends('components.master.master')

@section('konten')
    @include('components.navbarKasir.navbarKasir')
    <section class="w-full max-w-7xl pt-[6rem]">
         <section
            class="w-1/2  h-screen overflow-y-auto p-4 scrollbar-none [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">

            <header class='w-full h-[5rem] flex justify-start items-center mb-10'>
                <div class="flex gap-2 mb-6">
                    @for ($i = 0; $i < 5; $i++)
                        @php
                            $tanggal = \Carbon\Carbon::today()->subDays($i);
                            $nilaiDikirim = $tanggal->format('Y-m-d');

                            // Ambil tanggal yang saat ini aktif dari controller/request (default hari ini)
                            $tanggalAktif = request('tanggal', \Carbon\Carbon::today()->format('Y-m-d'));

                            if ($i == 0) {
                                $teksTombol = 'HARI INI';
                                // Tombol hari ini mengarah ke URL bersih tanpa query string ?tanggal=
                                $urlTarget = request()->url();
                                $isActive = $tanggalAktif == $nilaiDikirim;
                            } else {
                                $teksTombol = strtoupper(
                                    $tanggal->translatedFormat('d') . ' ' . $tanggal->translatedFormat('M'),
                                );
                                $urlTarget = request()->url() . '?tanggal=' . $nilaiDikirim;
                                $isActive = $tanggalAktif == $nilaiDikirim;
                            }
                        @endphp

                        <a href="{{ $urlTarget }}"
                            class="px-5 py-2 text-sm font-semibold border rounded-full transition-all duration-300 inline-block
         {{ $isActive
             ? 'bg-primary text-white border-primary shadow-sm'
             : 'bg-base text-text-muted border-border hover:border-primary-light hover:text-primary' }}">
                            {{ $teksTombol }}
                        </a>
                    @endfor
                </div>


            </header>
            @forelse($transaksis as $transaksi)
                <div
                    class="card-transaksi bg-surface rounded-xl shadow-sm border border-border p-5 mb-6 relative overflow-hidden transition-all hover:shadow-md">

                    {{-- Header Transaksi --}}
                    <div class="flex justify-between items-start mb-4 pb-4 border-b border-dashed border-border-dark">
                        <div>
                            <p class="text-xs text-text-light uppercase tracking-wider mb-1 font-semibold">No. Transaksi</p>
                            <span class="font-bold text-primary-dark text-lg tracking-tight">
                                #{{ $transaksi->id_transaksi }}
                            </span>
                        </div>
                        <div class="text-right">
                            <span class="block text-sm font-medium text-text-muted">
                                {{ $transaksi->created_at->format('d M Y') }}
                            </span>
                            <span class="block text-xs text-text-light mt-0.5">
                                {{ $transaksi->created_at->format('H:i') }} WIB
                            </span>
                        </div>
                    </div>

                    {{-- Detail Item --}}
                    <table class="w-full text-sm mb-5">
                        <thead>
                            <tr class="text-text-muted text-xs uppercase tracking-wider border-b border-border">
                                <th class="text-left font-semibold pb-2">Produk</th>
                                <th class="text-center font-semibold pb-2">Qty</th>
                                <th class="text-right font-semibold pb-2">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="text-text">
                            @foreach ($transaksi->detailTransaksi as $detail)
                                <tr
                                    class="border-b border-dashed border-border hover:bg-surface-alt transition-colors duration-150">
                                    <td class="py-3 font-medium">
                                        {{ $detail->produk->nama ?? 'Produk #' . $detail->id_produk }}
                                    </td>
                                    <td class="text-center text-text-muted">
                                        {{ $detail->quantity }}
                                    </td>
                                    <td class="text-right font-semibold text-text-muted">
                                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Footer Transaksi --}}
                    <div class="bg-surface-alt rounded-lg p-4 border border-border">
                        <div class="space-y-2 mb-3">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-text-muted font-medium">Total Harga</span>
                                <span class="text-text font-bold">Rp
                                    {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-text-muted">Nominal Dibayar</span>
                                <span class="text-text font-medium">Rp
                                    {{ number_format($transaksi->uang_pelanggan, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        {{-- Bagian Kembalian Highlight --}}
                        <div class="pt-3 border-t border-dashed border-border-dark flex justify-between items-center">
                            <span class="font-bold text-text uppercase tracking-wide text-sm">Kembalian</span>
                            <span class="font-bold text-lg text-secondary">
                                Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}
                            </span>
                        </div>

                        {{-- container btn hapus transaksi --}}
                        {{-- <div class="w-full mt-4">

                            <form method='POST' action="{{ route('destroyStruk', $transaksi->id_transaksi) }}"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus Kategori ini?');">
                                @csrf
                                @METHOD('DELETE')
                                <button type="submit"
                                    class="block w-full py-2.5 text-center text-sm font-semibold text-red-600 bg-white border border-red-200 rounded-lg hover:bg-red-50 hover:border-red-300 transition-all duration-300 cursor-pointer">
                                    Hapus Transaksi
                                </button>
                            </form>
                        </div> --}}
                    </div>
                </div>
            @empty
                {{-- Empty State --}}
                <div
                    class="flex flex-col items-center justify-center py-16 px-4 bg-surface rounded-xl border border-dashed border-border-dark mt-4 shadow-sm">
                    <svg class="w-16 h-16 text-text-light mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <p class="text-text-muted font-medium text-center text-lg">Belum ada transaksi</p>
                    <p class="text-text-light text-sm text-center mt-1">Transaksi yang masuk pada tanggal ini akan otomatis
                        muncul di sini.
                    </p>
                </div>
            @endforelse
        </section>
    </section>
@endsection
