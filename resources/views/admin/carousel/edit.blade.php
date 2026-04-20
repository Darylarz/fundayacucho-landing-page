@extends('admin.layouts.admin')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0 text-primary">Editar Slide del Carrusel</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.carousel.update', $carousel) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="title" class="form-label">Título (Opcional)</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Texto sobre la imagen" value="{{ old('title', $carousel->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="order" class="form-label">Orden</label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $carousel->order) }}" required>
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Imagen</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            <div class="form-text">Formatos aceptados: JPG, PNG, WEBP. Máx: 5MB. Recomendado: 1920x600 px. Dejar vacío para mantener la imagen actual.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if ($carousel->image_path)
                            <div class="mb-3">
                                <label class="form-label">Imagen Actual:</label>
                                <div>
                                    <img src="{{ asset('storage/' . $carousel->image_path) }}" class="img-thumbnail" style="max-width: 200px; height: auto;">
                                </div>
                            </div>
                        @endif

                        <div class="mb-4 form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" @checked(old('is_active', $carousel->is_active))>
                            <label class="form-check-label" for="is_active">Activo</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.carousel.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar Slide</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection