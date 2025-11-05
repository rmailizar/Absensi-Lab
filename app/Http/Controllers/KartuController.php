<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Barryvdh\DomPDF\Facade\Pdf;

class KartuController extends Controller
{
    // ✅ Tampilkan kartu di browser
    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.kartu', compact('mahasiswa'));
    }

    public function download($id)
    {
        $mahasiswa = \App\Models\Mahasiswa::findOrFail($id);

        // Atur agar DomPDF menampilkan warna latar belakang
        $pdf = Pdf::loadView('mahasiswa.kartu', compact('mahasiswa'));
        $pdf->set_option('isHtml5ParserEnabled', true);
        $pdf->set_option('isRemoteEnabled', true);
        $pdf->set_option('defaultMediaType', 'screen');

        // Ukuran kertas kartu (8.6 x 5.4 cm)
        $pdf->setPaper([0, 0, 243.78, 153.07], 'landscape');

        return $pdf->download("Kartu_{$mahasiswa->nim}.pdf");
    }
}
