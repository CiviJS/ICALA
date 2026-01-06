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
        
        <form action="{{url('/planillas/crear')}}" method="POST" class="form-container">
            @csrf
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
                
                <div class="form-group">
                    <label>Persona Encargada</label>
                    <input type="text" id="userSearchInput" placeholder=" Filtrar nombre..." onkeyup="filterUsers()" style="margin-bottom: 5px; padding: 10px;">
                    
                    <select name="IdUsuario" id="userSelect" size="2" class="form-group" style="border: 1px solid var(--border-color); border-radius: 8px; ">
                        @foreach($data['usuarios'] as $usuario)
                            <option value="{{$usuario->uuid}}">{{$usuario->nombre}}</option>
                        @endforeach 
                    </select>
                    @error('IdUsuario')
                        <div class="error-message" style="color: var(--danger-color); font-size: 0.8rem;">{{ $errors->first('IdUsuario') }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Tipo De Evento</label>
                    <select name="TipoServicio" size="1" style="border: 1px solid var(--border-color); border-radius: 8px; padding: 10px;">
                        <option>Servicio normal</option>
                        <option>Servicio de jovenes</option>
                        <option>otro...</option>
                    </select>
                    @error('TipoServicio')
                        <div class="error-message" style="color: var(--danger-color); font-size: 0.8rem;">{{ $errors->first('TipoServicio') }}</div>
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
                    <th class="text-center">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data['planillas'] as $planilla)
                    <tr>
                        <td data-label="Fecha">
                            <strong>{{ $planilla['FechaCreacion'] }}</strong> 
                            <span style="color: var(--text-muted); font-size: 0.85rem;">({{ strtoupper($planilla['DiaSemana']) }})</span>
                        </td>
                        <td data-label="Acciones">
                            <div class="action-group">
                                <a href="{{ url('planillas/ver/' . $planilla['uuid']) }}" class="btn btn-outline" style="padding: 5px 12px; font-size: 0.8rem;">
                                    Ver Detalle
                                </a>
                                
                                <form action="{{ url('planillas/borrar/' . $planilla['uuid']) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline" style="border-color: var(--danger-color); color: var(--danger-color);" onclick="return confirm('⚠️ ¿Borrar esta planilla?');">
                                        Borrar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center" style="padding: 40px; color: var(--text-muted);">
                            No hay planillas registradas actualmente.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>



</body>
</html>