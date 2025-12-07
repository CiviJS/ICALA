<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Integrantes - ICALA</title>
    <!-- Carga de la fuente Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css'])
</head>
<body class="fade-in">
    
    @if(session('error')) 
    <div class="layout-container">
        <div class="alert-placeholder">
        @if(session('error')) <div class="alert-box-error">...</div> @endif
        </div>
    </div>


    <div class="layout-container">
        <header class="main-header">
            <div class="brand">
                <h1>
                    <span>⛪</span> ICALA 
                    <span class="subtitle">| Gestión de Integrantes</span>
                </h1>
            </div>
            
            <nav class="top-nav">
                <!-- Los hrefs son solo placeholders estáticos -->
                <a href="#" class="btn btn-outline">📋 Planillas</a>
                <a href="#" class="btn btn-outline">📊 Reportes</a>
                <a href="#" class="btn btn-primary">+ Nuevo Usuario</a>
            </nav>
        </header>

        <main>
       @if(session('message')) 
       <div class="alert-box">...</div> 
       @endif

            <div class="toolbar">
                <h3>Base de Datos de Miembros (Total Registros)</h3>
                <a href="#" class="btn btn-outline">Mostrar Todo</a>
                <form action="#" method="GET" class="search-bar">
                    <input type="text" name="campo" placeholder="Buscar nombre..." required>
                    <button type="submit" class="btn" style="background: none; padding: 0 10px;">🔍</button>
                </form>
            </div>  
            
            <div class="table-responsive-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Nacimiento</th>
                            <th>Teléfono</th>
                            <th class="text-center">Asistencias</th>
                            <th class="text-center">Faltas</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
               @foreach ($usuarios as $usuario) 
                        
                        <tr>
                            <td data-label="Nombre"><strong>{{ $usuario->nombre }}</strong></td>
                            <td data-label="Nacimiento">{{ $usuario->nacimiento }}</td>
                            <td data-label="Teléfono">{{ $usuario->telefono }}</td>
                            <td data-label="Asistencias" class="text-center">
                                <span class="badge badge-success">{{ $usuario->asistencias }}</span>
                            </td>
                            <td data-label="Faltas" class="text-center">
                                <span class="badge badge-danger">{{ $usuario->faltas }}</span>
                            </td>
                            <td data-label="Acciones">
                                <div class="action-group">
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn-icon-action edit" title="Editar">✏️</a>
                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon-action delete" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar a {{ $usuario->nombre }}?')">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    
                       @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Aquí iría la Paginación (si aplica) -->

        </main>
    </div>

</body>
</html>