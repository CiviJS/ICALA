<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel='icon' type="image/jpeg" href="images/ICALA.jpg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="auth-wrapper">
        <div class="auth-card">

            <div class="auth-header">
                <h1>ICALA</h1>
                <p class="subtitle">Gestión de Personal</p>
            </div>

            <div class="card-wrapper">
                <h2 class="text-center" style="margin-bottom: 20px;">Bienvenido</h2>

                @if (session('error'))
                    <div class="alert-box-error">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ url('/auth') }}" method="POST" class="form-container">
                    @csrf

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            autofocus>
                        @error('email')
                            <p style="color: var(--danger-color); font-size: 0.8rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div style="margin-top: 10px;">
                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            Iniciar Sesión
                        </button>
                    </div>
                    @error('throttle')
                        <div class="alert-box-error">
                            <span><strong>Seguridad:</strong></span> {{ $message }}
                        </div>
                    @enderror
                </form>
            </div>

            <div class="auth-footer">
                &copy; {{ date('Y') }} Todos los derechos reservados.
            </div>
        </div>
    </div>

</body>

</html>
