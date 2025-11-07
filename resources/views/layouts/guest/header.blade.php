 <header id="header" class="header d-flex align-items-center fixed-top">
     <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

         <a href="index.html" class="logo d-flex align-items-center">
             <!-- Uncomment the line below if you also wish to use an image logo -->
             <!-- <img src="assets/img/logo.png" alt=""> -->
             <h1 class="sitename">Dokumen Publik</h1>
         </a>

         <nav id="navmenu" class="navmenu">
             <ul>
                 <li>
                     <a href="{{ route('dashboard') }}"
                         class="{{ request()->routeIs('dashboard') || request()->routeIs('dashboard.*') ? 'active' : '' }}">
                         Home
                     </a>
                 </li>

                 <li> <a href="{{ route('warga.index') }}" class="{{ request()->routeIs('warga.*') ? 'active' : '' }}">
                         Warga
                     </a></li>
                 <li>
    <a href="{{ route('jenis.index') }}"
       class="{{ request()->routeIs('jenis.*') ? 'active' : '' }}">
       Jenis Dokumen
    </a>
</li>

                 <li><a href="#portfolio">Kategori</a></li>
                 <li><a href="#team">Lampiran</a></li>
                 <li><a href="#team">Riwayat</a></li>
                 <li><a href="#team">Login</a></li>

             </ul>
             <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
         </nav>

     </div>
 </header>
