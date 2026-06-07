<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\User;

class Users extends Controller
{
    //
    public function users()
    {
        $dataUser = User::all();

        // dd($dataUser);

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
                'email_user' => 'required',
                'role_user' => 'required',
                'pass_user' => 'required|min:6',
            ],
            [
                'nama_user.required' => 'Nama tidak boleh kosong',
                'email_user.required' => 'Email tidak boleh kosong',
                'role_user.required' => 'Role tidak boleh kosong',
                'pass_user.required' => 'Password tidak boleh kosong',
                'pass_user.min' => 'Password minimal 6 karakter',
            ],
        );

        User::create([
            'name' => $request->nama_user,
            'role' => $request->role_user,
            'email' => $request->email_user,
            'password' => $request->pass_user,
        ]);


        return redirect()->route('users');
    }

}
