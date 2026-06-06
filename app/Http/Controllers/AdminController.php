<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\models\Produk;
use App\models\Transaksi;
use App\models\User;
use Carbon\carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    //
    // halama dasboard
    public function index(Request $request)
    {

        // Jika ada parameter tanggal di URL, gunakan itu dan simpan ke session
        if ($request->has('tanggal')) {
            $tanggalFilter = $request->input('tanggal');
            session(['filter_tanggal' => $tanggalFilter]);
        } else {
            // Jika URL di-refresh/diakses TANPA parameter 'tanggal',
            // kita paksa balikkan ke HARI INI (menghapus session lama)
            $tanggalFilter = carbon::today()->format('Y-m-d');
            session()->forget('filter_tanggal');
        }

        // 1. Ambil data transaksi beserta relasinya
        $transaksis = Transaksi::with(['detailTransaksi.produk'])
            ->whereDate('created_at', $tanggalFilter) // Filter berdasarkan tanggal
            ->orderBy('created_at', 'desc')
            ->get();

        // 2. Hitung total uang masuk dari koleksi transaksis di atas
        $totalUangMasuk = $transaksis->sum('total_harga');

        // 3. Kirimkan variabel ke view
        return view('admin.dashboard', compact('transaksis', 'totalUangMasuk'));
    }

    public function destroyStruk($id)
    {

        Transaksi::destroy($id);

        return redirect()->route('index')->with('success', 'kategori berhasil dihapus');
    }

    public function kategori()
    {

        $dataKategori = Kategori::all();

        return view('admin.kategori', compact('dataKategori'));
    }

    // halaman tambah kategori
    public function tambahKategori()
    {

        return view('admin.kategoriCRUD.tambahKategori');
    }

    // simpan kategori form
    public function tambahKategoriForm(Request $request)
    {

        $request->validate([
            'nama_kategori' => 'required|regex:/^[a-zA-Z\s]+$/',
        ], [
            'nama_kategori.required' => 'Nama kategori harus diisi!',
            'nama_kategori.regex' => 'Nama kategori hanya boleh berisi huruf dan spasi.',
        ]);

        Kategori::create([
            'nama' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori')->with('success', 'kategori berhasil ditambahkan');
    }

    // halaman kategori update
    public function kategoriUpdate($id)
    {

        $updateKategori = Kategori::findOrFail($id);

        return view('admin.kategoriCRUD.updateKategori', compact('updateKategori'));

    }

    // update updateKategoriForm

    public function updateKategoriForm(Request $request, $id)
    {

        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|regex:/^[a-zA-Z\s]+$/',
        ], [
            'nama_kategori.required' => 'Nama kategori harus diisi!',
            'nama_kategori.regex' => 'Nama kategori hanya boleh berisi huruf dan spasi.',
        ]);

        $kategori->update([
            'nama' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori')->with('success', 'kategori berhasil diperbarui');

    }

    // hapus kategori form

    public function hapusKategoriForm($id)
    {

        Kategori::destroy($id);

        return redirect()->route('kategori')->with('success', 'kategori berhasil dihapus');
    }

    // halaman produk
    public function produk()
    {
        $dataProduk = Produk::with('kategori')->get();

        return view('admin.produk', compact('dataProduk'));
    }

    // halaman form tambah produk
    public function tambahProduk()
    {

        // data table kategori untuk opsi kategori
        $dataKategori = Kategori::all();

        // dd($dataKategori);

        return view('admin.produkCRUD.tambahProduk', compact('dataKategori'));
    }

    // fungsi untuk menyimpan barang
    public function simpanProduk(Request $request)
    {
        $request->validate(
            [
                'nama_produk' => 'required|string|max:50',
                'kategori_produk' => 'required', // Validasi id harus ada di tabel kategori
                'harga_produk' => 'required|numeric|min:0',
                'foto_produk' => 'required|image|mimes:jpg,png,jpeg|max:3000',
            ],
            [
                'nama_produk.required' => 'Nama produk jangan kosong!',
                'harga_produk.required' => 'Harga produk jangan kosong!',
                'kategori_produk.required' => 'Kategori produk harus dipilih!',
                'kategori_produk.exists' => 'Kategori tidak valid!',
                'foto_produk.required' => 'Wajib mengupload foto!',
                'foto_produk.mimes' => 'Foto hanya boleh jpg, png, jpeg',
                'foto_produk.max' => 'Ukuran foto maksimal 3MB',
            ]
        );

        $namaFile = Str::random(5).'.'.$request->foto_produk->extension();
        $request->foto_produk->move(public_path('foto_produk'), $namaFile);

        Produk::create([
            'id_kategori' => $request->kategori_produk,
            'nama' => $request->nama_produk,
            'harga' => $request->harga_produk,
            'foto' => $namaFile,
        ]);

        // Redirect kembali ke halaman list produk (admin.produk)
        return redirect()->route('produk')->with('success', 'Produk berhasil ditambahkan');
    }

    // halaman detail produk

    public function detailProduk($id)
    {

        $produkDetail = Produk::findOrFail($id);

        return view('admin.produkCRUD.detailProduk', compact('produkDetail'));
    }

    // halaman update
    public function updateProduk($id)
    {

        $updateProduk = Produk::findOrFail($id);
        $updateKategori = Kategori::all();

        return view('admin.produkCRUD.updateProduk', compact('updateProduk', 'updateKategori'));
    }

    // form update
    public function updateProdukForm(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:50',
            'kategori_produk' => 'required|exists:kategori,id_kategori', // Tambahkan exists agar aman
            'harga_produk' => 'required|numeric|min:0',
            'foto_produk' => 'nullable|image|mimes:jpg,png,jpeg|max:3000', // Ubah jadi nullable
        ], [
            'nama_produk.required' => 'Nama produk jangan kosong!',
            'harga_produk.required' => 'Harga produk jangan kosong!',
            'kategori_produk.required' => 'Kategori produk harus dipilih!',
            'foto_produk.image' => 'File harus berupa gambar',
            'foto_produk.mimes' => 'Foto hanya boleh jpg, png, jpeg',
            'foto_produk.max' => 'Ukuran foto maksimal 3MB',
        ]);

        $produk = Produk::findOrFail($id);
        $namaFile = $produk->foto; // Sesuaikan dengan kolom di database (tadi di migration Anda pakai 'foto')

        if ($request->hasFile('foto_produk')) {
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($produk->foto && File::exists(public_path('foto_produk/'.$produk->foto))) {
                    File::delete(public_path('foto_produk/'.$produk->foto));
                }

                // Simpan foto baru
                $fotoRequest = $request->file('foto');
                $namaFoto = time().'_'.$fotoRequest->getClientOriginalName();
                $fotoRequest->move(public_path('foto_produk'), $namaFoto);
                $produk->foto = $namaFoto;
            }

            // Upload foto baru
            $file = $request->file('foto_produk');
            $namaFile = Str::random(10).'.'.$file->extension();
            $file->move(public_path('foto_produk'), $namaFile);
        }

        $produk->update([
            'id_kategori' => $request->kategori_produk,
            'nama' => $request->nama_produk,
            'harga' => $request->harga_produk,
            'foto' => $namaFile,
        ]);

        return redirect()->route('produk')->with('success', 'Produk berhasil diupdate');
    }

    // hapus produk form

    public function hapusProdukForm($id)
    {
        // Menghapus data berdasarkan ID secara langsung
        Produk::destroy($id);

        return redirect()->route('produk')->with('success', 'Produk berhasil dihapus');
    }

    public function users()
    {

        $dataUser = User::all();

        // dd($dataUser);

        return view('admin.users', compact('dataUser'));

    }
}
