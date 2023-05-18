<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <title>Archivault</title>
        <link href="{{ asset('css/header.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <!-- icons -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-700 antialiased">
    <header>
            <div class="logo">
                <a href="{{ route('index') }}">
                    <img src="{{ asset ('images/logo.png')}}" alt ="logo">
                </a>
            </div>
            <nav>
            <a href="{{ route('login') }}" class="nav-link"><span class="material-symbols-outlined">login</span></a>
                <a href="{{ route('register') }}" class="nav-link"><span class="material-symbols-outlined">patient_list</span></a>
            </nav>
        </header>

        <div class="content-margin min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0  -mt-9">
            <!-- <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div> -->

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg mb-12">
                {{ $slot }}
            </div>
        </div>

        <footer class="bg-white text-white p-4 text-center">
             <h3 class="text-lg font-semibold">ArchiVault</h3>
            <p class="text-sm">Copyright© 2023 - Todos los derechos reservados ArchiVault</p>
        </footer>

    </body>

</html>
