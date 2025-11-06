<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailKeranjang extends Model
{
    protected $fillable = [
        'keranjang_id',
        'produk_id', 
        'jumlah',
    ];

    public function keranjangBelanja()
    {
        return $this->belongsTo(KeranjangBelanja::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    // TAMBAHKAN ACCESSOR INI
    public function getSubtotalAttribute()
    {
        return $this->jumlah * $this->produk->harga;
    }
}