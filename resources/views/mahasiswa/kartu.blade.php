<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Kartu Anggota Lab</title>
    <style>
        @page {
            size: 10.6cm 8.4cm;
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
            color: white;
            border-radius: 10px;
            position: relative;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            padding: 10px 15px;
        }

        /* ✅ Logo fix di kiri atas */
        .logo {
            position: absolute;
            top: 10px;
            left: 15px;
            width: 45px;
            height: 45px;
        }

        /* ✅ Judul fix di kanan atas, tidak terdorong logo */
        .title {
            position: absolute;
            top: 10px;
            right: 15px;
            text-align: right;
            font-size: 14px;
            font-weight: bold;
            line-height: 1.1;
        }

        .title small {
            font-size: 11px;
            font-weight: normal;
        }

        .body {
            position: absolute;
            top: 70px;
            left: 20px;
            font-size: 15px;
            line-height: 1.5;
        }

        .nama {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 4px;
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
      <img src="{{ asset('images/untirta.svg') }}" alt="UNTIRTA" class="logo">
        <div class="title">
            Kartu Anggota Lab<br>
            <small>Informatika</small>
        </div>

        <div class="body">
            <div class="nama">{{ strtoupper($mahasiswa->nama) }}</div>
            <div>NIM : {{ $mahasiswa->nim }}</div>
            <div>Jurusan : {{ $mahasiswa->jurusan }}</div>
        </div>

        <div class="qrcode">
            @if ($mahasiswa->qr_code)
            <img src="{{ asset('storage/' . $mahasiswa->qr_code) }}" width="90" height="90" alt="QR">
            @else
                <small>Tidak ada QR</small>
            @endif
        </div>

        <div class="footer">
            Berlaku hingga {{ now()->addYears(4)->format('d M Y') }}
        </div>
    </div>
</body>

</html>
