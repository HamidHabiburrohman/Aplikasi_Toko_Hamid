<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('produk_keluars', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah');
            $table->date('tanggal');
            $table->enum('tipe_keluar', ['penjualan', 'rusak', 'kadaluarsa', 'sample']); // ✅ BEDA PURPOSE
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('penjualan_id')->nullable(); // ✅ NULLABLE, karena bukan selalu dari penjualan
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('restrict');
            $table->foreign('penjualan_id')->references('id')->on('penjualans')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_keluars');
    }
};