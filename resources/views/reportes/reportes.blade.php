<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Personal</title>
        <link rel='icon' type="image/jpeg" href="images/ICALA.jpg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="layout-container wide fade-in">
        
        <header class="header-accent" style="border-left: 5px solid var(--primary-color); padding-left: 20px; margin-bottom: 30px;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                <div>
                    <h1 style="color: var(--primary-color); font-size: 1.8rem; margin-bottom: 5px;">  <img src="images/ICALA.jpg" height="30hv"></img> Reporte de Personal</h1>
                    <p class="subtitle" style="color: var(--text-muted);">Consulta de cumpleaños y nuevos ingresos</p>
                </div>
                <a href="{{ url('/Eventos') }}" class="btn btn-outline">
                   Control de eventos
                </a>
                <a href="{{ url('/') }}" class="btn btn-outline">
                    &larr; Ir al Panel
                </a>
            </div>
        </header>

        <div class="card-wrapper" style="margin-bottom: 30px; padding: 20px;">
            <form action="{{ url('/Reportes') }}" method="GET" style="display: flex; align-items: flex-end; gap: 15px; flex-wrap: wrap;">
                <div class="form-group" style="width: auto; min-width: 250px;">
                    <label for="fecha">Seleccionar Mes de Reporte</label>
                    <input type="month" id="fecha" name="fecha" value="{{ request('fecha') }}" required>
                </div>
        
                <button type="submit" class="btn btn-primary" style="height: 48px;">
                     Buscar Reporte
                </button>

                @error('fecha')
                    <div class="alert-box-error" style="margin-top: 10px; width: 100%;">
                        ⚠️ La fecha no puede ser mayor a la fecha actual.
                    </div>
                @enderror   
            </form>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 25px; margin-bottom: 30px;">
            
            <div class="card-wrapper">
                <h2 style="margin-bottom: 20px; display: flex; align-items: center; gap: 10px;"> Cumpleaños Hoy</h2>
                @if($data['cumpleAniosHoy']->isEmpty())
                    <p style="color: var(--text-muted); font-style: italic;">Nadie cumple años hoy. ¡Un día tranquilo!</p>
                @else
                    <div class="table-responsive-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Nacimiento</th>
                                    <th>Edad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['cumpleAniosHoy'] as $u)
                                <tr>
                                    <td data-label="Nombre"><strong>{{ $u->nombre }}</strong></td>
                                    <td data-label="Nacimiento">{{ $u->fechaNacimiento }}</td>
                                    <td data-label="Edad"><span class="badge badge-success">{{ $u->edad }} años</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div class="card-wrapper">
                <h2 style="margin-bottom: 20px; display: flex; align-items: center; gap: 10px;"> Cumpleaños Mañana</h2>
                @if($data['cumpleAniosManana']->isEmpty())
                    <p style="color: var(--text-muted); font-style: italic;">Nadie cumple años mañana.</p>
                @else
                    <div class="table-responsive-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Nacimiento</th>
                                    <th>Edad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['cumpleAniosManana'] as $u)
                                <tr>
                                    <td data-label="Nombre"><strong>{{ $u->nombre }}</strong></td>
                                    <td data-label="Nacimiento">{{ $u->fechaNacimiento }}</td>
                                    <td data-label="Edad"><span class="badge badge-success">{{ $u->edad }} años</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <div class="card-wrapper">
            <h2 style="margin-bottom: 20px; display: flex; align-items: center; gap: 10px;"> Nuevos Integrantes (Este Mes)</h2>
            @if($data['Nusuarios']->isEmpty())
                <p style="color: var(--text-muted); font-style: italic;">No hay nuevos integrantes este mes.</p>
            @else
                <div class="table-responsive-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha de Ingreso</th>
                                <th>Teléfono</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['Nusuarios'] as $u)
                            <tr>
                                <td data-label="Nombre"><strong>{{ $u->nombre }}</strong></td>
                                <td data-label="Ingreso">{{ $u->fechaIngreso }}</td>
                                <td data-label="Teléfono">{{ $u->telefono ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
</body>
</html>