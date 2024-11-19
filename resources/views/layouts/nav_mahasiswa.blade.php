<ul class="nav-main">
    <!-- Dashboard -->
    <li class="nav-main-item">
        <a
            class="nav-main-link {{ Request::is('mahasiswa/dashboard') || (Request::is('mahasiswa/dashboard/*') && !Request::is('mahasiswa/dashboard/create')) ? 'active' : '' }}"
            href="/mahasiswa/dashboard"
        >
            <i class="nav-main-link-icon si si-speedometer"></i>
            <span class="nav-main-link-name">Dashboard</span>
        </a>
    </li>

    <li class="nav-main-heading">Heading</li>
    
    <!-- Profil -->
    <li class="nav-main-item">
        <a
            class="nav-main-link {{ Request::is('mahasiswa/*/edit') && !Request::is('mahasiswa/dashboard/*') ? 'active' : '' }}"
            href="{{ route('mahasiswa.edit', auth()->user()->username) }}"
        >
            <i class="nav-main-link-icon si si-user"></i>
            <span class="nav-main-link-name">Profil</span>
        </a>
    </li>
    
    <!-- Tambah Surat -->
    <li class="nav-main-item">
        <a
            class="nav-main-link {{ Request::is('mahasiswa/dashboard/create') ? 'active' : '' }}"
            href="/mahasiswa/dashboard/create"
        >
            <i class="nav-main-link-icon si si-plus"></i>
            <span class="nav-main-link-name">Tambah Surat</span>
        </a>
    </li>
</ul>