@extends('layouts.plantilla')

@section('title', 'Cómo funcionan los e-tickets | TicketGO')

@section('contenido')
<div class="min-h-screen flex justify-center px-8 container py-12 mb-20 bg-gray-50">
  <div class="bg-white shadow-lg rounded-lg max-w-5xl p-12">
    <h2 class="text-left text-blue-700 text-3xl font-extrabold mb-10">¿Cómo funcionan los <span class="text-yellow-500">E-tickets</span>?</h2>

    <p class="mb-8 text-gray-700 text-lg leading-relaxed">
      Los <span class="font-semibold text-blue-700">e-tickets</span> son entradas digitales que te permiten ingresar a tus eventos favoritos de forma segura, cómoda y sin papeles. Te explicamos en detalle cómo aprovecharlos al máximo:
    </p>

    <ul class="space-y-10">
      <li class="flex items-start space-x-6">
        <div class="text-yellow-500 text-5xl flex-shrink-0">📩</div>
        <div>
          <h3 class="font-semibold text-2xl text-blue-700 mb-3">Entrega digital rápida</h3>
          <p class="text-gray-700 leading-relaxed text-lg">
            Después de comprar tu entrada, recibirás el e-ticket directamente en tu correo electrónico en formato PDF o con un código QR único. Asegúrate de revisar la bandeja de entrada y también la carpeta de spam.
          </p>
        </div>
      </li>

      <li class="flex items-start space-x-6">
        <div class="text-yellow-500 text-5xl flex-shrink-0">🎟️</div>
        <div>
          <h3 class="font-semibold text-2xl text-blue-700 mb-3">Ingreso sencillo y sin complicaciones</h3>
          <p class="text-gray-700 leading-relaxed text-lg">
            Para ingresar al evento, solo tienes que mostrar tu e-ticket en la entrada, ya sea en la pantalla de tu teléfono móvil o impreso. No necesitas más que eso para disfrutar.
          </p>
          {{-- Aquí podrías poner una imagen explicativa, ejemplo: --}}
          {{-- <img src="{{ asset('images/eticket-demo.png') }}" alt="Ejemplo e-ticket" class="mt-4 rounded shadow-md"> --}}
        </div>
      </li>

      <li class="flex items-start space-x-6">
        <div class="text-yellow-500 text-5xl flex-shrink-0">🔒</div>
        <div>
          <h3 class="font-semibold text-2xl text-blue-700 mb-3">Validación segura y única</h3>
          <p class="text-gray-700 leading-relaxed text-lg">
            Cada e-ticket posee un código exclusivo que se escanea en la entrada para garantizar que solo tú puedas usarlo. Esto ayuda a prevenir fraudes o el ingreso de copias no autorizadas.
          </p>
        </div>
      </li>

      <li class="flex items-start space-x-6">
        <div class="text-yellow-500 text-5xl flex-shrink-0">🛡️</div>
        <div>
          <h3 class="font-semibold text-2xl text-blue-700 mb-3">Cuida tu e-ticket</h3>
          <p class="text-gray-700 leading-relaxed text-lg">
            No compartas ni difundas tu e-ticket con otras personas. Si alguien más lo usa, no podrás ingresar al evento. Si pierdes tu e-ticket o tienes problemas con él, contáctanos cuanto antes para ayudarte.
          </p>
        </div>
      </li>

      <li class="flex items-start space-x-6">
        <div class="text-yellow-500 text-5xl flex-shrink-0">💡</div>
        <div>
          <h3 class="font-semibold text-2xl text-blue-700 mb-3">Consejos para aprovechar tu e-ticket</h3>
          <p class="text-gray-700 leading-relaxed text-lg">
            Guarda el correo con tu e-ticket en un lugar seguro. Si vas a usarlo desde el móvil, asegúrate de tener batería suficiente para mostrar el código QR al ingresar. Imprimirlo puede ser útil en caso de que la conexión falle.
          </p>
        </div>
      </li>
    </ul>

    <p class="mt-12 text-left text-gray-600 text-lg font-medium">
      Disfruta de tus eventos favoritos con la comodidad y seguridad que solo <span class="text-blue-700 font-bold">TicketGO</span> te ofrece.
    </p>
  </div>
</div>
@endsection
