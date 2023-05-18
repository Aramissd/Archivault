<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controlador EmailVerificationPromptController
 *
 * Controlador responsable de mostrar el mensaje de verificación de correo electrónico.
 *
 * @package App\Http\Controllers\Auth
 */
class EmailVerificationPromptController extends Controller
{
    /**
     * Muestra el mensaje de verificación de correo electrónico.
     *
     * @param  Request  $request
     * @return RedirectResponse|View
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect('inicio')
                    : view('auth.verify-email');
    }
}
