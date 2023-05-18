<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserFolder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Dividir la URL y obtener el nombre de la carpeta
        $parts = explode('/', $request->getPathInfo());
        $folder = $parts[3];

        // Comprobar si el usuario está autenticado y si la ID del usuario coincide con el nombre de la carpeta
        if (Auth::check() && Auth::user()->id == $folder) {
            return $next($request);
        }

        return abort(403, 'Access denied');
    }
}

?>
