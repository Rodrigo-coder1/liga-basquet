
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar equipo</title>
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
    <h1>Registrar equipo de básquetbol</h1>

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('equipos.store') }}" method="POST">
        @csrf

        <label>Nombre del equipo:</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}" required>
        <br><br>

        <label>Ciudad:</label>
        <input type="text" name="ciudad" value="{{ old('ciudad') }}" required>
        <br><br>

        <label>Entrenador:</label>
        <input type="text" name="entrenador" value="{{ old('entrenador') }}">
        <br><br>

        <button type="submit">Guardar equipo</button>
    </form>

    <br>
    <a href="{{ route('equipos.index') }}">Volver a la lista</a>
</body>
</html>
