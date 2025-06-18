@extends('layouts.plantilla')

@section('title', 'Cómo comprar entradas | TicketGO')

@section('contenido')
<div class="min-h-screen flex justify-center px-8 container py-12 mb-20 bg-gray-50">
  <div class="bg-white shadow-lg rounded-lg max-w-5xl p-12">
    <h2 class="text-left text-blue-700 text-3xl font-extrabold mb-10">¿Cómo comprar entradas en <span class="text-yellow-500">TicketGO</span>?</h2>

    <p class="mb-8 text-gray-700 text-lg leading-relaxed">
      Comprar tus entradas para los mejores eventos es sencillo, rápido y totalmente seguro. Solo sigue estos pasos para asegurar tu lugar:
    </p>

    <ol class="list-decimal list-inside space-y-10 text-gray-700">
      <li class="flex items-start space-x-6">
        <div class="text-yellow-500 text-5xl flex-shrink-0">🔍</div>
        <div>
          <h3 class="font-semibold text-2xl text-blue-700 mb-3">Busca tu evento</h3>
          <p class="text-gray-700 leading-relaxed text-lg">
            Explora nuestra plataforma o utiliza el buscador para encontrar el evento que quieres disfrutar. Tenemos eventos como conciertos, obras de teatro
            y exhibiciones de arte.
          </p>
        </div>
      </li>

      <li class="flex items-start space-x-6">
        <div class="text-yellow-500 text-5xl flex-shrink-0">👤</div>
        <div>
          <h3 class="font-semibold text-2xl text-blue-700 mb-3">Regístrate o inicia sesión</h3>
          <p class="text-gray-700 leading-relaxed text-lg">
            Crea una cuenta nueva o inicia sesión para que puedas contar con una cuenta en nuestra plataforma.
             Esto te permitirá gestionar tus entradas y recibir notificaciones importantes. De este modo puedes continuar con el proceso de compra sin complicaciones.
          </p>
        </div>
      </li>

      <li class="flex items-start space-x-6">
        <div class="text-yellow-500 text-5xl flex-shrink-0">🎫</div>
        <div>
          <h3 class="font-semibold text-2xl text-blue-700 mb-3">Selecciona tus entradas</h3>
          <p class="text-gray-700 leading-relaxed text-lg">
            Elige la cantidad y el tipo de entradas que deseas comprar según tus preferencias y la disponibilidad del evento.
          </p>
          {{-- <img src="{{ asset('images/seleccion-entradas.png') }}" alt="Seleccionar entradas" class="mt-4 rounded shadow-md"> --}}
        </div>
      </li>

      <li class="flex items-start space-x-6">
        <div class="text-yellow-500 text-5xl flex-shrink-0">💳</div>
        <div>
          <h3 class="font-semibold text-2xl text-blue-700 mb-3">Completa el pago</h3>
          <p class="text-gray-700 leading-relaxed text-lg">
            Presiona la opción de boleta y elige el método de pago disponible. Sigue las instrucciones para confirmar tu compra sin complicaciones.
          </p>
        </div>
      </li>

      <li class="flex items-start space-x-6">
        <div class="text-yellow-500 text-5xl flex-shrink-0">📩</div>
        <div>
          <h3 class="font-semibold text-2xl text-blue-700 mb-3">Recibe tu e-ticket</h3>
          <p class="text-gray-700 leading-relaxed text-lg">
            Una vez aprobado el pago, recibirás en tu correo electrónico tu e-ticket para que puedas asistir sin inconvenientes.
          </p>
        </div>
      </li>
    </ol>

    <p class="mt-12 text-left text-gray-600 text-lg font-medium">
      Recuerda que nuestra mayor preocupación es que disfrutes de tu evento sin problemas. Contáctanos si tienes alguna pregunta o inquietud.
    </p>
  </div>
</div>
@endsection
