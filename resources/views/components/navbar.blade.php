@props(['setActive'])

<nav class="navbar navbar-expand-lg">
  <button
    class="navbar-toggler"
    type="button"
    data-bs-toggle="collapse"
    data-bs-target="#navbarSupportedContent6"
    aria-controls="navbarSupportedContent6"
    aria-expanded="false"
    aria-label="Toggle navigation"
  >
    <span class="toggler-icon"></span>
    <span class="toggler-icon"></span>
    <span class="toggler-icon"></span>
  </button>

  <div
    class="collapse navbar-collapse sub-menu-bar"
    id="navbarSupportedContent6"
  >
    <ul id="nav6" class="navbar-nav ms-auto">

      <li class="nav-item">
        <a 
          class="@class(['page-scroll', 'active' => $setActive == 'Home'])" 
          href="#home"
        >Home</a>
      </li>

      <li class="nav-item">
        <a 
          class="@class(['page-scroll', 'active' => $setActive == 'Scanner'])" 
          href="scanner.html"
        >Scanner</a>
      </li>

      <li class="nav-item">
        <a 
          class="@class(['page-scroll', 'active' => $setActive == 'Report'])" 
          href="report.html"
        >Report</a>
      </li>

      <li class="nav-item dropdown">
        <a
          {{-- 
            Ini akan aktif jika $setActive adalah 'Management', 'ManagementUser', 
            atau 'ManagementAdmin' (menggunakan helper 'Str::startsWith') 
          --}}
          class="@class([
            'nav-link',
            'dropdown-toggle',
            'page-scroll',
            'active' => Str::startsWith($setActive, 'Management')
          ])"
          href="#"
          id="managementDropdown"
          role="button"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          Management
        </a>
        <ul
          class="dropdown-menu"
          aria-labelledby="managementDropdown"
        >
          <li>
            <a 
              class="@class(['dropdown-item', 'active' => $setActive == 'ManagementUser'])" 
              href="managementUser.html"
            >Management Mahasiswa</a>
          </li>
          <li>
            <a 
              class="@class(['dropdown-item', 'active' => $setActive == 'ManagementAdmin'])" 
              href="#admin"
            >Management Admin</a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a 
          class="@class(['page-scroll', 'active' => $setActive == 'Login'])" 
          href="#contact"
        >Login</a>
      </li>

    </ul>
  </div>
</nav>