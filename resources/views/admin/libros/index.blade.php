@extends('admin.layouts.admin')

@section('title', 'Libros - Panel Administrativo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="bi bi-book me-2"></i>Gestión de Libros
    </h1>
    <a href="{{ route('admin.libros.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Nuevo Libro
    </a>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Lista de Libros</h5>
            </div>
            <div class="card-body">
                @if($libros->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Portada</th>
                                    <th>Título</th>
                                    <th>Archivo PDF</th>
                                    <th>Fecha</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($libros as $libro)
                                    <tr>
                                        <td>
                                            @if($libro->cover_image_path)
                                                <img src="{{ Storage::url($libro->cover_image_path) }}" 
                                                     alt="{{ $libro->title }}" 
                                                     class="img-thumbnail" 
                                                     style="width: 60px; height: 80px; object-fit: cover;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center" 
                                                     style="width: 60px; height: 80px;">
                                                    <i class="bi bi-book text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $libro->title }}</strong>
                                            @if($libro->author)
                                                <br><small class="text-muted">{{ $libro->author }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($libro->pdf_file_path)
                                                <a href="{{ Storage::url($libro->pdf_file_path) }}" 
                                                   target="_blank" 
                                                   class="btn btn-sm btn-outline-success">
                                                    <i class="bi bi-file-pdf me-1"></i>Ver PDF
                                                </a>
                                            @else
                                                <span class="text-muted">Sin archivo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small>{{ $libro->created_at->format('d/m/Y') }}</small>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.libros.edit', $libro) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="Editar">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form method="POST" 
                                                      action="{{ route('admin.libros.destroy', $libro) }}" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('¿Está seguro de eliminar este libro?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            title="Eliminar">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-book text-muted" style="font-size: 4rem;"></i>
                        <h5 class="mt-3 text-muted">No hay libros registrados</h5>
                        <p class="text-muted">
                            Comience agregando un nuevo libro a la biblioteca digital.
                        </p>
                        <a href="{{ route('admin.libros.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Agregar Primer Libro
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
