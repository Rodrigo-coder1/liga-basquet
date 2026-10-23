<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Partidos de Básquetbol</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 25px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #777;
            text-align: center;
        }

        th {
            background-color: #eeeeee;
            color: #222222;
        }

        tr.pendiente {
            background-color: #d4edda;
            color: #155724;
        }

        tr.finalizado {
            background-color: #f8d7da;
            color: #721c24;
        }

        .enlace {
            display: inline-block;
            margin-right: 8px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Gestión de Partidos</h1>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <div>
        <a class="enlace" href="{{ route('partidos.create') }}">
            Registrar partido
        </a>

        <a class="enlace" href="{{ route('equipos.index') }}">
            Volver a equipos
        </a>
    </div>

    <h2>Lista de partidos</h2>

    @if ($partidos->isEmpty())
        <p>Todavía no hay partidos registrados.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Fecha y hora</th>
                    <th>Equipo local</th>
                    <th>Marcador</th>
                    <th>Equipo visitante</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($partidos as $partido)
                    <tr class="{{ $partido->puntos_local !== null && $partido->puntos_visitante !== null ? 'finalizado' : 'pendiente' }}">
                        <td>
                            {{ $partido->fecha->format('d/m/Y H:i') }}
                        </td>

                        <td>
                            {{ $partido->equipoLocal->nombre }}
                        </td>

                        <td>
                            @if ($partido->puntos_local !== null &&
                                 $partido->puntos_visitante !== null)
                                <strong>
                                    {{ $partido->puntos_local }}
                                    -
                                    {{ $partido->puntos_visitante }}
                                </strong>
                            @else
                                Pendiente
                            @endif
                        </td>

                        <td>
                            {{ $partido->equipoVisitante->nombre }}
                        </td>

                        <td>
                            @if ($partido->puntos_local !== null &&
                                 $partido->puntos_visitante !== null)
                                <strong>Finalizado</strong>
                            @else
                                <strong>Pendiente</strong>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('partidos.edit', $partido) }}">
                                Editar
                            </a>

                            <form
                                action="{{ route('partidos.destroy', $partido) }}"
                                method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('¿Seguro que deseas eliminar este partido?');"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>