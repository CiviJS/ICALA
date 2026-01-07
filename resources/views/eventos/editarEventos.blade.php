<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Evento | Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/tu_estilo.css') }}">
    @vite(['resources/css/app.css']);
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="layout-container fade-in">
        <header class="main-header">
            <div class="brand">
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    Editar Evento
                </h1>
            </div>
            <div class="nav-action">
                <a href="{{ url('/Eventos') }}" class="btn btn-outline">Volver al listado</a>
            </div>
        </header>

        @if (!empty($evento))
            <div class="card-wrapper">
                <form method="post" action="{{ url('/Evento/actualizar/' .$evento->uuid) }}" class="form-container">
                    @method('put')
                    @csrf

                    <div class="form-group">
                        <label for="nombre">Nombre del Evento</label>
                        <input type="text" name="nombre" id="nombre" value="{{ $evento->nombre }}" placeholder="Ej: Conferencia Anual">
                        @error('nombre')
                            <div class="alert-box-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="fecha_inicio">Fecha y Hora de Inicio</label>
                        <input type="datetime-local" name="fecha_inicio" id="fecha_inicio" value="{{ $evento->fecha_inicio }}">
                        @error('fecha_inicio')
                            <div class="alert-box-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" value="{{ $evento->descripcion }}" placeholder="Breve detalle del evento">
                        @error('descripcion')
                            <div class="alert-box-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="admin_encargado">Administrador Encargado</label>
                        <select name="admin_encargado" id="admin_encargado">
                            <option value="" disabled>Seleccione un responsable</option>
                            @foreach ($admins as $admin)
                                <option value="{{ $admin['id'] }}" {{ $evento->admin_encargado == $admin['id'] ? 'selected' : '' }}>
                                    {{ $admin['name'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('admin_encargado')
                            <div class="alert-box-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="margin-top: 1rem; display: flex; justify-content: flex-end;">
                        <button type="submit" class="btn-save">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                            Actualizar Evento
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="alert-box-error">
                <p>No se encontró la información del evento solicitado.</p>
                <a href="{{ url('/Eventos') }}" style="color: inherit; font-weight: bold;">Regresar</a>
            </div>
        @endif
    </div>

</body>
</html>