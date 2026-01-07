<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - No encontrado</title>
    <link rel="stylesheet" href="{{ asset('css/tu_estilo.css') }}">
</head>
<body class="auth-wrapper"> <div class="auth-card fade-in"> <div class="card-wrapper" style="text-align: center;">
            
            <h1 style="font-size: 4rem; color: var(--primary-color); margin-bottom: 1rem;">404</h1>
            
            <div class="form-container">
                <p style="color: var(--text-muted); margin-bottom: 1.5rem;">
                    Te perdiste pai, aquí no hay nada, vuelve al inicio.
                </p>

                <a href="{{ url('/') }}" class="btn btn-primary" style="justify-content: center; width: 100%;">
                    Volver al inicio
                </a>
            </div>

        </div>
    </div>

</body>
</html>