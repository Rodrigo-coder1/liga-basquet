<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::latest()->get();

        return view('equipos.index', compact('equipos'));
    }

    public function create()
    {
        return view('equipos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:equipos,nombre',
            'ciudad' => 'required|string|max:100',
            'entrenador' => 'nullable|string|max:100',
        ]);

        Equipo::create($request->only([
            'nombre',
            'ciudad',
            'entrenador',
        ]));

        return redirect()
            ->route('equipos.index')
            ->with('success', 'Equipo registrado correctamente.');
    }

    public function edit(Equipo $equipo)
    {
        return view('equipos.edit', compact('equipo'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:100',
                Rule::unique('equipos', 'nombre')->ignore($equipo->getKey()),
            ],
            'ciudad' => 'required|string|max:100',
            'entrenador' => 'nullable|string|max:100',
        ]);

        $equipo->update($request->only([
            'nombre',
            'ciudad',
            'entrenador',
        ]));

        return redirect()
            ->route('equipos.index')
            ->with('success', 'Equipo actualizado correctamente.');
    }

    public function destroy(Equipo $equipo)
    {
        $equipo->delete();

        return redirect()
            ->route('equipos.index')
            ->with('success', 'Equipo eliminado correctamente.');
    }
}