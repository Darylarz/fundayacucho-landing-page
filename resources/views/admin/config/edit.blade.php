@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2 class="mb-4 text-primary">Configuración del Sitio</h2>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('admin.config.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h5 class="text-secondary mb-3">Imágenes Institucionales</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label for="logo" class="form-label">Logo del Sitio</label>
                                <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                                @if($config->logo_path)
                                    <div class="mt-2 border p-2 bg-light d-inline-block rounded">
                                        <img src="{{ asset('storage/' . $config->logo_path) }}" alt="Logo" style="height: 50px;">
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cintillo" class="form-label">Cintillo Superior</label>
                                <input type="file" class="form-control" id="cintillo" name="cintillo" accept="image/*">
                                @if($config->cintillo_path)
                                    <div class="mt-2 border p-2 bg-light d-inline-block rounded">
                                        <img src="{{ asset('storage/' . $config->cintillo_path) }}" alt="Cintillo" style="height: 40px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <h5 class="text-secondary mb-3">Contacto</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $config->email) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $config->phone) }}">
                            </div>
                        </div>

                        <h5 class="text-secondary mb-3">Redes Sociales</h5>
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><i class="bi bi-facebook"></i> Facebook URL</label>
                                <input type="url" class="form-control" name="facebook_url" value="{{ old('facebook_url', $config->facebook_url) }}" placeholder="https://facebook.com/...">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><i class="bi bi-instagram"></i> Instagram URL</label>
                                <input type="url" class="form-control" name="instagram_url" value="{{ old('instagram_url', $config->instagram_url) }}" placeholder="https://instagram.com/...">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><i class="bi bi-twitter"></i> Twitter/X URL</label>
                                <input type="url" class="form-control" name="twitter_url" value="{{ old('twitter_url', $config->twitter_url) }}" placeholder="https://twitter.com/...">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><i class="bi bi-youtube"></i> YouTube URL</label>
                                <input type="url" class="form-control" name="youtube_url" value="{{ old('youtube_url', $config->youtube_url) }}" placeholder="https://youtube.com/...">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection