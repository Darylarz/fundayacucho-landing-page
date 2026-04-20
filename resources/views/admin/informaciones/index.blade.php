@extends('admin.layouts.admin')

@section('title', 'Información - Panel Administrativo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="bi bi-info-circle me-2"></i>Gestión de Información
    </h1>
    <a href="{{ route('admin.informaciones.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Nueva Información
    </a>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Lista de Información</h5>
            </div>
            <div class="card-body">
                @if($informaciones->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Título</th>
                                    <th>Contenido</th>
                                    <th>Enlace</th>
                                    <th>Orden</th>
                                    <th>Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($informaciones as $informacion)
                                    <tr>
                                        <td>
                                            @if($informacion->image_path)
                                                <img src="{{ Storage::url($informacion->image_path) }}" 
                                                     alt="{{ $informacion->title }}" 
                                                     class="img-thumbnail" 
                                                     style="width: 80px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center" 
                                                     style="width: 80px; height: 60px;">
                                                    <i class="bi bi-info-circle text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $informacion->title }}</strong>
                                        </td>
                                        <td>
                                            {{ Str::limit($informacion->content, 80) }}
                                        </td>
                                        <td>
                                            @if($informacion->link)
                                                <a href="{{ $informacion->link }}" 
                                                   target="_blank" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="Abrir enlace">
                                                    <i class="bi bi-box-arrow-up-right me-1"></i>Ver Enlace
                                                </a>
                                            @else
                                                <span class="text-muted">Sin enlace</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark">
                                                <i class="bi bi-hash me-1"></i>{{ $informacion->order }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($informacion->is_active)
                                                <span class="badge bg-success">
                                                    <i class="bi bi-check-circle me-1"></i>Activa
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    <i class="bi bi-pause-circle me-1"></i>Inactiva
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.informaciones.edit', $informacion) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="Editar">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form method="POST" 
                                                      action="{{ route('admin.informaciones.destroy', $informacion) }}" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('¿Está seguro de eliminar esta información?')">
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
                        <i class="bi bi-info-circle text-muted" style="font-size: 4rem;"></i>
                        <h5 class="mt-3 text-muted">No hay información registrada</h5>
                        <p class="text-muted">
                            Comience agregando nueva información.
                        </p>
                        <a href="{{ route('admin.informaciones.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Agregar Primera Información
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection