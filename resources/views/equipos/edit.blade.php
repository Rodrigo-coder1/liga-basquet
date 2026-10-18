
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar equipo</title>
</head>
<body>
    <h1>Editar equipo</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('equipos.update', $equipo) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nombre">Nombre del equipo:</label>
            <input
                type="text"
                id="nombre"
                name="nombre"
                value="{{ old('nombre', $equipo->nombre) }}"
                required
                maxlength="100"
            >
        </div>

        <br>

        <div>
            <label for="ciudad">Ciudad:</label>
            <input
                type="text"
                id="ciudad"
                name="ciudad"
                value="{{ old('ciudad', $equipo->ciudad) }}"
                required
                maxlength="100"
            >
        </div>

        <br>

        <div>
            <label for="entrenador">Entrenador:</label>
            <input
                type="text"
                id="entrenador"
                name="entrenador"
                value="{{ old('entrenador', $equipo->entrenador) }}"
                maxlength="100"
            >
        </div>

        <br>

        <button type="submit">Guardar cambios</button>
        <a href="{{ route('equipos.index') }}">Cancelar</a>
    </form>
</body>
</html>
