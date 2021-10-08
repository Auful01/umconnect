<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pendidikan extends Model
{
    use HasFactory;
    protected $table = 'pendidikan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_user',
        'instansi',
        'jenjang',
        'fakultas',
        'jurusan',
        'tahun_masuk',
        'tahun_keluar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
