<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'nama',
        'username',
        'telepon',
        'user_id',
        'alamat',
        'poin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class);
    }

    public function keranjangBelanja()
    {
        return $this->hasOne(KeranjangBelanja::class);
    }

    // TAMBAHKAN METHODS INI
    public function buatKeranjangJikaBelumAda()
    {
        if (!$this->keranjangBelanja) {
            return $this->keranjangBelanja()->create([
                'tanggal_dibuat' => now()
            ]);
        }
        return $this->keranjangBelanja;
    }

    public function tambahKeKeranjang($produkId, $jumlah = 1)
    {
        $keranjang = $this->buatKeranjangJikaBelumAda();
        $keranjang->tambahProduk($produkId, $jumlah);
    }

    public function hapusDariKeranjang($produkId)
    {
        if ($this->keranjangBelanja) {
            $this->keranjangBelanja->hapusProduk($produkId);
        }
    }

    public function updateKeranjang($produkId, $jumlah)
    {
        if ($this->keranjangBelanja) {
            $this->keranjangBelanja->updateJumlah($produkId, $jumlah);
        }
    }

    public function kosongkanKeranjang()
    {
        if ($this->keranjangBelanja) {
            $this->keranjangBelanja->kosongkan();
        }
    }

    public function getTotalKeranjangAttribute()
    {
        return $this->keranjangBelanja ? $this->keranjangBelanja->total : 0;
    }
    public static function createForUser($user)
    {
        return self::create([
            'user_id' => $user->id,
            'nama' => $user->name, // PASTIKAN ADA NAMA
            'username' => $user->name ?? explode('@', $user->email)[0],
            'telepon' => '000000000000',
        ]);
    }

    // Method untuk buat keranjang otomatis
    public function ensureKeranjangExists()
    {
        if (!$this->keranjangBelanja) {
            return $this->keranjangBelanja()->create([
                'tanggal_dibuat' => now()
            ]);
        }
        return $this->keranjangBelanja;
    }


}