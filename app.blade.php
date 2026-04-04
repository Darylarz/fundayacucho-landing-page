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
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    @php
        // Aseguramos que la configuración esté disponible en todas las vistas que extiendan este layout
        $siteConfig = $config ?? \App\Models\SiteConfig::first();
    @endphp

    <x-navbar :config="$siteConfig" />

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <x-footer :config="$siteConfig" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
