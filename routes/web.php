<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\EventoController;

Route::get('/', [App\Http\Controllers\EventoController::class, 'index'])->name('welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

// Página principal
Route::view('/', 'welcome')->name('welcome');

// Página de "Sobre Nosotros"
Route::view('/nosotros', 'nosotros')->name('nosotros');

//Ruta para términos y condiciones. 
Route::view('/terminos-condiciones', 'terminos')->name('terminos');

// routes/web.php
Route::view('/politica-cookies', 'cookies')->name('cookies');

//Ruta para politica de privacidad
Route::view('/politica-privacidad', 'privacidad')->name('privacidad');

//Ruta para derechos ARCO
Route::view('/derechos-arco', 'derechos')->name('derechos');

// Ruta para como comprar entradas

Route::view('/como-comprar-entradas', 'comprar')->name('comprar');
//Ruta para como funcionan los etickets
Route::view('/como-funcionan-etickets', 'funciona')->name('funciona');

//Página para cuando el usuaurio se logea por primera vez
Route::view('/principallog', 'usuario.principallog')->name('pagina.principallog');



// Rutas para administrador de eventos :)
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');

    Route::middleware(['auth', 'adminonly'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // CRUD de proveedores
        Route::resource('proveedores', ProveedorController::class)->names('admin.proveedores');

        // CRUD de eventos
        Route::resource('eventos', EventoController::class)->names('admin.eventos');
        Route::get('/admin/eventos/crear', [EventoController::class, 'create'])->name('admin.eventos.create');
        Route::get('/admin/eventos', [EventoController::class, 'index'])->name('admin.eventos.index');
        Route::get('/admin/eventos/{id}/gestionar', [App\Http\Controllers\EventoController::class, 'gestionar'])->name('admin.eventos.gestionar');
        Route::post('/admin/eventos/{id}/publicar', [App\Http\Controllers\EventoController::class, 'publicar'])->name('admin.eventos.publicar');

        //CRUD de promociones :)
        Route::resource('promociones', PromocionController::class)->names('admin.promociones');
    });

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

Route::get('/eventos', [App\Http\Controllers\EventoController::class, 'publicos'])->name('eventos.publicos');

require __DIR__ . '/auth.php';
