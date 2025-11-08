@php
    use Illuminate\Support\Str;
@endphp

@props(['setActive'])

<header class="header shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-light bg-white bg-opacity-75 fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary fs-4" href="{{ route('users.home') }}">
                <h4 class="gradient-text text-center" aria-label="LabLogix">
                    <!--
                  Setiap huruf diberi variabel CSS untuk gradiennya,
                  sesuai dengan palet warna di gambar.
                -->
                    <span style="--letter-gradient: linear-gradient(to right, #0077b6, #48cae4);">L</span>
                    <span style="--letter-gradient: linear-gradient(to right, #48cae4, #90e0ef);">a</span>
                    <span style="--letter-gradient: linear-gradient(to right, #ade8f4, #c8f7c5);">b</span>
                    <span style="--letter-gradient: linear-gradient(to right, #90e0ef, #dbeafe);">L</span>
                    <span style="--letter-gradient: linear-gradient(to right, #0077b6, #48cae4);">o</span>
                    <span style="--letter-gradient: linear-gradient(to right, #48cae4, #90e0ef);">g</span>
                    <span style="--letter-gradient: linear-gradient(to right, #ade8f4, #c8f7c5);">i</span>
                    <span style="--letter-gradient: linear-gradient(to right, #90e0ef, #dbeafe);">x</span>
                </h4>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ $setActive == 'Home' ? 'active text-primary' : '' }}"
                            href="{{ route('users.home') }}">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ $setActive == 'Scanner' ? 'active text-primary' : '' }}"
                            href="{{ route('absensi.index') }}">Scanner</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-semibold {{ $setActive == 'Rekap' ? 'active text-primary' : '' }}"
                            href="{{ route('absensi.rekap') }}">Report</a>
                    </li>
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link dropdown-toggle {{ $setActive == 'ManagementMahasiswa' || $setActive == 'ManagementUser' ? 'active text-primary' : '' }}"
                            href="#" id="managementDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Management
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm">
                            <li>
                                <a class="dropdown-item {{ $setActive == 'ManagementMahasiswa' ? 'active' : '' }}"
                                    href="{{ route('mahasiswa.index') }}">
                                    Management Mahasiswa
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ $setActive == 'ManagementUser' ? 'active' : '' }}"
                                    href="{{ route('users.index') }}">
                                    Management User
                                </a>
                            </li>
                        </ul>
                    </li>
                    </li>
                    <li class="nav-item mx-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger px-3">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
