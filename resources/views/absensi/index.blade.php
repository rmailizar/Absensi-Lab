@extends('layouts.app')

@section('content')
<div class="container mt-4 text-center">
    <h2>Absensi Pengunjung Lab</h2>
    <p>Silakan arahkan QR Code mahasiswa ke kamera</p>

    <div id="reader" style="width:400px; margin:auto;"></div>

    <div id="result" class="mt-4"></div>
</div>

{{-- CDN html5-qrcode --}}
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    let lastScanTime = 0; // waktu terakhir scan sukses

    function onScanSuccess(decodedText, decodedResult) {
        const now = Date.now();
        if (now - lastScanTime < 3000) {
            // cegah spam (kurang dari 2 detik)
            return;
        }
        lastScanTime = now;

        document.getElementById('result').innerHTML = `<p>QR Terdeteksi: <b>${decodedText}</b></p>`;

        fetch("{{ route('absensi.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ nim: decodedText })
        })
        .then(res => res.json())
        .then(data => {
            let box = document.getElementById('result');
            if (data.status === 'success') {
                box.innerHTML += `<div class='alert alert-success mt-2'>${data.message}</div>`;
            } else if (data.status === 'warning') {
                box.innerHTML += `<div class='alert alert-warning mt-2'>${data.message}</div>`;
            } else {
                box.innerHTML += `<div class='alert alert-danger mt-2'>${data.message}</div>`;
            }
        })
        .catch(err => console.error(err));
    }

    function onScanError(errorMessage) {
        // bisa diabaikan
    }

    const html5QrCode = new Html5Qrcode("reader");
    html5QrCode.start(
        { facingMode: "environment" },
        { fps: 10, qrbox: 250 },
        onScanSuccess,
        onScanError
    );
</script>

@endsection
