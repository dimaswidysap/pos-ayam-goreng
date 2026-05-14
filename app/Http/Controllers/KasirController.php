<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    /**
     * Halaman utama kasir
     */
    public function kasir()
    {
        $dataProduk = Produk::all();
        $cart = session('cart', []);

        return view('kasir.kasir', compact('dataProduk', 'cart'));
    }

    /**
     * Tambah item ke session cart
     */
    public function cartAdd(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        $productId = $request->id;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name' => $request->name,
                'quantity' => 1,
                'price' => $request->price,
                'category' => $request->category,
                'foto' => $request->foto,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Item berhasil ditambahkan ke keranjang!',
            'cart_count' => count($cart),
            'cart' => $cart,
        ]);
    }

    /**
     * Ambil isi cart dari session (untuk render ulang saat halaman dibuka)
     */
    public function getCart()
    {
        $cart = session()->get('cart', []);

        return response()->json([
            'success' => true,
            'cart' => $cart,
        ]);
    }

    /**
     * Alias getCart — dipakai tombol "Uang Pas"
     */
    public function getMoney()
    {
        $cart = session()->get('cart', []);

        return response()->json([
            'success' => true,
            'cart' => $cart,
        ]);
    }

    /**
     * Kosongkan session cart
     */
    public function resetCart()
    {
        session()->forget('cart');

        return redirect()->route('kasir')->with('success', 'Keranjang berhasil dikosongkan.');
    }

    /**
     * Kurangi quantity item; jika menjadi 0, hapus dari cart
     */
    public function decreaseCart(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $cart = session()->get('cart', []);
        $productId = $request->id;

        if (isset($cart[$productId])) {
            if ($cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
            } else {
                unset($cart[$productId]);
            }

            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'cart' => $cart,
        ]);
    }

    /**
     * Proses transaksi: simpan ke DB, kembalikan data untuk struk
     */
    public function cetakTransaksi(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'uang_pelanggan' => 'required|numeric|min:1',
        ], [
            'uang_pelanggan.required' => 'Uang pelanggan tidak boleh kosong.',
            'uang_pelanggan.numeric' => 'Uang pelanggan harus berupa angka.',
            'uang_pelanggan.min' => 'Uang pelanggan minimal Rp 1.',
        ]);

        // 2. Ambil cart dari session
        $cart = session()->get('cart');

        if (! $cart || count($cart) === 0) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang masih kosong, tidak ada yang bisa di-checkout.',
            ], 400);
        }

        // 3. Hitung total harga
        $total_harga = 0;
        foreach ($cart as $item) {
            $total_harga += $item['price'] * $item['quantity'];
        }

        $uang_pelanggan = (float) $request->uang_pelanggan;
        $kembalian = $uang_pelanggan - $total_harga;

        if ($kembalian < 0) {
            return response()->json([
                'success' => false,
                'message' => 'Uang pelanggan kurang! Total belanja: Rp '.number_format($total_harga, 0, ',', '.'),
            ], 400);
        }

        // 4. Simpan ke database dalam satu transaksi
        DB::beginTransaction();

        try {
            // 5. Simpan header transaksi
            $id_transaksi = DB::table('transaksi')->insertGetId([
                'uang_pelanggan' => $uang_pelanggan,
                'total_harga' => $total_harga,
                'kembalian' => $kembalian,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 6. Siapkan detail transaksi (batch insert)
            $detail_data = [];
            foreach ($cart as $id_produk => $item) {
                $detail_data[] = [
                    'id_transaksi' => $id_transaksi,
                    'id_produk' => $id_produk,
                    'quantity' => $item['quantity'],
                    'harga_satuan' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('detail_transaksi')->insert($detail_data);
            DB::commit();

            // 7. Kosongkan cart session
            session()->forget('cart');

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan!',
                'id_transaksi' => $id_transaksi,
                'total_harga' => $total_harga,
                'kembalian' => $kembalian,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Tampilkan halaman struk berdasarkan ID transaksi
     * (opsional — untuk akses ulang struk setelah transaksi)
     */
    public function lihatStruk($id_transaksi)
    {
        $transaksi = DB::table('transaksi')
            ->where('id_transaksi', $id_transaksi)
            ->first();

        if (! $transaksi) {
            abort(404, 'Transaksi tidak ditemukan.');
        }

        $detail = DB::table('detail_transaksi as dt')
            ->join('produk as p', 'dt.id_produk', '=', 'p.id_produk')
            ->select('p.nama_produk', 'dt.quantity', 'dt.harga_satuan', 'dt.subtotal')
            ->where('dt.id_transaksi', $id_transaksi)
            ->get();

        return view('kasir.struk', compact('transaksi', 'detail'));
    }
}
