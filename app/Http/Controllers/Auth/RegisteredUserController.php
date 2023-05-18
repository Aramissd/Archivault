<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Usuario;

/**
 * Controlador RegisteredUserController
 *
 * Controlador responsable de manejar el registro de nuevos usuarios.
 *
 * @package App\Http\Controllers\Auth
 */
class RegisteredUserController extends Controller
{
    /**
     * Muestra la vista de registro.
     *
     * @return View
     */

    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Maneja una solicitud entrante de registro.
     *
     * @param  Request  $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Usuario::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Usuario::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'rol' => 'normal',
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect()->route('login');
    }
}
