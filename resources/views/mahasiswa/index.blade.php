@extends('layouts.app')

@section('title', 'Table Mahasiswa | LabLogix')

@section('content')
    <x-navbar setActive="ManagementMahasiswa" />

    <div class="bg-shape"></div>
    <div class="bg-gradient"></div>
    <!-- Alert container -->
    <div class="alert-container"></div>

    <!-- Content -->
    <div class="container">
        <div class="card shadow-sm rounded-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                    <h5 class="fw-bold mb-0" style="color: #0d6efd">
                        Mahasiswa Table
                    </h5>
                    <div class="d-flex align-items-center gap-2 flex-nowrap">
                        <form method="GET" action="{{ route('mahasiswa.index') }}" class="d-flex gap-2">
                            <select name="jurusan" class="form-select form-select-sm filter-select" onchange="this.form.submit()">
                                <option {{ request('jurusan') == 'Semua Jurusan' ? 'selected' : '' }}>Semua Jurusan</option>
                                <option value="Teknik Informatika" {{ request('jurusan') == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                                <option value="Sistem Informasi" {{ request('jurusan') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                                <option value="Teknik Komputer" {{ request('jurusan') == 'Teknik Komputer' ? 'selected' : '' }}>Teknik Komputer</option>
                                <option value="Manajemen Informatika" {{ request('jurusan') == 'Manajemen Informatika' ? 'selected' : '' }}>Manajemen Informatika</option>
                            </select>
                        
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm search-box" placeholder="Cari mahasiswa..." />
                        
                            <button type="submit" class="btn btn-sm btn-primary">Cari</button>
                        </form>
                        <button id="addMahasiswaBtn" class="btn btn-primary btn-sm px-3">
                            <i class="bi bi-person-plus me-1"></i> <span>Tambah Mahasiswa</span>
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
                            @foreach ($mahasiswas as $index => $mhs)
                                <tr data-id="{{ $mhs->id }}">
                                    <td>{{ $mahasiswas->firstItem() + $index }}</td>
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
                                        <button type="button" class="btn btn-sm btn-danger" data-id="{{ $mhs->id }}">
                                            Hapus
                                        </button>
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
                <div class="d-flex justify-content-center">
                    {{ $mahasiswas->links('pagination::bootstrap-4') }}
                </div>
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
                        <button type="submit" class="btn btn-success" id="saveBtn">cihuy</button>
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
        function showAlert(message, type = "success") {
            const container = document.querySelector(".alert-container");
            const alert = document.createElement("div");
            alert.className = `alert alert-${type} alert-dismissible fade show shadow`;
            alert.role = "alert";
            alert.innerHTML = `
    ${message}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  `;
            container.appendChild(alert);
            setTimeout(() => alert.remove(), 4000);
        }

        // === Tambah Mahasiswa ===
        const addModal = new bootstrap.Modal(document.getElementById("mahasiswaModal"));
        const saveBtn = document.getElementById("saveBtn");
        const form = document.getElementById("mahasiswaForm");

        document.getElementById("addMahasiswaBtn").addEventListener("click", () => {
            form.reset();
            document.getElementById("mhs_id").value = "";
            document.getElementById("nimField").style.display = "block";
            document.getElementById("modalTitle").textContent = "Tambah Mahasiswa";
            saveBtn.textContent = "Simpan";
            addModal.show();
        });

        saveBtn.addEventListener("click", async (e) => {
            e.preventDefault();
            const formData = new FormData(form);

            const id = document.getElementById("mhs_id").value;
            const url = id ? `/mahasiswa/${id}` : `/mahasiswa`;
            if (id) formData.append("_method", "PUT");

            try {
                const res = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: formData
                });

                const result = await res.json();

                if (res.ok && result.success) {
                    showAlert(result.message || "Data mahasiswa berhasil disimpan!", "success");
                    addModal.hide();
                    setTimeout(() => location.reload(), 1200);
                } else {
                    showAlert(result.message || "Gagal menyimpan data.", "danger");
                }
            } catch (err) {
                console.error(err);
                showAlert("Terjadi kesalahan saat menyimpan data.", "danger");
            }
        });

        // === Edit Mahasiswa ===
        document.querySelectorAll(".editBtn").forEach(button => {
            button.addEventListener("click", async () => {
                const id = button.closest("tr").dataset.id;

                try {
                    const res = await fetch(`/mahasiswa/${id}/edit`);
                    if (!res.ok) throw new Error("Gagal mengambil data mahasiswa");
                    const mhs = await res.json();

                    document.getElementById("mhs_id").value = mhs.id;
                    document.getElementById("nama").value = mhs.nama;
                    document.getElementById("jurusan").value = mhs.jurusan;
                    document.getElementById("nimField").style.display = "none";

                    document.getElementById("modalTitle").textContent = "Edit Mahasiswa";
                    saveBtn.textContent = "Update";
                    addModal.show();
                } catch (err) {
                    console.error(err);
                    showAlert("Gagal memuat data mahasiswa", "danger");
                }
            });
        });

        // === Hapus Mahasiswa ===
        document.addEventListener("DOMContentLoaded", () => {
            let deleteId = null;
            const deleteModal = new bootstrap.Modal(document.getElementById("deleteConfirmModal"));
            const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

            document.querySelectorAll(".btn.btn-sm.btn-danger[data-id]").forEach(button => {
                button.addEventListener("click", e => {
                    e.preventDefault();
                    deleteId = button.dataset.id;
                    deleteModal.show();
                });
            });

            confirmDeleteBtn.addEventListener("click", async () => {
                if (!deleteId) return;
                try {
                    const res = await fetch(`/mahasiswa/${deleteId}`, {
                        method: "DELETE",
                        headers: {
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    });

                    const result = await res.json();

                    if (res.ok && result.success) {
                        showAlert(result.message || "Mahasiswa berhasil dihapus!", "success");
                        deleteModal.hide();
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        showAlert(result.message || "Gagal menghapus data.", "danger");
                    }
                } catch (err) {
                    console.error(err);
                    showAlert("Terjadi kesalahan saat menghapus data.", "danger");
                }
            });
        });
    </script>
@endsection
