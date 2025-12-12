<style>
    /* Logo Styling */
    .logo {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        transition: transform 0.3s ease;
    }

    .logo:hover {
        transform: translateY(-2px);
    }

    .logo-image {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid white;
        box-shadow: 0 4px 15px rgba(246, 167, 35, 0.3);
        transition: all 0.4s ease;
    }

    .logo-image:hover {
        transform: rotate(360deg) scale(1.1);
        box-shadow: 0 6px 20px rgba(246, 167, 35, 0.5);
    }

    .sitename {
        color: white;
        font-size: 24px;
        font-weight: 700;
        letter-spacing: 1px;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .logo-image {
            width: 38px;
            height: 38px;
            border: 2px solid white;
        }

        .sitename {
            font-size: 18px;
        }
    }
</style>

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
            <img src="https://images.unsplash.com/photo-1595409583957-5d1ec5869de9?q=80&w=686&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                 alt="Logo Dokumen Publik"
                 class="logo-image">
            <h1 class="sitename">Dokumen Publik</h1>
        </a>

        {{-- Navigation --}}
        <nav id="navmenu" class="navmenu">
            <ul>

                <li>
                    <a href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard') || request()->routeIs('dashboard.*') ? 'active' : '' }}">
                        Home
                    </a>
                </li>

                 <li>
                    <a href="{{ route('about') }}"
                        class="{{ request()->routeIs('about') || request()->routeIs('about.*') ? 'active' : '' }}">
                        About
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
