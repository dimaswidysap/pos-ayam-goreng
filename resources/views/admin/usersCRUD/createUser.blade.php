@extends('components.master.master')

@section('konten')
    <h1>Tambah User</h1>
    <form action="{{ route('addUser') }}" method="POST">
        @csrf
        <div>
            <label for="">Masukan Nama user</label>
            <input name="nama_user" type="text">
            @error('nama_user')
                <span class="text-red-700">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="">Masukan Email user</label>
            <input name="email_user" type="email">
            @error('email_user')
                <span class="text-red-700">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="">Masukan Role user</label>
            <select name="role_user" id="">
                <option value="">Admin atau Kasir</option>
                <option value="" disabled>pilih role</option>
                <option value="admin">Admin</option>
                <option value="kasir">Kasir</option>
            </select>
            @error('role_user')
                <span class="text-red-700">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="">Masukan Password user</label>
            <input name="pass_user" type="password">
            @error('pass_user')
                <span class="text-red-700">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <button type="submit">Buat User</button>
        </div>
    </form>
    <a href="{{ route('users') }}">Kembali</a>
@endsection
