<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo d-flex justify-content-center align-items-center position-relative">
        <a href="/" class="d-flex align-items-center text-decoration-none">
            <span class="app-brand-logo">
                <img src="{{ asset('/backend/assets/img/avatars/logo.png') }}" alt="Logo SPK BPJS" width="100"
                    height="100" style="border-radius: 50%; background-color: #ffffff; padding: 5px;">
            </span>
        </a>

        <!-- Tombol toggle tetap di kanan -->
        <a href="javascript:void(0);"
            class="layout-menu-toggle menu-link text-large position-absolute end-0 d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>


    <!-- Digital Clock -->

    <div class="menu-inner-shadow"></div>
    <hr>
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        {{-- //Masyarakat --}}
        <li class="menu-item {{ Request::is('masyarakat*') ? 'active' : '' }}">
            <a href="/masyarakat" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="kriteria">Data Masyarakat</div>
            </a>
        </li>
        {{-- Kriteria --}}
        @if (auth()->check() && auth()->user()->role_id != 3)
            <li class="menu-item {{ Request::is('kriteria*') ? 'active' : '' }}">
                <a href="/kriteria" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-slider-alt"></i>
                    <div data-i18n="kriteria">Kriteria</div>
                </a>
            </li>
        @endif



        {{-- PENILAIAN --}}
        @if (auth()->check() && auth()->user()->role_id != 3)
            <li class="menu-item {{ Request::is('penilaian*') ? 'active' : '' }}">
                <a href="/penilaian" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
                    <div data-i18n="Penilaian">Penilaian</div>
                </a>
            </li>
        @endif



        {{-- HITUNG --}}
        <li class="menu-item {{ Request::is('perhitungan*') ? 'active' : '' }}">
            <a href="/perhitungan" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calculator"></i>
                <div data-i18n="Perhitungan">Hitung</div>
            </a>
        </li>
        {{-- //Hasil Akhir --}}
        <li class="menu-item {{ Request::is('laporan*') ? 'active' : '' }}">
            <a href="/laporan" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
                <div data-i18n="laporan">Laporan</div>
            </a>
        </li>


        @if (auth()->check() && auth()->user()->role_id == 1)
            {{-- ADMIN --}}
            <li class="menu-item {{ Request::is('user*') ? 'active' : '' }}">
                <a href="/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-circle"></i>
                    <div data-i18n="Analytics">Hak Akses</div>
                </a>
            </li>
        @endif


    </ul>
</aside>
