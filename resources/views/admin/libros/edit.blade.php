@extends('admin.layouts.admin')

@section('title', 'Editar Libro - Panel Administrativo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="bi bi-pencil me-2"></i>Editar Libro
    </h1>
    <a href="{{ route('admin.libros.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Volver
    </a>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Editar Información del Libro</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.libros.update', $libro) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Título -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Título del Libro <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $libro->title) }}" 
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Autor -->
                            <div class="mb-3">
                                <label for="author" class="form-label">Autor</label>
                                <input type="text" 
                                       class="form-control @error('author') is-invalid @enderror" 
                                       id="author" 
                                       name="author" 
                                       value="{{ old('author', $libro->author) }}">
                                @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Descripción -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="4">{{ old('description', $libro->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Breve descripción del libro (opcional)</small>
                            </div>

                            <!-- Nombre del archivo al descargar -->
                            <div class="mb-3">
                                <label for="download_name" class="form-label">Nombre del Archivo al Descargar</label>
                                <input type="text" 
                                       class="form-control @error('download_name') is-invalid @enderror" 
                                       id="download_name" 
                                       name="download_name" 
                                       value="{{ old('download_name', $libro->download_name) }}"
                                       placeholder="Ej: mi-libro.pdf">
                                @error('download_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Nombre que tendrá el archivo cuando el usuario lo descargue</small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Portada Actual -->
                            <div class="mb-3">
                                <label class="form-label">Portada Actual</label>
                                @if($libro->cover_image_path)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($libro->cover_image_path) }}" 
                                             alt="{{ $libro->title }}" 
                                             class="img-thumbnail" 
                                             style="width: 100%; max-height: 300px; object-fit: cover;">
                                    </div>
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center mb-2" 
                                         style="width: 100%; height: 200px;">
                                        <div class="text-center">
                                            <i class="bi bi-book text-muted" style="font-size: 3rem;"></i>
                                            <p class="text-muted mb-0 mt-2">Sin portada</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Nueva Portada -->
                            <div class="mb-3">
                                <label for="cover_image" class="form-label">Cambiar Portada</label>
                                <input type="file" 
                                       class="form-control @error('cover_image') is-invalid @enderror" 
                                       id="cover_image" 
                                       name="cover_image" 
                                       accept="image/*">
                                @error('cover_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Deje vacío para mantener la actual</small>
                            </div>

                            <!-- PDF Actual -->
                            <div class="mb-3">
                                <label class="form-label">Archivo PDF Actual</label>
                                @if($libro->pdf_file_path)
                                    <div class="mb-2">
                                        <a href="{{ Storage::url($libro->pdf_file_path) }}" 
                                           target="_blank" 
                                           class="btn btn-sm btn-outline-success w-100">
                                            <i class="bi bi-file-pdf me-1"></i>Ver PDF Actual
                                        </a>
                                    </div>
                                @else
                                    <div class="alert alert-warning">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        No hay archivo PDF cargado
                                    </div>
                                @endif
                            </div>

                            <!-- Nuevo PDF -->
                            <div class="mb-3">
                                <label for="pdf_file" class="form-label">Cambiar Archivo PDF</label>
                                <input type="file" 
                                       class="form-control @error('pdf_file') is-invalid @enderror" 
                                       id="pdf_file" 
                                       name="pdf_file" 
                                       accept="application/pdf">
                                @error('pdf_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Deje vacío para mantener el actual</small>
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.libros.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-2"></i>Cancelar
                        </a>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Actualizar Libro
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Preview de la nueva portada
    document.getElementById('cover_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Aquí podrías agregar un preview si lo deseas
                console.log('Preview de nueva portada:', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
