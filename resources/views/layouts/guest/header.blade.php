<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
            <h1 class="sitename">Dokumen Publik</h1>
        </a>

        {{-- Navigation --}}
        <nav id="navmenu" class="navmenu">
            <ul>
                <li>
                    <a href="{{ route('about') }}"
                        class="{{ request()->routeIs('about') || request()->routeIs('about.*') ? 'active' : '' }}">
                        About
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard') || request()->routeIs('dashboard.*') ? 'active' : '' }}">
                        Home
                    </a>
                </li>

                <li>
                    <a href="{{ route('pages.user.index') }}" class="{{ request()->routeIs('user.*') ? 'active' : '' }}">
                        User
                    </a>
                </li>

                <li>
                    <a href="{{ route('warga.index') }}" class="{{ request()->routeIs('warga.*') ? 'active' : '' }}">
                        Warga
                    </a>
                </li>

                <li>
                    <a href="{{ route('jenis.index') }}" class="{{ request()->routeIs('jenis.*') ? 'active' : '' }}">
                        Jenis Dokumen
                    </a>
                </li>

                <li>
                    <a href="{{ route('kategori.index') }}"
                        class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                        Kategori
                    </a>
                </li>


                <li>
                    <a href="{{ route('dokumen.index') }}"
                        class="{{ request()->routeIs('dokumen.*') ? 'active' : '' }}">
                        Dokumen
                    </a>
                </li>


                <li>
                    <a href="{{ route('lampiran.index') }}"
                        class="{{ request()->routeIs('lampiran.*') ? 'active' : '' }}">
                        Lampiran
                    </a>
                </li>

                <li>
                    <a href="{{ route('riwayat.index') }}"
                        class="{{ request()->routeIs('riwayat.*') ? 'active' : '' }}">
                        Riwayat
                    </a>
                </li>

                {{-- ✅ Tampilkan Login jika belum login, dan Logout jika sudah login --}}
                @auth
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm ms-2">Logout</button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">
                            Login
                        </a>
                    </li>
                @endauth
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>
