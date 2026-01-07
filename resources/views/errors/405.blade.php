<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acción no permitida</title>
    <link rel="stylesheet" href="{{ asset('css/tu_estilo.css') }}">
</head>
<body class="auth-wrapper"> <div class="auth-card fade-in"> <div class="card-wrapper" style="text-align: center;">
            
            <div style="margin-bottom: 1.5rem;">
                <span class="badge badge-danger">ERROR 405</span>
            </div>

            <h1 style="color: var(--danger-color); margin-bottom: 1rem;">Método no permitido</h1>
            
            <p style="color: var(--text-muted); margin-bottom: 2rem;">
                La acción que intentaste no está permitida por el servidor Dios te bendiga.
            </p>

            <a href="{{ url('/') }}" class="btn btn-primary" style="justify-content: center; width: 100%;">
                Volver al inicio
            </a>
            
        </div>
    </div>

</body>
</html>