@extends('layouts.app')

@section('content')
    <x-navbar setActive="ManagementUser" />
<<<<<<< HEAD

    <!-- Alert container -->
    <div class="alert-container"></div>

    <div class="container">
=======
>>>>>>> 333f7525776eb4459c1fb5be5d935b2f8e459b77

    <!-- Alert container -->
    <div class="alert-container"></div>

<<<<<<< HEAD
        <div class="card shadow-lg">
            <div class="card-body">
                {{-- <div class="text-end mb-3">
                    
                </div> --}}
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                    <h5 class="fw-bold mb-0" style="color: #0d6efd">
                        Managemen User
                    </h5>
                    <div class="d-flex align-items-center gap-2 flex-nowrap">
                        <a href="{{ route('users.create') }}" class="btn btn-primary">➕ Tambah User</a>
                    </div>
                </div>
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role === 'admin')
                                        <span class="badge bg-danger">Admin</span>
                                    @else
                                        <span class="badge bg-info text-dark">Asisten Lab</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                    @if (Auth::id() !== $user->id)
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Belum ada data user.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
=======
    <!-- Content -->
    <div class="container py-5 mt-5">
      <div class="card shadow-sm rounded-4">
        <div class="card-body">
          <div
            class="d-flex justify-content-between align-items-center mb-4 flex-wrap"
          >
            <h5 class="fw-bold mb-0" style="color: #0d6efd;" >Management User</h5>
            <div class="d-flex align-items-center gap-2 flex-nowrap">
              <select class="form-select form-select-sm filter-select">
                <option selected>Semua Jurusan</option>
                <option>Teknik Informatika</option>
                <option>Sistem Informasi</option>
                <option>Teknik Komputer</option>
                <option>Manajemen Informatika</option>
              </select>
              <input
                type="text"
                class="form-control form-control-sm search-box"
                placeholder="Cari admin..."
              />
                <div class="text-end">
                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm px-3"><i class="bi bi-person-plus me-1"></i> <span>Tambah User</span></a>
                </div>
>>>>>>> 333f7525776eb4459c1fb5be5d935b2f8e459b77
            </div>
          </div>

          <div class="table-responsive">
            <table class="table align-middle table-bordered text-center">
              <thead class="table-light">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>NIM</th>
                  <th>Role</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $index => $user)
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
                        <td>{{ $user->nim}}</td>
                        <td>
                            @if ($user->role === 'admin')
                                <span class="badge bg-danger">Admin</span>
                            @else
                                <span class="badge bg-info text-dark">Asisten Lab</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>

                            @if (Auth::id() !== $user->id)
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            @endif
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
@endsection
