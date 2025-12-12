@extends('layouts.guest.main')
@include('layouts.guest.css')

@section('title', 'Tentang Kami | Dokumen Publik')

@section('content')
<style>
    .about-hero {
        background: linear-gradient(135deg, #f6a723 0%, #e67e22 100%);
        padding: 100px 0 80px;
        position: relative;
        overflow: hidden;
    }

    .about-hero::before,
    .about-hero::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 8s ease-in-out infinite;
    }

    .about-hero::before {
        width: 500px;
        height: 500px;
        top: -250px;
        right: -200px;
    }

    .about-hero::after {
        width: 400px;
        height: 400px;
        bottom: -200px;
        left: -150px;
        animation-delay: 2s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-30px); }
    }

    .about-hero .container {
        position: relative;
        z-index: 1;
    }

    .about-hero h1 {
        color: white;
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
    }

    .about-hero p {
        color: rgba(255, 255, 255, 0.95);
        font-size: 20px;
        max-width: 700px;
        margin: 0 auto 30px;
    }

    .decorative-line {
        width: 100px;
        height: 5px;
        background: white;
        margin: 0 auto;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
    }

    .about-content {
        background: white;
        padding: 80px 0;
    }

    .content-card {
        background: white;
        border-radius: 25px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        height: 100%;
    }

    .content-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(246, 167, 35, 0.2);
    }

    .about-image-wrapper {
        position: relative;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
    }

    .about-image-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(246, 167, 35, 0.2) 0%, rgba(230, 126, 34, 0.2) 100%);
        z-index: 1;
        transition: opacity 0.4s ease;
    }

    .about-image-wrapper:hover::before {
        opacity: 0;
    }

    .about-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .about-image-wrapper:hover img {
        transform: scale(1.1);
    }

    .about-content h3 {
        font-size: 32px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 20px;
        position: relative;
        padding-left: 20px;
    }

    .about-content h3::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 5px;
        height: 80%;
        background: linear-gradient(135deg, #f6a723 0%, #e67e22 100%);
        border-radius: 10px;
    }

    .about-content p {
        color: #718096;
        font-size: 16px;
        line-height: 1.8;
        margin-bottom: 15px;
    }

    .feature-list {
        list-style: none;
        padding: 0;
        margin-top: 25px;
    }

    .feature-list li {
        padding: 15px 20px;
        margin-bottom: 12px;
        background: linear-gradient(135deg, #fff8ec 0%, #ffe9d0 100%);
        border-radius: 15px;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .feature-list li:hover {
        transform: translateX(10px);
        box-shadow: 0 5px 15px rgba(246, 167, 35, 0.2);
    }

    .feature-list li i {
        font-size: 24px;
        color: #f6a723;
        margin-right: 15px;
        min-width: 30px;
    }

    .feature-list li span {
        color: #2d3748;
        font-size: 15px;
        font-weight: 500;
    }

    .vision-mission {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 80px 0;
    }

    .vm-card {
        background: white;
        border-radius: 25px;
        padding: 50px 40px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .vm-card::before {
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

    .vm-card:hover::before {
        transform: scaleX(1);
    }

    .vm-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(246, 167, 35, 0.2);
    }

    .vm-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #f6a723 0%, #e67e22 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        transition: all 0.4s ease;
    }

    .vm-card:hover .vm-icon {
        transform: rotate(360deg) scale(1.1);
    }

    .vm-icon i {
        font-size: 40px;
        color: white;
    }

    .vm-card h4 {
        font-size: 28px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 20px;
        text-align: center;
    }

    .vm-card p {
        color: #718096;
        font-size: 16px;
        line-height: 1.8;
        text-align: center;
    }

    .stats-section {
        background: linear-gradient(135deg, #f6a723 0%, #e67e22 100%);
        padding: 60px 0;
        margin: 80px 0;
    }

    .stat-card {
        text-align: center;
        padding: 20px;
    }

    .stat-card .stat-number {
        font-size: 48px;
        font-weight: 700;
        color: white;
        margin-bottom: 10px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .stat-card .stat-label {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
    }

    .stat-divider {
        width: 2px;
        height: 60px;
        background: rgba(255, 255, 255, 0.3);
        margin: 0 auto;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .about-hero {
            padding: 80px 0 60px;
        }

        .about-hero h1 {
            font-size: 32px;
        }

        .about-hero p {
            font-size: 16px;
        }

        .about-content {
            padding: 60px 0;
        }

        .content-card {
            padding: 30px;
        }

        .about-content h3 {
            font-size: 24px;
        }

        .vision-mission {
            padding: 60px 0;
        }

        .vm-card {
            padding: 40px 30px;
            margin-bottom: 20px;
        }

        .stat-divider {
            display: none;
        }

        .stat-card {
            margin-bottom: 20px;
        }
    }
</style>

<!-- Hero Section -->
<section class="about-hero">
    <div class="container text-center" data-aos="fade-up">
        <h1>Tentang Sistem Informasi Produk Hukum</h1>
        <p>Platform digital yang mempermudah akses terhadap berbagai produk hukum dan jenis dokumen resmi</p>
        <div class="decorative-line"></div>
    </div>
</section>

<!-- Main Content Section -->
<section class="about-content">
    <div class="container" data-aos="fade-up">
        <div class="row align-items-center g-4">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="about-image-wrapper">
                    <img src="https://img.freepik.com/free-vector/legal-document-concept-illustration_114360-4655.jpg"
                         alt="Produk Hukum"
                         class="img-fluid">
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="content-card">
                    <h3>Membangun Akses Hukum yang Lebih Terbuka</h3>
                    <p>
                        Website ini dirancang untuk memudahkan masyarakat dalam menemukan, memahami,
                        dan mengelola berbagai produk hukum seperti peraturan daerah, keputusan, dan dokumen hukum lainnya.
                    </p>

                    <p>
                        Kami percaya bahwa keterbukaan informasi hukum adalah kunci untuk menciptakan pemerintahan yang transparan dan akuntabel.
                        Melalui sistem ini, pengguna dapat menelusuri jenis-jenis dokumen hukum dengan mudah dan memperoleh informasi terbaru.
                    </p>

                    <ul class="feature-list">
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Menampilkan data jenis dan produk hukum secara interaktif</span>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Mendukung validasi dan pengelolaan data secara mudah</span>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Memberikan kemudahan akses untuk masyarakat umum</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-number">1000+</div>
                    <div class="stat-label">Dokumen Hukum</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Kategori</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Pengguna Aktif</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-number">99%</div>
                    <div class="stat-label">Kepuasan</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission Section -->
<section class="vision-mission">
    <div class="container" data-aos="fade-up">
        <div class="row g-4">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="vm-card">
                    <div class="vm-icon">
                        <i class="bi bi-eye"></i>
                    </div>
                    <h4>Visi Kami</h4>
                    <p>
                        Menjadi platform digital yang mampu memperkuat transparansi dan efektivitas informasi hukum,
                        serta menjadi sarana pembelajaran bagi masyarakat dalam mengenal lebih jauh tentang produk dan jenis dokumen hukum.
                    </p>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="vm-card">
                    <div class="vm-icon">
                        <i class="bi bi-bullseye"></i>
                    </div>
                    <h4>Misi Kami</h4>
                    <p>
                        Menghadirkan sistem yang informatif, efisien, dan mudah digunakan untuk mendukung pengelolaan produk hukum berbasis digital.
                        Meningkatkan kesadaran masyarakat akan pentingnya akses informasi hukum yang transparan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
