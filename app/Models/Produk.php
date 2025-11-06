<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'foto_produk',
        'nama_produk', 
        'harga',
        'stok',
        'status',
        'deskripsi',
        'kategori_id',
        'supplier_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    
    public function produkKeluars()
    {
        return $this->hasMany(ProdukKeluar::class);
    }

    // TAMBAHKAN METHODS INI
    public function detailKeranjangs()
    {
        return $this->hasMany(DetailKeranjang::class);
    }

    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class);
    }

    public function getStokTersediaAttribute()
    {
        return $this->stok;
    }

    public function kurangiStok($jumlah)
    {
        $this->decrement('stok', $jumlah);
    }

    public function tambahStok($jumlah)
    {
        $this->increment('stok', $jumlah);
    }

    public function isStokCukup($jumlah)
    {
        return $this->stok >= $jumlah;
    }

    // Scope untuk produk aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeTersedia($query)
    {
        return $query->aktif()->where('stok', '>', 0);
    }
}