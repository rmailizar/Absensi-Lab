<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-5.0.0-beta1.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.2.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lindy-uikit.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/manageuser.css') }}">
    <style>
        /* CSS Kustom untuk Teks "LabLogix" */
        .gradient-text {
            font-weight: 900;
            letter-spacing: -0.05em;
            /* Mirip 'tracking-tighter' */
            /* Ukuran font responsif */
            /* Ukuran desktop besar */
        }

        .gradient-text span {
            /* Terapkan gradien sebagai background */
            background-image: var(--letter-gradient);

            /* Potong background agar sesuai dengan bentuk teks */
            -webkit-background-clip: text;
            background-clip: text;

            /* Buat teksnya transparan agar gradien terlihat */
            color: transparent;

            /* Mencegah pemecahan baris antar huruf */
            display: inline-block;
        }
    </style>
    <!-- Memuat Font Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    @yield('custom-style')
    <style>
        body {
            padding-top: 90px;
            /* menyesuaikan tinggi navbar */
            overflow-y: auto;
            /* pastikan bisa scroll */
        }
    </style>
</head>

<body class="">
    @yield('content')

    <script src="{{ asset('assets/js/bootstrap-5.0.0-beta1.min.js') }}"></script>
    <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @yield('scripts')
</body>

</html>
