<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    Route::get('/', [LandingPageController::class, 'home'])->name('home');
});

Route::prefix('admin')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('index');

    // kategori
    Route::get('/kategori', [AdminController::class, 'kategori'])->name('kategori');
    // masuk halaman tambah katgeori
    Route::get('/tambah-kategori', [AdminController::class, 'tambahKategori'])->name('tambahKategori');
    //   form tambah kategori
    Route::post('/simpan-kategori', [AdminController::class, 'tambahKategoriForm'])->name('tambahKategoriForm');
    // masuk halaman kategori edit
    Route::get('/update-kategori/{id}', [AdminController::class, 'kategoriUpdate'])->name('kategoriUpdate');
    // update kategori form
    Route::post('/updateKategoriForm/{id}', [AdminController::class, 'updateKategoriForm'])->name('updateKategoriForm');
    // hapus kategori for,
    Route::delete('hapusKategoriForm/{id}', [AdminController::class, 'hapusKategoriForm'])->name('hapusKategoriForm');

    // produk
    Route::get('/produk', [AdminController::class, 'produk'])->name('produk');
    // halaman form produk
    Route::get('/tambah-produk', [AdminController::class, 'tambahProduk'])->name('tambahProduk');
    // simpan produk
    Route::post('/simpan-produk', [AdminController::class, 'simpanProduk'])->name('simpanProduk');
    // detail produk
    Route::get('/detail-produk/{id}', [AdminController::class, 'detailProduk'])->name('detailProduk');
    // update produk (halaman)
    Route::get('/update-produk/{id}', [AdminController::class, 'updateProduk'])->name('updateProduk');
    // form update produk
    Route::post('update/{id}', [AdminController::class, 'updateProdukForm'])->name('updateProdukForm');
    // form hapus produk
    Route::delete('hapus/{id}', [AdminController::class, 'hapusProdukForm'])->name('hapusProdukForm');
});

Route::prefix('kasir')->group(function () {
    Route::get('/', [KasirController::class, 'kasir'])->name('kasir');
    Route::post('/addCart', [KasirController::class, 'cartAdd'])->name('cartAdd');
    Route::post('/decreaseCart', [KasirController::class, 'decreaseCart'])->name('decreaseCart');
    Route::get('/resetCart', [KasirController::class, 'resetCart'])->name('resetCart');
    Route::get('/getCart', [KasirController::class, 'getCart'])->name('getCart');
    Route::get('/getMoney', [KasirController::class, 'getMoney'])->name('getMoney');
    Route::post('/cetakTransaksi', [KasirController::class, 'cetakTransaksi'])->name('cetakTransaksi');

    // Akses ulang struk berdasarkan ID transaksi
    Route::get('/struk/{id_transaksi}', [KasirController::class, 'lihatStruk'])->name('lihatStruk');
});
