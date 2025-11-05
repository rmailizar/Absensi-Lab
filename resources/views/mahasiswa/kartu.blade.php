<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Kartu Anggota Lab</title>
    <style>
        @page {
            size: 8.6cm 5.4cm;
            /* ukuran kartu ID standar */
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            background: none;
            font-family: 'Arial', sans-serif;
        }

        .kartu {
            width: 8.6cm;
            height: 5.4cm;
            background: linear-gradient(135deg, #004aad, #007bff);
            background-color: #004aad;
            /* fallback solid */
            color: white;
            border-radius: 10px;
            position: relative;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            padding: 10px 15px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header img {
            width: 45px;
            height: 45px;
        }

        .title {
            font-size: 14px;
            font-weight: bold;
            text-align: right;
        }

        .body {
            margin-top: 5px;
            font-size: 11px;
            line-height: 1.5;
        }

        .nama {
            font-size: 13px;
            font-weight: bold;
            margin-top: 3px;
        }

        .qrcode {
            position: absolute;
            bottom: 8px;
            right: 10px;
        }

        .footer {
            position: absolute;
            bottom: 4px;
            left: 10px;
            font-size: 9px;
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div class="kartu">
        <div class="header">
            <img src="{{ public_path('logo_kampus.png') }}" alt="Logo Kampus">
            <div class="title">
                Kartu Anggota Lab<br>
                <small>Universitas Contoh</small>
            </div>
        </div>

        <div class="body">
            <div class="nama">{{ strtoupper($mahasiswa->nama) }}</div>
            <div>NIM : {{ $mahasiswa->nim }}</div>
            <div>Jurusan : {{ $mahasiswa->jurusan }}</div>
            <div>Email : {{ $mahasiswa->email }}</div>
        </div>

        <div class="qrcode">
            {!! QrCode::size(60)->generate($mahasiswa->nim) !!}
        </div>

        <div class="footer">
            Berlaku hingga {{ now()->addYears(4)->format('d M Y') }}
        </div>
    </div>
</body>

</html>
