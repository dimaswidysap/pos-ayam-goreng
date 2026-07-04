@extends('components.master.master')

@section('konten')
    {{-- Header + Tombol Kembali --}}
    <section class="w-full flex items-center justify-between mb-6 mt-28">
        <div class="flex items-center gap-3">
            <a href="{{ route('index') }}"
                class="inline-flex items-center justify-center w-9 h-9 rounded-full border border-border bg-base text-text-muted hover:text-primary hover:border-primary-light transition-all duration-300">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-lg font-bold text-primary-dark leading-tight">Statistik Penjualan</h1>
                <p class="text-xs text-text-muted">Ringkasan produk yang berhasil terjual</p>
            </div>
        </div>
    </section>

    {{-- Filter Tanggal --}}
    <section class="w-full flex justify-start items-center mb-8">
        <div class="flex gap-2 flex-wrap">
            @for ($i = 0; $i < 5; $i++)
                @php
                    $tanggal = \Carbon\Carbon::today()->subDays($i);
                    $nilaiDikirim = $tanggal->format('Y-m-d');
                    $tanggalAktif = request('tanggal', \Carbon\Carbon::today()->format('Y-m-d'));

                    if ($i == 0) {
                        $teksTombol = 'HARI INI';
                        $urlTarget = request()->url();
                        $isActive = $tanggalAktif == $nilaiDikirim;
                    } else {
                        $teksTombol = strtoupper(
                            $tanggal->translatedFormat('d') . ' ' . $tanggal->translatedFormat('M'),
                        );
                        $urlTarget = request()->url() . '?tanggal=' . $nilaiDikirim;
                        $isActive = $tanggalAktif == $nilaiDikirim;
                    }
                @endphp

                <a href="{{ $urlTarget }}"
                    class="px-5 py-2 text-sm font-semibold border rounded-full transition-all duration-300 inline-block
     {{ $isActive
         ? 'bg-primary text-white border-primary shadow-sm'
         : 'bg-base text-text-muted border-border hover:border-primary-light hover:text-primary' }}">
                    {{ $teksTombol }}
                </a>
            @endfor
        </div>
    </section>

    {{-- Stat Cards --}}
    <section class="w-full mb-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="relative overflow-hidden bg-base border border-border rounded-2xl p-5 flex items-center gap-4">
            <div class="w-11 h-11 shrink-0 rounded-xl bg-[#FFF0EE] flex items-center justify-center text-primary-dark">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 7h-3.09a2 2 0 1 0-3.82 0H10a2 2 0 1 0-3.82 0H3v13a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V7Z" />
                    <path d="M8 12h.01M12 12h.01M16 12h.01M8 16h.01M12 16h.01M16 16h.01" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-text-muted mb-0.5">Total Produk Terjual</p>
                <p class="text-2xl font-bold text-primary-dark">{{ $totalProdukTerjual }} <span
                        class="text-sm font-medium text-text-muted">pcs</span></p>
            </div>
        </div>

        <div class="relative overflow-hidden bg-base border border-border rounded-2xl p-5 flex items-center gap-4">
            <div class="w-11 h-11 shrink-0 rounded-xl bg-[#FFF0EE] flex items-center justify-center text-primary-dark">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-text-muted mb-0.5">Total Pendapatan</p>
                <p class="text-2xl font-bold text-primary-dark">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
            </div>
        </div>
    </section>

    {{-- Tabel Produk Terjual --}}
    <section class="w-full bg-base border border-border rounded-2xl overflow-hidden">
        <div class="px-5 py-4 border-b border-border">
            <h2 class="text-sm font-semibold text-primary-dark">Rincian Produk Terjual</h2>
        </div>

        <table class="w-full text-sm">
            <thead class="bg-[#FAFAFA] text-text-muted">
                <tr>
                    <th class="px-5 py-3 text-left font-medium w-12">#</th>
                    <th class="px-5 py-3 text-left font-medium">Produk</th>
                    <th class="px-5 py-3 text-right font-medium">Qty Terjual</th>
                    <th class="px-5 py-3 text-right font-medium">Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $index => $item)
                    <tr class="border-t border-border hover:bg-[#FFF8F7] transition-colors">
                        <td class="px-5 py-3.5 text-text-muted">{{ $index + 1 }}</td>
                        <td class="px-5 py-3.5 font-medium text-primary-dark">
                            {{ $item->produk->nama ?? 'Produk #' . $item->id_produk }}
                        </td>
                        <td class="px-5 py-3.5 text-right">
                            <span
                                class="inline-flex items-center justify-center min-w-[2.25rem] px-2 py-0.5 rounded-full bg-[#FFF0EE] text-primary-dark text-xs font-semibold">
                                {{ $item->total_terjual }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-right font-semibold text-primary-dark">
                            Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-14 text-center">
                            <div class="flex flex-col items-center gap-2 text-text-muted">
                                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="7" width="18" height="14" rx="2" />
                                    <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 12h18" />
                                </svg>
                                <p class="text-sm">Belum ada transaksi pada tanggal ini.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
