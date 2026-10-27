<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jugadores de Básquetbol</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
    <div class="panel-usuario">
        <div class="usuario-info">
            <span class="usuario-icono">🏀</span>

            <div class="usuario-texto">
                <small>USUARIO ACTIVO</small>
                <strong>{{ auth()->user()->name }}</strong>
                <span>{{ auth()->user()->email }}</span>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="form-logout">
            @csrf
            <button type="submit">🚪 Cerrar sesión</button>
        </form>
    </div>
    <h1>Gestión de Jugadores</h1>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('jugadores.create') }}">Registrar jugador</a>
    |
    <a href="{{ route('equipos.index') }}">Volver a equipos</a>

    <h2>Lista de jugadores</h2>

    @if ($jugadores->isEmpty())
        <p>Todavía no hay jugadores registrados.</p>
    @else
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Número</th>
                    <th>Posición</th>
                    <th>Equipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($jugadores as $jugador)
                    <tr>
                        <td>{{ $jugador->nombre }}</td>
                        <td>{{ $jugador->apellidos }}</td>
                        <td>{{ $jugador->numero_camiseta }}</td>
                        <td>{{ $jugador->posicion ?? 'Sin especificar' }}</td>
                        <td>{{ $jugador->equipo?->nombre ?? 'Sin equipo' }}</td>

                        <td>
                            <a href="{{ route('jugadores.edit', $jugador) }}">
                                Editar
                            </a>

                            <form
                                action="{{ route('jugadores.destroy', $jugador) }}"
                                method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('¿Seguro que deseas eliminar este jugador?');"
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