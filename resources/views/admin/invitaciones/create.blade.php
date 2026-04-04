@extends('admin.layouts.admin')

@section('title', 'Nueva Invitación - Panel Administrativo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="bi bi-plus-circle me-2"></i>Nueva Invitación
    </h1>
    <a href="{{ route('admin.invitaciones.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Volver
    </a>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Información de la Invitación</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.invitaciones.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Título -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Título de la Invitación <span class="text-danger">*</span></label>
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

                            <!-- Descripción -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Breve descripción de la invitación (opcional)</small>
                            </div>

                            <!-- Enlace -->
                            <div class="mb-3">
                                <label for="link" class="form-label">Enlace de Destino <span class="text-danger">*</span></label>
                                <input type="url" 
                                       class="form-control @error('link') is-invalid @enderror" 
                                       id="link" 
                                       name="link" 
                                       value="{{ old('link') }}" 
                                       placeholder="https://ejemplo.com/formulario"
                                       required>
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">URL donde el usuario será redirigido al hacer clic</small>
                            </div>

                            <!-- Orden y Estado -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="order" class="form-label">Orden de Visualización</label>
                                        <input type="number" 
                                               class="form-control @error('order') is-invalid @enderror" 
                                               id="order" 
                                               name="order" 
                                               value="{{ old('order', 1) }}" 
                                               min="1" 
                                               max="99">
                                        @error('order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Número para ordenar las invitaciones (1-99)</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Estado</label>
                                        <div class="form-check form-switch mt-2">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   id="is_active" 
                                                   name="is_active" 
                                                   value="1" 
                                                   {{ old('is_active') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Invitación Activa
                                            </label>
                                        </div>
                                        <small class="form-text text-muted">Las invitaciones inactivas no se mostrarán en el sitio</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Imagen -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Imagen de la Invitación <span class="text-danger">*</span></label>
                                <input type="file" 
                                       class="form-control @error('image') is-invalid @enderror" 
                                       id="image" 
                                       name="image" 
                                       accept="image/*" 
                                       required>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Formatos: JPG, PNG, WEBP. Máx. 5MB</small>
                                <small class="form-text text-muted">Tamaño recomendado: 400x300px</small>
                            </div>

                            <!-- Preview -->
                            <div class="mb-3">
                                <label class="form-label">Vista Previa</label>
                                <div id="image-preview" class="border rounded p-3 bg-light text-center" 
                                     style="min-height: 200px;">
                                    <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                    <p class="text-muted mb-0 mt-2">La imagen aparecerá aquí</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.invitaciones.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-2"></i>Cancelar
                        </a>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Guardar Invitación
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
    // Preview de la imagen
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('image-preview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <img src="${e.target.result}" 
                         alt="Vista previa" 
                         class="img-fluid rounded" 
                         style="max-height: 200px;">
                `;
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = `
                <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mb-0 mt-2">La imagen aparecerá aquí</p>
            `;
        }
    });
</script>
@endpush
