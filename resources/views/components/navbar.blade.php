@php
  use Illuminate\Support\Str;
@endphp

@props(['setActive'])

<header class="header shadow-sm">
      <nav
        class="navbar navbar-expand-lg navbar-light bg-white bg-opacity-75 fixed-top shadow-sm"
      >
        <div class="container">
          <a class="navbar-brand fw-bold text-primary fs-4" href="{{ route('users.home') }}">LabLogix</a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
              <li class="nav-item mx-2">
                <a class="nav-link {{ $setActive == 'Home' ? 'active text-primary' : '' }}" href="{{ route('users.home') }}">Home</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link {{ $setActive == 'Scanner' ? 'active text-primary' : '' }}" href="{{ route('absensi.index') }}">Scanner</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link fw-semibold {{ $setActive == 'Rekap' ? 'active text-primary' : '' }}" href="{{ route('absensi.rekap') }}"
                  >Report</a
                >
              </li>
              <li class="nav-item dropdown mx-2">
                <a
                  class="nav-link dropdown-toggle {{ $setActive == 'ManagementMahasiswa' || $setActive == 'ManagementUser' ? 'active text-primary' : '' }}"
                  href="#"
                  id="managementDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Management
                </a>
                <ul class="dropdown-menu border-0 shadow-sm">
                  <li>
                    <a class="dropdown-item {{ $setActive == 'ManagementMahasiswa' ? 'active' : '' }}" href="{{ route('mahasiswa.index') }}">
                      Management Mahasiswa
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item {{ $setActive == 'ManagementUser' ? 'active' : '' }}" href="{{ route('users.index') }}">
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
