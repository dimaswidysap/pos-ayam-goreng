<?php

namespace App\Services;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionService
{
    public function getDailyTransactionsData(Request $request)
    {
        if ($request->has('tanggal')) {
            $tanggalFilter = $request->input('tanggal');
            session(['filter_tanggal' => $tanggalFilter]);
        } else {
            $tanggalFilter = Carbon::today()->format('Y-m-d');
            session()->forget('filter_tanggal');
        }

        // 1. Ambil data transaksi beserta relasinya
        $transaksis = Transaksi::with(['detailTransaksi.produk'])
            ->whereDate('created_at', $tanggalFilter)
            ->orderBy('created_at', 'desc')
            ->get();

        // 2. Hitung total uang masuk
        $totalUangMasuk = $transaksis->sum('total_harga');

        // Kembalikan data dalam bentuk array agar fleksibel digunakan di view manapun
        return [
            'transaksis' => $transaksis,
            'totalUangMasuk' => $totalUangMasuk,
        ];
    }
}
