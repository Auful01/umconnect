<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profil extends Model
{
    use HasFactory;

    protected $table = 'profil';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_user',
        'jenis_kelamin',
        'nim',
        'tgl_lahir',
        'domisili',
        'wa',
        'photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
