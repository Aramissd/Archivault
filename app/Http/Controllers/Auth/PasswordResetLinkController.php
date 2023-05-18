<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

/**
 * Controlador PasswordResetLinkController
 *
 * Controlador responsable de manejar las solicitudes de enlace para restablecer la contraseña.
 *
 * @package App\Http\Controllers\Auth
 */
class PasswordResetLinkController extends Controller
{
    /**
     * Muestra la vista de solicitud de enlace para restablecer la contraseña.
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Maneja una solicitud entrante de enlace para restablecer la contraseña.
     *
     * @param  Request  $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Enviamos el enlace de restablecimiento de contraseña a este usuario. Una vez que hayamos intentado
        // enviar el enlace, examinaremos la respuesta y veremos el mensaje que debemos mostrar al usuario.
        // Finalmente, enviaremos una respuesta adecuada.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
