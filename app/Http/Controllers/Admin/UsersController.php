<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function hapusUser($id)
    {
        $item = User::findOrFail($id);

        $item->delete();

        return response()->json([
            'success' => true,

            'message' => 'Data berhasil dihapus!',
        ]);
    }
}
