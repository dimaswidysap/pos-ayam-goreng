<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi'; // sesuaikan dengan nama tabelmu

    protected $primaryKey = 'id_detail_transaksi';

    // Relasi balik ke Transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }

    // Opsional tapi sangat penting: Relasi ke tabel Produk (untuk menampilkan nama item di struk)
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
