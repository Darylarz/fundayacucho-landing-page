@extends('admin.layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Gestión de Noticias</h2>
        <a href="{{ route('admin.noticias.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Redactar Noticia
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Imagen</th>
                            <th>Título</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($noticias as $noticia)
                            <tr>
                                <td>
                                    @if($noticia->image_path)
                                        <img src="{{ asset('storage/' . $noticia->image_path) }}" alt="Noticia" class="img-thumbnail" style="height: 50px; width: 50px; object-fit: cover;">
                                    @else
                                        <span class="text-muted small">Sin img</span>
                                    @endif
                                </td>
                                <td>{{ Str::limit($noticia->title, 50) }}</td>
                                <td>{{ $noticia->created_at->format('d/m/Y') }}</td>
                                <td>
                                    @if($noticia->is_published)
                                        <span class="badge bg-success">Publicada</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Borrador</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.noticias.edit', $noticia) }}" class="btn btn-sm btn-outline-primary me-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.noticias.destroy', $noticia) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Borrar esta noticia?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No hay noticias registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $noticias->links() }}
            </div>
        </div>
    </div>
</div>
@endsection