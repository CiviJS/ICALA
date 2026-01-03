<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Personal</title>
    @vite(['resources/css/reportes/reportes.css'])
</head>
<body>
    <div style="padding: 20px;">
        <div class="container fade-in">
            
            <a href="{{ url('/') }}" class="btn-volver">
                &larr; Ir al Panel
            </a>

            <form Action ={{url('/Reportes')}} method="GET">
            <input type="month" name="fecha" value="{{ old('fecha', null) }}" required>
    
            <button type="submit" class="btn-volver">Buscar Reporte</button>
            @error('fecha')
                <p>La fecha no puede ser mayor a la fecha actual.</p>
            @enderror   
            </form>

            <h2>🎂 Cumpleaños Hoy</h2>
            @if($data['cumpleAniosHoy']->isEmpty())
                <p>Nadie cumple años hoy. ¡Un día tranquilo!</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Edad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['cumpleAniosHoy'] as $u)
                        <tr>
                            <td>{{ $u->nombre }}</td>
                            <td>{{ $u->fechaNacimiento }}</td>
                            <td>{{ $u->edad }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <h2>🎉 Cumpleaños Mañana</h2>
            @if($data['cumpleAniosManana']->isEmpty())
                <p>Nadie cumple años mañana.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Edad (actual)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['cumpleAniosManana'] as $u)
                        <tr>
                            <td>{{ $u->nombre }}</td>
                            <td>{{ $u->fechaNacimiento }}</td>
                            <td>{{ $u->edad }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <h2>📌 Nuevos Integrantes (Este Mes)</h2>
            @if($data['Nusuarios']->isEmpty())
                <p>No hay nuevos integrantes este mes.</p>
            @else
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
                            <td>{{ $u->nombre }}</td>
                            <td>{{ $u->fechaIngreso }}</td>
                            <td>{{ $u->telefono }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>
</body>
</html>