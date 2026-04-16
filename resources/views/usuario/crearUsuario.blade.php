<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar Integrante - ICALA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="fade-in">

    <div class="layout-container form-view">
        <header class="main-header" style="border-left: 5px solid var(--primary-color); padding-left: 20px; align-items: flex-start; flex-direction: column;">
            <a href="{{ url('/') }}" class="btn btn-outline" style="margin-bottom: 15px;">
                &larr; Volver al Listado
            </a>
            <div class="brand">
                <h1>Registrar Nuevo Integrante</h1>
                <p class="subtitle">Ingrese los datos requeridos para el registro oficial en la base de datos.</p>
            </div>
        </header>

        <main>
            <div class="card-wrapper">
                <form action="{{ url('/Usuario/store') }}" method="POST" class="form-container">
                    @csrf
                    
                    <div class="form-group">
                        <label for="nombre">Nombre Completo</label>
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="Ej. Juan Pérez" required>
                        @error('nombre')
                            <div class="error-message" style="color: var(--danger-color); font-size: 0.8rem; margin-top: 5px;">
                                 {{ $errors->first('nombre') }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="fechanacimiento">Fecha de Nacimiento</label>
                        <input type="date" id="fechanacimiento" name="fechanacimiento" value="{{ old('fechanacimiento') }}" required>
                        @error('fechanacimiento')
                            <div class="error-message" style="color: var(--danger-color); font-size: 0.8rem; margin-top: 5px;">
                                 {{ $errors->first('fechanacimiento') }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="fechaingreso">Fecha de Ingreso a la Iglesia</label>
                        <input type="date" id="fechaingreso" name="fechaingreso" value="{{ old('fechaingreso') }}" required>
                        @error('fechaingreso')
                            <div class="error-message" style="color: var(--danger-color); font-size: 0.8rem; margin-top: 5px;">
                                 {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="telefono">Número de Teléfono</label>
                        <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" placeholder="Ej. 123456789" required>
                        @error('telefono')
                            <div class="error-message" style="color: var(--danger-color); font-size: 0.8rem; margin-top: 5px;">
                                 {{ $errors->first('telefono') }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                         Guardar Registro
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

</body>
</html>