@extends('layouts.app')

@section('content')
    <x-navbar setActive="ManagementUser" />

    <!-- Alert container -->
    <div class="alert-container"></div>

    <div class="container">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

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
            </div>
        </div>
    </div>
@endsection
