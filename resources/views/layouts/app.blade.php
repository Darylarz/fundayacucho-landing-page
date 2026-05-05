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
        
        /* Enhanced Navbar Styles */
        .navbar-brand {
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 0.5rem;
            margin-top: 0.5rem;
        }
        
        .dropdown-item {
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            border-radius: 0.25rem;
            margin: 0.25rem 0.5rem;
        }
        
        .dropdown-item:hover {
            background-color: var(--color-primario);
            color: white;
            transform: translateX(5px);
        }
        
        .dropdown-item:focus {
            background-color: var(--color-primario);
            color: white;
            outline: 2px solid var(--color-acento);
            outline-offset: 2px;
        }
        
        .dropdown-divider {
            margin: 0.5rem 1rem;
            border-color: rgba(0, 0, 0, 0.1);
        }
        
        .nav-link {
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-link:hover {
            color: var(--color-acento) !important;
            transform: translateY(-2px);
        }
        
        .nav-link.active {
            color: var(--color-acento) !important;
            font-weight: 600;
        }
        
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: var(--color-acento);
        }
        
        /* Mobile Navigation Enhancements */
        @media (max-width: 991.98px) {
            .navbar-nav {
                padding: 1rem 0;
            }
            
            .nav-item {
                margin: 0.25rem 0;
            }
            
            .nav-link {
                padding: 0.75rem 1rem;
                border-radius: 0.5rem;
                margin: 0 0.5rem;
            }
            
            .nav-link:hover {
                background-color: rgba(255, 255, 255, 0.1);
                transform: none;
            }
            
            .dropdown-menu {
                border: none;
                background-color: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                margin: 0.5rem 1rem;
            }
            
            .dropdown-item {
                color: var(--color-primario);
                margin: 0.25rem 0;
            }
            
            .dropdown-item:hover {
                background-color: var(--color-primario);
                color: white;
            }
        }
        
        /* Keyboard Accessibility */
        .dropdown.show .dropdown-toggle {
            color: var(--color-acento) !important;
        }
        
        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 128, 0, 0.25);
        }
        
        /* Animation for dropdown */
        .dropdown-menu {
            animation: slideDown 0.3s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
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
    
    <!-- Enhanced Navbar JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced keyboard navigation for dropdowns
            const dropdowns = document.querySelectorAll('.dropdown');
            
            dropdowns.forEach(function(dropdown) {
                const toggle = dropdown.querySelector('.dropdown-toggle');
                const menu = dropdown.querySelector('.dropdown-menu');
                
                // Handle keyboard navigation
                toggle.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        dropdown.classList.toggle('show');
                        menu.classList.toggle('show');
                        
                        if (dropdown.classList.contains('show')) {
                            // Focus first menu item
                            const firstItem = menu.querySelector('.dropdown-item');
                            if (firstItem) {
                                setTimeout(() => firstItem.focus(), 100);
                            }
                        }
                    }
                    
                    if (e.key === 'Escape' && dropdown.classList.contains('show')) {
                        dropdown.classList.remove('show');
                        menu.classList.remove('show');
                        toggle.focus();
                    }
                });
                
                // Handle arrow key navigation in dropdown
                menu.addEventListener('keydown', function(e) {
                    const items = Array.from(menu.querySelectorAll('.dropdown-item'));
                    const currentIndex = items.findIndex(item => item === document.activeElement);
                    
                    if (e.key === 'ArrowDown') {
                        e.preventDefault();
                        const nextIndex = (currentIndex + 1) % items.length;
                        items[nextIndex].focus();
                    }
                    
                    if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        const prevIndex = currentIndex === 0 ? items.length - 1 : currentIndex - 1;
                        items[prevIndex].focus();
                    }
                    
                    if (e.key === 'Escape') {
                        dropdown.classList.remove('show');
                        menu.classList.remove('show');
                        toggle.focus();
                    }
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!dropdown.contains(e.target)) {
                        dropdown.classList.remove('show');
                        menu.classList.remove('show');
                    }
                });
            });
            
            // Mobile menu enhancement
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            
            // Close mobile menu when clicking on a link
            const mobileLinks = navbarCollapse.querySelectorAll('.nav-link:not(.dropdown-toggle)');
            mobileLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 991.98) {
                        navbarCollapse.classList.remove('show');
                    }
                });
            });
            
            // Handle mobile dropdowns
            const mobileDropdowns = navbarCollapse.querySelectorAll('.dropdown');
            mobileDropdowns.forEach(function(dropdown) {
                const toggle = dropdown.querySelector('.dropdown-toggle');
                
                toggle.addEventListener('click', function(e) {
                    if (window.innerWidth <= 991.98) {
                        e.preventDefault();
                        
                        // Close other mobile dropdowns
                        mobileDropdowns.forEach(function(otherDropdown) {
                            if (otherDropdown !== dropdown) {
                                otherDropdown.classList.remove('show');
                                otherDropdown.querySelector('.dropdown-menu').classList.remove('show');
                            }
                        });
                        
                        dropdown.classList.toggle('show');
                        dropdown.querySelector('.dropdown-menu').classList.toggle('show');
                    }
                });
            });
            
            // Add smooth scroll behavior for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
                anchor.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href !== '#') {
                        const target = document.querySelector(href);
                        if (target) {
                            e.preventDefault();
                            const offsetTop = target.offsetTop - 80; // Account for sticky navbar
                            window.scrollTo({
                                top: offsetTop,
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });
            
            // Active state management based on scroll position
            window.addEventListener('scroll', function() {
                const sections = document.querySelectorAll('section[id]');
                const scrollY = window.pageYOffset;
                
                sections.forEach(function(section) {
                    const sectionHeight = section.offsetHeight;
                    const sectionTop = section.offsetTop - 100;
                    const sectionId = section.getAttribute('id');
                    
                    if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                        const correspondingLink = document.querySelector(`.nav-link[href="#${sectionId}"]`);
                        if (correspondingLink) {
                            document.querySelectorAll('.nav-link').forEach(function(link) {
                                link.classList.remove('active');
                            });
                            correspondingLink.classList.add('active');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>