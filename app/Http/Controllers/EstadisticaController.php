<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Partido;

class EstadisticaController extends Controller
{
    public function index()
    {
        $equipos = Equipo::orderBy('nombre')->get();

        // Solo contamos partidos que ya tienen ambos marcadores.
        $partidos = Partido::whereNotNull('puntos_local')
            ->whereNotNull('puntos_visitante')
            ->get();

        // Inicializar las estadísticas de cada equipo.
        $estadisticas = [];

        foreach ($equipos as $equipo) {
            $estadisticas[$equipo->id] = [
                'jugados' => 0,
                'victorias' => 0,
                'derrotas' => 0,
                'empates' => 0,
                'puntos_favor' => 0,
                'puntos_contra' => 0,
                'diferencia' => 0,
            ];
        }

        // Calcular las estadísticas de cada partido finalizado.
        foreach ($partidos as $partido) {
            $localId = $partido->equipo_local_id;
            $visitanteId = $partido->equipo_visitante_id;

            if (
                !isset($estadisticas[$localId]) ||
                !isset($estadisticas[$visitanteId])
            ) {
                continue;
            }

            $puntosLocal = (int) $partido->puntos_local;
            $puntosVisitante = (int) $partido->puntos_visitante;

            $estadisticas[$localId]['jugados']++;
            $estadisticas[$visitanteId]['jugados']++;

            $estadisticas[$localId]['puntos_favor'] += $puntosLocal;
            $estadisticas[$localId]['puntos_contra'] += $puntosVisitante;

            $estadisticas[$visitanteId]['puntos_favor'] += $puntosVisitante;
            $estadisticas[$visitanteId]['puntos_contra'] += $puntosLocal;

            if ($puntosLocal > $puntosVisitante) {
                $estadisticas[$localId]['victorias']++;
                $estadisticas[$visitanteId]['derrotas']++;
            } elseif ($puntosLocal < $puntosVisitante) {
                $estadisticas[$visitanteId]['victorias']++;
                $estadisticas[$localId]['derrotas']++;
            } else {
                $estadisticas[$localId]['empates']++;
                $estadisticas[$visitanteId]['empates']++;
            }
        }

        // Calcular la diferencia de puntos.
        foreach ($estadisticas as &$datos) {
            $datos['diferencia'] =
                $datos['puntos_favor'] - $datos['puntos_contra'];
        }

        unset($datos);

        // Organizar la tabla por victorias y luego por diferencia de puntos.
        $tabla = $equipos->map(function ($equipo) use ($estadisticas) {
            return (object) array_merge(
                ['equipo' => $equipo],
                $estadisticas[$equipo->id]
            );
        })->sortBy([
            ['victorias', 'desc'],
            ['diferencia', 'desc'],
            ['puntos_favor', 'desc'],
        ])->values();

        $totalJugados = $partidos->count();

        $totalPendientes = Partido::where(function ($consulta) {
            $consulta->whereNull('puntos_local')
                ->orWhereNull('puntos_visitante');
        })->count();

        return view('estadisticas.index', compact(
            'tabla',
            'totalJugados',
            'totalPendientes'
        ));
    }
}