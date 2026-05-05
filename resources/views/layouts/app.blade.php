{{-- Layout Principal --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Fundayacucho') }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --color-primario: #002B48;
            --color-acento: #ff8000;
        }
        .text-primary { color: var(--color-primario) !important; }
        .bg-primary { background-color: var(--color-primario) !important; }
        .btn-primary { background-color: var(--color-primario); border-color: var(--color-primario); }
        .btn-outline-primary { color: var(--color-primario); border-color: var(--color-primario); }
        .btn-outline-primary:hover { background-color: var(--color-primario); color: white; }
        .hover-scale { transition: transform 0.3s ease; }
        .hover-scale:hover { transform: scale(1.05); }
        
        /* Hero Section Styles */
        .hero-section {
            position: relative;
            z-index: 10;
            margin-bottom: 0;
        }
        
        .hero-section .display-4 {
            font-size: clamp(2rem, 5vw, 3.5rem);
        }
        
        .hero-section .lead {
            font-size: clamp(1rem, 2.5vw, 1.25rem);
        }
        
        .hero-icon {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @media (max-width: 768px) {
            .hero-section {
                text-align: center;
            }
            .hero-section .col-lg-8 {
                margin-bottom: 2rem;
            }
            .hero-icon {
                margin-top: 2rem;
            }
            .hero-icon i {
                font-size: 4rem !important;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    @php
        // Aseguramos que la configuración esté disponible en todas las vistas que extiendan este layout
        // Si el controlador no pasó $config, lo buscamos aquí.
        $siteConfig = $config ?? \App\Models\SiteConfig::first();
    @endphp

    @include('layouts.navbar', ['config' => $siteConfig])

    <main class="flex-grow-1">
        @yield('content')
    </main>

    @include('layouts.footer', ['config' => $siteConfig])

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>