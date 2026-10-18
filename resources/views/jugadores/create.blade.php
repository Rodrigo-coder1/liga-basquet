<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar jugador</title>
</head>
<body>
    <h1>Registrar jugador de básquetbol</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($equipos->isEmpty())
        <p style="color: red;">
            Primero debes registrar un equipo antes de agregar jugadores.
        </p>

        <a href="{{ route('equipos.create') }}">Registrar equipo</a>
    @else
        <form action="{{ route('jugadores.store') }}" method="POST">
            @csrf

            <div>
                <label for="nombre">Nombre:</label>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre') }}"
                    maxlength="100"
                    required
                >
            </div>

            <br>

            <div>
                <label for="apellidos">Apellidos:</label>
                <input
                    type="text"
                    id="apellidos"
                    name="apellidos"
                    value="{{ old('apellidos') }}"
                    maxlength="100"
                    required
                >
            </div>

            <br>

            <div>
                <label for="numero_camiseta">Número de camiseta:</label>
                <input
                    type="number"
                    id="numero_camiseta"
                    name="numero_camiseta"
                    value="{{ old('numero_camiseta') }}"
                    min="0"
                    max="99"
                    required
                >
            </div>

            <br>

            <div>
                <label for="posicion">Posición:</label>
                <select id="posicion" name="posicion">
                    <option value="">Seleccionar posición</option>

                    @foreach ([
                        'Base',
                        'Escolta',
                        'Alero',
                        'Ala-pívot',
                        'Pívot'
                    ] as $posicion)
                        <option
                            value="{{ $posicion }}"
                            {{ old('posicion') == $posicion ? 'selected' : '' }}
                        >
                            {{ $posicion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <br>

            <div>
                <label for="equipo_id">Equipo:</label>
                <select id="equipo_id" name="equipo_id" required>
                    <option value="">Seleccionar equipo</option>

                    @foreach ($equipos as $equipo)
                        <option
                            value="{{ $equipo->id }}"
                            {{ old('equipo_id') == $equipo->id ? 'selected' : '' }}
                        >
                            {{ $equipo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <br>

            <button type="submit">Guardar jugador</button>
        </form>
    @endif

    <br>
    <a href="{{ route('jugadores.index') }}">Volver a jugadores</a>
</body>
</html>