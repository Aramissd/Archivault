<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/css/registro.css') }}" rel="stylesheet" type="text/css" >     
      <title>ArchiVault</title>
</head>
<body>
    <header>
        <div class="logo">
                <a href="{{route('index')}}"> 
                <img src="{{ asset ('images/logo.png')}}" alt ="logo de la tienda">
            </a> 
        </div>
        <nav>
            <a href="{{ route('login') }}" class="nav-link">Iniciar sesión</a>
            <a href="{{ route ('crear_usuario') }}" class="nav-link">Crear cuenta</a>
        </nav>
    </header>
