<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("/audiencia", [App\Http\Controllers\AudienciaController::class, 'index']);
Route::post("/audiencia/guardar", [App\Http\Controllers\AudienciaController::class, 'store']);
Route::get("/audiencia/mostrar", [App\Http\Controllers\AudienciaController::class, 'show']);
