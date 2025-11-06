<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukMasuk extends Model
{
    protected $fillable = [
        'kode_pembelian',
        'tanggal_masuk',
        'jumlah',
        'harga_beli',
        'total_harga',
        'produk_id',
        'supplier_id',
        'catatan'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}