<?php

namespace App\Http\Controllers;
use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EquipoController extends Controller
{
    // 1. Listar equipos
    public function index()
    {
        $equipos = Equipo::latest()->get();

        return view('equipos.index', compact('equipos'));
    }

    // 2. Mostrar formulario para registrar
    public function create()
    {
        return view('equipos.create');
    }

    // 3. Guardar un equipo nuevo
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

    // 4. Mostrar formulario para editar
    public function edit(Equipo $equipo)
    {
        return view('equipos.edit', compact('equipo'));
    }

    // 5. Actualizar los datos de un equipo
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

    // 6. Eliminar un equipo
    public function destroy(Equipo $equipo)
    {
        $equipo->delete();

        return redirect()
            ->route('equipos.index')
            ->with('success', 'Equipo eliminado correctamente.');
    }
}
