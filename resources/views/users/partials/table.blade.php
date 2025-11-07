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
        @forelse ($users as $index => $user)
            <tr>
                <td>{{ $users->firstItem() + $index }}</td>
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
        @empty
            <tr>
                <td colspan="4" class="text-center text-muted">Tidak ada data ditemukan.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Pagination Links -->
@if ($users->hasPages())
    <div class="d-flex justify-content-center mt-3">
        <nav>
            <ul class="pagination pagination-sm mb-0 shadow-sm rounded-pill">
                {{-- Tombol Sebelumnya --}}
                @if ($users->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link rounded-start-pill">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a href="{{ $users->previousPageUrl() }}" class="page-link rounded-start-pill">&laquo;</a>
                    </li>
                @endif

                {{-- Nomor Halaman --}}
                @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                        <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    </li>
                @endforeach

                {{-- Tombol Berikutnya --}}
                @if ($users->hasMorePages())
                    <li class="page-item">
                        <a href="{{ $users->nextPageUrl() }}" class="page-link rounded-end-pill">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link rounded-end-pill">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
<!-- End Pagination Links -->
