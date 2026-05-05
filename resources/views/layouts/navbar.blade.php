@if(optional($config)->cintillo_path)
    <div class="container-fluid p-0">
        <img src="{{ Storage::url($config->cintillo_path) }}" alt="Cintillo Institucional" class="w-100">
    </div>
@endif

<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow">
    <div class="container">
        <!-- Brand Logo (visible on mobile) -->
        <a class="navbar-brand" href="{{ route('home') }}">
            @if(optional($config)->logo_path)
                <img src="{{ Storage::url($config->logo_path) }}" alt="Logo Fundayacucho" height="50">
            @else
                <span class="fw-bold text-white">Fundayacucho</span>
            @endif
        </a>
        
        <!-- Mobile toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('home') ? 'active' : '' }}" 
                       href="{{ route('home') }}">
                        <i class="bi bi-house-door me-1"></i> Inicio
                    </a>
                </li>
                
                <!-- Programas Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white {{ request()->routeIs('programas.*') ? 'active' : '' }}" 
                       href="#" id="programasDropdown" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-mortarboard me-1"></i> Programas
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="programasDropdown">
                        <li><a class="dropdown-item" href="{{ route('home') }}#programas-academicos">
                            <i class="bi bi-book me-2"></i> Programas Académicos
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('home') }}#programas-especiales">
                            <i class="bi bi-star me-2"></i> Programas Especiales
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('home') }}#programas-internacionales">
                            <i class="bi bi-globe me-2"></i> Programas Internacionales
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('becarios') }}">
                            <i class="bi bi-award-fill me-2 text-primary"></i> Postular a Programa
                        </a></li>
                    </ul>
                </li>
                
                <!-- Becarios Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white {{ request()->routeIs('becarios') ? 'active' : '' }}" 
                       href="#" id="becariosDropdown" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-people me-1"></i> Becarios
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="becariosDropdown">
                        <li><a class="dropdown-item" href="{{ route('becarios') }}">
                            <i class="bi bi-person-plus me-2"></i> Nueva Postulación
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('home') }}#requisitos">
                            <i class="bi bi-check-circle me-2"></i> Requisitos
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('home') }}#beneficios">
                            <i class="bi bi-gift me-2"></i> Beneficios
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('home') }}#proceso">
                            <i class="bi bi-arrow-right-circle me-2"></i> Proceso de Selección
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('home') }}#testimonios">
                            <i class="bi bi-chat-quote me-2"></i> Testimonios
                        </a></li>
                    </ul>
                </li>
                
                <!-- Biblioteca Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white {{ request()->routeIs('biblioteca.*') ? 'active' : '' }}" 
                       href="#" id="bibliotecaDropdown" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-book-half me-1"></i> Biblioteca
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="bibliotecaDropdown">
                        <li><a class="dropdown-item" href="{{ route('home') }}#libros">
                            <i class="bi bi-collection me-2"></i> Catálogo de Libros
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('home') }}#recursos-digitales">
                            <i class="bi bi-laptop me-2"></i> Recursos Digitales
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('home') }}#revistas">
                            <i class="bi bi-journal-text me-2"></i> Revistas Académicas
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('home') }}#servicios">
                            <i class="bi bi-headset me-2"></i> Servicios Bibliotecarios
                        </a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('historia') ? 'active' : '' }}" 
                       href="{{ route('historia') }}">
                        <i class="bi bi-clock-history me-1"></i> Historia
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('mision') ? 'active' : '' }}" 
                       href="{{ route('mision') }}">
                        <i class="bi bi-bullseye me-1"></i> Misión y Visión
                    </a>
                </li>
            </ul>
            
            <!-- Additional mobile menu items -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item d-lg-none">
                    <a class="nav-link text-white" href="{{ route('becarios') }}">
                        <i class="bi bi-award-fill me-1"></i> Postular a Beca
                    </a>
                </li>
                @if(auth()->check())
                    <li class="nav-item d-lg-none">
                        <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-gear me-1"></i> Panel Admin
                        </a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link text-white btn btn-link">
                                <i class="bi bi-box-arrow-right me-1"></i> Cerrar Sesión
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item d-lg-none">
                        <a class="nav-link text-white" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar Sesión
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>