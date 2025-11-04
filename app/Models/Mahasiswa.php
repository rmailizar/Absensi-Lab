<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'nama',
        'jurusan',
        'qr_code',
    ];

    // Relasi: 1 Mahasiswa punya banyak absensi
    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }
}
