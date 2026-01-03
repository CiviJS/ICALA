<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Integrantes - ICALA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="fade-in">

    @if (session('error'))
        <div class="alert-box-error">
            <span>Error: </span> {{ session('error') }}
        </div>
    @endif

    <div class="layout-container">
        <header class="main-header">
            <div class="brand">
                <h1>
                    <span>⛪</span> ICALA 
                    <span class="subtitle">| Gestión de Integrantes</span>
                    
                </h1>
                
            </div>
            @if(auth()->check())
                        <div><p>Bienvenido {{ auth()->user()->name }}</p></div>
                        <a href="{{url('/logout')}}"class="btn btn-outline" > Cerrar Sesion 🚪</a>
            @endif
            <nav class="top-nav">
                <a href="{{ url('/planillas') }}" class="btn btn-outline">📋 Planillas</a>
                <a href="{{ url('/Reportes') }}" class="btn btn-outline">📊 Reportes</a>
                <a href="{{ url('/Usuario/crear') }}" class="btn btn-primary">+ Nuevo Usuario</a>
            </nav>
        </header>

        <main>
            @if (session('message'))
                <div class="alert-box">
                    <span>✅</span> {{ session('message') }}
                </div>
            @endif

            <div class="toolbar">
                <h3>Base de Datos de Miembros</h3>
                <a href="{{ url('/') }}" class="btn btn-outline">Mostrar Todo</a>
                <form action="{{ url('usuario/buscar') }}" method="GET" class="search-bar">
                    <input type="text" name="campo" placeholder="Buscar nombre..." required>
                    <button type="submit" class="btn">🔍</button>
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
                                <td data-label="Nacimiento">{{ $usuario->fechanacimiento }}</td>
                                <td data-label="Teléfono">{{ $usuario->telefono }}</td>
                                <td data-label="Asistencias" class="text-center">
                                    <span class="badge badge-success">{{ $usuario->planillas_count }}</span>
                                </td>
                                <td data-label="Faltas" class="text-center">
                                    <span class="badge badge-danger">{{ $usuario->NoAsistidas }}</span>
                                </td>
                                <td data-label="Acciones">
                                    <div class="action-group">
                                        <a href="{{ url('/Usuario/editar/' . $usuario->uuid) }}" class="btn-icon-action edit" title="Editar">✏️</a>
                                        <form action="{{ url('/Usuario/borrar/' . $usuario->uuid) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon-action delete" title="Eliminar" onclick="return confirm('⚠️ ¿Estás seguro de eliminar a {{ $usuario->nombre }}?');">🗑️</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($usuarios->isEmpty())
                <div style="text-align: center; padding: 40px; color: #64748b;">
                    <p>No se encontraron resultados.</p>
                </div>
            @endif

        </main>
    </div>

</body>
</html>
