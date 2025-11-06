<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_supplier');
            $table->string('kode_supplier')->unique();
            $table->string('telepon', 20);
            $table->string('email')->nullable();
            $table->text('alamat');
            $table->string('kota');
            $table->string('kode_pos', 10)->nullable();
            $table->string('nama_kontak')->nullable();
            $table->text('catatan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('nama_supplier');
            $table->index('kode_supplier');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};