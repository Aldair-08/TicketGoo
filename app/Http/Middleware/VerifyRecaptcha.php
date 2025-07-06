<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class VerifyRecaptcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $recaptchaToken = $request->input('g-recaptcha-response');

        if (!$recaptchaToken) {
            return response()->json([
                'success' => false,
                'message' => 'Por favor, completa el reCAPTCHA.'
            ], 422);
        }

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $recaptchaToken,
            'remoteip' => $request->ip(),
        ]);

        $result = $response->json();

        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'message' => 'Verificación reCAPTCHA fallida. Por favor, intenta nuevamente.'
            ], 422);
        }

        return $next($request);
    }
} 