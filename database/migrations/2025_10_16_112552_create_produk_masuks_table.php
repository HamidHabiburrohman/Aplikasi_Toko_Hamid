<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pembelian')->unique();
            $table->date('tanggal_masuk');
            $table->integer('jumlah');
            $table->decimal('harga_beli', 10, 2);
            $table->decimal('total_harga', 10, 2);
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('supplier_id');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('restrict');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('restrict');

            $table->index('tanggal_masuk');
            $table->index('kode_pembelian');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_masuks');
    }
};