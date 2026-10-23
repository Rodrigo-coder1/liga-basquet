<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\PartidoController;

Route::get('/', function () {
    return redirect()->route('equipos.index');
});

Route::resource('equipos', EquipoController::class)
    ->except(['show']);

Route::resource('jugadores', JugadorController::class)
    ->except(['show'])
    ->parameters(['jugadores' => 'jugador']);

Route::resource('partidos', PartidoController::class)
    ->except(['show'])
    ->parameters(['partidos' => 'partido']);