<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('audiencias.index');
});


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::post("/audiencia/guardar", [App\Http\Controllers\AudienciaController::class, 'store']);
    Route::post("/audiencia/editar/{id}", [App\Http\Controllers\AudienciaController::class, 'edit']);
    Route::post("/audiencia/actualizar/{audiencia}", [App\Http\Controllers\AudienciaController::class, 'update']);
    Route::post("/audiencia/eliminar/{id}", [App\Http\Controllers\AudienciaController::class, 'destroy']);
});

Route::get("/audiencia", [App\Http\Controllers\AudienciaController::class, 'index'])->name('audiencias.index');
Route::post("/audiencia/mostrar", [App\Http\Controllers\AudienciaController::class, 'show']);
Route::get("/detalles", [App\Http\Controllers\DetallesController::class, 'index'])->name('detalles.index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
