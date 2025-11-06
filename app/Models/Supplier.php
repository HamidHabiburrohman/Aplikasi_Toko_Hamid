<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'nama_supplier',
        'kode_supplier', 
        'telepon',
        'email',
        'alamat',
        'kota',
        'kode_pos',
        'nama_kontak',
        'catatan',
        'is_active'
    ];

    public function produk ()
    {
        return $this->hasMany(Produk::class);
    }
}
