<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_user',
        'gambar',
        'harga',
        'nama_produk',
        'deskripsi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
