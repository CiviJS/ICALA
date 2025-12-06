<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/usuarios/crearUsuario.css')
</head>
<body>
    <div class="layout-container fade-in">

    <div class="main-header" style="border-left: 5px solid var(--accent);">
        <a href={{url('/')}} class="btn btn-outline">
            &larr; Volver
        </a>
        <div class="brand">
             <h1>Registrar Nuevo Usuario</h1>
             <p class="subtitle">Ingrese los datos requeridos para el registro.</p>
        </div>
    </div>

    <div class="card-wrapper">
        <form action="{{ url('/Usuario/store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                @error('nombre')
                    <div class="error-message">{{ $errors->first('nombre') }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="{{ old('fechaNacimiento') }}" required>
                @error('fechaNacimiento')
                    <div class="error-message">{{ $errors->first('fechaNacimiento') }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="fechaIngreso">Fecha de Ingreso a la iglesia:</label>
                <input type="date" id="fechaIngreso" name="fechaIngreso" value="{{ old('fechaIngreso') }}" required>
                @error('fechaIngreso')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" required>
                @error('telefono')
                    <div class="error-message">{{ $errors->first('telefono') }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Crear Usuario</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>