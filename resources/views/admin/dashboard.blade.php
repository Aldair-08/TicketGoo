@extends('layouts.ad-plantilla')
@section('contenido')

<!-- 🟨 Bloque blanco: Bienvenida + imagen -->
<div class="w-full bg-white px-6 py-8 shadow-md flex flex-col md:flex-row items-center gap-6">
    <!-- Texto -->
    <div class="md:w-1/2">
        <h1 class="text-2xl font-bold text-yellow-600">¡Bienvenido, Administrador!</h1>
        <p class="mt-2 text-gray-700">
            Comienza a gestionar todos tus eventos. Organiza espacios, crea promociones, 
            revisa ventas y mantén el control total con TicketGO.
        </p>
    </div>

    <!-- Imagen -->
    <div class="md:w-1/2">
        <img src="{{ asset('images/vision.png') }}" alt="Bienvenida admin" class="w-full max-w-sm mx-auto">
    </div>
</div>


<div class="w-full bg-gray-400 px-6 py-10">
  <h1 class="text-2xl text-center font-bold">Experiencia TicketGO en números</h1>
  <p class="mt-2 text-gray-700 text-center">
    Conoce algunos de los números de quienes han confiado en nosotros
  </p>

  <div class="flex justify-center gap-12 mt-10 w-full max-w-4xl mx-auto">
    <!-- Icono 1 -->
    <div class="flex flex-col items-center">
      <div class="bg-yellow-500 rounded-full w-24 h-24 flex items-center justify-center">
        <div class="w-16 h-16 flex items-center justify-center">
          <img src="{{ asset('images/eventopublicado.png') }}" alt="Icono 1" class="max-w-full max-h-full object-contain">
        </div>
      </div>
      <p class="mt-3 text-center text-gray-800 font-semibold">258 426 <br> Eventos publicados </p>
    </div>

    <!-- Icono 2 -->
    <div class="flex flex-col items-center">
      <div class="bg-yellow-500 rounded-full w-24 h-24 flex items-center justify-center">
        <div class="w-16 h-16 flex items-center justify-center">
          <img src="{{ asset('images/eticketemitido.png') }}" alt="Icono 2" class="max-w-full max-h-full object-contain">
        </div>
      </div>
      <p class="mt-3 text-center text-gray-800 font-semibold"> 10 M <br> E-Tickets emitidos</p>
    </div>

    <!-- Icono 3 -->
    <div class="flex flex-col items-center">
      <div class="bg-yellow-500 rounded-full w-24 h-24 flex items-center justify-center">
        <div class="w-16 h-16 flex items-center justify-center">
          <img src="{{ asset('images/clientes.png') }}" alt="Icono 3" class="max-w-full max-h-full object-contain">
        </div>
      </div>
      <p class="mt-3 text-center text-gray-800 font-semibold"> 5.2M <br> Clientes satisfechos</p>
    </div>

    <!-- Icono 4 -->
    <div class="flex flex-col items-center">
      <div class="bg-yellow-500 rounded-full w-24 h-24 flex items-center justify-center">
        <div class="w-16 h-16 flex items-center justify-center">
          <img src="{{ asset('images/artistas.png') }}" alt="Icono 4" class="max-w-full max-h-full object-contain">
        </div>
      </div>
      <p class="mt-3 text-center text-gray-800 font-semibold"> 300 <br> Artistas publicados</p>
    </div>
  </div>
</div>
<div class="w-full flex items-stretch mt-0">
  <!-- Imagen izquierda -->
  <div class="w-1/2">
    <img src="{{ asset('images/2.jpg') }}" alt="Asesor" class="w-full h-full object-cover">
  </div>

    <!-- Texto derecha con fondo amarillo -->
    <div class="w-1/2 bg-yellow-500 p-6 flex flex-col justify-center min-h-[300px]">
        <h1 class="text-center text-black text-lg font-semibold">
            ¿Te gustaría que te ayudemos a organizar tu evento perfecto?
        </h1>
        <p class="text-center mt-4 text-black text-sm">
            Nuestro equipo de asesores está listo para acompañarte en cada paso, 
            resolver tus dudas y ofrecerte la mejor solución para que tu evento sea todo un éxito.
            ¡No dudes en contactarnos, estamos aquí para ayudarte!
        </p>
    </div>

</div>


</div>


@endsection
