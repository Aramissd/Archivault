@php
function adaptiveFileSize($sizeInBytes) {
    $sizeInKB = $sizeInBytes / 1024;
    $sizeInMB = $sizeInKB / 1024;
    $sizeInGB = $sizeInMB / 1024;

    if ($sizeInGB > 1) {
        return number_format($sizeInGB, 2) . " GB";
    } else if ($sizeInMB > 1) {
        return number_format($sizeInMB, 2) . " MB";
    } else{
        return number_format($sizeInKB, 2) . " KB";
    }
}

    use Illuminate\Support\Facades\Auth;



@endphp
<!DOCTYPE html>
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
    <title>ArchiVault</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="{{ asset('/css/inicio.css') }}" rel="stylesheet" type="text/css" >

    <script>
        window.routes = {
            archivosStore  : "{{ route('archivos.store') }}",
            archivosDestroy : "{{ route('archivos.destroy', ':id') }}",
            
        }

        window.Laravel = {
            storageUrl: "{{ asset('storage') }}",
            authId: "{{ Auth::id() }}",


        };
        window.totalStorageUsed = "{{ $totalStorageUsed}}"

    </script>
</head>
<body>
    <header>
            <div class="logo">
            <a href="{{route('index')}}">
                    <img src="{{ asset ('images/logo.png')}}" alt ="logo de la tienda">
            </a> 
            </div>
            <nav>
                @if (auth()->check())
                @csrf
                <a href="{{ route('logout') }}" class="nav-link"><span class="material-symbols-outlined">logout</span></a>
                <a href="{{ route ('profile.edit') }}" class="nav-link"><span class="material-symbols-outlined">settings</span></a>
                @else
                <a href="{{ route('login') }}" class="nav-link">Iniciar sesión</a>
                <a href="{{ route ('crear_usuario') }}" class="nav-link">Crear cuenta</a>

                @endif
            </nav>
    </header>
    <main>
  


      <form class="modal" action="{{ route('archivos.store') }}" method="POST" enctype="multipart/form-data" id="formulario-archivo">
           @csrf        
         <!-- <span class="close">X</span> -->
            <div class="content">
                <span class="title">Sube tu archivo</span>
                <p class="message">Select a file to upload from your computer or device.</p>
                <input type="hidden" name="usuario_id" value="{{ Auth::id() }}">

                <div class="actions">
                    <label for="archivo" class="button upload-btn">Elige un archivo</label>
                    <input type="file" id="archivo" name="archivo" style="display: none;">
                </div>

                <div class="result">
                    <div class="file-uploaded"><p></p></div>
                </div>
                <div id="error-message" class="error-message"></div>


            </div>
    </form>    
        <div class="storage-info">
            <p id="storage-used">Total de almacenamiento usado: <strong> {{adaptiveFileSize($totalStorageUsed)}}</strong></p>
            <p id="storage-limit">Límite de almacenamiento: <strong>{{ number_format($storage_limit / 1024 / 1024, 2) }} GB</strong></p>
        </div>



    <hr>
    

    <!-- <h2>Mis archivos</h2> -->
    <div class="archivos-list">
    <!-- @if(isset($archivos)) -->
        @foreach($archivos as $archivo)
        <div class="archivo-card">
            <!-- <img src="{{ asset('storage/' . Auth::id() . '/' . $archivo->nombre) }}" alt="{{ $archivo->nombre }}" width="200" height="200" /> -->
            <div class="descripcion">
                <p data-id="{{ $archivo->id }}">{{ $archivo->nombre }}</p>
            </div>
            <div class="acciones">
                 <a href="{{ asset('storage/' . Auth::id() . '/' . $archivo->nombre) }}" download class="download-btn">
                 <span class="material-symbols-outlined">download</span>
                </a>
                <form method="POST" action="{{ route('archivos.destroy', $archivo) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"  class="delete-btn"><span class="material-symbols-outlined">delete</span></button>
                </form>
            </div>
        </div>
    @endforeach
    <!-- @endif -->


    </div>
    <div class="modal-overlay">
    <div class="modal">
        <h2>Límite de almacenamiento alcanzado</h2>
        <p>No tienes suficiente espacio de almacenamiento. Elimina algunos archivos para liberar espacio.</p>
        <button class="modal-close">Cerrar</button>
    </div>
    </div>
    </main>
    <footer>
            <h3><b>ArchiVault</b></h3>
            <p>Copyright© 2023 - Todos los derechos reservados ArchiVault</p>
    </footer>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('/js/inicio.js') }}" type="text/javascript"></script>

    </html>