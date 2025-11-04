<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    /**
     * Tampilkan halaman scanner
     */
    public function index()
    {
        return view('absensi.index');
    }

    /**
     * Simpan hasil scan QR ke database
     */
    public function store(Request $request)
    {
        $nim = $request->nim;
        $mahasiswa = \App\Models\Mahasiswa::where('nim', $nim)->first();

        if (!$mahasiswa) {
            return response()->json(['status' => 'error', 'message' => 'Mahasiswa tidak ditemukan!']);
        }

        $now = \Carbon\Carbon::now('Asia/Jakarta');
        $tanggal = $now->toDateString();
        $jam = $now->format('H:i:s');

        $absen = \App\Models\Absensi::where('mahasiswa_id', $mahasiswa->id)
            ->where('tanggal', $tanggal)
            ->first();

        if (!$absen) {
            // Belum absen → Check-In
            \App\Models\Absensi::create([
                'mahasiswa_id' => $mahasiswa->id,
                'tanggal' => $tanggal,
                'jam' => $jam,
                'status' => 'hadir',
            ]);

            return response()->json([
                'status' => 'success',
                'message' => "{$mahasiswa->nama} berhasil CHECK IN pada {$jam} WIB",
            ]);
        } else {
            // Sudah pernah Check-In hari ini
            if ($absen->jam_keluar === null) {
                // Hitung selisih waktu dari jam masuk
                $selisih = $now->diffInSeconds(\Carbon\Carbon::parse($absen->jam));

                if ($selisih < 30) {
                    $sisa = 30 - $selisih;
                    return response()->json([
                        'status' => 'warning',
                        'message' => "Maaf {$mahasiswa->nama}, Anda baru saja check-in. Tunggu {$sisa} detik sebelum check-out.",
                    ]);
                }

                // Jika sudah lebih dari 30 detik → boleh check-out
                $absen->update([
                    'jam_keluar' => $jam,
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => "{$mahasiswa->nama} berhasil CHECK OUT pada {$jam} WIB",
                ]);
            } else {
                return response()->json([
                    'status' => 'warning',
                    'message' => "{$mahasiswa->nama} sudah CHECK OUT hari ini.",
                ]);
            }
        }
    }
}
