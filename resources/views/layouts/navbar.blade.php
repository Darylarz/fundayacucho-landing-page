@if(optional($config)->cintillo_path)
    <div class="container-fluid p-0">
        <img src="{{ Storage::url($config->cintillo_path) }}" alt="Cintillo Institucional" class="w-100">
    </div>
@endif

<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}">Inicio</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('historia') }}">Historia</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('mision') }}">Misión y Visión</a></li>
            </ul>
            <a class="navbar-brand ms-auto" href="{{ route('home') }}">
                @if(optional($config)->logo_path)
                    <img src="{{ Storage::url($config->logo_path) }}" alt="Logo" height="50">
                @else
                    Fundayacucho
                @endif
            </a>
        </div>
    </div>
</nav>