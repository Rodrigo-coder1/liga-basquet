<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\EstadisticaController;

// Login y registro: solo para usuarios que no han iniciado sesión.
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');

    Route::get('/registro', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/registro', [AuthController::class, 'register'])
        ->name('register.submit');
});

// Todas las funciones de la liga requieren iniciar sesión.
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('equipos.index');
    });

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::resource('equipos', EquipoController::class)
        ->except(['show']);

    Route::resource('jugadores', JugadorController::class)
        ->except(['show'])
        ->parameters(['jugadores' => 'jugador']);

    Route::resource('partidos', PartidoController::class)
        ->except(['show'])
        ->parameters(['partidos' => 'partido']);

    Route::get('/estadisticas', [EstadisticaController::class, 'index'])
        ->name('estadisticas.index');
});