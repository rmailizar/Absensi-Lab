@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h3 class="mb-4 text-center">📅 Rekap Absensi Mahasiswa</h3>

        <!-- Filter Rentang Tanggal & Pencarian -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="{{ route('absensi.rekap') }}" method="GET" class="row g-3 align-items-center">

                    <div class="col-md-3">
                        <label for="tanggal_awal" class="form-label fw-bold">Dari</label>
                        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control"
                            value="{{ $tanggalAwal ?? '' }}">
                    </div>

                    <div class="col-md-3">
                        <label for="tanggal_akhir" class="form-label fw-bold">Sampai</label>
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control"
                            value="{{ $tanggalAkhir ?? '' }}">
                    </div>

                    <div class="col-md-3">
                        <label for="keyword" class="form-label fw-bold">Cari Nama / NIM</label>
                        <input type="text" name="keyword" id="keyword" class="form-control"
                            placeholder="Contoh: Budi / 123456" value="{{ $keyword ?? '' }}">
                    </div>

                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Tampilkan
                        </button>
                        <a href="{{ route('absensi.export', ['tanggal_awal' => $tanggalAwal, 'tanggal_akhir' => $tanggalAkhir, 'keyword' => $keyword]) }}"
                            class="btn btn-success w-100">
                            <i class="bi bi-download"></i> Download Excel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Rekap -->
        @if (count($data) > 0)
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">
                        @if ($tanggalAwal && $tanggalAkhir)
                            Rekap dari <span class="text-primary">{{ $tanggalAwal }}</span> hingga <span
                                class="text-primary">{{ $tanggalAkhir }}</span>
                        @else
                            Semua Data Absensi
                        @endif
                        @if ($keyword)
                            — Filter: <span class="text-info fw-bold">{{ $keyword }}</span>
                        @endif
                    </h5>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $a)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $a->mahasiswa->nama }}</td>
                                        <td>{{ $a->mahasiswa->nim }}</td>
                                        <td>{{ $a->tanggal }}</td>
                                        <td>{{ $a->jam ?? '-' }}</td>
                                        <td>{{ $a->jam_keluar ?? '-' }}</td>
                                        <td>
                                            @if ($a->jam && !$a->jam_keluar)
                                                <span class="badge bg-warning text-dark">Masih di Lab</span>
                                            @elseif($a->jam_keluar)
                                                <span class="badge bg-success">Selesai</span>
                                            @else
                                                <span class="badge bg-secondary">Tidak Hadir</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning text-center">
                Tidak ada data absensi yang cocok.
            </div>
        @endif
    </div>
@endsection
