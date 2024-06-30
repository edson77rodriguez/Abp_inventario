<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\TallaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\EstiloController;
use App\Http\Controllers\ComposicionController;
use App\Http\Controllers\OrigenController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\TipoPagosController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\SomeController;
use App\Http\Controllers\GestionController;








Route::get('/', function () {
    return view('welcome');
});

// Registrar las rutas de autenticación
Auth::routes();

// Agrupar las rutas que requieren autenticación
Route::middleware(['auth'])->group(function () {
    // Ruta del dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Rutas de recursos
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('cargos', CargoController::class);
    Route::resource('homes', HomeController::class);
    Route::resource('generos', GeneroController::class);
    Route::resource('tipos', TipoController::class);
    Route::resource('tallas', TallaController::class);
    Route::resource('modelos', ModeloController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('estilos', EstiloController::class);
    Route::resource('composiciones', ComposicionController::class);
    Route::resource('origenes', OrigenController::class);
    Route::resource('personas', PersonaController::class);
    Route::resource('proveedores', ProveedorController::class);
    Route::resource('marcas', MarcaController::class);
    Route::resource('empleados', EmpleadoController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('inventarios', InventarioController::class);
    Route::resource('ventas', VentaController::class);
    Route::resource('tipopagos', TipoPagosController::class);
    Route::resource('detalleventas', DetalleVentaController::class);
Route::get('/catalogo/{tipo}', [HomeController::class, 'catalogo'])->name('catalogo');
Route::get('/producto/{producto}', [HomeController::class, 'detalle'])->name('productos.detalle');
Route::get('/carrito', [CarritoController::class, 'ver'])->name('carrito.ver');
Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::post('/carrito/actualizar/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::post('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::get('/checkout', [CarritoController::class, 'checkout'])->name('checkout');

Route::post('/pago/procesar', [CarritoController::class, 'procesarPago'])->name('pago.procesar');
Route::get('/checkout', [SomeController::class, 'showCheckout'])->name('checkout');
Route::post('/carrito/procesarPago', [CarritoController::class, 'procesarPago'])->name('carrito.procesarPago');

Route::get('/gestion/inventario', [GestionController::class, 'inventario'])->name('gestion.inventario');
Route::get('/gestion/ventas', [GestionController::class, 'ventas'])->name('gestion.ventas');
Route::get('/gestion/proveedores', [GestionController::class, 'proveedores'])->name('gestion.proveedores');
Route::get('/gestion/informes', [GestionController::class, 'informes'])->name('gestion.informes');
Route::get('/gestion/configuracion', [GestionController::class, 'configuracion'])->name('gestion.configuracion');




});
