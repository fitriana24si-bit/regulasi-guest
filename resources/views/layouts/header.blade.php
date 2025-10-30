<header id="header" class="header fixed-top">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="{{ route('dashboard') }}" class="logo text-decoration-none">
                <h1 class="mb-0">Dokumen Publik</h1>
            </a>
            <nav id="navbar" class="navbar">
                <ul class="d-flex gap-3">

                    <!-- 🔹 Tambahan Data Warga -->
                    <li><a class="nav-link {{ request()->routeIs('warga.index') ? 'active' : '' }}"
                            href="{{ route('warga.index') }}"><i class="bi bi-people"></i> Data Warga</a></li>

                    <li><a class="nav-link {{ request()->routeIs('jenis.index') ? 'active' : '' }}"
                            href="{{ route('jenis.index') }}"><i class="bi bi-tags"></i> Jenis Dokumen</a></li>
                    <li><a class="nav-link {{ request()->routeIs('kategori.index') ? 'active' : '' }}"
                            href="{{ route('kategori.index') }}"><i class="bi bi-folder2-open"></i> Kategori
                            Dokumen</a></li>
                    <li><a class="nav-link {{ request()->routeIs('dokumen.index') ? 'active' : '' }}"
                            href="{{ route('dokumen.index') }}"><i class="bi bi-file-earmark-text"></i> Dokumen
                            Hukum</a></li>
                    <li><a class="nav-link {{ request()->routeIs('riwayat.index') ? 'active' : '' }}"
                            href="{{ route('riwayat.index') }}"><i class="bi bi-arrow-repeat"></i> Riwayat
                            Perubahan</a></li>
                    <li><a class="nav-link {{ request()->routeIs('lampiran.index') ? 'active' : '' }}"
                            href="{{ route('lampiran.index') }}"><i class="bi bi-paperclip"></i> Lampiran Dokumen</a>
                    </li>
                    <li><a class="nav-link {{ request()->routeIs('login.index') ? 'active' : '' }}"
                            href="{{ route('login.index') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a></li>
                </ul>
            </nav>
        </div>
    </header>
