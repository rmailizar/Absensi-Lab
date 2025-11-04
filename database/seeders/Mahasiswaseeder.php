<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        Mahasiswa::create([
            'nim' => '202310001',
            'nama' => 'Budi Santoso',
            'jurusan' => 'Teknik Informatika',
            'qr_code' => 'QR-202310001',
        ]);

        Mahasiswa::create([
            'nim' => '202310002',
            'nama' => 'Siti Rahmawati',
            'jurusan' => 'Sistem Informasi',
            'qr_code' => 'QR-202310002',
        ]);
    }
}
