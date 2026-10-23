<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar partido</title>
</head>
<body>
    <h1>Registrar partido de básquetbol</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($equipos->count() < 2)
        <p style="color: red;">
            Necesitas registrar al menos dos equipos para programar un partido.
        </p>

        <a href="{{ route('equipos.create') }}">Registrar equipo</a>
    @else
        <form action="{{ route('partidos.store') }}" method="POST">
            @csrf

            <div>
                <label for="equipo_local_id">Equipo local:</label>

                <select id="equipo_local_id" name="equipo_local_id" required>
                    <option value="">Seleccionar equipo local</option>

                    @foreach ($equipos as $equipo)
                        <option
                            value="{{ $equipo->id }}"
                            {{ old('equipo_local_id') == $equipo->id ? 'selected' : '' }}
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
                            {{ old('equipo_visitante_id') == $equipo->id ? 'selected' : '' }}
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
                    value="{{ old('fecha', now()->format('Y-m-d\TH:i')) }}"
                    required
                >
            </div>

            <br>

            <p>Si el partido todavía no se ha jugado, deja los marcadores vacíos.</p>

            <div>
                <label for="puntos_local">Puntos del equipo local:</label>

                <input
                    type="number"
                    id="puntos_local"
                    name="puntos_local"
                    value="{{ old('puntos_local') }}"
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
                    value="{{ old('puntos_visitante') }}"
                    min="0"
                    max="999"
                >
            </div>

            <br>

            <button type="submit">Guardar partido</button>
        </form>
    @endif

    <br>
    <a href="{{ route('partidos.index') }}">Volver a partidos</a>
</body>
</html>