<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTwoFactorTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only check if we are in the middle of a 2FA challenge
        if ($request->session()->has('login.id')) {
            $expiresAt = $request->session()->get('login.expires_at');

            // 1. Check for timeout
            if (!$expiresAt || now()->timestamp > $expiresAt) {
                $request->session()->forget(['login.id', 'login.remember', 'login.expires_at', 'login.remember']);
                
                return redirect()->route('login')->withErrors([
                    'email' => 'Sua sessão de verificação expirou por inatividade. Por favor, faça login novamente.'
                ]);
            }

            // 2. Clear if navigating back to login or register (Start fresh)
            if ($request->routeIs('login') || $request->routeIs('register')) {
                $request->session()->forget(['login.id', 'login.remember', 'login.expires_at']);
            }
        }

        return $next($request);
    }
}
