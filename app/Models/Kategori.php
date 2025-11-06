<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = [
        'nama_kategori',
        'slug', 
        'deskripsi', 
        'is_active'
    ];

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
