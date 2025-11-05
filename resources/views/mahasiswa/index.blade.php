@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        {{-- Tombol Logout --}}
        <form method="POST" action="{{ route('logout') }}" class="mb-3 text-end">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>

        <h2>Daftar Mahasiswa</h2>
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary mb-3">+ Tambah Mahasiswa</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>QR Code</th>
                    <th>Aksi</th>
                    <th>Kartu Lab</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswas as $mhs)
                    <tr>
                        <td>{{ $mhs->nim }}</td>
                        <td>{{ $mhs->nama }}</td>
                        <td>{{ $mhs->jurusan }}</td>
                        <td>
                            @if ($mhs->qr_code)
                                <img src="{{ asset('storage/' . $mhs->qr_code) }}" alt="QR" width="80">
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Hapus data ini?')">Hapus</button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('mahasiswa.kartu.show', $mhs->id) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-person-badge"></i> Lihat Kartu
                            </a>
                            <a href="{{ route('mahasiswa.kartu.download', $mhs->id) }}" class="btn btn-success btn-sm">
                                <i class="bi bi-download"></i> Download PDF
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
