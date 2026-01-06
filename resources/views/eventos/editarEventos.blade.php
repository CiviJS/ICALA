<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Evento</title>
</head>
<body>

    @if(!empty($evento))
    <form method="POST" action="{{url('/update')}}">
         @csrf
        <input type="text" name='nombre' value="{{$evento->nombre}}">
        @error('nombre')
            <p>{{ $message }}</p>
        @enderror
        <input type="date" name='fecha_inicio' value="{{$evento->fecha_inicio}}">
        @error('fecha_inicio')
            <p>{{ $message }}</p>
        @enderror
        <input type="text" name='descripcion' value="{{$evento->descripcion}}">
        @error('descripcion')
            <p>{{ $message }}</p>
        @enderror
        <select name='admin_encargado' value="{{$evento->admin_encargado}}">
            <option value=1>1 admin prueba</option>
            <option value=1>no te tiene que dejar</option>
        </select>
        <button type='submit'> Crear Evento</button>
        @error('admin_encargado')
            <p>{{ $message }}</p>
        @enderror
    </form>
    @else
        <p>no hay nada we</p>
    @endif

</body>
</html>