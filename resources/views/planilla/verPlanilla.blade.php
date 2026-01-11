<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Planilla</title>
         <link rel='icon' type="image/jpeg" href="images/ICALA.jpg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="fade-in">

<div class="layout-container wide">

    <header class="header-accent" style="border-left: 5px solid var(--primary-color); padding-left: 20px; margin-bottom: 30px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
            <div>
                <h1 style="color: var(--primary-color); font-size: 1.8rem; margin-bottom: 5px;">
                     Planilla del {{ $data['planilla']->fechacreacion }}
                </h1>
                <p class="subtitle" style="color: var(--text-muted); font-size: 1.1rem;">
                    <strong>Actividad:</strong> {{$data['planilla']->tipodeactividad}} | 
                    <strong>Encargado:</strong> {{$data['planilla']->encargado->name}}


                </p>
            </div>
            <a href="{{ url('/planillas') }}" class="btn btn-outline">
                &larr; Volver al Listado
            </a>
        </div>
    </header>

    @if (session('error'))
        <div class="alert-box-error">
            <span>🚫</span> {{ session('error') }}
        </div>
    @endif

    <div class="card-wrapper" style="padding: 0; overflow: hidden;">
        <div class="table-responsive-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Teléfono</th>
                        <th style="text-align: center;">Asistencia</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['usuarios'] as $usuario)
                    <tr>
                        <td data-label="Nombre"><strong>{{ $usuario->nombre }}</strong></td>
                        <td data-label="Edad">{{ $usuario->edad }} años</td>
                        <td data-label="Teléfono">{{ $usuario->telefono ?? 'Sin número' }}</td>

                        <td data-label="Asistencia" style="text-align: center;">
                            @if ($usuario->asistencia)
                                <span class="badge badge-success">Asistió</span>
                            @else
                                <span class="badge badge-danger">No asistió</span>
                            @endif
                        </td>

                        <td data-label="Acción" style="text-align: center;">
                            <form action="{{ url('/planilla/Asistencia/'.$data['planilla']->uuid.'/'.$usuario->uuid) }}" method="POST" style="display: inline-block; width: 100%;">
                                @csrf
                                @method('PUT') 
                                
                                @if ($usuario->asistencia)
                                    <input type="hidden" name="estado" value="0">
                                    <button type="submit" class="btn btn-outline"
                                                style="border-color: var(--danger-color); color: var(--danger-color);">
                                        Desmarcar Asistencia
                                    </button>
                                @else
                                    <input type="hidden" name="estado" value="1">
                                    <button type="submit" class="btn btn-primary" >
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
    </div>
            <a href="{{ $data['usuarios']->previousPageUrl() }}" class="btn btn-outline">Anterior</a>
            <span>Página {{ $data['usuarios']->currentPage() }} de {{ $data['usuarios']->lastPage() }}</span>
            <a href="{{ $data['usuarios']->nextPageUrl() }}" class="btn btn-outline">Siguiente</a>
</div>

</body>
</html>