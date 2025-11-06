@extends('layouts.app')

@section('content')
    <x-navbar setActive="ManagementUser" />

    <!-- Alert container -->
    <div class="alert-container position-fixed top-0 end-0 p-3" style="z-index: 1055;"></div>

    <div class="container" style="margin-top: 200px;">
        <div class="card shadow-sm rounded-4">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <h5 class="fw-bold mb-0">Management User</h5>

                <div class="d-flex align-items-center gap-2 flex-wrap justify-content-end">
                  <select class="form-select form-select-sm filter-select w-auto">
                    <option selected>Semua Jurusan</option>
                    <option>Teknik Informatika</option>
                    <option>Sistem Informasi</option>
                    <option>Teknik Komputer</option>
                    <option>Manajemen Informatika</option>
                  </select>

                  <input type="text" class="form-control form-control-sm search-box" placeholder="Cari admin..." style="width: 200px;">

                  <button class="btn btn-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                    <i class="bi bi-person-plus me-1"></i> <span>Tambah User</span>
                  </button>
                </div>
              </div>

                <div class="table-responsive">
                    <table class="table align-middle table-bordered text-center">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="text-start">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person-circle avatar-icon me-2"></i>
                                            <div>
                                                <h6 class="mb-0 fw-semibold">{{ $user->name }}</h6>
                                                <small class="text-muted">{{ $user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($user->role === 'admin')
                                            <span class="badge bg-danger">Admin</span>
                                        @else
                                            <span class="badge bg-info text-dark">Asisten Lab</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-warning btn-edit" data-id="{{ $user->id }}">
                                          <i class="bi bi-pencil-square"></i>
                                        </a>

                                        @if (Auth::id() !== $user->id)
                                            <button class="btn btn-sm btn-danger" data-id="{{ $user->id }}">
                                              <i class="bi bi-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah User -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
          <div class="modal-header">
            <h5 class="modal-title" id="addAdminModalLabel">Tambah User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body px-4 py-4">
            <form id="addUserForm">
              @csrf
              <div class="mb-3">
                <label class="form-label fw-semibold">Nama</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" required />
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email" required />
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Role</label>
                <select name="role" class="form-select" required>
                  <option selected disabled>Pilih role</option>
                  <option value="admin">Admin</option>
                  <option value="asisten lab">Asisten Lab</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required />
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="saveAdminBtn">Simpan</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Edit User -->
    <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg text-dark bg-white">
          <div class="modal-header">
            <h5 class="modal-title" id="editAdminModalLabel">Edit User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body px-4 py-4">
            <form id="editUserForm">
              @csrf
              @method('PUT')
              <input type="hidden" id="editUserId">
              <div class="mb-3">
                <label class="form-label fw-semibold">Nama</label>
                <input type="text" class="form-control" id="editName" required />
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" id="editEmail" required />
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Role</label>
                <select class="form-select" id="editRole" required>
                  <option value="admin">Admin</option>
                  <option value="asisten lab">Asisten Lab</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" class="form-control" id="editPassword" placeholder="Kosongkan jika tidak diubah" />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-primary" id="saveEditBtn">Simpan Perubahan</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
     <div
      class="modal fade"
      id="deleteConfirmModal"
      tabindex="-1"
      aria-labelledby="deleteConfirmModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="deleteConfirmModalLabel">
              Konfirmasi Hapus
            </h5>
            <button
              type="button"
              class="btn-close btn-close-white"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <div class="modal-body">
            Apakah kamu yakin ingin menghapus admin ini?
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">
              Batal
            </button>
            <button class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
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

// Script Tambah User
const addUserModal = new bootstrap.Modal(document.getElementById("addAdminModal"));
const addUserBtn = document.getElementById("saveAdminBtn");
const addUserForm = document.getElementById("addUserForm");

addUserBtn.addEventListener("click", async () => {
  const formData = new FormData(addUserForm);

  try {
    const res = await fetch("{{ route('users.store') }}", {
      method: "POST",
      headers: {
        "Accept": "application/json",
        "X-CSRF-TOKEN": "{{ csrf_token() }}"
      },
      body: formData
    });

    const result = await res.json();

    if (res.ok) {
      showAlert(result.message || "User berhasil ditambahkan!", "success");
      addUserModal.hide();
      addUserForm.reset();
      setTimeout(() => location.reload(), 1200);
    } else {
      showAlert(result.message || "Gagal menambah user.", "danger");
    }
  } catch (err) {
    console.error(err);
    showAlert("Terjadi kesalahan saat menyimpan user.", "danger");
  }
});

// Script Edit User
document.addEventListener("DOMContentLoaded", () => {
  const modal = new bootstrap.Modal(document.getElementById("editAdminModal"));
  const saveBtn = document.getElementById("saveEditBtn");

  document.querySelectorAll(".btn-edit").forEach(button => {
    button.addEventListener("click", async () => {
      const id = button.dataset.id;
      try {
        const res = await fetch(`/users/${id}/edit`);
        if (!res.ok) throw new Error("Gagal mengambil data user");
        const user = await res.json();

        document.getElementById("editUserId").value = user.id;
        document.getElementById("editName").value = user.name;
        document.getElementById("editEmail").value = user.email;
        document.getElementById("editRole").value = user.role;
        document.getElementById("editPassword").value = "";

        modal.show();
      } catch (err) {
        console.error(err);
        showAlert("Gagal memuat data user", "danger");
      }
    });
  });

  saveBtn.addEventListener("click", async () => {
    const id = document.getElementById("editUserId").value;
    const data = {
      name: document.getElementById("editName").value,
      email: document.getElementById("editEmail").value,
      role: document.getElementById("editRole").value,
      password: document.getElementById("editPassword").value,
      _token: "{{ csrf_token() }}",
      _method: "PUT"
    };

    try {
      const res = await fetch(`/users/${id}`, {
        method: "POST",
        headers: { "Content-Type": "application/json", "Accept": "application/json" },
        body: JSON.stringify(data)
      });

      const result = await res.json();

      if (res.ok) {
        showAlert(result.message || "Data user berhasil diperbarui!", "success");
        modal.hide();
        setTimeout(() => location.reload(), 1200);
      } else {
        showAlert(result.message || "Gagal menyimpan perubahan.", "danger");
      }
    } catch (err) {
      console.error(err);
      showAlert("Terjadi kesalahan saat menyimpan data.", "danger");
    }
  });
});

// Script Delete User
document.addEventListener("DOMContentLoaded", () => {
  let deleteUserId = null;
  const deleteModal = new bootstrap.Modal(document.getElementById("deleteConfirmModal"));
  const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

  // Saat tombol delete diklik
  document.querySelectorAll(".btn.btn-sm.btn-danger[data-id]").forEach(button => {
    button.addEventListener("click", e => {
      e.preventDefault();
      deleteUserId = button.dataset.id; // ambil ID dari atribut data-id
      deleteModal.show();
    });
  });

  // Saat tombol "Hapus" di modal diklik
  confirmDeleteBtn.addEventListener("click", async () => {
    if (!deleteUserId) return;

    try {
      const res = await fetch(`/users/${deleteUserId}`, {
        method: "DELETE",
        headers: {
          "Accept": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
      });

      const result = await res.json();

      if (res.ok) {
        showAlert(result.message || "User berhasil dihapus!", "success");
        deleteModal.hide();
        setTimeout(() => location.reload(), 1000);
      } else {
        showAlert(result.message || "Gagal menghapus user.", "danger");
      }
    } catch (err) {
      console.error(err);
      showAlert("Terjadi kesalahan saat menghapus user.", "danger");
    }
  });
});

// End Script Delete User
</script>
@endsection
