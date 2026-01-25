<?php

namespace App\Http\Controllers;

use App\Livewire\Actions\Logout;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
    public function googleCallback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->user();

            $user = User::query()
                ->where('email', $googleUser->getEmail())
                ->orWhere('google_id', $googleUser->getId())
                ->first();

            if ($user) {
                // Update google_id if not set
                if (empty($user->google_id)) {
                    $user->update(['google_id' => $googleUser->getId()]);
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

            // Redirect to register with google data if user doesn't exist
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
