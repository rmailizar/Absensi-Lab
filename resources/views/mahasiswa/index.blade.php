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
                        <button id="addMahasiswaBtn" class="btn btn-success mb-3">
                            + Tambah Mahasiswa
                        </button>
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
                                <tr data-id="{{ $mhs->id }}">
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
                                        <button class="btn btn-sm btn-warning editBtn">Edit</button>
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

    <!-- Modal Tambah/Edit -->
    <div class="modal fade" id="mahasiswaModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalTitle">Tambah Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="mahasiswaForm">
                    @csrf
                    <input type="hidden" id="mhs_id">
                    <div class="modal-body">
                        <div class="mb-3" id="nimField">
                            <label>NIM</label>
                            <input type="text" name="nim" id="nim" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Jurusan</label>
                            <select name="jurusan" id="jurusan" class="form-select" required>
                                <option value="">Pilih Jurusan</option>
                                <option>Teknik Informatika</option>
                                <option>Sistem Informasi</option>
                                <option>Teknik Komputer</option>
                                <option>Manajemen Informatika</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="saveBtn">Simpan</button>
                    </div>
                </form>
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

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = new bootstrap.Modal(document.getElementById('mahasiswaModal'));
            const form = document.getElementById('mahasiswaForm');
            const saveBtn = document.getElementById('saveBtn');
            const modalTitle = document.getElementById('modalTitle');
            const mhsId = document.getElementById('mhs_id');
            const nimField = document.getElementById('nimField');

            // Klik tombol tambah
            document.getElementById('addMahasiswaBtn').addEventListener('click', () => {
                form.reset();
                mhsId.value = '';
                nimField.style.display = 'block'; // tampilkan NIM
                modalTitle.textContent = 'Tambah Mahasiswa';
                saveBtn.textContent = 'Simpan';
                modal.show();
            });

            // Klik tombol edit
            document.querySelectorAll('.editBtn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const row = e.target.closest('tr');
                    // ambil id dari atribut data-id
                    mhsId.value = row.dataset.id;
                    document.getElementById('nama').value = row.children[2].textContent.trim();
                    document.getElementById('jurusan').value = row.children[3].textContent.trim();

                    // sembunyikan field NIM saat edit
                    nimField.style.display = 'none';
                    modalTitle.textContent = 'Edit Mahasiswa';
                    saveBtn.textContent = 'Update';
                    modal.show();
                });
            });

            // Submit form via AJAX
            form.addEventListener('submit', (e) => {
                e.preventDefault();

                const formData = new FormData(form);
                const id = mhsId.value;

                // jika edit, tambahkan _method = PUT
                if (id) formData.append('_method', 'PUT');

                // ambil CSRF dari meta tag
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                fetch(id ? `/mahasiswa/${id}` : `/mahasiswa`, {
                        method: 'POST', // selalu POST (Laravel handle PUT via _method)
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(async res => {
                        // kalau bukan JSON, munculkan pesan error
                        if (!res.ok) {
                            const text = await res.text();
                            throw new Error(text || 'Terjadi kesalahan server');
                        }
                        return res.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // reload halaman agar tabel terupdate
                            location.reload();
                        } else {
                            alert(data.message || 'Gagal menyimpan data!');
                        }
                    })
                    .catch(err => {
                        console.error('Error:', err);
                        alert('Terjadi kesalahan, periksa console untuk detail.');
                    });
            });
        });
    </script>
@endsection
