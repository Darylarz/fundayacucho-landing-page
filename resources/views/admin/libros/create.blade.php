@extends('admin.layouts.admin')

@section('title', 'Nuevo Libro - Panel Administrativo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="bi bi-plus-circle me-2"></i>Nuevo Libro
    </h1>
    <a href="{{ route('admin.libros.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Volver
    </a>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Información del Libro</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.libros.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Título -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Título del Libro <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title') }}" 
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
                                       value="{{ old('author') }}">
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
                                          rows="4">{{ old('description') }}</textarea>
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
                                       value="{{ old('download_name') }}"
                                       placeholder="Ej: mi-libro.pdf">
                                @error('download_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Nombre que tendrá el archivo cuando el usuario lo descargue</small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Portada -->
                            <div class="mb-3">
                                <label for="cover_image" class="form-label">Portada del Libro <span class="text-danger">*</span></label>
                                <input type="file" 
                                       class="form-control @error('cover_image') is-invalid @enderror" 
                                       id="cover_image" 
                                       name="cover_image" 
                                       accept="image/*" 
                                       required>
                                @error('cover_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Formatos: JPG, PNG, WEBP. Máx. 5MB</small>
                            </div>

                            <!-- Archivo PDF -->
                            <div class="mb-3">
                                <label for="pdf_file" class="form-label">Archivo PDF <span class="text-danger">*</span></label>
                                <input type="file" 
                                       class="form-control @error('pdf_file') is-invalid @enderror" 
                                       id="pdf_file" 
                                       name="pdf_file" 
                                       accept="application/pdf" 
                                       required>
                                @error('pdf_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Solo archivos PDF. Máx. 20MB</small>
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
                                <i class="bi bi-save me-2"></i>Guardar Libro
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
    // Preview de la portada
    document.getElementById('cover_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Aquí podrías agregar un preview si lo deseas
                console.log('Preview de portada:', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
