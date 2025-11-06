<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeranjangBelanja extends Model
{
    protected $fillable = [
        'member_id',
        'tanggal_dibuat',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function detailKeranjangs()
    {
        return $this->hasMany(DetailKeranjang::class);
    }

    // TAMBAHKAN METHODS INI
    public function getTotalAttribute()
    {
        return $this->detailKeranjangs->sum(function($detail) {
            return $detail->jumlah * $detail->produk->harga;
        });
    }

    public function getJumlahItemAttribute()
    {
        return $this->detailKeranjangs->sum('jumlah');
    }

    public function tambahProduk($produkId, $jumlah = 1)
    {
        $detail = $this->detailKeranjangs()->where('produk_id', $produkId)->first();

        if ($detail) {
            $detail->update(['jumlah' => $detail->jumlah + $jumlah]);
        } else {
            $this->detailKeranjangs()->create([
                'produk_id' => $produkId,
                'jumlah' => $jumlah
            ]);
        }
    }

    public function hapusProduk($produkId)
    {
        $this->detailKeranjangs()->where('produk_id', $produkId)->delete();
    }

    public function updateJumlah($produkId, $jumlah)
    {
        if ($jumlah <= 0) {
            return $this->hapusProduk($produkId);
        }

        $this->detailKeranjangs()->where('produk_id', $produkId)->update(['jumlah' => $jumlah]);
    }

    public function kosongkan()
    {
        $this->detailKeranjangs()->delete();
    }
}