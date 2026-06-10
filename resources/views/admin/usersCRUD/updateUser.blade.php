@extends('components.master.master')

@section('konten')
    <h1>Update User<h1>
            <form method="POST" action="{{ route('saveUpdate', $userUpdate->id) }}">
                @csrf
                <div>
                    <label for="">Masukan Nama user</label>
                    <input name="nama_user_update" type="text" value="{{ $userUpdate->name }}">
                    @error('nama_user_update')
                        <span class="text-red-700">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="">Masukan Email user</label>
                    <input name="email_user_update" type="email" value="{{ $userUpdate->email }}">
                    @error('email_user_update')
                        <span class="text-red-700">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="role_user">Masukan Role User</label>

                    <select name="role_user_update" id="role_user">
                        <option value="admin" {{ $userUpdate->role === 'admin' ? 'selected' : '' }}>
                            admin
                        </option>

                        <option value="kasir" {{ $userUpdate->role === 'kasir' ? 'selected' : '' }}>
                            kasir
                        </option>
                    </select>

                    @error('role_user_update')
                        <span class="text-red-700">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="">Masukan status User</label>

                    <select name="status_user_update" id="">
                        <option value="1" {{  $userUpdate->status === 1 ? 'selected' : ''}}>Aktif</option>
                        <option value="0" {{  $userUpdate->status === 0 ? 'selected' : ''}}>Nonaktif</option>
                    </select>

                      @error('status_user_update')
                        <span class="text-red-700">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <button type="submit">Update User</button>
                </div>
            </form>
            <a href="{{ route('users') }}">Kembali</a>
        @endsection
