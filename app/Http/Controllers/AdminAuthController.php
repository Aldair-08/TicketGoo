<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // Validar campos requeridos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'g_recaptcha_response' => 'required',
        ], [
            'email.required' => 'Por favor, ingrese su correo electrónico.',
            'email.email' => 'Ingrese un correo electrónico válido.',
            'password.required' => 'Por favor, ingrese su contraseña.',
            'g_recaptcha_response.required' => 'Por favor, complete la verificación de seguridad.',
        ]);

        // Verificar reCAPTCHA
        $this->verifyRecaptcha($request->input('g_recaptcha_response'));

        // Verificar si el correo existe en la base de datos
        if (! \App\Models\User::where('email', $request->email)->exists()) {
            return back()->withErrors(['email' => 'El correo electrónico ingresado no está registrado.'])
                        ->withInput($request->except('password', 'g_recaptcha_response'));
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            } else {
                Auth::logout();
                return back()->withErrors(['email' => 'No tiene permisos de administrador.'])
                            ->withInput($request->except('password', 'g_recaptcha_response'));
            }
        }

        return back()->withErrors(['password' => 'La contraseña ingresada es incorrecta.'])
                    ->withInput($request->except('password', 'g_recaptcha_response'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    /**
     * Verify reCAPTCHA token
     */
    protected function verifyRecaptcha(string $token): void
    {
        // Verificar si el token está presente
        if (empty($token)) {
            throw ValidationException::withMessages([
                'g_recaptcha_response' => 'Por favor, completa el reCAPTCHA.',
            ]);
        }

        $response = \Illuminate\Support\Facades\Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $token,
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
