<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Tampilkan semua mahasiswa
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Form tambah mahasiswa
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Simpan data mahasiswa baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas',
            'nama' => 'required',
            'jurusan' => 'required',
        ]);

        // Simpan data mahasiswa
        $mahasiswa = Mahasiswa::create($request->only('nim', 'nama', 'jurusan'));

        // Buat QR code berdasarkan NIM
        $qrContent = $mahasiswa->nim;
        $qrPath = 'qrcodes/' . $mahasiswa->nim . '.svg';

        // Generate dan simpan ke storage/app/public/qrcodes/
        Storage::disk('public')->put($qrPath, QrCode::format('svg')->size(250)->generate($qrContent));

        // Update path QR ke database
        $mahasiswa->update(['qr_code' => $qrPath]);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    /**
     * Form edit mahasiswa
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update data mahasiswa
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama' => 'required',
            'jurusan' => 'required',
        ]);

        $mahasiswa->update($request->only('nama', 'jurusan'));
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa diperbarui.');
    }

    /**
     * Hapus mahasiswa
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        if ($mahasiswa->qr_code && Storage::disk('public')->exists($mahasiswa->qr_code)) {
            Storage::disk('public')->delete($mahasiswa->qr_code);
        }

        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa dihapus.');
    }
}
