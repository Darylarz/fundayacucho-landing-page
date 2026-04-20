@extends('admin.layouts.admin')

@section('title', 'Editar Información - Panel Administrativo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">
        <i class="bi bi-pencil me-2"></i>Editar Información
    </h1>
    <a href="{{ route('admin.informaciones.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Volver
    </a>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Editar Información</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.informaciones.update', $informacion) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="title" class="form-label">Título <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $informacion->title) }}" 
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Contenido <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('content') is-invalid @enderror" 
                                          id="content" 
                                          name="content" 
                                          rows="3"
                                          maxlength="500"
                                          required>{{ old('content', $informacion->content) }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Máximo 500 caracteres</small>
                            </div>

                            <div class="mb-3">
                                <label for="link" class="form-label">Enlace</label>
                                <input type="url" 
                                       class="form-control @error('link') is-invalid @enderror" 
                                       id="link" 
                                       name="link" 
                                       value="{{ old('link', $informacion->link) }}" 
                                       placeholder="https://ejemplo.com">
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="order" class="form-label">Orden</label>
                                        <input type="number" 
                                               class="form-control @error('order') is-invalid @enderror" 
                                               id="order" 
                                               name="order" 
                                               value="{{ old('order', $informacion->order) }}" 
                                               min="1" 
                                               max="99">
                                        @error('order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
                                                   {{ old('is_active', $informacion->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Información Activa
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="image" class="form-label">Imagen (opcional)</label>
                                <input type="file" 
                                       class="form-control @error('image') is-invalid @enderror" 
                                       id="image" 
                                       name="image" 
                                       accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Dejar vacío para conservar la imagen actual</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Vista Previa</label>
                                <div id="image-preview" class="border rounded p-3 bg-light text-center" 
                                     style="min-height: 200px;">
                                    @if($informacion->image_path)
                                        <img src="{{ Storage::url($informacion->image_path) }}" 
                                             alt="{{ $informacion->title }}" 
                                             class="img-fluid rounded" 
                                             style="max-height: 200px;">
                                    @else
                                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                        <p class="text-muted mb-0 mt-2">La imagen aparecerá aquí</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.informaciones.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-2"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
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
        }
    });
</script>
@endpush