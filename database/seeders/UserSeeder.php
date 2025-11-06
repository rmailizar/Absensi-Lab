<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // <-- Pastikan Anda memanggil model User

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama (opsional, tapi bagus agar tidak duplikat)
        User::truncate();

        // Buat data Admin
        User::create([
            'name' => 'Admin Lab',
            'email' => 'admin@lab.com',
            'password' => Hash::make('admin123'), // Ganti 'admin123' dengan password aman
            'role' => 'admin',
        ]);

        // Buat data Mahasiswa
        User::create([
            'name' => 'Mahasiswa Contoh',
            'email' => 'mahasiswa@lab.com',
            'password' => Hash::make('mahasiswa123'), // Ganti 'mahasiswa123' dengan password aman
            'role' => 'admin',
        ]);

        // Anda bisa tambahkan user lain sebanyak yang Anda mau
        User::create([
            'name' => 'Budi Setiawan',
            'email' => 'budi@lab.com',
            'password' => Hash::make('passwordbudi'),
            'role' => 'admin',
        ]);

        // Tips: Jika Anda ingin membuat banyak data palsu,
        // pertimbangkan menggunakan User Factory.
    }
}