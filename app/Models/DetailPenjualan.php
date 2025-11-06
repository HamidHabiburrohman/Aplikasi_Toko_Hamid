<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $fillable = [
        'penjualan_id',
        'produk_id',
        'diskon_id',
        'jumlah',
        'harga_satuan'
    ];

    public function penjualan () {
       return $this->belongsTo(Penjualan::class);
    }

    public function produk () {
        return $this->belongsTo(Produk::class);
    }

    public function diskon () {
        return $this->belongsTo(Diskon::class);
    }

}

