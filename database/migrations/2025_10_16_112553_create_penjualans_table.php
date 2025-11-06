<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penjualan')->unique();
            $table->dateTime('tanggal_penjualan');
            $table->unsignedBigInteger('member_id')->nullable();
            $table->unsignedBigInteger('kasir_id');
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->decimal('diskon', 10, 2)->default(0);
            $table->decimal('total_bayar', 12, 2);
            $table->decimal('jumlah_dibayar', 12, 2);
            $table->decimal('kembalian', 10, 2)->default(0);
            $table->unsignedBigInteger('metode_pembayaran_id');
            $table->enum('status_transaksi', ['pending', 'completed', 'cancelled', 'refunded'])->default('pending');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members')->onDelete('set null');
            $table->foreign('kasir_id')->references('id')->on('kasirs')->onDelete('restrict');
            $table->foreign('metode_pembayaran_id')->references('id')->on('metode_pembayarans')->onDelete('restrict');

            $table->index('tanggal_penjualan');
            $table->index('status_transaksi');
            $table->index(['tanggal_penjualan', 'status_transaksi']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};