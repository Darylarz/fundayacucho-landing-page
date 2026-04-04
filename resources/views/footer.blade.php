@props(['config'])

<footer class="bg-dark text-white pt-5 pb-3 mt-auto">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5 class="text-uppercase mb-3 text-warning">Fundayacucho</h5>
                <p>Impulsando la educación universitaria universal y de calidad para la transformación de la patria.</p>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="text-uppercase mb-3 text-warning">Contacto</h5>
                <ul class="list-unstyled">
                    @if(optional($config)->phone)
                        <li><i class="bi bi-telephone me-2"></i> {{ $config->phone }}</li>
                    @endif
                    @if(optional($config)->email)
                        <li><i class="bi bi-envelope me-2"></i> {{ $config->email }}</li>
                    @endif
                    <li><i class="bi bi-geo-alt me-2"></i> C. 3B, Caracas 1073, Miranda</li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="text-uppercase mb-3 text-warning">Síguenos</h5>
                <div class="d-flex gap-3">
                    @if(optional($config)->facebook_url)
                        <a href="{{ $config->facebook_url }}" class="text-white fs-4" target="_blank"><i class="bi bi-facebook"></i></a>
                    @endif
                    @if(optional($config)->twitter_url)
                        <a href="{{ $config->twitter_url }}" class="text-white fs-4" target="_blank"><i class="bi bi-twitter-x"></i></a>
                    @endif
                    @if(optional($config)->instagram_url)
                        <a href="{{ $config->instagram_url }}" class="text-white fs-4" target="_blank"><i class="bi bi-instagram"></i></a>
                    @endif
                    @if(optional($config)->youtube_url)
                        <a href="{{ $config->youtube_url }}" class="text-white fs-4" target="_blank"><i class="bi bi-youtube"></i></a>
                    @endif
                </div>
            </div>
        </div>
        <hr class="border-secondary">
        <div class="text-center small">
            &copy; {{ date('Y') }} Fundación Gran Mariscal de Ayacucho. Todos los derechos reservados.
        </div>
    </div>
</footer>
