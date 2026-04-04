<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Panel Administrativo') - Fundayacucho</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    
    @stack('styles')
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-gear-fill me-2"></i>
                Panel Administrativo
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                           href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    </li>
                    
                    <!-- Carrusel -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.carousel.*') ? 'active' : '' }}" 
                           href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-images me-1"></i> Carrusel
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.carousel.index') }}">
                                <i class="bi bi-list-ul me-2"></i> Ver Slides
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.carousel.create') }}">
                                <i class="bi bi-plus-circle me-2"></i> Nuevo Slide
                            </a></li>
                        </ul>
                    </li>
                    
                    <!-- Invitaciones -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.invitaciones.*') ? 'active' : '' }}" 
                           href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-envelope-paper me-1"></i> Invitaciones
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.invitaciones.index') }}">
                                <i class="bi bi-list-ul me-2"></i> Ver Invitaciones
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.invitaciones.create') }}">
                                <i class="bi bi-plus-circle me-2"></i> Nueva Invitación
                            </a></li>
                        </ul>
                    </li>
                    
                    <!-- Noticias -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.noticias.*') ? 'active' : '' }}" 
                           href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-newspaper me-1"></i> Noticias
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.noticias.index') }}">
                                <i class="bi bi-list-ul me-2"></i> Ver Noticias
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.noticias.create') }}">
                                <i class="bi bi-plus-circle me-2"></i> Nueva Noticia
                            </a></li>
                        </ul>
                    </li>
                    
                    <!-- Libros -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.libros.*') ? 'active' : '' }}" 
                           href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-book me-1"></i> Libros
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.libros.index') }}">
                                <i class="bi bi-list-ul me-2"></i> Ver Libros
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.libros.create') }}">
                                <i class="bi bi-plus-circle me-2"></i> Nuevo Libro
                            </a></li>
                        </ul>
                    </li>
                    
                    <!-- Configuración -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.config.*') ? 'active' : '' }}" 
                           href="{{ route('admin.config.edit') }}">
                            <i class="bi bi-gear-wide-connected me-1"></i> Configuración
                        </a>
                    </li>
                </ul>
                
                <!-- User Menu -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('home') }}" target="_blank">
                                <i class="bi bi-eye me-2"></i> Ver Sitio Web
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container-fluid py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <small class="text-muted">
                © {{ date('Y') }} Fundación Gran Mariscal de Ayacucho - Panel Administrativo
            </small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Flash Messages -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var toast = document.createElement('div');
                toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed top-0 end-0 m-3';
                toast.style.zIndex = '9999';
                toast.setAttribute('role', 'alert');
                toast.innerHTML = `
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                `;
                document.body.appendChild(toast);
                var bsToast = new bootstrap.Toast(toast);
                bsToast.show();
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var toast = document.createElement('div');
                toast.className = 'toast align-items-center text-white bg-danger border-0 position-fixed top-0 end-0 m-3';
                toast.style.zIndex = '9999';
                toast.setAttribute('role', 'alert');
                toast.innerHTML = `
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                `;
                document.body.appendChild(toast);
                var bsToast = new bootstrap.Toast(toast);
                bsToast.show();
            });
        </script>
    @endif

    @stack('scripts')
</body>
</html>
