<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/usuarios/editarUsuario.css'])
</head>
<body>
    <div class="layout-container fade-in">

    <div class="main-header" style="border-left: 5px solid var(--success);">
        <a href={{url('/')}} class="btn btn-outline">
            &larr; Volver
        </a>        
        @if (session('message'))
            <div class="alert-box">
                <span>✅</span> {{ session('message') }}
            </div>
        @endif
        
        <div class="brand">
             <h1>Editar Usuario: {{ $usuario->nombre }}</h1>
             <p class="subtitle">Modifique los campos necesarios y guarde los cambios.</p>
        </div>
       
    </div>
 
    <div class="card-wrapper">
        <form action="{{ url('/Usuario/update', $usuario->UUID) }}" method="POST">
            @csrf
            @method('PUT') <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>
                @error('nombre')
                    <div class="error-message">{{ $errors->first('nombre') }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="{{ old('fechaNacimiento', $usuario->fechaNacimiento) }}" required>
                @error('fechaNacimiento')
                    <div class="error-message">{{ $errors->first('fechaNacimiento') }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="fechaIngreso">Fecha de Ingreso:</label>
                <input type="date" id="fechaIngreso" name="fechaIngreso" value="{{ old('fechaIngreso', $usuario->fechaIngreso) }}" required>
                @error('fechaIngreso')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $usuario->telefono) }}" required>
                @error('telefono')
                    <div class="error-message">{{ $errors->first('telefono') }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ url('/') }}" class="btn btn-outline">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
