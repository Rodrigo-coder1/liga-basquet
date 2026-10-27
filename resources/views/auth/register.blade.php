<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear cuenta - Basket Anime League</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
    <h1>BASKET ANIME LEAGUE</h1>

    <h2>¡Únete a la liga!</h2>
    <p>Crea tu cuenta para administrar equipos, jugadores y partidos.</p>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.submit') }}" method="POST">
        @csrf

        <div>
            <label for="name">Nombre completo</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                maxlength="255"
                autocomplete="name"
                required
            >
        </div>

        <br>

        <div>
            <label for="email">Correo electrónico</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                autocomplete="email"
                required
            >
        </div>

        <br>

        <div>
            <label for="password">Contraseña (mínimo 8 caracteres)</label>
            <input
                type="password"
                id="password"
                name="password"
                autocomplete="new-password"
                minlength="8"
                required
            >
        </div>

        <br>

        <div>
            <label for="password_confirmation">Repetir contraseña</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                autocomplete="new-password"
                minlength="8"
                required
            >
        </div>

        <br>

        <button type="submit">Crear cuenta 🏀</button>
    </form>

    <p>¿Ya tienes una cuenta?</p>
    <a href="{{ route('login') }}">Volver al login</a>
</body>
</html>