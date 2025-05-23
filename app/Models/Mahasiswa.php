<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    
    protected $fillable = [
        'npm',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'sex',
        'alamat',
        'telp',
        'email',
        'photo',
    ];
}
