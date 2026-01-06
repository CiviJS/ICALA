<!DOCTYPE html>
<html lang="es">
<<<<<<< HEAD

=======
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Integrantes - ICALA</title>
<<<<<<< HEAD
    <link rel='icon' type="image/jpeg" href="images/ICALA.jpg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

=======
       <link rel='icon' type="image/jpeg" href="images/ICALA.jpg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
<body class="fade-in">

    <div class="layout-container">
        @if (session('error'))
            <div class="alert-box-error">
                <span><strong>⚠️ Error:</strong></span> {{ session('error') }}
            </div>
        @endif

        <header class="main-header">
<<<<<<< HEAD


            <div class="brand">
                <h1>
                    <span> <img src="images/ICALA.jpg" height="30hv"></img></span> ICALA
                    <span class="subtitle">| Gestión de Integrantes</span>
                </h1>


            </div>
            @if (auth()->check())
                <p>Hola, <strong>{{ auth()->user()->name }}</strong></p>
                <a href="{{ url('/logout') }}" class="btn btn-outline"
                    style="border-color: var(--danger-color); color: var(--danger-color);">Cerrar Sesión </a>
            @endif

            <div class="user-info">

                <nav class="top-nav">

                    <a href="{{ url('/planillas') }}" class="btn btn-outline">Planillas</a>
                    <a href="{{ url('/Reportes') }}" class="btn btn-outline">Reportes</a>
                    <a href="{{ url('/Usuario/crear') }}" class="btn btn-primary">+ Nuevo Usuario</a>
                    <a href="{{ url('/Eventos') }}" class="btn btn-outline">Control de eventos</a>
                </nav>
            </div>


=======
            
            
            <div class="brand">
                <h1>
                    <span> <img src="images/ICALA.jpg" height="30hv"></img></span> ICALA 
                    <span class="subtitle">| Gestión de Integrantes</span>
                </h1>
               
                 
            </div>
              @if(auth()->check())
                    <p>Hola, <strong>{{ auth()->user()->name }}</strong></p>
                    <a href="{{url('/logout')}}" class="btn btn-outline" style="border-color: var(--danger-color); color: var(--danger-color);">Cerrar Sesión </a>
                    @endif

            <div class="user-info">
               
                <nav class="top-nav">
                    
                    <a href="{{ url('/planillas') }}" class="btn btn-outline">Planillas</a>
                    <a href="{{ url('/Reportes') }}" class="btn btn-outline">Reportes</a>
                    <a href="{{ url('/Usuario/crear') }}" class="btn btn-primary">+ Nuevo Usuario</a>
                </nav>
            </div>
            
           
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
        </header>

        <main>
            @if (session('message'))
                <div class="alert-box">
                    <span>✅</span> {{ session('message') }}
                </div>
            @endif

            <div class="toolbar">
                <h3>Base de Datos de Miembros</h3>
                <div style="display: flex; gap: 10px;">
                    <a href="{{ url('/') }}" class="btn btn-outline">Mostrar Todo</a>
                    <form action="{{ url('usuario/buscar') }}" method="GET" class="search-bar">
                        <input type="text" name="campo" placeholder="Buscar nombre..." required>
                        <button type="submit" class="btn btn-primary" style=" margin-top: 10px;">Buscar..</button>
                    </form>
                </div>
<<<<<<< HEAD

=======
                
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
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
                                    <span class="badge badge-danger">{{ $usuario->noAsistidas }}</span>
                                </td>
                                <td data-label="Acciones">
                                    <div class="action-group">
<<<<<<< HEAD
                                        <a href="{{ url('/Usuario/editar/' . $usuario->uuid) }}"
                                            class="btn btn-primary" title="Editar">Editar</a>
                                        <form action="{{ url('/Usuario/borrar/' . $usuario->uuid) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline"
                                                style="border-color: var(--danger-color); color: var(--danger-color);"
                                                title="Eliminar"
                                                onclick="return confirm('⚠️ ¿Estás seguro de eliminar a {{ $usuario->nombre }}?');">Eliminar..</button>
=======
                                        <a href="{{ url('/Usuario/editar/' . $usuario->uuid) }}" class="btn btn-primary" title="Editar">Editar</a>
                                        <form action="{{ url('/Usuario/borrar/' . $usuario->uuid) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline" style="border-color: var(--danger-color); color: var(--danger-color);" title="Eliminar" onclick="return confirm('⚠️ ¿Estás seguro de eliminar a {{ $usuario->nombre }}?');">Eliminar..</button>
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

<<<<<<< HEAD
                @if ($usuarios->isEmpty())
                    <div style="text-align: center; padding: 60px; color: var(--text-muted);">
                        <p style="font-size: 1.2rem;"> No se encontraron resultados.... quizá lo encuentre con el numero
                            de telefono...</p>
=======
                @if($usuarios->isEmpty())
                    <div style="text-align: center; padding: 60px; color: var(--text-muted);">
                        <p style="font-size: 1.2rem;"> No se encontraron resultados.... quizá lo encuentre con el numero de telefono...</p>
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
                    </div>
                @endif
            </div>
        </main>
    </div>

</body>
<<<<<<< HEAD

</html>
=======
</html>
>>>>>>> 3f9235c7372b5df851f356e0184f95948641ac83
