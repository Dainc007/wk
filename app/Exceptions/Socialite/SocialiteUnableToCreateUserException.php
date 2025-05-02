<?php

namespace App\Exceptions\Socialite;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SocialiteUnableToCreateUserException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request): RedirectResponse
    {
        session()->put('filament-socialite-login-error', 'Unable to create your account.');
        return redirect()->route('filament.auth.login');
    }
}
