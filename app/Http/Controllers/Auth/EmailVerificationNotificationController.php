<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Controlador EmailVerificationNotificationController
 *
 * Controlador responsable de enviar una nueva notificación de verificación de correo electrónico.
 *
 * @package App\Http\Controllers\Auth
 */
class EmailVerificationNotificationController extends Controller
{
    /**
     * Envía una nueva notificación de verificación de correo electrónico.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
