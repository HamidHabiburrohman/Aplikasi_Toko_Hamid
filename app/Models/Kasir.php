<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    protected $fillable = [
        'username',
        'nama', 
        'telepon',
        'user_id',
        'alamat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
