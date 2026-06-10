<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'nama_produk',
        'kode_produk',
        'stok',
        'harga',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
