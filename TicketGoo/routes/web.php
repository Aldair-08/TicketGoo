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
use App\Models\Compra;


// Ruta principal y alias
Route::view('/', 'welcome')->name('welcome');
Route::get('/inicio', function () {
    return view('welcome');
})->name('inicio');

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

// Rutas estáticas para páginas informativas
Route::view('/nosotros', 'nosotros')->name('nosotros');
Route::view('/terminos-condiciones', 'terminos')->name('terminos');
Route::view('/politica-cookies', 'cookies')->name('cookies');
Route::view('/politica-privacidad', 'privacidad')->name('privacidad');
Route::view('/derechos-arco', 'derechos')->name('derechos');
Route::view('/como-comprar-entradas', 'comprar')->name('comprar');
Route::view('/como-funcionan-etickets', 'funciona')->name('funciona');

// Rutas de usuario específicas
Route::view('/principallog', 'usuario.principallog')->name('pagina.principallog');
Route::get('/duki', function () {
    return view('usuario.duki');
})->name('evento.duki');
Route::get('/compraduki', function () {
    return view('usuario.compraduki');
})->name('usuario.compraduki');
Route::get('/identificadorduki', function () {
    return view('usuario.identificadorduki');
})->name('usuario.identificadorduki');

Route::get('/etickets', function () {
    return view('usuario.etickets');
})->name('usuario.etickets');  

Route::get('/compras', function () {
    return view('usuario.compras');
})->name('usuario.compras');  

//ruta nueva para no mostrar al usuario si no se a iniciado session
Route::get('/dukipreview', function () {
    return view('usuario.dukipreview');
})->name('usuario.dukipreview');

Route::get('/vaucherduki', function () {
    // Obtenemos la última compra con estado 'pendiente' o cualquier estado que necesites
    $compra = Compra::with('detalles', 'usuario')->latest('fecha')->first();

    if (!$compra) {
        abort(404, 'Compra no encontrada');
    }

    return view('usuario.vaucherduki', [
    'compra' => $compra,
    'detalles' => $compra->detalles,
]);
})->name('usuario.vaucherduki');


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
        Route::resource('proveedores', ProveedorController::class)->names('admin.proveedores');
        Route::resource('promociones', PromocionController::class)->names('admin.promociones');
    });

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// Rutas de autenticación por defecto Laravel
require __DIR__.'/auth.php';
