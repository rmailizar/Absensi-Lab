@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h2 class="text-white">Scan Kode QR Kamu Disini</h2>
        <p>Arahkan kamera ke QR Code kamu</p>

        <div id="camera-container" style="position: relative; display: inline-block;">
            <div id="reader" style="width: 350px; margin:auto;"></div>
            <div class="scanner-line"></div>
            <div id="overlay-message" class="overlay-text text-light"></div>
        </div>
    </div>

    <script>
        const overlay = document.getElementById("overlay-message");
        const body = document.body;
        let lastScanTime = 0;

        function showOverlay(message, success = true) {
            overlay.textContent = message;
            overlay.classList.add("show");
            body.classList.add(success ? "scan-success" : "scan-fail");

            setTimeout(() => {
                overlay.classList.remove("show");
                body.classList.remove("scan-success", "scan-fail");
            }, 2000);
        }

        function onScanSuccess(decodedText, decodedResult) {
            const now = Date.now();
            if (now - lastScanTime < 3000) {
                // cegah spam scan
                return;
            }
            lastScanTime = now;

            // kirim data absensi ke backend Laravel
            fetch("{{ route('absensi.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        nim: decodedText
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        showOverlay(data.message, true);
                    } else if (data.status === 'warning') {
                        showOverlay(data.message, false);
                    } else {
                        showOverlay(data.message, false);
                    }
                })
                .catch(err => {
                    console.error(err);
                    showOverlay("Terjadi kesalahan saat mengirim data ❌", false);
                });
        }

        function onScanError(errorMessage) {
            // error scanning bisa diabaikan
        }

        // Inisialisasi scanner
        const html5QrCode = new Html5Qrcode("reader");
        html5QrCode.start({
                facingMode: "environment"
            }, {
                fps: 10,
                qrbox: 250
            },
            onScanSuccess,
            onScanError
        ).catch(err => {
            overlay.textContent = "Gagal mengakses kamera!";
            overlay.classList.add("show");
        });
    </script>
@endsection
