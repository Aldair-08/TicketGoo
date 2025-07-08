<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.plantilla')]
class Login extends Component
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    #[Validate('required|string')]
    public string $g_recaptcha_response = ''; // reCAPTCHA token 

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'g_recaptcha_response' => ['required', 'string'],
        ], [
            'email.required' => 'Por favor, ingrese su correo electrónico.',
            'email.email' => 'Ingrese un correo electrónico válido.',
            'password.required' => 'Por favor, ingrese su contraseña.',
            'g_recaptcha_response.required' => 'Por favor, complete la verificación de seguridad.',
        ]);

        // Verificar reCAPTCHA
        $this->verifyRecaptcha();

        $this->ensureIsNotRateLimited();

        // Verificar si el correo existe en la base de datos
        if (! \App\Models\User::where('email', $this->email)->exists()) {
            $this->g_recaptcha_response = ''; // Reiniciar reCAPTCHA
            $this->dispatch('recaptcha-reset'); // Disparar evento para reinicio inmediato
            throw ValidationException::withMessages([
                'email' => 'El correo electrónico ingresado no está registrado.',
            ]);
        }

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());
            $this->g_recaptcha_response = ''; // Reiniciar reCAPTCHA
            $this->dispatch('recaptcha-reset'); // Disparar evento para reinicio inmediato

            throw ValidationException::withMessages([
                'password' => 'La contraseña ingresada es incorrecta.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();
        #AQUI ESTAMOS REDIRIGIENDO A LA PAGINA PRINCIPAL DESPUES DE INICIAR SESION
        $this->redirect(route('usuario.principallog', absolute: false), navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }

    /**
     * Verify reCAPTCHA token
     */
    protected function verifyRecaptcha(): void
    {
        // Debug: Verificar si el token está presente
        if (empty($this->g_recaptcha_response)) {
            throw ValidationException::withMessages([
                'g_recaptcha_response' => 'Por favor, completa el reCAPTCHA.',
            ]);
        }

        $response = \Illuminate\Support\Facades\Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $this->g_recaptcha_response,
            'remoteip' => request()->ip(),
        ]);

        $result = $response->json();

        if (!$result['success']) {
            throw ValidationException::withMessages([
                'g_recaptcha_response' => 'Verificación reCAPTCHA fallida. Por favor, intenta nuevamente.',
            ]);
        }
    }
}
