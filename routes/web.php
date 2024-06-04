<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\TallaController;
//use APP\Http\Controllers\ModeloController; ni idea pa aqui me dice que hay mayusculas 
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\EstiloController;
use App\Http\Controllers\ComposicionController;
use App\Http\Controllers\OrigenController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProveedorController;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('cargos', CargoController::class);
Route::resource('generos', GeneroController::class);
Route::resource('tipos',TipoController::class);
Route::resource('tallas',TallaController::class);
Route::resource('modelos', ModeloController::class);
Route::resource('colors', ColorController::class);
Route::resource('estilos', EstiloController::class);
Route::resource('composiciones', ComposicionController::class);
Route::resource('origenes',OrigenController::class);
Route::resource('personas',PersonaController::class);

Route::resource('proveedors',ProveedorController::class);
//=======
Route::resource('marcas',MarcaController::class);
Route::resource('empleados',EmpleadoController::class);

//>>>>>>> 76472ee563acb5f00bc41c2212cf95b868948cf1
