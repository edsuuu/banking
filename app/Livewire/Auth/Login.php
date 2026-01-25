<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    protected function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    protected function messages()
    {
        return [
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Digite um e-mail válido.',
            'password.required' => 'A senha é obrigatória.',
        ];
    }

    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        $this->validate();

        try {
            $user = User::where('email', $this->email)->first();

            if (! $user || ! \Illuminate\Support\Facades\Hash::check($this->password, $user->password)) {
                RateLimiter::hit($this->throttleKey());
                $this->addError('email', trans('auth.failed'));

                Log::channel('auth')->warning('Login attempt failed', [
                    'email' => $this->email,
                    'ip' => request()->ip()
                ]);

                return;
            }

            // Check if user has 2FA enabled
            if ($user->two_factor_secret && $user->two_factor_confirmed_at) {
                session([
                    'login.id' => $user->getKey(),
                    'login.remember' => $this->remember,
                    'login.expires_at' => now()->addMinutes(15)->timestamp,
                ]);

                return redirect()->route('two-factor.login');
            }

            Auth::login($user, $this->remember);

            RateLimiter::clear($this->throttleKey());

            return redirect()->intended(route('dashboard'));

        } catch (\Exception $e) {
            Log::channel('auth')->error('Login Authentication Error: ' . $e->getMessage(), [
                'email' => $this->email,
                'exception' => $e
            ]);

            $this->addError('email', 'Ocorreu um erro ao tentar entrar. Por favor, tente novamente.');
        }
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 3)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey());

        Log::channel('auth')->notice('Login rate limit reached', [
            'email' => $this->email,
            'ip' => request()->ip()
        ]);

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
