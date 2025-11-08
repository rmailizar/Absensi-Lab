@extends('layouts.app')

@section('custom-style')
    <style>
        /* Menggunakan font Inter sebagai default */
        body {
            font-family: 'Inter', sans-serif;
        }

        /* CSS Kustom untuk Latar Belakang
          Ini adalah bagian yang paling penting untuk membuat ulang efek "gelombang"
          tanpa menggunakan gambar, sesuai permintaan Anda.
        */
        .hero-background {
            /* Warna dasar langit */
            background-color: #f0f9ff;
            /* sky-50 */

            /* Gradien bergelombang di bagian bawah.
              Ini adalah elips besar yang sangat buram (blur) yang tumpang tindih.
              Ini menciptakan kembali efek gelombang abstrak seperti pada gambar.
            */
            background-image:
                /* Gelombang hijau muda di kiri bawah */
                radial-gradient(ellipse 50% 40% at 20% 100%, #c8f7c599 0%, transparent 80%),
                /* Gelombang biru muda di tengah */
                radial-gradient(ellipse 60% 45% at 50% 100%, #a0e9ff99 0%, transparent 80%),
                /* Gelombang biru pucat di kanan bawah */
                radial-gradient(ellipse 50% 40% at 85% 100%, #dbeafe99 0%, transparent 80%);

            background-repeat: no-repeat;
            /* Memastikan gradien menutupi seluruh area, mirip 'background-size: cover' */
            background-size: 100% 100%;
            background-position: center bottom;

            /* Bootstrap helper classes */
            min-height: 100vh;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow-x: hidden;
            /* Mencegah scroll horizontal */
        }

        /* Kustomisasi Navbar Bootstrap agar terlihat seperti di gambar */
        .custom-navbar {
            background-color: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 50rem;
            /* Membuat bentuk pil */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding-left: 1rem;
            padding-right: 1rem;
        }

        /* Kustomisasi link navbar */
        .navbar-nav .nav-link {
            transition: all 0.3s ease;
            font-weight: 500;
            color: #4b5563;
            /* text-gray-600 */
            border-radius: 50rem;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .navbar-nav .nav-link:hover {
            transform: translateY(-2px);
            background-color: #ffffff;
            /* Putih */
            color: #0284c7;
            /* sky-600 */
        }

        .navbar-nav .nav-link.active {
            color: #0284c7;
            /* sky-700 */
        }

        /* Kustomisasi Teks Sub-judul */
        .hero-title {
            color: #0369a1;
            /* text-sky-800 */
            font-weight: 700;
            /* bold */
        }

        .hero-subtitle {
            color: #0284c7;
            /* text-sky-700 */
        }

        /* Media Queries untuk font responsif */
        @media (max-width: 1200px) {
            .gradient-text {
                font-size: 11.5rem;
            }
        }

        @media (max-width: 992px) {
            .gradient-text {
                font-size: 9rem;
            }
        }

        @media (max-width: 768px) {
            .gradient-text {
                font-size: 7rem;
            }
        }

        @media (max-width: 576px) {
            .gradient-text {
                font-size: 4.5rem;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }
        }
    </style>
@endsection

@section('content')
    <x-navbar setActive="Home" />
    <div class="bg-shape"></div>
    <div class="bg-gradient"></div>
    <!-- ===== Konten Hero ===== -->
    <main class="flex-grow-1 d-flex flex-column justify-content-center align-items-center text-center px-4 pt-5 pb-4">

        <!-- Teks Judul Utama "LabLogix" dengan Gradien -->
        <h1 class="gradient-text" style="font-size: 14rem" aria-label="LabLogix">
            <!--
                      Setiap huruf diberi variabel CSS untuk gradiennya,
                      sesuai dengan palet warna di gambar.
                    -->
            <span style="--letter-gradient: linear-gradient(to right, #0077b6, #48cae4);">L</span>
            <span style="--letter-gradient: linear-gradient(to right, #48cae4, #90e0ef);">a</span>
            <span style="--letter-gradient: linear-gradient(to right, #ade8f4, #c8f7c5);">b</span>
            <span style="--letter-gradient: linear-gradient(to right, #90e0ef, #dbeafe);">L</span>
            <span style="--letter-gradient: linear-gradient(to right, #0077b6, #48cae4);">o</span>
            <span style="--letter-gradient: linear-gradient(to right, #48cae4, #90e0ef);">g</span>
            <span style="--letter-gradient: linear-gradient(to right, #ade8f4, #c8f7c5);">i</span>
            <span style="--letter-gradient: linear-gradient(to right, #90e0ef, #dbeafe);">x</span>
        </h1>

        <!-- Teks Sub-judul -->
        <div class="mt-4 mt-sm-0">
            <h2 class="display-5 hero-title">
                Welcome to LabLogix
            </h2>
            <p class="lead fs-4 hero-subtitle mt-3" style="max-width: 600px;">
                Online Website for efficiency and security of our lab
            </p>
        </div>

    </main>
    </div>
@endsection
