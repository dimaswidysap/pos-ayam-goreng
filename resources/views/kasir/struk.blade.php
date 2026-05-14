@extends('components.master.master')

@section('konten')
    <div class="mt-[5.5rem] flex justify-center px-4 py-8">
        <div class="w-full max-w-sm">

            {{-- Struk --}}
            <div id="area-struk" class="bg-white rounded-lg shadow-md p-6 font-mono text-sm text-gray-800">

                {{-- Header --}}
                <div class="text-center border-b border-dashed border-gray-400 pb-4 mb-4">
                    <h2 class="text-lg font-bold tracking-widest uppercase">🏪 Toko Kami</h2>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ \Carbon\Carbon::parse($transaksi->created_at)->translatedFormat('d F Y') }}
                        &mdash;
                        {{ \Carbon\Carbon::parse($transaksi->created_at)->format('H:i:s') }}
                    </p>
                    <p class="text-xs text-gray-500">
                        No. Transaksi: #{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}
                    </p>
                </div>

                {{-- Item-item --}}
                <div class="mb-4 space-y-2">
                    @foreach ($detail as $item)
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="font-semibold">{{ $item->nama_produk }}</div>
                                <div class="text-xs text-gray-500">
                                    {{ $item->quantity }} x Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="font-semibold whitespace-nowrap">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Total --}}
                <div class="border-t border-dashed border-gray-400 pt-3 space-y-1">
                    <div class="flex justify-between font-bold text-base">
                        <span>TOTAL</span>
                        <span>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="border-t border-dashed border-gray-400 pt-3 mt-3 space-y-1">
                    <div class="flex justify-between text-sm">
                        <span>Bayar</span>
                        <span>Rp {{ number_format($transaksi->uang_pelanggan, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between font-bold text-green-600">
                        <span>Kembalian</span>
                        <span>Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- Footer --}}
                <div
                    class="border-t border-dashed border-gray-400 mt-4 pt-4 text-center text-xs text-gray-400 leading-relaxed">
                    <p>Terima kasih atas kunjungan Anda!</p>
                    <p>Selamat berbelanja kembali 😊</p>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex gap-3 mt-4 no-print">
                <button onclick="window.print()"
                    class="flex-1 py-2 bg-slate-700 text-white rounded-lg text-sm font-semibold hover:bg-slate-800 transition-colors">
                    🖨 Cetak
                </button>
                <a href="{{ route('kasir') }}"
                    class="flex-1 py-2 text-center bg-slate-100 text-slate-700 border border-slate-200 rounded-lg text-sm font-semibold hover:bg-slate-200 transition-colors">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body>*:not(#area-struk) {
                visibility: hidden;
            }

            #area-struk,
            #area-struk * {
                visibility: visible;
            }

            #area-struk {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                box-shadow: none;
                border-radius: 0;
            }
        }
    </style>
@endsection
