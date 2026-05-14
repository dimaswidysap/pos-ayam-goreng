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
        //
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');

            $table->unsignedBigInteger('id_kategori');

            $table->string('nama', 50);

            $table->decimal('harga', 10, 2);

            $table->string('foto', 255);

            $table->timestamps();

            $table->foreign('id_kategori')
                ->references('id_kategori')
                ->on('kategori')
                ->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('produk');
    }
};
