<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\CompraDetalleController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DocumentoController;

Route::get('/', [App\Http\Controllers\CarruselController::class, 'welcome'])->name('welcome');
Route::get('/usuario/principallog', [App\Http\Controllers\EventoController::class, 'usuarioEventos'])->name('usuario.principallog');
Route::get('/principallog', [App\Http\Controllers\EventoController::class, 'usuarioEventos'])->name('pagina.principallog');

// Dashboard protegido
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas de configuración protegidas por auth
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

// Página de "Sobre Nosotros"
Route::view('/nosotros', 'nosotros')->name('nosotros');
Route::view('/terminos-condiciones', 'terminos')->name('terminos');
Route::view('/politica-cookies', 'cookies')->name('cookies');
Route::view('/politica-privacidad', 'privacidad')->name('privacidad');
Route::view('/derechos-arco', 'derechos')->name('derechos');
Route::view('/como-comprar-entradas', 'comprar')->name('comprar');
Route::view('/como-funcionan-etickets', 'funciona')->name('funciona');

Route::get('/etickets', [CompraController::class, 'mostrarEtickets'])->middleware('auth')->name('usuario.etickets');

Route::get('/compras', [CompraController::class, 'mostrarCompras'])->middleware('auth')->name('usuario.compras');
Route::get('/voucher-compra/{compra_id}', [CompraController::class, 'mostrarVoucherCompra'])->middleware('auth')->name('usuario.Voucher');
Route::post('/enviar-voucher/{compra_id}', [CompraController::class, 'enviarVoucherPorEmail'])->middleware('auth')->name('usuario.enviarVoucher');

// Rutas para compra, pago y documentos
Route::post('/guardar-detalle', [CompraDetalleController::class, 'guardarDetalle'])->name('guardar.detalle');
Route::get('/formato-entrega', [CompraDetalleController::class, 'mostrarVistaEntrega'])->name('elegirduki');
Route::post('/guardar-formato', [CompraDetalleController::class, 'guardarFormatoEntrega'])->name('guardar.formatoEntrega');
Route::post('/guardar-compra', [CompraController::class, 'guardarCompra'])->name('guardar.compra');


Route::get('/pago/confirmar', [CompraController::class, 'vistaPago'])->name('pago.confirmar');
Route::post('/pago', [CompraController::class, 'pagar'])->name('compra.pagar');
Route::get('/pagoduki', [CompraController::class, 'mostrarPagoFinal'])->name('pagoduki');
Route::delete('/detalle/{id}/eliminar', [CompraController::class, 'eliminarDetalle'])->name('detalle.eliminar');
Route::get('/identificador-duki/{compra_id}', [CompraController::class, 'mostrarIdentificador'])->name('usuario.identificadorduki');

Route::post('/documento/simular', [DocumentoController::class, 'simular'])->name('documento.simular');
Route::post('/confirmar-compra', [CompraController::class, 'confirmarCompra'])->name('voucher.generar');
Route::get('/voucher/{id}', [CompraController::class, 'mostrarVoucher'])->name('voucher.mostrar');
Route::get('/vaucher', [CompraController::class, 'vistaVaucher'])->name('vaucher');

Route::get('/pago/exito', function () {
    return view('pago.exito');
})->name('pago.exito');

// Rutas de administración con prefijo admin
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

        //Carrusel
        Route::resource('carrusel', App\Http\Controllers\CarruselController::class)->names('admin.carrusel');
        //CRUD de promociones :)
        Route::resource('promociones', PromocionController::class)->names('admin.promociones');
    });

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

Route::get('/eventos', [App\Http\Controllers\EventoController::class, 'publicos'])->name('eventos.publicos');

Route::get('/evento/{id}', [App\Http\Controllers\EventoController::class, 'show'])->name('evento.show');
//nuevo
Route::get('/comprar/{id_evento}', [App\Http\Controllers\CompraController::class, 'index'])->name('comprar.index');
Route::post('/comprar/procesar', [CompraController::class, 'procesarCompra'])->middleware('auth');

Route::post('/comprar/boleta', [CompraController::class, 'descargarBoleta'])->middleware('auth');
require __DIR__ . '/auth.php';
