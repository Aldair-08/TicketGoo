<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.plantilla')]
class Register extends Component
{
    public string $nombres = '';
    public string $apellidos = '';
    public string $correo = '';
    public string $celular = '';
    public string $pais = '';
    public string $dni = '';
    public string $genero = '';
    public string $cumple = '';
    public string $contrasena = '';
    public string $confirmar_contrasena = '';
    public bool $acepto_terminos = false;
    public bool $acepto_promociones = false;
    public string $g_recaptcha_response = ''; // reCAPTCHA token

    /**
     * Maneja la petición de registro.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class . ',email'],
            'celular' => ['required', 'string', 'max:20'],
            'pais' => ['required', 'string', 'max:2'],
            'dni' => ['required', 'string', 'size:8', 'unique:' . User::class . ',dni'],
            'genero' => ['required', 'string', 'in:M,F'],
            'cumple' => ['required', 'date', 'before_or_equal:-18 years'],
            'contrasena' => ['required', 'string', Rules\Password::defaults()],
            'confirmar_contrasena' => ['required', 'same:contrasena'],
            'acepto_terminos' => ['accepted'],
            'g_recaptcha_response' => ['required', 'string'],
        ], [
            // Mensajes personalizados (opcional)
            'cumple.before_or_equal' => 'Debes ser mayor de edad para poder registrarte.',
            'acepto_terminos.accepted' => 'Debes aceptar los términos y condiciones.',
            'g_recaptcha_response.required' => 'Por favor, completa el reCAPTCHA.',
        ]);

        // La validación 'confirmed' en 'contrasena' asume que el campo de confirmación se llama 'contrasena_confirmation'.
        // Por eso, ajustamos $this->confirmar_contrasena a contrasena_confirmation para que valide automáticamente.
        $this->validate([
            'confirmar_contrasena' => ['required', 'same:contrasena'],
        ], [
            'confirmar_contrasena.same' => 'La confirmación de la contraseña no coincide.',
        ]);

        // Verificar reCAPTCHA
        $this->verifyRecaptcha();

        // Hasheamos la contraseña
        $validated['password'] = Hash::make($validated['contrasena']);

        // Creamos el usuario con los campos necesarios (ajusta según tu tabla users)
        $user = User::create([
            'name' => $validated['nombres'] . ' ' . $validated['apellidos'],
            'email' => $validated['correo'],
            'phone' => $validated['celular'],
            'country' => $validated['pais'],
            'dni' => $validated['dni'],
            'gender' => $validated['genero'],
            'birthdate' => $validated['cumple'],
            'password' => $validated['password'],
        ]);

        event(new Registered($user));

        Auth::login($user);

        $this->redirect(route('pagina.principallog', absolute: false), navigate: true);

    }

    /**
     * Verify reCAPTCHA token
     */
    protected function verifyRecaptcha(): void
    {
        // Debug: Verificar si el token está presente
        if (empty($this->g_recaptcha_response)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
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
            throw \Illuminate\Validation\ValidationException::withMessages([
                'g_recaptcha_response' => 'Verificación reCAPTCHA fallida. Por favor, intenta nuevamente.',
            ]);
        }
    }
}
