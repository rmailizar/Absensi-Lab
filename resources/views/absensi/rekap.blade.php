@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">📋 Rekap Absensi Pengunjung Lab Komputer</h4>
        </div>

        <div class="card-body">
            @if($data->isEmpty())
                <div class="alert alert-info text-center">
                    Belum ada data absensi untuk ditampilkan.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Lama di Lab</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $i => $a)
                            @php
                                $masuk = \Carbon\Carbon::parse($a->jam);
                                $keluar = $a->jam_keluar ? \Carbon\Carbon::parse($a->jam_keluar) : null;
                                $durasi = $keluar ? $masuk->diff($keluar)->format('%h jam %i menit') : '-';
                            @endphp
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td class="fw-semibold">{{ $a->mahasiswa->nama }}</td>
                                <td>{{ $a->mahasiswa->nim }}</td>
                                <td>{{ \Carbon\Carbon::parse($a->tanggal)->translatedFormat('d F Y') }}</td>
                                <td>{{ $a->jam }}</td>
                                <td>{{ $a->jam_keluar ?? '-' }}</td>
                                <td>{{ $durasi }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
