<?php

namespace App\Http\Controllers;

use App\Livewire\Actions\Logout;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Actions\ConfirmTwoFactorAuthentication;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Redirect to Google for authentication.
     */
    public function googleRedirect()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            Log::channel('auth')->error('Google Redirect Error: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            return redirect()->route('login')->withErrors(['error' => 'Não foi possível redirecionar para o Google.']);
        }
    }

    /**
     * Handle the Google callback.
     */
    public function googleCallback(Request $request): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')
                ->user();

            // Case 1: User is already logged in and confirming identity (Secure Area / Sudo Mode)
            if (Auth::check()) {
                $user = Auth::user();
                
                Log::channel('auth')->info('Google Sudo Mode Attempt', [
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                    'google_email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId()
                ]);

                if ($user->email === $googleUser->getEmail() || ($user->google_id && $user->google_id === $googleUser->getId())) {
                    session(['auth.password_confirmed_at' => time()]);
                    
                    if (empty($user->google_id)) {
                        $user->update(['google_id' => $googleUser->getId()]);
                    }

                    Log::channel('auth')->info('Google Sudo Mode Success', ['user_id' => $user->id]);

                    return redirect()->intended(route('settings.index'));
                }
                
                Log::channel('auth')->warning('Google Sudo Mode Mismatch', [
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                    'google_email' => $googleUser->getEmail()
                ]);

                return redirect()->route('settings.index')->withErrors(['error' => 'A conta Google informada não coincide com seu usuário logado.']);
            }

            // Case 2: Regular Login Flow
            $user = User::query()
                ->where('email', $googleUser->getEmail())
                ->orWhere('google_id', $googleUser->getId())
                ->first();

            if ($user) {
                // Update google_id if not set
                if (empty($user->google_id)) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }

                // Check for 2FA
                if ($user->two_factor_secret && $user->two_factor_confirmed_at) {
                    session([
                        'login.id' => $user->getKey(),
                        'login.remember' => true,
                        'login.expires_at' => now()->addMinutes(15)->timestamp,
                    ]);

                    return redirect()->route('two-factor.login');
                }

                // Check if user has business
                if ($user->business_id) {
                    Auth::login($user, true);
                    return redirect()->intended(route('dashboard'));
                }
                
                // Fallback to register if no business linked
                session([
                    'social_user' => [
                        'google_id' => $googleUser->getId(),
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'provider' => 'google',
                    ]
                ]);
                return redirect()->route('register');
            }

            // Case 3: New User / Registration
            session([
                'social_user' => [
                    'google_id' => $googleUser->getId(),
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'provider' => 'google',
                ]
            ]);

            return redirect()->route('register');

        } catch (\Exception $e) {
            Log::channel('auth')->error('Google Auth Error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('login')->withErrors(['error' => 'Falha na autenticação com o Google. Tente novamente.']);
        }
    }

    /**
     * Confirm identity using 2FA code for Sudo Mode (Secure Area).
     */
    public function confirmSudo2FA(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $user = Auth::user();

        $action = app(ConfirmTwoFactorAuthentication::class);

        try {
            $action($user, $request->code);

            if ($user->two_factor_confirmed_at) {
                session(['auth.password_confirmed_at' => time()]);

                Log::channel('daily')->info('Sudo Mode: 2FA Confirmed', [
                    'user_id' => $user->id,
                    'ip' => $request->ip()
                ]);

                return redirect()->intended(route('settings.index'));
            }
        } catch (\Exception $e) {
            Log::channel('daily')->error('Sudo Mode: 2FA Confirmation Error', [
                'user_id' => $user->id,
                'message' => $e->getMessage(),
                'ip' => $request->ip()
            ]);
        }

        return redirect()->back()->withErrors(['code' => 'O código de autenticação informado é inválido.']);
    }

    /**
     * Logout the user.
     */
    public function logout(Logout $logout)
    {
        try {
            $logout();
        } catch (\Exception $e) {
            Log::channel('auth')->error('Logout Error: ' . $e->getMessage(), [
                'exception' => $e
            ]);
        }
        
        return redirect('/');
    }
}
