<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Partido;
use Illuminate\Http\Request;

class PartidoController extends Controller
{
    public function index()
    {
        $partidos = Partido::with([
            'equipoLocal',
            'equipoVisitante',
        ])
            ->orderBy('fecha')
            ->get();

        return view('partidos.index', compact('partidos'));
    }

    public function create()
    {
        $equipos = Equipo::orderBy('nombre')->get();

        return view('partidos.create', compact('equipos'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'equipo_local_id' => [
                'required',
                'integer',
                'exists:equipos,id',
                'different:equipo_visitante_id',
            ],
            'equipo_visitante_id' => [
                'required',
                'integer',
                'exists:equipos,id',
                'different:equipo_local_id',
            ],
            'fecha' => 'required|date',
            'puntos_local' => [
                'nullable',
                'integer',
                'min:0',
                'max:999',
                'required_with:puntos_visitante',
            ],
            'puntos_visitante' => [
                'nullable',
                'integer',
                'min:0',
                'max:999',
                'required_with:puntos_local',
            ],
        ]);

        Partido::create($datos);

        return redirect()
            ->route('partidos.index')
            ->with('success', 'Partido registrado correctamente.');
    }

    public function edit(Partido $partido)
    {
        $equipos = Equipo::orderBy('nombre')->get();

        return view(
            'partidos.edit',
            compact('partido', 'equipos')
        );
    }

    public function update(Request $request, Partido $partido)
    {
        $datos = $request->validate([
            'equipo_local_id' => [
                'required',
                'integer',
                'exists:equipos,id',
                'different:equipo_visitante_id',
            ],
            'equipo_visitante_id' => [
                'required',
                'integer',
                'exists:equipos,id',
                'different:equipo_local_id',
            ],
            'fecha' => 'required|date',
            'puntos_local' => [
                'nullable',
                'integer',
                'min:0',
                'max:999',
                'required_with:puntos_visitante',
            ],
            'puntos_visitante' => [
                'nullable',
                'integer',
                'min:0',
                'max:999',
                'required_with:puntos_local',
            ],
        ]);

        $partido->update($datos);

        return redirect()
            ->route('partidos.index')
            ->with('success', 'Partido actualizado correctamente.');
    }

    public function destroy(Partido $partido)
    {
        $partido->delete();

        return redirect()
            ->route('partidos.index')
            ->with('success', 'Partido eliminado correctamente.');
    }
}