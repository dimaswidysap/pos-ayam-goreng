<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    //
    public function hapusKategori($id)
    {
        $item = Kategori::findOrFail($id);

        $item->delete();

        return response()->json([
            'success' => true,

            'message' => 'Data berhasil dihapus!',
        ]);
    }
}
