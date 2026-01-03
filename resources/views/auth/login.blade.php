<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    
<h1>Login</h1>
@if(session('error'))
    <p>error</p>{{session('error')}}
@endif        

<form action="{{url('/auth')}}" method="POST">
@csrf
    <input type="email" name="email" required><br><br>
    @error('email')
    <p style="color:red">{{$message}}</p>
    @enderror
    <input type="password" name="password" required>
    @error('email')
    <p style="color:red">{{$message}}</p>
    @enderror
    <button type="submit">Iniciar sesion</button>
</form>


</body>
</html>