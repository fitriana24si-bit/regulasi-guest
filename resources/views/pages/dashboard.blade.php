@extends('layouts.guest.main')

@section('title', 'Dashboard | Dokumen Publik')
@include('layouts.guest.css')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <img src="https://plus.unsplash.com/premium_photo-1664299493948-1103ac2c651d?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
             alt="" data-aos="fade-in">

        <div class="container text-center" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2>Selamat Datang Di Website Regulasi Desa</h2>
                    <p>Ini adalah halaman utama</p>
                    <a href="#features" class="btn-get-started">Mulai Sekarang</a>
                </div>
            </div>
        </div>

        <a href="https://wa.me/6289525819432?text=Halo%20Admin%20Cantik,%20saya%20ingin%20bertanya%20tentang%20produk hukum."
            class="whatsapp-float" target="_blank" title="Chat via WhatsApp">
            <i class="bi bi-whatsapp"></i>
        </a>
    </section>

    <!-- Features/Menu Cards Section -->
    <section id="features" class="features section" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 80px 0;">
        <div class="container">
            <div class="section-title text-center mb-5" data-aos="fade-up">
                <h2 style="font-size: 42px; font-weight: 700; background: linear-gradient(135deg, #f6a723 0%, #e67e22 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    Menu Sistem
                </h2>
                <p style="color: #6c757d; font-size: 18px; margin-top: 15px;">
                    Akses cepat ke berbagai fitur sistem dokumen publik
                </p>
                {{-- Role Indicator --}}
                <div class="mt-3">
                    <span class="badge bg-{{ auth()->user()->role === 'admin' ? 'danger' : 'primary' }} p-2">
                        <i class="bi bi-person-badge me-1"></i>
                        {{ auth()->user()->role === 'admin' ? 'Administrator (Full Access)' : 'User (Read Only)' }}
                    </span>
                </div>
            </div>

            <div class="row g-4">
                <!-- Card Dokumen -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ route('dokumen.index') }}" class="feature-card">
                        <div class="icon-box">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <h3>Dokumen</h3>
                        <p>Kelola dan akses dokumen publik</p>
                        <div class="arrow">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </a>
                </div>

                <!-- Card Lampiran -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('lampiran.index') }}" class="feature-card">
                        <div class="icon-box">
                            <i class="bi bi-paperclip"></i>
                        </div>
                        <h3>Lampiran</h3>
                        <p>Lihat lampiran dokumen</p>
                        <div class="arrow">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </a>
                </div>

                <!-- Card Kategori -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('kategori.index') }}" class="feature-card">
                        <div class="icon-box">
                            <i class="bi bi-tags"></i>
                        </div>
                        <h3>Kategori</h3>
                        <p>Browse berdasarkan kategori</p>
                        <div class="arrow">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </a>
                </div>

                <!-- Card Jenis Dokumen -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('jenis.index') }}" class="feature-card">
                        <div class="icon-box">
                            <i class="bi bi-folder"></i>
                        </div>
                        <h3>Jenis Dokumen</h3>
                        <p>Lihat jenis-jenis dokumen</p>
                        <div class="arrow">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </a>
                </div>

                <!-- Card User - Hanya untuk Admin -->
                @if(auth()->user()->role === 'admin')
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <a href="{{ route('pages.user.index') }}" class="feature-card">
                            <div class="icon-box">
                                <i class="bi bi-people"></i>
                            </div>
                            <h3>User</h3>
                            <p>Manajemen pengguna sistem</p>
                            <div class="arrow">
                                <i class="bi bi-arrow-right"></i>
                            </div>
                        </a>
                    </div>
                @endif

                <!-- Card Warga -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <a href="{{ route('warga.index') }}" class="feature-card">
                        <div class="icon-box">
                            <i class="bi bi-person-badge"></i>
                        </div>
                        <h3>Warga</h3>
                        <p>Data warga desa</p>
                        <div class="arrow">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </a>
                </div>

                <!-- Card Riwayat -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="700">
                    <a href="{{ route('riwayat.index') }}" class="feature-card">
                        <div class="icon-box">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <h3>Riwayat</h3>
                        <p>Lihat riwayat aktivitas</p>
                        <div class="arrow">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </a>
                </div>

                <!-- Card About -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="800">
                    <a href="{{ route('about') }}" class="feature-card">
                        <div class="icon-box">
                            <i class="bi bi-info-circle"></i>
                        </div>
                        <h3>About</h3>
                        <p>Tentang sistem ini</p>
                        <div class="arrow">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="team section" style="background: white; padding: 80px 0;">
        <div class="container">
            <div class="section-title text-center mb-5" data-aos="fade-up">
                <h2 style="font-size: 42px; font-weight: 700; background: linear-gradient(135deg, #f6a723 0%, #e67e22 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    Tim Pengembang
                </h2>
                <p style="color: #6c757d; font-size: 18px; margin-top: 15px;">
                    Kenali tim di balik sistem ini
                </p>
            </div>

            <div class="row justify-content-center g-4">
                <!-- Team Member 1 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop" alt="Developer 1">
                            <div class="team-overlay">
                                <div class="social-links">
                                    <a href="https://linkedin.com/in/yourprofile" target="_blank" title="LinkedIn">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                    <a href="https://github.com/yourprofile" target="_blank" title="GitHub">
                                        <i class="bi bi-github"></i>
                                    </a>
                                    <a href="https://www.instagram.com/ftrntsy/followers/" target="_blank" title="Instagram">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                    <a href="fitriana24si@mahasiswa.pcr.ac.id" title="Email">
                                        <i class="bi bi-envelope"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="team-info">
                            <h3>Fitriana Tasya</h3>
                            <span class="position">Full Stack Developer</span>
                            <p class="nim">NIM: 2457301058</p>
                            <p class="prodi">Sistem Informasi</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=400&fit=crop" alt="Developer 2">
                            <div class="team-overlay">
                                <div class="social-links">
                                    <a href="https://linkedin.com/in/yourprofile" target="_blank" title="LinkedIn">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                    <a href="https://github.com/yourprofile" target="_blank" title="GitHub">
                                        <i class="bi bi-github"></i>
                                    </a>
                                    <a href="https://instagram.com/yourprofile" target="_blank" title="Instagram">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                    <a href="mailto:your@email.com" title="Email">
                                        <i class="bi bi-envelope"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="team-info">
                            <h3>Edith Helena</h3>
                            <span class="position">UI/UX Designer</span>
                            <p class="nim">NIM: 987654321</p>
                            <p class="prodi">Sistem Informasi</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&h=400&fit=crop" alt="Developer 3">
                            <div class="team-overlay">
                                <div class="social-links">
                                    <a href="https://linkedin.com/in/yourprofile" target="_blank" title="LinkedIn">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                    <a href="https://github.com/yourprofile" target="_blank" title="GitHub">
                                        <i class="bi bi-github"></i>
                                    </a>
                                    <a href="https://instagram.com/yourprofile" target="_blank" title="Instagram">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                    <a href="mailto:your@email.com" title="Email">
                                        <i class="bi bi-envelope"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="team-info">
                            <h3>Anggota Tim Ketiga</h3>
                            <span class="position">Backend Developer</span>
                            <p class="nim">NIM: 456789123</p>
                            <p class="prodi">Teknik Komputer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Feature Cards Styling */
        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 35px 25px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: block;
            height: 100%;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(135deg, #f6a723 0%, #e67e22 100%);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(246, 167, 35, 0.3);
        }

        .feature-card .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #f6a723 0%, #e67e22 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s ease;
        }

        .feature-card:hover .icon-box {
            transform: rotate(360deg) scale(1.1);
        }

        .feature-card .icon-box i {
            font-size: 36px;
            color: white;
        }

        .feature-card h3 {
            font-size: 22px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 12px;
            transition: color 0.3s ease;
        }

        .feature-card:hover h3 {
            color: #f6a723;
        }

        .feature-card p {
            color: #718096;
            font-size: 15px;
            margin-bottom: 20px;
        }

        .feature-card .arrow {
            position: absolute;
            bottom: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: translateX(-10px);
            transition: all 0.3s ease;
        }

        .feature-card:hover .arrow {
            opacity: 1;
            transform: translateX(0);
        }

        .feature-card .arrow i {
            color: #f6a723;
            font-size: 20px;
        }

        /* Team Cards Styling */
        .team-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(246, 167, 35, 0.3);
        }

        .team-image {
            position: relative;
            overflow: hidden;
            height: 350px;
        }

        .team-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .team-card:hover .team-image img {
            transform: scale(1.1);
        }

        .team-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(246, 167, 35, 0.9) 0%, rgba(230, 126, 34, 0.9) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .team-card:hover .team-overlay {
            opacity: 1;
        }

        .social-links {
            display: flex;
            gap: 15px;
        }

        .social-links a {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f6a723;
            font-size: 22px;
            transition: all 0.3s ease;
            transform: translateY(20px);
            opacity: 0;
        }

        .team-card:hover .social-links a {
            transform: translateY(0);
            opacity: 1;
        }

        .team-card:hover .social-links a:nth-child(1) {
            transition-delay: 0.1s;
        }

        .team-card:hover .social-links a:nth-child(2) {
            transition-delay: 0.2s;
        }

        .team-card:hover .social-links a:nth-child(3) {
            transition-delay: 0.3s;
        }

        .team-card:hover .social-links a:nth-child(4) {
            transition-delay: 0.4s;
        }

        .social-links a:hover {
            background: #2d3748;
            color: white;
            transform: translateY(-5px) scale(1.1);
        }

        .team-info {
            padding: 30px 25px;
            text-align: center;
        }

        .team-info h3 {
            font-size: 24px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .team-info .position {
            display: block;
            color: #f6a723;
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .team-info .nim,
        .team-info .prodi {
            color: #718096;
            font-size: 14px;
            margin: 5px 0;
        }

        /* WhatsApp Float */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(145deg, #25d366, #1ebe5d);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
            z-index: 999;
            transition: all 0.3s ease;
            animation: floatIn 0.7s ease-out;
        }

        .whatsapp-float:hover {
            transform: scale(1.12) rotate(8deg);
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.3);
            background: linear-gradient(145deg, #20ba5a, #25d366);
        }

        @keyframes floatIn {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .feature-card {
                padding: 25px 20px;
            }

            .team-image {
                height: 300px;
            }

            .social-links {
                gap: 10px;
            }

            .social-links a {
                width: 45px;
                height: 45px;
                font-size: 20px;
            }
        }
    </style>
@endsection
