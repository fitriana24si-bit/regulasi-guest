@extends('layouts.guest.main')

@section('title', 'Dashboard | Regna')
@include('layouts.guest.css')
@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <img src="https://img.freepik.com/foto-gratis/pemandangan-pegunungan-dengan-kabut_1150-18328.jpg" alt=""
            data-aos="fade-in">

        <div class="container text-center" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2>Selamat Datang Di Website Regulasi Desa</h2>
                    <p>Ini adalah halaman utama</p>
                    <a href="#about" class="btn-get-started">Mulai Sekarang</a>
                </div>
            </div>
        </div>

        <a href="https://wa.me/6289525819432?text=Halo%20Admin%20Cantik,%20saya%20ingin%20bertanya%20tentang%20produk hukum."
            class="whatsapp-float" target="_blank" title="Chat via WhatsApp">
            <i class="bi bi-whatsapp"></i>
        </a>

        <style>
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .btn-primary,
            .btn-outline-primary {
                transition: all 0.3s ease;
            }

            .btn-primary:hover,
            .btn-outline-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(74, 123, 200, 0.3);
            }

            /* 🌿 Floating WhatsApp Style (DIPERBAIKI) */
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

            .whatsapp-float i {
                margin: 0;
                line-height: 1;
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
        </style>
    </section>
@endsection
