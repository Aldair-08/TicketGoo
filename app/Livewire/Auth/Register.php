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
        try {
            $validated = $this->validate([
                'nombres' => ['required', 'string', 'max:255'],
                'apellidos' => ['required', 'string', 'max:255'],
                'correo' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class . ',email'],
                'celular' => ['required', 'string', 'min:9'],
                'pais' => ['required', 'string', 'max:2'],
                'dni' => ['required', 'string', 'min:8', 'unique:' . User::class . ',dni'],
                'genero' => ['required', 'string', 'in:M,F'],
                'cumple' => ['required', 'date', 'before_or_equal:-18 years'],
                'contrasena' => ['required', 'string', Rules\Password::defaults()],
                'confirmar_contrasena' => ['required', 'same:contrasena'],
                'acepto_terminos' => ['accepted'],
                'g_recaptcha_response' => ['required', 'string'],
            ], [
                'nombres.required' => 'Por favor, ingrese su(s) nombre(s).',
                'apellidos.required' => 'Por favor, ingrese su(s) apellido(s).',
                'correo.required' => 'Por favor, ingrese su correo electrónico.',
                'correo.email' => 'Ingrese un correo electrónico válido.',
                'correo.unique' => 'El correo electrónico ingresado ya se encuentra registrado.',
                'celular.required' => 'Por favor, ingrese su número de celular.',
                'celular.min' => 'El número de celular debe contener 9 dígitos.',
                'celular.numeric' => 'El número de celular debe contener solo dígitos.',
                'pais.required' => 'Por favor, seleccione su país de residencia.',
                'dni.required' => 'Por favor, ingrese su número de DNI.',
                'dni.min' => 'El número de DNI debe contener 8 dígitos.',
                'dni.unique' => 'El número de DNI ingresado ya se encuentra registrado.',
                'dni.numeric' => 'El número de DNI debe contener solo dígitos.',
                'genero.required' => 'Por favor, seleccione su género.',
                'cumple.required' => 'Por favor, ingrese su fecha de nacimiento.',
                'cumple.before_or_equal' => 'Debe ser mayor de edad para completar el registro.',
                'contrasena.required' => 'Por favor, ingrese una contraseña.',
                'confirmar_contrasena.required' => 'Por favor, confirme su contraseña.',
                'confirmar_contrasena.same' => 'La confirmación de la contraseña no coincide.',
                'acepto_terminos.accepted' => 'Debe aceptar los Términos y Condiciones para continuar.',
                'g_recaptcha_response.required' => 'Por favor, complete la verificación de seguridad.',
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

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Reiniciar reCAPTCHA cuando hay errores de validación
            $this->g_recaptcha_response = '';
            $this->dispatch('recaptcha-reset'); // Disparar evento para reinicio inmediato
            throw $e;
        }
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
