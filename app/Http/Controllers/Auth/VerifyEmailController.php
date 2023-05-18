<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

/**
 * Controlador VerifyEmailController
 *
 * Controlador responsable de marcar la dirección de correo electrónico verificada del usuario autenticado.
 *
 * @package App\Http\Controllers\Auth
 */
class VerifyEmailController extends Controller
{
    /**
     * Marca la dirección de correo electrónico verificada del usuario autenticado.
     *
     * @param  EmailVerificationRequest  $request
     * @return RedirectResponse
     */public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('inicio');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->route('inicio');
    }

}
