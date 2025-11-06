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
       // Kosongkan tabel users terlebih dahulu
       DB::table('users')->truncate();

       // === USER DARI CONTOH ANDA ===

       // 1. Buat data Admin
       User::create([
           'name' => 'Admin Lab',
           'email' => 'admin@lab.com',
           'password' => Hash::make('admin123'),
           'role' => 'admin',
       ]);

       // 2. Buat data Mahasiswa (sesuai contoh Anda, role admin)
       User::create([
           'name' => 'Mahasiswa Contoh',
           'email' => 'mahasiswa@lab.com',
           'password' => Hash::make('mahasiswa123'),
           'role' => 'admin', // Sesuai contoh yang Anda berikan
       ]);

       // 3. User Budi
       User::create([
           'name' => 'Budi Setiawan',
           'email' => 'budi@lab.com',
           'password' => Hash::make('passwordbudi'),
           'role' => 'admin',
       ]);

       // === ADMIN TAMBAHAN ===

       // 4. Admin Keuangan
       User::create([
           'name' => 'Admin Keuangan',
           'email' => 'finance.admin@lab.com',
           'password' => Hash::make('finance123'),
           'role' => 'admin',
       ]);

       // 5. Admin Support
       User::create([
           'name' => 'Support Teknis',
           'email' => 'support@lab.com',
           'password' => Hash::make('support123'),
           'role' => 'admin',
       ]);


       // === 15 DATA MAHASISWA BARU ===

       // 6.
       User::create([
           'name' => 'Citra Lestari',
           'email' => 'citra.lestari@lab.com',
           'password' => Hash::make('password123'),
           'role' => 'admin',
       ]);

       // 7.
       User::create([
           'name' => 'Eko Prasetyo',
           'email' => 'eko.prasetyo@lab.com',
           'password' => Hash::make('password123'),
           'role' => 'admin',
       ]);

       // 8.
       User::create([
           'name' => 'Fitriani Indah',
           'email' => 'fitriani.indah@lab.com',
           'password' => Hash::make('password123'),
           'role' => 'admin',
       ]);

       // 9.
       User::create([
           'name' => 'Gilang Ramadhan',
           'email' => 'gilang.ramadhan@lab.com',
           'password' => Hash::make('password123'),
           'role' => 'admin',
       ]);

       // 10.
       User::create([
           'name' => 'Hana Yuliana',
           'email' => 'hana.yuliana@lab.com',
           'password' => Hash::make('password123'),
           'role' => 'admin',
       ]);

    //    // 11.
    //    User::create([
    //        'name' => 'Indra Wijaya',
    //        'email' => 'indra.wijaya@lab.com',
    //        'password' => Hash::make('password123'),
    //        'role' => 'admin',
    //    ]);

    //    // 12.
    //    User::create([
    //        'name' => 'Joko Susilo',
    //        'email' => 'joko.susilo@lab.com',
    //        'password' => Hash::make('password123'),
    //        'role' => 'admin',
    //    ]);

    //    // 13.
    //    User::create([
    //        'name' => 'Kartika Dewi',
    //        'email' => 'kartika.dewi@lab.com',
    //        'password' => Hash::make('password123'),
    //        'role' => 'admin',
    //    ]);

    //    // 14.
    //    User::create([
    //        'name' => 'Lutfi Hakim',
    //        'email' => 'lutfi.hakim@lab.com',
    //        'password' => Hash::make('password123'),
    //        'role' => 'admin',
    //    ]);

    //    // 15.
    //    User::create([
    //        'name' => 'Mega Anggraini',
    //        'email' => 'mega.anggraini@lab.com',
    //        'password' => Hash::make('password123'),
    //        'role' => 'admin',
    //    ]);

    //    // 16.
    //    User::create([
    //        'name' => 'Nanda Pratama',
    //        'email' => 'nanda.pratama@lab.com',
    //        'password' => Hash::make('password123'),
    //        'role' => 'admin',
    //    ]);

    //    // 17.
    //    User::create([
    //        'name' => 'Olivia Putri',
    //        'email' => 'olivia.putri@lab.com',
    //        'password' => Hash::make('password123'),
    //        'role' => 'admin',
    //    ]);

    //    // 18.
    //    User::create([
    //        'name' => 'Putra Sanjaya',
    //        'email' => 'putra.sanjaya@lab.com',
    //        'password' => Hash::make('password123'),
    //        'role' => 'admin',
    //    ]);

    //    // 19.
    //    User::create([
    //        'name' => 'Rina Marlina',
    //        'email' => 'rina.marlina@lab.com',
    //        'password' => Hash::make('password123'),
    //        'role' => 'admin',
    //    ]);

    //    // 20.
    //    User::create([
    //        'name' => 'Sari Purnamasari',
    //        'email' => 'sari.purnamasari@lab.com',
    //        'password' => Hash::make('password123'),
    //        'role' => 'admin',
    //    ]);

        // Tips: Jika Anda ingin membuat banyak data palsu,
        // pertimbangkan menggunakan User Factory.
    }
}