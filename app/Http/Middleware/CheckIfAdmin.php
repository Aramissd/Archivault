<?php

namespace App\Http\Middleware;
use App\Models\Usuario;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Aquí puedes agregar tu lógica para verificar si el usuario es un administrador.
        // Por ejemplo, puedes verificar si el usuario tiene un determinado rol o permiso.
        // Si el usuario no es un administrador, puedes redirigirlo o mostrar un mensaje de error.

        if (Auth::check() && Auth::user()->rol === 'admin') {
            return $next($request);
        }
        
        return redirect('/');

    }
}
