<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Transaksi;
use Carbon\carbon;

class orders extends Controller
{
    //
    public function ordersKasir(Request $request)
    {
        // Jika ada parameter tanggal di URL, gunakan itu dan simpan ke session
        if ($request->has('tanggal')) {
            $tanggalFilter = $request->input('tanggal');
            session(['filter_tanggal' => $tanggalFilter]);
        } else {
            // Jika URL di-refresh/diakses TANPA parameter 'tanggal',
            // kita paksa balikkan ke HARI INI (menghapus session lama)
            $tanggalFilter = carbon::today()->format('Y-m-d');
            session()->forget('filter_tanggal');
        }

        // 1. Ambil data transaksi beserta relasinya
        $transaksis = Transaksi::with(['detailTransaksi.produk'])
            ->whereDate('created_at', $tanggalFilter) // Filter berdasarkan tanggal
            ->orderBy('created_at', 'desc')
            ->get();

        return view('kasir.orders',compact('transaksis'));
    }
}
