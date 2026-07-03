<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TransactionService;


class dashboard extends Controller
{
   public function riwayatPesanan(Request $request, TransactionService $transactionService)
    {
        // Ambil data dari Service
        $data = $transactionService->getDailyTransactionsData($request);

        // Lempar data ke view (Anda bebas mengganti nama view sesuai controller)
        return view('admin.dashboard.orders.index', $data);
    }
}
