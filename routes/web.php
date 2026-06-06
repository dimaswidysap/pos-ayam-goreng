<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\KasirLoginController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'home'])->name('home');

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::get('/kasir/login', [KasirLoginController::class, 'showLoginForm'])->name('kasir.login');
Route::post('/kasir/login', [KasirLoginController::class, 'login']);
Route::post('/kasir/logout', [KasirLoginController::class, 'logout'])->name('kasir.logout');

Route::prefix('admin')->middleware('admin')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::delete('/destroyStruk/{id}', [AdminController::class, 'destroyStruk'])->name('destroyStruk');

    Route::get('/kategori', [AdminController::class, 'kategori'])->name('kategori');
    Route::get('/tambah-kategori', [AdminController::class, 'tambahKategori'])->name('tambahKategori');
    Route::post('/simpan-kategori', [AdminController::class, 'tambahKategoriForm'])->name('tambahKategoriForm');
    Route::get('/update-kategori/{id}', [AdminController::class, 'kategoriUpdate'])->name('kategoriUpdate');
    Route::post('/updateKategoriForm/{id}', [AdminController::class, 'updateKategoriForm'])->name('updateKategoriForm');
    Route::delete('hapusKategoriForm/{id}', [AdminController::class, 'hapusKategoriForm'])->name('hapusKategoriForm');

    Route::get('/produk', [AdminController::class, 'produk'])->name('produk');
    Route::get('/tambah-produk', [AdminController::class, 'tambahProduk'])->name('tambahProduk');
    Route::post('/simpan-produk', [AdminController::class, 'simpanProduk'])->name('simpanProduk');
    Route::get('/detail-produk/{id}', [AdminController::class, 'detailProduk'])->name('detailProduk');
    Route::get('/update-produk/{id}', [AdminController::class, 'updateProduk'])->name('updateProduk');
    Route::post('update/{id}', [AdminController::class, 'updateProdukForm'])->name('updateProdukForm');
    Route::delete('hapus/{id}', [AdminController::class, 'hapusProdukForm'])->name('hapusProdukForm');

    Route::get('/users', [AdminController::class, 'users'])->name('users');
});

Route::prefix('kasir')->middleware('kasir')->group(function () {

    Route::get('/', [KasirController::class, 'kasir'])->name('kasir');
    Route::post('/addCart', [KasirController::class, 'cartAdd'])->name('cartAdd');
    Route::post('/decreaseCart', [KasirController::class, 'decreaseCart'])->name('decreaseCart');
    Route::get('/resetCart', [KasirController::class, 'resetCart'])->name('resetCart');
    Route::get('/getCart', [KasirController::class, 'getCart'])->name('getCart');
    Route::get('/getMoney', [KasirController::class, 'getMoney'])->name('getMoney');
    Route::post('/cetakTransaksi', [KasirController::class, 'cetakTransaksi'])->name('cetakTransaksi');
    Route::get('/struk/{id_transaksi}', [KasirController::class, 'lihatStruk'])->name('lihatStruk');
});
