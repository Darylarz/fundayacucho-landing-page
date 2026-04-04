@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Gestión de Carrusel</h2>
        <a href="{{ route('admin.carousel.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nuevo Slide
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 120px;">Imagen</th>
                        <th>Título</th>
                        <th>Orden</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slides as $slide)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $slide->image_path) }}" class="img-thumbnail" style="width: 100px; height: 60px; object-fit: cover;">
                            </td>
                            <td>{{ $slide->title ?? 'Sin título' }}</td>
                            <td>{{ $slide->order }}</td>
                            <td>
                                @if($slide->is_active)
                                    <span class="badge bg-success">Activo</span>
                                @else
                                    <span class="badge bg-secondary">Inactivo</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="{{ route('admin.carousel.edit', $slide) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.carousel.destroy', $slide) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este slide?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-images d-block mb-2" style="font-size: 2rem;"></i>
                                No hay imágenes configuradas en el carrusel.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection