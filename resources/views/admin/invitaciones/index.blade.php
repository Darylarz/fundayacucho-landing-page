@extends('admin.layouts.admin')

@section('title', 'Invitaciones - Panel Administrativo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="bi bi-envelope-paper me-2"></i>Gestión de Invitaciones
    </h1>
    <a href="{{ route('admin.invitaciones.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Nueva Invitación
    </a>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Lista de Invitaciones</h5>
            </div>
            <div class="card-body">
                @if($invitaciones->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Título</th>
                                    <th>Enlace</th>
                                    <th>Orden</th>
                                    <th>Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invitaciones as $invitacion)
                                    <tr>
                                        <td>
                                            @if($invitacion->image_path)
                                                <img src="{{ Storage::url($invitacion->image_path) }}" 
                                                     alt="{{ $invitacion->title }}" 
                                                     class="img-thumbnail" 
                                                     style="width: 80px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center" 
                                                     style="width: 80px; height: 60px;">
                                                    <i class="bi bi-envelope text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $invitacion->title }}</strong>
                                            @if($invitacion->description)
                                                <br><small class="text-muted">{{ Str::limit($invitacion->description, 80) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($invitacion->link)
                                                <a href="{{ $invitacion->link }}" 
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
                                                <i class="bi bi-hash me-1"></i>{{ $invitacion->order }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($invitacion->is_active)
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
                                                <a href="{{ route('admin.invitaciones.edit', $invitacion) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="Editar">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form method="POST" 
                                                      action="{{ route('admin.invitaciones.destroy', $invitacion) }}" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('¿Está seguro de eliminar esta invitación?')">
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
                        <i class="bi bi-envelope-paper text-muted" style="font-size: 4rem;"></i>
                        <h5 class="mt-3 text-muted">No hay invitaciones registradas</h5>
                        <p class="text-muted">
                            Comience agregando una nueva invitación para el formulario de becarios.
                        </p>
                        <a href="{{ route('admin.invitaciones.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Agregar Primera Invitación
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
