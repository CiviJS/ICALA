<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planillas Registradas - ICALA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="fade-in">

    <div class="layout-container wide">

        <header class="main-header">
            <div class="brand">
                <h1>Listado de Planillas</h1>
            </div>
            <div class="user-info">
                <a href="{{ url('/') }}" class="btn btn-outline">
                    ⬅ Volver a Usuarios
                </a>
            </div>
        </header>

        <div class="card-wrapper" style="margin-bottom: 40px;">
            <h3 style="margin-bottom: 20px; color: var(--primary-color);">Nueva Planilla</h3>

            <form action="{{ url('/planillas/crear') }}" method="POST" class="form-container">
                @csrf

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">

                    <div class="form-group">
                        <label>Persona Encargada</label>
                        <input type="text" id="userSearchInput" placeholder=" Filtrar nombre..."
                            onkeyup="filterUsers()" style="margin-bottom: 5px; padding: 10px;">

                        <select name="IdUsuario" id="userSelect" size="2" class="form-group"
                            style="border: 1px solid var(--border-color); border-radius: 8px; ">
                            @foreach ($admins as $admin)
                                <option value="{{ $admin['id'] }}">{{ $admin['name'] }}</option>
                            @endforeach
                        </select>
                        @error('IdUsuario')
                            <div class="error-message" style="color: var(--danger-color); font-size: 0.8rem;">
                                {{ $errors->first('IdUsuario') }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tipo De Evento</label>
                        <select name="TipoServicio" size="1"
                            style="border: 1px solid var(--border-color); border-radius: 8px; padding: 10px;">
                            <option>Servicio normal</option>
                            <option>Servicio de jovenes</option>
                            <option>otro...</option>
                        </select>
                        @error('TipoServicio')
                            <div class="error-message" style="color: var(--danger-color); font-size: 0.8rem;">
                                {{ $errors->first('TipoServicio') }}</div>
                        @enderror
                    </div>

                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">
                        Crear Planilla
                    </button>
                </div>
            </form>
        </div>

        <div class="table-responsive-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Fecha de Creación</th>
                        <th>tipo de actividad</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($planillas as $planilla)
                        <tr class="fade-in">
                            <td data-label="Fecha">
                                <strong>{{ $planilla->fechacreacion }}</strong>
                                {{-- Asegúrate de que 'DiaSemana' exista en el modelo o sea un Appended attribute --}}
                                @if (isset($planilla->DiaSemana))
                                    <span style="color: var(--text-muted); font-size: 0.75rem;">
                                        ({{ strtoupper($planilla->DiaSemana) }})
                                    </span>
                                @endif
                            </td>

                            <td data-label="Actividad">
                                <span class="badge badge-primary" style="font-size: 0.7rem;">
                                    {{ $planilla->tipodeactividad }}
                                </span>
                            </td>

                            <td data-label="Acciones">
                                <div class="action-group">
                                    {{-- Usamos route() si tienes nombres de ruta, o url() como tenías --}}
                                    <a href="{{ url('planillas/ver/' . $planilla->uuid) }}" class="btn btn-outline"
                                        style="padding: 4px 10px; font-size: 0.75rem;">
                                        Ver Detalle
                                    </a>

                                    <form action="{{ url('planillas/borrar/' . $planilla->uuid) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline"
                                            style="border-color: var(--danger-color); color: var(--danger-color); padding: 4px 10px; font-size: 0.75rem;"
                                            onclick="return confirm('⚠️ ¿Borrar esta planilla?');">
                                            Borrar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            {{-- Cambiado a colspan="3" para cubrir Fecha, Actividad y Acciones --}}
                            <td colspan="3" class="text-center"
                                style="padding: 30px; color: var(--text-muted); font-size: 0.8rem;">
                                No hay planillas registradas actualmente.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <a href="{{$planillas->previousPageUrl() }}" class="btn btn-outline">Anterior</a>
        <span>pagina {{$planillas->currentPage()}} de {{$planillas->lastPage()}}</span>
         <a href="{{ $planillas->nextPageUrl() }}" class="btn btn-outline">Siguiente</a>
    </div>

</body>

</html>
