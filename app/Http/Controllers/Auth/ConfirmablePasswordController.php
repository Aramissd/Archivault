<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Controlador ConfirmablePasswordController
 *
 * Controlador responsable de mostrar la vista de confirmación de contraseña y confirmar la contraseña del usuario.
 *
 * @package App\Http\Controllers\Auth
 */
class ConfirmablePasswordController extends Controller
{
    /**
     * Muestra la vista de confirmación de contraseña.
     *
     * @return View
     */
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirma la contraseña del usuario.
     *
     * @param  Request  $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if (!Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
