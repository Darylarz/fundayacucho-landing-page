@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Biblioteca Digital</h2>
        <a href="{{ route('admin.libros.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Publicar Libro
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse($libros as $libro)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $libro->cover_image_path) }}" class="card-img-top" alt="{{ $libro->title }}" style="height: 250px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate" title="{{ $libro->title }}">{{ $libro->title }}</h5>
                        <div class="mt-auto pt-3 d-flex justify-content-between">
                            <a href="{{ asset('storage/' . $libro->pdf_file_path) }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="Ver PDF">
                                <i class="bi bi-file-earmark-pdf"></i>
                            </a>
                            <div>
                                <a href="{{ route('admin.libros.edit', $libro) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.libros.destroy', $libro) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este libro?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No hay libros publicados en la biblioteca.
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $libros->links() }}
    </div>
</div>
@endsection