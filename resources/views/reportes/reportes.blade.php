<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Personal</title>
    @vite('resources/css/reportes/reportes.css')
</head>
<body>
    <div style="padding: 20px;">
        <div class="container fade-in">
            
            <a href="{{ url('/') }}" class="btn-volver">
                &larr; Ir al Panel
            </a>

            <h2>🎂 Cumpleaños Hoy</h2>
            @if($cumpleAniosHoy->isEmpty())
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
                        @foreach($cumpleAniosHoy as $u)
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
            @if($cumpleAniosManana->isEmpty())
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
                        @foreach($cumpleAniosManana as $u)
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
            @if($Nusuarios->isEmpty())
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
                        @foreach($Nusuarios as $u)
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