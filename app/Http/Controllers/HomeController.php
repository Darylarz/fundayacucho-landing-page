<?php

namespace App\Http\Controllers;

use App\Models\CarouselSlide;
use App\Models\Invitacion;
use App\Models\Noticia;
use App\Models\Libro;
use App\Models\Informacion;
use App\Models\SiteConfig;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides = CarouselSlide::where('is_active', true)->orderBy('order')->get();
        $invitaciones = Invitacion::where('is_active', true)->orderBy('order')->get();
        $noticias = Noticia::where('is_published', true)->latest()->take(3)->get();
        $libros = Libro::latest()->take(4)->get();
        $informaciones = Informacion::where('is_active', true)->get();
        $config = SiteConfig::first(); // Asumiendo que hay un solo registro de configuración

        return view('home', compact('slides', 'invitaciones', 'noticias', 'libros', 'informaciones', 'config'));
    }
}