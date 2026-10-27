<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar partido</title>
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
    <h1>Editar partido de básquetbol</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('partidos.update', $partido) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="equipo_local_id">Equipo local:</label>
            <select id="equipo_local_id" name="equipo_local_id" required>
                <option value="">Seleccionar equipo local</option>

                @foreach ($equipos as $equipo)
                    <option
                        value="{{ $equipo->id }}"
                        {{ old('equipo_local_id', $partido->equipo_local_id) == $equipo->id ? 'selected' : '' }}
                    >
                        {{ $equipo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label for="equipo_visitante_id">Equipo visitante:</label>
            <select id="equipo_visitante_id" name="equipo_visitante_id" required>
                <option value="">Seleccionar equipo visitante</option>

                @foreach ($equipos as $equipo)
                    <option
                        value="{{ $equipo->id }}"
                        {{ old('equipo_visitante_id', $partido->equipo_visitante_id) == $equipo->id ? 'selected' : '' }}
                    >
                        {{ $equipo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label for="fecha">Fecha y hora:</label>
            <input
                type="datetime-local"
                id="fecha"
                name="fecha"
                value="{{ old('fecha', $partido->fecha->format('Y-m-d\TH:i')) }}"
                required
            >
        </div>

        <br>

        <p>Si el partido está pendiente, deja los dos marcadores vacíos.</p>

        <div>
            <label for="puntos_local">Puntos del equipo local:</label>
            <input
                type="number"
                id="puntos_local"
                name="puntos_local"
                value="{{ old('puntos_local', $partido->puntos_local) }}"
                min="0"
                max="999"
            >
        </div>

        <br>

        <div>
            <label for="puntos_visitante">Puntos del equipo visitante:</label>
            <input
                type="number"
                id="puntos_visitante"
                name="puntos_visitante"
                value="{{ old('puntos_visitante', $partido->puntos_visitante) }}"
                min="0"
                max="999"
            >
        </div>

        <br>

        <button type="submit">Guardar cambios y resultado</button>
        <a href="{{ route('partidos.index') }}">Cancelar</a>
    </form>
</body>
</html>