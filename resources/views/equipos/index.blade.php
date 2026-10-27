<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Equipos de Básquetbol</title>
</head>
<body>
    <h1>Gestión de Liga de Básquetbol</h1>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <div>
    <a href="{{ route('equipos.create') }}">Registrar equipo</a>
    |
    <a href="{{ route('jugadores.index') }}">Ver jugadores</a>
    |
    <a href="{{ route('partidos.index') }}">Gestionar partidos</a>
    |
    <a href="{{ route('estadisticas.index') }}">Estadísticas</a>
</div>
    <h2>Lista de equipos</h2>

    @if ($equipos->isEmpty())
        <p>Todavía no hay equipos registrados.</p>
    @else
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                    <th>Entrenador</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($equipos as $equipo)
                    <tr>
                        <td>{{ $equipo->nombre }}</td>
                        <td>{{ $equipo->ciudad }}</td>
                        <td>{{ $equipo->entrenador ?? 'Sin asignar' }}</td>

                        <td>
                            <a href="{{ route('equipos.edit', $equipo) }}">
                                Editar
                            </a>

                            <form
                                action="{{ route('equipos.destroy', $equipo) }}"
                                method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('¿Seguro que deseas eliminar este equipo?');"
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