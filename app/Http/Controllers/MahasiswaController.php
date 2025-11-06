<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas',
            'nama' => 'required',
            'jurusan' => 'required',
        ]);

        $mahasiswa = Mahasiswa::create($request->only('nim', 'nama', 'jurusan'));

        $qrContent = $mahasiswa->nim;
        $qrPath = 'qrcodes/' . $mahasiswa->nim . '.svg';
        Storage::disk('public')->put($qrPath, QrCode::format('svg')->size(250)->generate($qrContent));

        $mahasiswa->update(['qr_code' => $qrPath]);

        return response()->json(['success' => true, 'message' => 'Mahasiswa berhasil ditambahkan']);
    }

    public function edit($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        return response()->json($mhs);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jurusan' => 'required',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->only('nama', 'jurusan'));

        return response()->json(['success' => true, 'message' => 'Data mahasiswa berhasil diperbarui']);
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        if ($mahasiswa->qr_code && Storage::disk('public')->exists($mahasiswa->qr_code)) {
            Storage::disk('public')->delete($mahasiswa->qr_code);
        }

        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa dihapus.');
    }
}
