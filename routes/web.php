<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CargoController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('marcas', MarcaController::class);
Route::resource('cargos', CargoController::class);