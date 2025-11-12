


    <link href="{{ asset('assets-guest/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets-guest/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link href="{{ asset('assets-guest/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-guest/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-guest/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-guest/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-guest/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-guest/css/main.css') }}" rel="stylesheet">

{{-- jenis dokumen --}}
 <style>
  section#tambah-jenis {
    animation: fadeInUp 0.6s ease-out;
  }

  .form-control {
    border: 1px solid #e0e0e0;
    padding: 12px 16px;
    transition: all 0.3s ease;
  }

  .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.1);
  }

  .btn {
    padding: 10px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .btn:hover {
    transform: translateY(-2px);
  }
</style>
<style>
  section#edit-jenis {
    animation: fadeInUp 0.6s ease-out;
  }

  .form-control {
    border: 1px solid #e0e0e0;
    padding: 12px 16px;
    transition: all 0.3s ease;
  }

  .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.1);
  }

  .btn {
    padding: 10px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .btn:hover {
    transform: translateY(-2px);
  }
</style>

{{-- kategori --}}
<style>
  /* Background halaman */
  body {
    background: linear-gradient(135deg, #ffb347, #ffcc33);
    min-height: 100vh;
  }

  /* Tambah jarak ekstra dari navbar jika diperlukan */
  .container.py-5.mt-5 {
    margin-top: 100px; /* opsional: bisa diatur sesuai tinggi navbar */
  }

  /* Efek hover pada kartu */
  .hover-zoom {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .hover-zoom:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
  }

  /* Kartu tetap putih agar kontras dengan background oranye */
  .card {
    background-color: #fff;
    border-radius: 20px;
  }
</style>

{{-- kategori --}}
<style>
  /* Tambah jarak agar konten tidak ketabrak navbar fixed */
  body {
    padding-top: 100px; /* Sesuaikan tinggi navbar kamu */
  }

  /* Jika navbar kamu lebih tinggi, ubah nilai ini, misal 120px */
  @media (max-width: 768px) {
    body {
      padding-top: 120px;
    }
  }
</style>

{{-- dropdwn --}}
<style>
    /* --- Dropdown Navbar Custom --- */
    .navbar .dropdown ul {
        display: none;
        position: absolute;
        background: #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        margin-top: 10px;
        border-radius: 8px;
        list-style: none;
        padding: 10px 0;
        z-index: 99;
        min-width: 180px;
    }

    .navbar .dropdown:hover > ul {
        display: block;
        animation: fadeDown 0.2s ease-in-out;
    }

    .navbar .dropdown ul li a {
        padding: 10px 20px;
        display: block;
        color: #333;
        transition: background 0.2s ease;
    }

    .navbar .dropdown ul li a:hover {
        background: #f8f9fa;
        color: #0d6efd;
    }

    .navbar .dropdown > a i {
        margin-left: 5px;
        font-size: 0.8em;
    }

    @keyframes fadeDown {
      from {
        opacity: 0;
        transform: translateY(-8px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
