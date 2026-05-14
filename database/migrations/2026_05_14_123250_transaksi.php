<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->decimal('uang_pelanggan', 15, 2);
            $table->decimal('total_harga', 15, 2);
            $table->decimal('kembalian', 15, 2);
            $table->timestamps();
        });

        Schema::create('detail_transaksi', function (Blueprint $table) { // Pastikan variabelnya $table
            $table->id('id_detail_transaksi'); // Perbaikan typo 'detail'
            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('id_produk');
            $table->integer('quantity'); // Gunakan integer, bukan number
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();

            // Foreign Keys
            $table->foreign('id_produk')
                ->references('id_produk')
                ->on('produk')
                ->onDelete('cascade');

            $table->foreign('id_transaksi')
                ->references('id_transaksi')
                ->on('transaksi')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('transaksi');
        Schema::dropIfExists('detail_transaksi');
    }
};
