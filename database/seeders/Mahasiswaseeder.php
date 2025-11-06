<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mahasiswas')->truncate();
        Mahasiswa::create([
            'nim' => '202310003',
            'nama' => 'Budi Santoso',
            'jurusan' => 'Teknik Informatika',
            'qr_code' => 'QR-202310001',
        ]);
    }
}
