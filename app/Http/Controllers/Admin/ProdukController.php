<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    //
    public function hapusProduk($id)
    {
        $item = Produk::findOrFail($id);

        $item->delete();

        return response()->json([
            'success' => true,

            'message' => 'Data berhasil dihapus!',
        ]);
    }
}
