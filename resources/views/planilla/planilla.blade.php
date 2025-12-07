<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planillas Registradas - ICALA</title>
    <!-- Fuente Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Vincula el CSS externo -->
    @vite(['resources/css/planilla/planilla.css']) 
  
</head>
<body class ="fade-in">

<div class="layout-container">

    <!-- Encabezado de la Página y Formulario de Creación -->
    <header class="page-header">
        <div class="header-content">
            <h1>📜 Listado de Planillas</h1>
            <div class="nav-actions">
                <a href="{{ url('/') }}" class="btn-primary">
                    ⬅  Volver a Usuarios
                </a>
            </div>
        </div>
        
        <!-- Formulario de Creación de Planilla -->
        <form action="{{url('/planillas/crear')}}" method="POST">
            @csrf
            
            <div class="input-group-user">
                <p>Persona Encargada</p>
                
                <!-- Input de Búsqueda -->
                <div class="search-container">
                    <input type="text" id="userSearchInput" placeholder="Buscar por nombre..." onkeyup="filterUsers()">
                </div>

                <!-- Select original -->
                <select name="IdUsuario" id="userSelect" size="4">
                    @foreach($usuarios as $usuario)
                    <option value="{{$usuario->uuid}}">{{$usuario->nombre}}</option>
                    @endforeach 
                </select>
                @error('IdUsuario')
                    <div class="error-message">{{ $errors->first('IdUsuario') }}</div>
                @enderror
            </div>
            
            <div>
                <p>Tipo De Evento</p>
                <select name="TipoServicio" size="4">
                    <option>Servicio normal</option>
                    <option>Servicio de jovenes</option>
                    <option>otro...</option>
                </select>
                @error('TipoServicio')
                    <div class="error-message">{{ $errors->first('TipoServicio') }}</div>
                @enderror
            </div>

            <button type="submit">Crear Planilla</button>
        </form>
    </header>

    <!-- Tabla de Planillas -->
    <div class="table-responsive-wrapper">
        <table class="pro-table">
            <thead>
                <tr>
                    <th>Fecha de Creación</th>
                    <th class="text-right">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($planillas as $planilla)
                    <tr>
                        <!-- data-label es CLAVE para la vista móvil -->
                        <td data-label="Fecha">{{ $planilla['FechaCreacion'].' ('.strtoupper($planilla['DiaSemana']).')' }}</td>
                        <td data-label="Acciones">
                            <div class="action-group">
                                <!-- Botón Ver -->
                                <a href="{{ url('planillas/ver/' . $planilla['uuid']) }}" class="btn-icon-action view">
                                    Ver Detalle
                                </a>
                                
                                <!-- Formulario Borrar -->
                                <form action="{{ url('planillas/borrar/' . $planilla['uuid']) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button" onclick="return confirm('⚠️ ¿Estás seguro de que deseas borrar esta planilla? Esta acción no se puede deshacer.');">
                                        Borrar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center" style="padding: 30px; color: var(--secondary);">
                            No hay planillas registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<script>
    /**
     * Función para filtrar las opciones del select en tiempo real
     * basándose en la entrada del campo de búsqueda.
     */
    function filterUsers() {
        // Obtener el input de búsqueda y el select
        const input = document.getElementById('userSearchInput');
        const filter = input.value.toUpperCase();
        const select = document.getElementById('userSelect');
        const options = select.getElementsByTagName('option');

        // Recorrer todas las opciones y ocultar/mostrar según el filtro
        for (let i = 0; i < options.length; i++) {
            const txtValue = options[i].textContent || options[i].innerText;
            
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                // Si coincide, mostrar la opción
                options[i].style.display = "";
            } else {
                // Si no coincide, ocultar la opción
                options[i].style.display = "none";
            }
        }
    }
</script>

</body>
</html>