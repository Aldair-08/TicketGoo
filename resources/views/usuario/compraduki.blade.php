@extends('layouts.tickets')
@section('añaticket')

<div class="px-4 py-2 bg-[#0a2f7a]">
    <p class="text-xs font-bold text-white uppercase">SELECCIONA TU UBICACIÓN EN EL MAPA</p>
</div>

<div class="px-4 py-4 flex flex-col items-center space-y-6">
    <img class="w-[280px] max-w-full" height="80" src="{{ asset('images/usuario/mapa.png') }}" width="280" />
</div>

<form action="{{ route('guardar.detalle') }}" method="POST">
    @csrf

    <div class="px-4 py-6 grid grid-cols-3 gap-x-4 gap-y-6 max-w-[280px] mx-auto">
        <div class="text-xs font-bold uppercase text-gray-700">TICKET</div>
        <div class="text-xs font-bold uppercase text-gray-700">PRECIO</div>
        <div class="text-xs font-bold uppercase text-gray-700 text-center">SELECCIONA CANTIDAD</div>

        <div class="flex items-center space-x-2 text-xs text-gray-700">
            <div class="w-3 h-3 rounded-full bg-gray-400"></div>
            <span>CANCHA VIP</span>
        </div>
        <div class="text-xs text-gray-700">S/ 345.00</div>
        <div class="flex items-center justify-center space-x-2">
            <button type="button" class="decrease border border-gray-300 rounded px-2 py-0.5 text-xs font-bold">-</button>
            <input name="vip" class="ticket-input w-10 text-center border border-gray-300 rounded text-xs" min="0" readonly type="number" value="0" />
            <button type="button" class="increase border border-gray-300 rounded px-2 py-0.5 text-xs font-bold">+</button>
        </div>

        <div class="flex items-center space-x-2 text-xs text-gray-700">
            <div class="w-3 h-3 rounded-full bg-[#7a0000]"></div>
            <span>CANCHA PREFERENCIAL</span>
        </div>
        <div class="text-xs text-gray-700">S/ 288.00</div>
        <div class="flex items-center justify-center space-x-2">
            <button type="button" class="decrease border border-gray-300 rounded px-2 py-0.5 text-xs font-bold">-</button>
            <input name="preferencial" class="ticket-input w-10 text-center border border-gray-300 rounded text-xs" min="0" readonly type="number" value="0" />
            <button type="button" class="increase border border-gray-300 rounded px-2 py-0.5 text-xs font-bold">+</button>
        </div>

        <div class="flex items-center space-x-2 text-xs text-gray-700">
            <div class="w-3 h-3 rounded-full bg-[#7a0000]"></div>
            <span>CANCHA GENERAL</span>
        </div>
        <div class="text-xs text-gray-700">S/ 173.00</div>
        <div class="flex items-center justify-center space-x-2">
            <button type="button" class="decrease border border-gray-300 rounded px-2 py-0.5 text-xs font-bold">-</button>
            <input name="general" class="ticket-input w-10 text-center border border-gray-300 rounded text-xs" min="0" readonly type="number" value="0" />
            <button type="button" class="increase border border-gray-300 rounded px-2 py-0.5 text-xs font-bold">+</button>
        </div>
    </div>

    <div class="px-4 pb-6 max-w-[280px] mx-auto">
        <button class="w-full bg-gray-100 border border-gray-300 rounded text-xs text-gray-700 py-1.5" type="submit">Agregar</button>
    </div>
</form>

<div id="summary" class="px-4 pb-6 max-w-[280px] mx-auto hidden">
    <h2 class="text-lg font-bold">Resumen de Tickets</h2>
    <div id="summary-content" class="text-xs text-gray-700"></div>
</div>

</section>

<aside class="flex-1 p-4 md:p-8 border-1 border-gray-200 max-w-md">
    <img class="w-full object-cover max-h-[300px]" src="{{ asset('images/usuario/dukiderecho.jpg') }}" alt="Duki Tour" />
    <div class="p-6 flex flex-col space-y-4">
        <p class="text-xs font-semibold text-gray-700">MÚSICA <span class="text-blue-700">/ PRESENCIAL</span></p>
        <h1 class="text-base font-extrabold text-black leading-tight">DUKI - AMERI WORLD TOUR 2025</h1>
        <p class="text-xs text-gray-500">sábado, 23 de agosto 21:00 hrs.</p>
        <p class="text-xs text-gray-700 leading-relaxed">
            Luego de batir todos los records con AMERI, que se convirtió en el álbum argentino más escuchado en 24hs, DUKI se prepara para dar la gira más grande de su carrera: WORLD TOUR. El artista hará una parada obligatoria en Perú el próximo 23 de agosto del 2025 para apoderarse y encender el escenario de Multiespacio Costa 21. Las entradas estarán disponibles desde este viernes 8 de noviembre a las 10:00 am por la plataforma de Teleticket.
        </p>
        <a href="{{ route('elegirduki') }}" class="w-full bg-[#f9d6a3] text-white text-xs font-bold py-3 rounded text-center block" style="color:#fff;">
            CONTINUAR
        </a>
    </div>
</aside>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputs = document.querySelectorAll('.ticket-input');
        const increaseButtons = document.querySelectorAll('.increase');
        const decreaseButtons = document.querySelectorAll('.decrease');

        increaseButtons.forEach((btn, index) => {
            btn.onclick = (e) => {
                e.preventDefault();
                let value = parseInt(inputs[index].value) || 0;
                inputs[index].value = value + 1;
            };
        });

        decreaseButtons.forEach((btn, index) => {
            btn.onclick = (e) => {
                e.preventDefault();
                let value = parseInt(inputs[index].value) || 0;
                if (value > 0) {
                    inputs[index].value = value - 1;
                }
            };
        });
    });
</script>


</main>

@endsection
