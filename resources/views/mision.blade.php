@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="text-primary fw-bold">Misión y Visión</h1>
        <p class="text-muted">Los pilares que guían nuestro compromiso con la educación venezolana.</p>
    </div>

    <div class="row g-4">
        {{-- Misión --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-5 text-center">
                    <div class="display-4 text-primary mb-3"><i class="bi bi-compass"></i></div>
                    <h3 class="card-title fw-bold mb-3">Misión</h3>
                    <p class="card-text">
                        Impulsar la educación universitaria universal y de calidad, a través de la articulación institucional y la gestión eficiente de programas de becas y créditos educativos, para garantizar la inclusión y la formación del talento humano necesario para el desarrollo integral de la Nación.
                    </p>
                </div>
            </div>
        </div>

        {{-- Visión --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100 bg-primary text-white">
                <div class="card-body p-5 text-center">
                    <div class="display-4 text-warning mb-3"><i class="bi bi-eye"></i></div>
                    <h3 class="card-title fw-bold mb-3">Visión</h3>
                    <p class="card-text">
                        Ser la institución de referencia nacional e internacional en la gestión de políticas de inclusión educativa, reconocida por su transparencia, eficacia y compromiso con la formación de ciudadanos comprometidos con el desarrollo ético, productivo y soberano de Venezuela.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
