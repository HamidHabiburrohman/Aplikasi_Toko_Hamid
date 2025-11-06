<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukKeluar extends Model
{
    protected $fillable = [
        'jumlah',
        'tanggal',
        'tipe_keluar',
        'produk_id',
        'penjualan_id',
        'keterangan'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
}