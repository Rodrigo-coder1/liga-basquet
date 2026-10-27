<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Estadísticas de la Liga</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 25px;
        }

        .resumen {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin: 20px 0;
        }

        .tarjeta {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            min-width: 180px;
            background: #f5f5f5;
        }

        .tarjeta h3 {
            margin-top: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #eeeeee;
        }

        td.nombre {
            text-align: left;
        }

        tr:nth-child(even) {
            background: #f8f8f8;
        }
    </style>
</head>
<body>
    <h1>Estadísticas de la Liga de Básquetbol</h1>

    <p>
        <a href="{{ route('equipos.index') }}">Equipos</a> |
        <a href="{{ route('jugadores.index') }}">Jugadores</a> |
        <a href="{{ route('partidos.index') }}">Partidos</a>
    </p>

    <div class="resumen">
        <div class="tarjeta">
            <h3>Partidos finalizados</h3>
            <strong>{{ $totalJugados }}</strong>
        </div>

        <div class="tarjeta">
            <h3>Partidos pendientes</h3>
            <strong>{{ $totalPendientes }}</strong>
        </div>

        <div class="tarjeta">
            <h3>Equipos registrados</h3>
            <strong>{{ $tabla->count() }}</strong>
        </div>
    </div>

    <h2>Tabla de posiciones</h2>

    @if ($tabla->isEmpty())
        <p>Todavía no hay equipos registrados.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Posición</th>
                    <th>Equipo</th>
                    <th>PJ</th>
                    <th>PG</th>
                    <th>PP</th>
                    <th>PE</th>
                    <th>PF</th>
                    <th>PC</th>
                    <th>Diferencia</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($tabla as $fila)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="nombre">
                            {{ $fila->equipo->nombre }}
                        </td>
                        <td>{{ $fila->jugados }}</td>
                        <td>{{ $fila->victorias }}</td>
                        <td>{{ $fila->derrotas }}</td>
                        <td>{{ $fila->empates }}</td>
                        <td>{{ $fila->puntos_favor }}</td>
                        <td>{{ $fila->puntos_contra }}</td>
                        <td>{{ $fila->diferencia }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p>
            <strong>PJ:</strong> partidos jugados.
            <strong>PG:</strong> partidos ganados.
            <strong>PP:</strong> partidos perdidos.
            <strong>PE:</strong> empates.
            <strong>PF:</strong> puntos a favor.
            <strong>PC:</strong> puntos en contra.
        </p>
    @endif
</body>
</html>