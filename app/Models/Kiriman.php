<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Kiriman extends Model
{
    use HasFactory;

    protected $table = 'kiriman';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_user',
        'gambar',
        'konten',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
