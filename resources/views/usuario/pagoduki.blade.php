@extends('layouts.pago')

@section('pago')
@if($compra && $compra->detalles->isNotEmpty())

<div class="max-w-6xl mx-auto space-y-8">

  {{-- Contenedor flex para documento+medio pago (izq) y aside (der) --}}
  <div class="flex flex-col md:flex-row md:space-x-10">

    {{-- Izquierda: Documento + Medio de Pago --}}
    <div class="flex flex-col space-y-6 flex-1 max-w-xl">

      {{-- Selecciona Documento --}}
      <div>
        <h3 class="bg-blue-900 text-white text-xs font-bold uppercase px-3 py-1 mb-3 inline-block">Selecciona Documento</h3>
        <div class="flex items-center space-x-3 mb-2">
          <div class="w-5 h-5 rounded-full bg-yellow-500 border border-yellow-700 flex items-center justify-center">
            <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
          </div>
          <span class="text-xs font-bold">BOLETA</span>
        </div>
        <p class="text-[10px] leading-tight text-justify text-gray-700">
          Las entradas son vendidas por TICKETGO, por cuenta y orden de la empresa organizadora del evento.
          TICKETGO no tiene participación alguna en la organización del evento. Cada asistente es responsable de verificar
          las condiciones de ingreso y seguridad antes de adquirir su entrada.
        </p>
        <p class="text-[10px] font-bold mt-2">Para descargar tu Boleta ingresa a “MI CUENTA”.</p>
      </div>

      {{-- Selecciona Medio de Pago --}}
      <div>
        <h3 class="bg-blue-900 text-white text-xs font-bold uppercase px-3 py-1 mb-3 inline-block">Selecciona el Medio de Pago</h3>
        <label for="niubiz" id="niubizLabel"
          class="pago-label flex items-center justify-between border border-gray-300 rounded-md p-3 cursor-pointer hover:shadow transition-all duration-200">
          <div class="flex items-center space-x-3">
            <img class="h-6 w-auto" src="{{ asset('images/usuario/metodos.png') }}" alt="Métodos de pago" />
            <span class="text-xs">NIUBIZ</span>
          </div>
          <input type="radio" id="niubiz" name="payment" value="niubiz"
            class="form-radio h-5 w-5 text-yellow-500 border-gray-300" checked />
        </label>

        {{-- BLOQUE AMARILLO: solo los pasos --}}
        <div id="niubizSteps"
          class="mt-4 p-3 border border-yellow-500 rounded bg-yellow-50 text-[11px] text-yellow-800">
          <h4 class="font-bold mb-1">Pasos para completar tu pago con NIUBIZ:</h4>
          <ol class="list-decimal list-inside space-y-1">
            <li>Confirma que los datos de tu compra sean correctos.</li>
            <li>Serás redirigido a la plataforma Niubiz.</li>
            <li>Ingresa los datos de tu tarjeta.</li>
            <li>Confirma y espera validación.</li>
            <li>Recibirás confirmación por email.</li>
          </ol>
        </div>

        {{-- RESUMEN DE TICKETS: fuera del bloque amarillo --}}
        <div class="mt-6">
          <h4 class="text-xs font-bold mb-2">RESUMEN</h4>
          <div class="border-t border-b border-gray-300 divide-y divide-gray-300 text-[10px]">
            @foreach($compra->detalles as $detalle)
            <div class="flex justify-between items-center py-2">
              <div class="flex space-x-2 w-1/2">
                <span class="w-16">{{ $detalle->cantidad }} TICKET</span>
                <span class="w-36 truncate">{{ strtoupper($detalle->descripcion ?? $detalle->tipo_ticket) }}</span>
              </div>
              <span class="w-20 text-right">S/ {{ number_format($detalle->precio_unitario * $detalle->cantidad, 1) }}</span>
              <form method="POST" action="{{ route('detalle.eliminar', $detalle->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="text-xs text-red-500 hover:text-red-700 w-16 text-right">Eliminar</button>
              </form>
            </div>
            @endforeach
          </div>

          <div class="text-center mt-3 text-[10px]">TOTAL</div>
          <div id="totalPrice" class="text-center font-bold text-lg mb-6">
            S/ {{ number_format($compra->detalles->sum(fn($d) => $d->precio_unitario * $d->cantidad), 1) }}
          </div>
        </div>
      </div>
    </div>

    {{-- Derecha: Info del evento y botón --}}
    <aside class="flex-1 p-4 md:p-8 max-w-md">
      <img class="w-full object-cover max-h-[300px]" src="{{ asset('images/usuario/dukiderecho.jpg') }}" alt="Duki Tour" />
      <div class="p-6 flex flex-col space-y-4">
        <p class="text-xs font-semibold text-gray-700">MÚSICA <span class="text-blue-700">/ PRESENCIAL</span></p>
        <h1 class="text-base font-extrabold text-black leading-tight">DUKI - AMERI WORLD TOUR 2025</h1>
        <p class="text-xs text-gray-500">sábado, 23 de agosto 21:00 hrs.</p>
        <p class="text-xs text-gray-700 leading-relaxed">
          Luego de batir todos los records con AMERI, que se convirtió en el álbum argentino más escuchado en 24hs, DUKI se prepara para dar la gira más grande de su carrera: WORLD TOUR. El artista hará una parada obligatoria en Perú el próximo 23 de agosto del 2025 para apoderarse y encender el escenario de Multiespacio Costa 21. Las entradas estarán disponibles desde este viernes 8 de noviembre a las 10:00 am por la plataforma de Teleticket.
        </p>
        <a href="{{ route('usuario.identificadorduki', ['compra_id' => $compra->id]) }}"
          class="bg-[#f7b32b] text-white uppercase font-bold text-sm py-3 rounded shadow-md hover:shadow-lg transition-shadow text-center block">
          CONTINUAR
        </a>
      </div>
    </aside>
  </div>
</div>

@else
<div class="text-red-600 text-sm font-bold p-4 bg-yellow-100 border border-yellow-300 rounded max-w-xl mx-auto">
  No se encontró una compra activa asociada a tu cuenta. Regresa al inicio para seleccionar tus tickets.
</div>
@endif
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const label = document.getElementById('niubizLabel');
    const input = document.getElementById('niubiz');

    function updateHighlight() {
      if (input.checked) {
        label.classList.add('bg-yellow-100', 'border-yellow-500');
      } else {
        label.classList.remove('bg-yellow-100', 'border-yellow-500');
      }
    }

    input.addEventListener('change', updateHighlight);
    updateHighlight();
  });
</script>
@endpush