<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>ArchiVault</title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="{{route('index')}}">
                <img src="{{ asset ('images/logo.png')}}" alt ="logo">
            </a>
        </div>
        <nav>
            <a href="{{ route('login') }}" class="nav-link"><span class="material-symbols-outlined">login</span></a>
            <a href="{{ route('register') }}" class="nav-link"><span class="material-symbols-outlined">patient_list</span></a>
        </nav>
    </header>
    <div class="contenedor">
            <div class="item1">
                <h1>Acceso sencillo y seguro a tu contenido</h1>
                <p>Guarda archivos desde tu dispositivo móvil, tablet u ordenador.</p>
                <div class="botones">
                    <a href="{{ route('login') }}">Iniciar sesión</a>
                   <a href="{{ route ('register') }}">Registrarse</a>
                </div>
            </div>
            <div class="item2">
                <img src="{{ asset ('images/portatil.jpg')}}">
            </div>

    </div>
    <div class="contenedor2">
        <div class="item3">
            <img src="{{ asset ('images/nube.png')}}" alt="Archivo 1">
            <h2>Almacenamiento en la nube</h2>
            <p>Guarda todos tus archivos importantes en la nube para acceder a ellos desde cualquier lugar.</p>
        </div>
        <div class="item5">
            <img src="{{ asset ('images/candado.png')}}" alt="Archivo 3">
            <h2>Protección de archivos confidenciales</h2>
            <p>Protege tus archivos confidenciales con seguridad avanzada.</p>
        </div>
    </div>
    <div class="main">
        <h1>Selecciona tu plan</h1>
        <div class="pricing-container">
            <div class="pricing-card">
                <div class="pkg">
                    <h2>Básico</h2>
                    <h1>5€<span class="s-text"> / mes</span></h1>
                </div>
                <ul class="s-text">
                    <li><i class="fa-solid fa-circle-check"></i>5GB de almacenamiento</li>
                    <li><i class="fa-solid fa-circle-check"></i>Acceso a la plataforma 24/7</li>
                    <li><i class="fa-solid fa-circle-check"></i>Soporte técnico básico por correo electrónico</li>
                    <li><i class="fa-solid fa-circle-check"></i>Cifrado estándar de archivos</li>
                    <li><i class="fa-solid fa-circle-check"></i>Transferencia de datos de 10GB por mes</li>
                </ul>
                <button>Comprar</button>
            </div>

            <div class="pricing-card">
                <div class="pkg">
                    <h2>Intermedio</h2>
                    <h1>8€<span class="s-text">/ mes</span></h1>
                </div>
                <ul class="s-text">
                    <li><i class="fa-solid fa-circle-check"></i>8GB de almacenamiento</li>
                    <li><i class="fa-solid fa-circle-check"></i>Acceso a la plataforma 24/7</li>
                    <!-- <li><i class="fa-solid fa-circle-check"></i>Soporte técnico prioritario por correo electrónico y chat</li> -->
                    <li><i class="fa-solid fa-circle-check"></i>Cifrado mejorado de archivos</li>
                    <li><i class="fa-solid fa-circle-check"></i>Transferencia de datos de 50GB por mes</li>
                    <li><i class="fa-solid fa-circle-check"></i>Recuperación de archivos borrados hasta por 30 días</li>
                </ul>
                <button>Comprar</button>
            </div>

            <div class="pricing-card">
                <div class="pkg">
                    <h2>Premium</h2>
                    <h1>15€<span class="s-text">/ mes</span></h1>
                </div>
                <ul class="s-text
                ">
                    <li><i class="fa-solid fa-circle-check"></i>15 GB de almacenamiento</li>
                    <li><i class="fa-solid fa-circle-check"></i>Transferencia de datos ilimitada</li>
                    <li><i class="fa-solid fa-circle-check"></i>Sincronización de archivos entre dispositivos</li>
                    <li><i class="fa-solid fa-circle-check"></i>Transferencia de datos de 50GB por mes</li>
                    <li><i class="fa-solid fa-circle-check"></i>Recuperación de archivos borrados sin límite de tiempo</li>
                </ul>
                <button>Comprar</button>
            </div>
        </div>
    </div>

    <footer>
        <h3><b>ArchiVault</b></h3>
        <p>Copyright© 2023 - Todos los derechos reservados ArchiVault</p>
    </footer>
</body>
</html>
