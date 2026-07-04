<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\User;
use Illuminate\Support\Facades\Auth;

class Users extends Controller
{
    //
    public function users()
    {
        $dataUser = User::all();

        return view('admin.users', compact('dataUser'));
    }

    public function createUser()
    {
        return view('admin.usersCRUD.createUser');
    }

    public function addUser(Request $request)
    {
        $request->validate(
            [
                'nama_user' => 'required',
                'email_user' => 'required|email|unique:users,email',
                'role_user' => 'required',
                'pass_user' => 'required|min:6',
                'status_user' => 'required',
            ],
            [
                'nama_user.required' => 'Nama tidak boleh kosong',
                'email_user.required' => 'Email tidak boleh kosong',
                'role_user.required' => 'Role tidak boleh kosong',
                'pass_user.required' => 'Password tidak boleh kosong',
                'pass_user.min' => 'Password minimal 6 karakter',
                'email_user.email' => 'Format email tidak valid',
                'email_user.unique' => 'Email sudah terdaftar, silakan gunakan email lain',
            ],
        );

        User::create([
            'name' => $request->nama_user,
            'role' => $request->role_user,
            'email' => $request->email_user,
            'password' => $request->pass_user,
            'status' => $request->status_user,
        ]);

        return redirect()->route('users');
    }

    public function showFormUpdate($id)
    {
        $userUpdate = User::findOrFail($id);

        return view('admin.usersCRUD.updateUser', compact('userUpdate'));
    }

    public function saveUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate(
            [
                'nama_user_update' => 'required',
                'email_user_update' => 'required',
                'role_user_update' => 'required',
                'status_user_update' => 'required',
            ],
            [
                'nama_user_update.required' => 'Nama tidak boleh kosong',
                'email_user_update.required' => 'Email tidak boleh kosong',
                'role_user_update.required' => 'Role tidak boleh kosong',
                'status_user_update.required' => 'Status tidak boleh kosong',
            ],
        );

        $user->update([
            'name' => $request->nama_user_update,
            'email' => $request->email_user_update,
            'role' => $request->role_user_update,
            'status' => (bool) $request->status_user_update, // ← sesuaikan
        ]);

        // dd($user);

        return redirect()->route('users')->with('success', 'user berhasil di edit');

        // dd($id);
    }

    public function deleteUser($id)
    {
        User::destroy($id);

        return redirect()->route('users')->with('success', 'user berhasil dihapus');
    }
}
