<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        // Siapkan array data untuk 20 mahasiswa
        // Ini untuk memastikan nama unik dan realistis
        $daftarMahasiswa = [
            ['nim_suffix' => '001', 'nama' => 'Budi Santoso'],
            ['nim_suffix' => '002', 'nama' => 'Siti Aminah'],
            ['nim_suffix' => '003', 'nama' => 'Ahmad Fauzi'],
            ['nim_suffix' => '004', 'nama' => 'Dewi Lestari'],
            ['nim_suffix' => '005', 'nama' => 'Eko Prasetyo'],
            ['nim_suffix' => '006', 'nama' => 'Fitri Handayani'],
            ['nim_suffix' => '007', 'nama' => 'Gunawan Wibisono'],
            ['nim_suffix' => '008', 'nama' => 'Hesti Purwanti'],
            ['nim_suffix' => '009', 'nama' => 'Indra Permana'],
            ['nim_suffix' => '010', 'nama' => 'Julia Rahmawati'],
            ['nim_suffix' => '011', 'nama' => 'Kusuma Wijaya'],
            ['nim_suffix' => '012', 'nama' => 'Lina Marlina'],
            ['nim_suffix' => '013', 'nama' => 'Muhammad Rizki'],
            ['nim_suffix' => '014', 'nama' => 'Nina Kirana'],
            ['nim_suffix' => '015', 'nama' => 'Oscar Pranata'],
            ['nim_suffix' => '016', 'nama' => 'Putri Ayu'],
            ['nim_suffix' => '017', 'nama' => 'Rian Ardiyanto'],
            ['nim_suffix' => '018', 'nama' => 'Siska Wulandari'],
            ['nim_suffix' => '019', 'nama' => 'Taufik Hidayat'],
            ['nim_suffix' => '020', 'nama' => 'Vina Setiawati'],
        ];

        // Daftar jurusan untuk dipilih secara acak
        $jurusan = [
            'Teknik Informatika',
            'Sistem Informasi',
            'Manajemen Bisnis',
            'Desain Komunikasi Visual',
            'Teknik Sipil',
            'Akuntansi'
        ];

        // Prefix NIM, sesuaikan jika perlu
        $nimPrefix = '202310';

        // Loop untuk membuat 20 data
        foreach ($daftarMahasiswa as $data) {
            $nimLengkap = $nimPrefix . $data['nim_suffix'];

            Mahasiswa::create([
                'nim' => $nimLengkap,
                'nama' => $data['nama'],
                'jurusan' => $jurusan[array_rand($jurusan)], // Ambil jurusan secara acak
                'qr_code' => 'QR-' . $nimLengkap, // Buat QR code unik berdasarkan NIM
            ]);
        }
    }
}
