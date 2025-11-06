<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    // TAMBAHKAN CONSTANTS
    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'paid';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_COMPLETED = 'completed';

    protected $fillable = [
        'tanggal_penjualan',
        'member_id',
        'kasir_id',
        'total_bayar',
        'metode_pembayaran_id',
        'status_transaksi',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function kasir()
    {
        return $this->belongsTo(Kasir::class);
    }

    public function metodePembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class);
    }

    // TAMBAHKAN RELATIONSHIP & METHODS
    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class);
    }

    public function isPending()
    {
        return $this->status_transaksi === self::STATUS_PENDING;
    }

    public function isPaid()
    {
        return $this->status_transaksi === self::STATUS_PAID;
    }

    public function markAsPaid()
    {
        $this->update(['status_transaksi' => self::STATUS_PAID]);
    }

    public function getTotalItemsAttribute()
    {
        return $this->detailPenjualans->sum('jumlah');
    }
}