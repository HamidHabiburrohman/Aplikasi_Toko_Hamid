<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kategoris', function (Blueprint $table) {
            $table->string('slug')->unique()->after('nama_kategori');
            $table->text('deskripsi')->nullable()->after('slug');
            $table->boolean('is_active')->default(true)->after('deskripsi');
        });
    }

    public function down(): void
    {
        Schema::table('kategoris', function (Blueprint $table) {
            $table->dropColumn(['slug', 'deskripsi', 'is_active']);
        });
    }
};