<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\InvitacionController;
use App\Http\Controllers\Admin\NoticiaController;
use App\Http\Controllers\Admin\LibroController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/historia', [PageController::class, 'historia'])->name('historia');
Route::get('/mision', [PageController::class, 'mision'])->name('mision');
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Rutas de autenticación
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rutas del panel administrativo (protegidas por autenticación)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
});

// Rutas del panel administrativo (protegidas por autenticación y rol 'admin')
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Módulo de Carrusel
    Route::resource('carousel', CarouselController::class);
    
    // Módulo de Invitaciones
    Route::resource('invitaciones', InvitacionController::class);
    
    // Módulo de Noticias
    Route::resource('noticias', NoticiaController::class);
    
    // Módulo de Libros
    Route::resource('libros', LibroController::class);
    
    // Configuración
    Route::get('config', [ConfigController::class, 'edit'])->name('config.edit');
    Route::put('config', [ConfigController::class, 'update'])->name('config.update');
});
