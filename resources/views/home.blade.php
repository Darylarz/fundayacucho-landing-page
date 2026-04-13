@extends('layouts.app')

@section('content')
    {{-- Carrusel --}}
    @if($slides->count() > 0)
    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($slides as $key => $slide)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ Storage::url($slide->image_path) }}" class="d-block w-100" alt="{{ $slide->title }}">
                    @if($slide->title)
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="bg-dark bg-opacity-50 d-inline-block px-3 py-1 rounded">{{ $slide->title }}</h5>
                    </div>
                    @endif
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
    @endif

    {{-- Invitaciones --}}
    <section class="container my-5">
        @if(auth()->check() && auth()->user()->hasRole('admin'))
            <div class="text-end mb-3">
                <a href="{{ route('admin.invitaciones.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-2"></i>Agregar Invitación
                </a>
            </div>
        @endif
        
        <div class="row text-center justify-content-center">
            @foreach($invitaciones as $invitacion)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <a href="{{ $invitacion->link ?? '#' }}" target="_blank">
                            <img src="{{ Storage::url($invitacion->image_path) }}" class="card-img-top rounded-top hover-scale" alt="{{ $invitacion->title }}" style="height: 200px; object-fit: cover;">
                        </a>
                        @if($invitacion->title)
                        <div class="card-body p-3">
                            <h6 class="card-title fw-bold text-primary">{{ $invitacion->title }}</h6>
                            @if($invitacion->description)
                                <p class="card-text small text-muted">{{ Str::limit($invitacion->description, 80) }}</p>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Noticias --}}
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold text-primary">Noticias Recientes</h2>
            <div class="row">
                @foreach($noticias as $noticia)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ Storage::url($noticia->image_path) }}" class="card-img-top" alt="{{ $noticia->title }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $noticia->title }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($noticia->body, 120) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Libros --}}
    <section class="container my-5">
        <h2 class="text-center mb-5 fw-bold text-primary">Biblioteca Digital</h2>
        <div class="row">
            @foreach($libros as $libro)
                <div class="col-6 col-md-3 mb-4 text-center">
                    <div class="card border-0 h-100">
                        <img src="{{ Storage::url($libro->cover_image_path) }}" class="img-fluid rounded mb-3 mx-auto d-block shadow" alt="{{ $libro->title }}" style="max-height: 250px; width: auto;">
                        <h6 class="fw-bold text-dark">{{ $libro->title }}</h6>
                        <a href="{{ Storage::url($libro->pdf_file_path) }}" class="btn btn-sm btn-outline-primary mt-auto" target="_blank">
                            <i class="bi bi-download"></i> Descargar PDF
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Información --}}
    <section class="py-5 bg-primary text-white">
        <div class="container">
             <div class="row">
                @foreach($informaciones as $info)
                    <div class="col-md-4 mb-4 d-flex align-items-center">
                         <img src="{{ Storage::url($info->image_path) }}" class="me-3 rounded-circle bg-white p-1" style="width: 80px; height: 80px; object-fit: cover;">
                         <div>
                             <h5 class="fw-bold mb-1">{{ $info->title }}</h5>
                             <p class="small mb-0 opacity-75">{{ $info->content }}</p>
                             @if($info->link)
                                 <a href="{{ $info->link }}" class="text-warning small text-decoration-none">Más información &rarr;</a>
                             @endif
                         </div>
                    </div>
                @endforeach
             </div>
        </div>
    </section>
@endsection
