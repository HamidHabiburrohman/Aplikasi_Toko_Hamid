<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    protected $fillable = [
        'username',
        'telepon',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
