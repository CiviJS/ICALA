<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='icon' type="image/jpeg" href="{{ asset('images/ICALA.jpg') }}">
    <title>Gestión de Eventos ICALA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="fade-in">
    <div class="layout-container">

        <header class="main-header">
            <div class="brand">
                <h1>Gestión de Eventos</h1>
            </div>
            <a href="{{ url('/') }}" class="btn btn-outline">Volver al Inicio</a>
        </header>

        @if (session('error'))
            <div class="alert-box-error">
                <span><strong> Error:</strong> {{ session('error') }}</span>
            </div>
        @endif

        @if (session('message'))
            <div class="alert-box">
                <span>{{ session('message') }}</span>
            </div>
        @endif

        <div class="card-wrapper" style="margin-bottom: 2.5rem;">
            <h2 style="margin-bottom: 1.5rem; font-size: 1.2rem;"> Crear Nuevo Evento</h2>
            <form action="/Eventos/crear" method="POST" class="form-container">
                @csrf
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem;">

                    <div class="form-group">
                        <label>Nombre del Evento</label>
                        <input type="text" name='nombre' value="{{ old('nombre') }}"
                            placeholder="Ej: Retiro Espiritual">
                        @error('nombre')
                            <small style="color: var(--danger-color)">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Fecha de Inicio</label>
                        <input type="datetime-local" name='fecha_inicio' value="{{ old('fecha_inicio') }}">
                        @error('fecha_inicio')
                            <small style="color: var(--danger-color)">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Admin Encargado</label>
                        <select name='admin_encargado'>
                            @foreach ($admins as $admin)
                                <option value="" disabled selected>Seleccione un responsable</option>
                                <option value="{{ $admin['id'] }}">{{ $admin['name'] }}</option>
                            @endforeach

                        </select>

                        @error('admin_encargado')
                            <small style="color: var(--danger-color)">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group" style="margin-top: 1rem;">
                    <label>Descripción</label>
                    <input type="text" name='descripcion' value="{{ old('descripcion') }}"
                        placeholder="Breve detalle del evento...">
                    @error('descripcion')
                        <small style="color: var(--danger-color)">{{ $message }}</small>
                    @enderror
                </div>

                <div style="margin-top: 1rem; text-align: right;">
                    <button type='submit' class="btn btn-primary">Crear Evento</button>
                </div>
            </form>
        </div>

        <h2 style="margin-bottom: 1rem; font-size: 1.2rem;">Eventos Registrados</h2>
        <div class="table-responsive-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Evento</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventos as $evento)
                        <tr>
                            <td data-label="Evento"><strong>{{ $evento->nombre }}</strong></td>
                            <td data-label="Fecha">
                                    {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y')}}  a las  {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('h:i A')}}
                    
                            </td>
                            <td data-label="Descripción" class="text-muted">{{ Str::limit($evento->descripcion, 50) }}
                            </td>
                            <td data-label="Acciones">
                                <div class="action-group">
                                    <a href="{{ url('/Evento/Editar/' . $evento->uuid) }}" class="btn btn-outline"
                                        style="padding: 0.4rem 0.8rem;">Editar</a>

                                    <form method="POST" action="{{ url('/Evento/borrar/' . $evento->uuid) }}"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline"
                                            style="border-color: var(--danger-color); color: var(--danger-color); padding: 0.4rem 0.8rem;"
                                            onclick="return confirm('⚠️ ¿Estás seguro de eliminar este evento?');">
                                            Borrar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
