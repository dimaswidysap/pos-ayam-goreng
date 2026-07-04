@auth
    @php
        $user = auth()->user();
    @endphp
@endauth

@vite(['resources/js/users.js','resources/js/admin/user/index.js'])
@extends('components.master.master')

@section('konten')
    @include('components.sidebarAdmin.sidebarAdmin')

    <section class="w-full mt-40 px-6 py-4  text-stone-800 font-sans">

        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">

            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-between p-6 gap-4 border-b border-stone-100 bg-stone-50/50">
                <div class="text-sm text-stone-600">
                    Total <span class="font-bold text-stone-900">{{ $dataUser->count() }} User</span>
                </div>
                <div class='flex gap-3'>
                    <div class="relative max-w-xs w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-stone-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input id='users-search' type="text" placeholder="Cari user..."
                            class="w-full pl-9 pr-4 py-2 text-sm bg-white border border-stone-200 rounded-lg focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">
                    </div>
                    <a href="{{ route('createUser') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-[10px] text-[0.85rem] font-semibold no-underline shadow-[0_3px_12px_rgba(200,118,58,0.28)] transition-all duration-200 hover:bg-primary-dark hover:-translate-y-0.5 hover:shadow-[0_5px_16px_rgba(160,90,40,0.35)] whitespace-nowrap">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Tambah User
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left text-sm">
                    <thead>
                        <tr
                            class="border-b border-stone-200 bg-stone-50 text-xs font-semibold tracking-wider text-stone-500 uppercase">
                            <th scope="col" class="px-6 py-4 max-w-16">ID</th>
                            <th scope="col" class="px-6 py-4">Name</th>
                            <th scope="col" class="px-6 py-4">Email</th>
                            <th scope="col" class="px-6 py-4">Role</th>
                            <th scope="col" class="px-6 py-4">Status</th>
                            <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-stone-100">
                        @foreach ($dataUser as $index => $user)
                            <tr id="row-{{ $user->id }}" class="users-container hover:bg-stone-50/80 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center justify-center px-2 py-1 text-xs font-medium text-stone-600 bg-stone-100 border border-stone-200 rounded">
                                        #{{ $index + 1 }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap font-bold text-stone-900">
                                    <div class="flex items-center gap-2">
                                        <span class="w-1 h-1 rounded-full bg-emerald-600"></span>
                                        <span>{{ $user->name }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-stone-600">
                                    {{ $user->email }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-stone-600">
                                    {{ $user->role }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-stone-600">
                                    @if ($user->status === 1)
                                        <span class="text-green-700/70 font-bold">Aktif</span>
                                    @else
                                        <span class="text-red-700/70 font-bold">Nonaktif</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="inline-flex items-center justify-center gap-2">
                                        <a href="{{ route('showFormUpdate', $user->id) }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-stone-700 bg-white border border-stone-200 rounded-lg hover:bg-stone-50 transition-colors shadow-sm">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>

                                        <button data-id="{{ $user->id }}"
                                            class="btn-delete inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-[0.78rem] font-medium border-[1.5px] border-[#FAD8D5] bg-[#FFF0EE] text-primary-dark transition-all hover:text-[#9B2318] hover:border-[#E8A8A0] hover:bg-[#FDEAE8] hover:-translate-y-0.5 whitespace-nowrap">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                                <polyline points="3 6 5 6 21 6" />
                                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                                <path d="M10 11v6M14 11v6" />
                                                <path d="M9 6V4h6v2" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-between p-6 bg-stone-50/50 border-t border-stone-100">
                <p class="text-xs italic text-stone-500">
                    Kelola data user dengan bijak untuk menjaga keamanan sistem
                </p>
                <p class="text-xs font-medium text-stone-600 mt-2 sm:mt-0">
                    Ayam Goreng Widy
                </p>
            </div>

        </div>


        {{-- @auth
            <p>Halo, {{ auth()->user() }}</p>
        @else
            <p>Kamu belum login</p>
        @endauth
        {{ $user }} --}}
    </section>
@endsection

<script>
     window.routes = {
        deleteUser: "{{ route('hapus-user', ':id') }}"
    };
</script>
