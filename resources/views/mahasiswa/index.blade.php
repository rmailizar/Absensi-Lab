@extends('layouts.app')

@section('content')
    <x-navbar setActive="ManagementMahasiswa" />

    <div class="bg-shape"></div>
    <div class="bg-gradient"></div>
    <!-- Alert container -->
    <div class="alert-container"></div>

    <!-- Content -->
    <div class="container content-wrapper">
        <div class="card shadow-sm rounded-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                    <h5 class="fw-bold mb-0" style="color: #0d6efd">
                        Mahasiswa Table
                    </h5>
                    <div class="d-flex align-items-center gap-2 flex-nowrap">
                        <select class="form-select form-select-sm filter-select">
                            <option selected>Semua Jurusan</option>
                            <option>Teknik Informatika</option>
                            <option>Sistem Informasi</option>
                            <option>Teknik Komputer</option>
                            <option>Manajemen Informatika</option>
                        </select>
                        <input type="text" class="form-control form-control-sm search-box"
                            placeholder="Cari mahasiswa..." />
                        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary btn-sm px-3" data-bs-toggle="modal"
                            data-bs-target="#addAdminModal">
                            <i class="bi bi-person-plus me-1"></i><span>Tambah Mahasiswa</span>
                        </a>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table align-middle table-bordered text-center">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>QR</th>
                                <th>Aksi</th>
                                <th>Kartu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswas as $mhs)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mhs->nim }}</td>
                                    <td>{{ $mhs->nama }}</td>
                                    <td>{{ $mhs->jurusan }}</td>
                                    <td>
                                        @if ($mhs->qr_code)
                                            <img src="{{ asset('storage/' . $mhs->qr_code) }}" alt="QR"
                                                width="80" />
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('mahasiswa.edit', $mhs->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST"
                                            style="display: inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Hapus data ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('mahasiswa.kartu.download', $mhs->id) }}"
                                            class="btn btn-success btn-sm">
                                            <i class="bi bi-download"></i>
                                            Download PDF
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav>
                    <ul class="pagination justify-content-center mt-4">
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Previous</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Modal Tambah mahasiswa -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAdminModalLabel">
                        Tambah Mahasiswa
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 py-4">
                    <form id="addAdminForm">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama lengkap" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">NIM</label>
                            <input type="text" class="form-control" placeholder="Masukkan NIM" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jurusan</label>
                            <select class="form-select" required>
                                <option selected disabled>
                                    Pilih jurusan
                                </option>
                                <option>Teknik Informatika</option>
                                <option>Sistem Informasi</option>
                                <option>Teknik Komputer</option>
                                <option>Manajemen Informatika</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control" placeholder="Masukkan password" required />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-primary" id="saveAdminBtn">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Mahasiswa -->
    <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAdminModalLabel">
                        Edit Admin
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 py-4">
                    <form>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" class="form-control" value="John Michael" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">NIM</label>
                            <input type="text" class="form-control" value="123456789" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jurusan</label>
                            <select class="form-select">
                                <option>Teknik Informatika</option>
                                <option>Sistem Informasi</option>
                                <option>Teknik Komputer</option>
                                <option>Manajemen Informatika</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control" placeholder="Kosongkan jika tidak diubah" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button class="btn btn-primary" id="saveEditBtn">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">
                        Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah kamu yakin ingin menghapus admin ini?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button class="btn btn-danger" id="confirmDeleteBtn">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
