@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-primary">Panel Administrativo</h2>
    
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Carrusel</h5>
                    <p class="card-text">Gestionar imágenes del inicio.</p>
                    <a href="{{ route('admin.carousel.index') }}" class="btn btn-outline-primary">Ir al módulo</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Noticias</h5>
                    <p class="card-text">Publicar y editar noticias.</p>
                    <a href="{{ route('admin.noticias.index') }}" class="btn btn-outline-primary">Ir al módulo</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Configuración</h5>
                    <p class="card-text">Datos del sitio y redes.</p>
                    <a href="{{ route('admin.config.edit') }}" class="btn btn-outline-primary">Ir al módulo</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
