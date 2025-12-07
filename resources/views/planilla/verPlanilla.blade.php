<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Planilla</title>
    <!-- Fuente Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Carga los estilos definidos arriba -->
    @vite(['resources/css/planilla/verPlanilla.css'])
</head>
<body class ="fade-in">

<div class="layout-container">


    <!-- Título y Botón Volver -->
    <h2>📋 Planilla del {{ $planilla->FechaCreacion }}</h2>
    <h1>Tipo de Actividad: {{$planilla->TipoDeActividad}}</h1>
    <h1>Usuario a cargo: {{$planilla->encargado->nombre;}}</h1>
    <a href="{{ url('/planillas') }}" class="btn-volver">
        ⬅️ Volver al Listado
    </a>
         @if (session('error'))
                <div class="alert-box">
                    <span>🚫🙅‍♀️</span> {{ session('error') }}
                </div>
                <br>
            @endif

    <!-- Tabla de Usuarios -->
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Teléfono</th>
                <th>Asistencia</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
            <tr>
                <!-- data-label para responsividad móvil -->
                <td data-label="Nombre">{{ $usuario->nombre }}</td>
                <td data-label="Edad">{{ $usuario->edad }}</td>
                <td data-label="Teléfono">{{ $usuario->telefono }}</td>

                <!-- Columna de Asistencia (con estilos dinámicos) -->
                <td data-label="Asistencia">
                    @if ($usuario->asistencia)
                        <span class="attendance-status status-asistio">Asistió</span>
                    @else
                        <span class="attendance-status status-no-asistio">No asistió</span>
                    @endif
                </td>

                <!-- Columna de Opciones (con botón dinámico) -->
                <td data-label="Acción">
                    <!-- Formulario de acción POST (cambiado a PUT recomendado para actualizaciones) -->
                    <form action="{{ url('/planilla/Asistencia/'.$planilla->uuid.'/'.$usuario->uuid) }}" method="POST">
                        @csrf
                        <!-- Usar PUT o PATCH es más semántico para una actualización -->
                        @method('PUT') 
                        
                        <!-- Lógica para alternar el botón según el estado de asistencia -->
                        @if ($usuario->asistencia)
                            <!-- Si asistió, el botón es rojo para DESMARCAR (estado=0) -->
                            <input type="hidden" name="estado" value="0">
                            <button type="submit" class="btn-danger">
                                Desmarcar Asistencia
                            </button>
                        @else
                            <!-- Si NO asistió, el botón es verde para MARCAR (estado=1) -->
                            <input type="hidden" name="estado" value="1">
                            <button type="submit" class="btn-success">
                                Marcar Asistencia
                            </button>
                        @endif
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>