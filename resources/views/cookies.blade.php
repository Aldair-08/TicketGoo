@extends('layouts.plantilla')

@section('title', 'Política de Cookies | TicketGO')

@section('contenido')
<div class="min-h-screen flex justify-center px-4 container py-5 mb-10">
    <div class="text-left max-w-3xl px-4">
        <h2 class="text-center text-blue-700 text-2xl font-bold mb-6">POLÍTICA DE COOKIES DE TICKETGO</h2>
        <br>
        <p>En TicketGO utilizamos cookies para asegurar el correcto funcionamiento de nuestro sitio web, mejorar su experiencia de navegación y ofrecer contenido personalizado. Al continuar navegando por nuestra web, usted acepta el uso de cookies según esta política.</p>
        <br>

        <h3 class="mt-4 font-semibold text-blue-700">1. ¿Qué son las cookies?</h3>
        <p>Las cookies son pequeños archivos de texto que se almacenan en su navegador o dispositivo cuando visita una página web. Sirven para recordar información sobre su visita, como su idioma preferido o su sesión activa.</p>
        <br>

        <h3 class="mt-4 font-semibold text-blue-700">2. ¿Qué tipos de cookies usamos?</h3>
        <p>En nuestro sitio utilizamos los siguientes tipos de cookies:</p>
        <br>

        <table class="w-full text-sm text-left text-gray-700 border border-gray-300">
            <thead class="bg-gray-100 text-gray-900">
                <tr>
                    <th class="px-4 py-2 border">Nombre</th>
                    <th class="px-4 py-2 border">Dominio</th>
                    <th class="px-4 py-2 border">Finalidad</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-4 py-2 border">XSRF-TOKEN</td>
                    <td class="px-4 py-2 border">ticketgo.com</td>
                    <td class="px-4 py-2 border">Seguridad. Protege contra ataques de tipo CSRF.</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border">laravel_session</td>
                    <td class="px-4 py-2 border">ticketgo.com</td>
                    <td class="px-4 py-2 border">Identifica la sesión activa del usuario.</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border">_ga</td>
                    <td class="px-4 py-2 border">.google.com</td>
                    <td class="px-4 py-2 border">Analítica. Permite medir datos de navegación con Google Analytics.</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border">_fbp</td>
                    <td class="px-4 py-2 border">.facebook.com</td>
                    <td class="px-4 py-2 border">Marketing. Utilizada por Facebook para mostrar anuncios relevantes.</td>
                </tr>
            </tbody>
        </table>
        <br>

        <h3 class="mt-4 font-semibold text-blue-700">3. ¿Cómo puede gestionar las cookies?</h3>
        <p>Puede configurar su navegador para aceptar, rechazar o eliminar cookies. A continuación, le dejamos algunos enlaces útiles según el navegador que utilice:</p>
        <ul class="list-disc pl-5 mt-2">
            <li><a href="https://support.google.com/chrome/answer/95647?hl=es" target="_blank" class="text-blue-700 underline">Google Chrome</a></li>
            <li><a href="https://support.mozilla.org/es/kb/impedir-que-los-sitios-web-guarden-sus-preferencia" target="_blank" class="text-blue-700 underline">Mozilla Firefox</a></li>
            <li><a href="https://support.apple.com/es-es/guide/safari/sfri11471/mac" target="_blank" class="text-blue-700 underline">Safari</a></li>
            <li><a href="https://support.microsoft.com/es-es/microsoft-edge/eliminar-las-cookies-en-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" class="text-blue-700 underline">Microsoft Edge</a></li>
        </ul>
        <br>

        <h3 class="mt-4 font-semibold text-blue-700">4. Actualizaciones y contacto</h3>
        <p>Esta política puede actualizarse ocasionalmente. Le recomendamos revisarla periódicamente.</p>
        <br>
        <p>Si tiene alguna duda sobre el uso de cookies en nuestro sitio, puede contactarnos a través del botón <strong>SOPORTE FANS</strong> en la parte inferior de la web.</p>
    </div>
</div>
@endsection
