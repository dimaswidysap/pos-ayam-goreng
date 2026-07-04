<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TransactionService;
use App\models\Transaksi;
use App\models\DetailTransaksi;
use Carbon\Carbon;

class dashboard extends Controller
{
    public function riwayatPesanan(Request $request, TransactionService $transactionService)
    {
        // Ambil data dari Service
        $data = $transactionService->getDailyTransactionsData($request);

        // Lempar data ke view (Anda bebas mengganti nama view sesuai controller)
        return view('admin.dashboard.orders.index', $data);
    }
    public function hapusRiwayatPesanan(Request $request, $id)
    {
        $item = Transaksi::findOrFail($id);

        $tanggal = $request->input('tanggal', Carbon::today()->format('Y-m-d'));

        $item->delete();

        $totalUangMasuk = Transaksi::whereDate('created_at', $tanggal)->sum('total_harga');

        return response()->json([
            'success' => true,

            'message' => 'Data berhasil dihapus!',

            'totalUangMasuk' => $totalUangMasuk,
        ]);
    }
   public function statistikBarang(Request $request)
{
    $tanggal = $request->input('tanggal', \Carbon\Carbon::today()->format('Y-m-d'));

    $items = DetailTransaksi::whereDate('created_at', $tanggal)
        ->with('produk') // pastikan relasi 'produk' ada di model DetailTransaksi
        ->select('id_produk')
        ->selectRaw('SUM(quantity) as total_terjual')
        ->selectRaw('SUM(subtotal) as total_pendapatan')
        ->groupBy('id_produk')
        ->orderByDesc('total_terjual')
        ->get();

    $totalProdukTerjual = $items->sum('total_terjual');
    $totalPendapatan = $items->sum('total_pendapatan');

    return view('admin.dashboard.statistik.index', compact('items', 'totalProdukTerjual', 'totalPendapatan', 'tanggal'));
}
}
