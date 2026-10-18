<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JugadorController extends Controller
{
    public function index(Request $request)
    {
        $equipoId = $request->query('equipo_id');
        $equipoSeleccionado = null;

        $consulta = Jugador::with('equipo');

        if ($equipoId !== null && $equipoId !== '') {
            $equipoSeleccionado = Equipo::findOrFail($equipoId);

            $consulta->where('equipo_id', $equipoSeleccionado->id);
        }

        $jugadores = $consulta
            ->orderBy('apellidos')
            ->orderBy('nombre')
            ->get();

        return view(
            'jugadores.index',
            compact('jugadores', 'equipoSeleccionado')
        );
    }

    public function create()
    {
        $equipos = Equipo::orderBy('nombre')->get();

        return view('jugadores.create', compact('equipos'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'numero_camiseta' => [
                'required',
                'integer',
                'min:0',
                'max:99',
                Rule::unique('jugadores', 'numero_camiseta')
                    ->where('equipo_id', $request->input('equipo_id')),
            ],
            'posicion' => 'nullable|string|max:50',
            'equipo_id' => 'required|integer|exists:equipos,id',
        ]);

        Jugador::create($datos);

        return redirect()
            ->route('jugadores.index')
            ->with('success', 'Jugador registrado correctamente.');
    }

    public function edit(Jugador $jugador)
    {
        $equipos = Equipo::orderBy('nombre')->get();

        return view(
            'jugadores.edit',
            compact('jugador', 'equipos')
        );
    }

    public function update(Request $request, Jugador $jugador)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'numero_camiseta' => [
                'required',
                'integer',
                'min:0',
                'max:99',
                Rule::unique('jugadores', 'numero_camiseta')
                    ->where('equipo_id', $request->input('equipo_id'))
                    ->ignore($jugador->getKey()),
            ],
            'posicion' => 'nullable|string|max:50',
            'equipo_id' => 'required|integer|exists:equipos,id',
        ]);

        $jugador->update($datos);

        return redirect()
            ->route('jugadores.index')
            ->with('success', 'Jugador actualizado correctamente.');
    }

    public function destroy(Jugador $jugador)
    {
        $jugador->delete();

        return redirect()
            ->route('jugadores.index')
            ->with('success', 'Jugador eliminado correctamente.');
    }
}