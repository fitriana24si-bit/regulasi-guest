
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'Regna - Dashboard Dokumen')</title>

    <meta name="description" content="@yield('description', 'Manajemen Dokumen Hukum Regna')">
    <meta name="keywords" content="@yield('keywords', 'dokumen hukum, kategori, manajemen dokumen, regna')">

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

    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1e40af;
            --primary-light: #3b82f6;
            --secondary-color: #64748b;
            --accent-color: #0ea5e9;
            --success-color: #10b981;
            --bg-light: #f8fafc;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e0f2fe 100%);
            min-height: 100vh;
            color: #1e293b;
        }

        /* Header Styles */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06);
            padding: 1rem 0;
            transition: var(--transition);
            border-bottom: 1px solid rgba(37, 99, 235, 0.1);
        }

        .header.scrolled {
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .logo h1 {
            font-weight: 700;
            font-size: 1.75rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .navbar .nav-link {
            color: #475569;
            font-weight: 500;
            font-size: 0.95rem;
            text-decoration: none;
            padding: 0.7rem 1.2rem;
            border-radius: 12px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .navbar .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            opacity: 0;
            transition: var(--transition);
            z-index: -1;
        }

        .navbar .nav-link:hover {
            color: white;
            transform: translateY(-2px);
        }

        .navbar .nav-link:hover::before {
            opacity: 1;
        }

        .navbar .nav-link.active {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .navbar .nav-link i {
            font-size: 1.1rem;
        }

        /* Main Content */
        main {
            margin-top: 100px;
            min-height: 80vh;
            padding-bottom: 3rem;
        }

        /* Content Card Enhancement */
        .content-wrapper {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(37, 99, 235, 0.1);
            transition: var(--transition);
        }

        .content-wrapper:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        /* Page Title Styling */
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-subtitle {
            color: var(--secondary-color);
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        /* Button Enhancements */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        }

        /* Table Enhancements */
        .table {
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead th {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            color: white;
            font-weight: 600;
            border: none;
            padding: 1rem;
        }

        .table tbody tr {
            transition: var(--transition);
        }

        .table tbody tr:hover {
            background: rgba(37, 99, 235, 0.05);
            transform: scale(1.01);
        }

        /* Footer Styles */
        footer {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(37, 99, 235, 0.1);
            padding: 1.5rem 0;
            box-shadow: 0 -2px 20px rgba(0, 0, 0, 0.06);
        }

        footer p {
            margin: 0;
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        footer strong {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .navbar ul {
                flex-direction: column;
                gap: 0.5rem;
            }

            .navbar .nav-link {
                width: 100%;
                justify-content: center;
            }

            main {
                margin-top: 120px;
            }

            .page-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
