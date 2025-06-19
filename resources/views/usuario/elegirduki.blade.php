@extends('layouts.elegir')

@section('añaelegir')

<div class="w-full flex justify-center px-4">
    <div class="bg-white rounded-lg p-6 flex flex-col lg:flex-row gap-6 w-full max-w-5xl">
        <!-- FORMULARIO PRINCIPAL -->
        <form action="{{ route('guardar.compra') }}" method="POST" class="flex-1" id="formulario-compra">
            @csrf

            <div class="px-4 py-2 bg-[#0a2f7a]">
                <p class="text-xs font-bold text-white uppercase">SELECCIONA TU FORMATO DE ENTREGA</p>
            </div>
            <br>

            <!-- Opción eTicket -->
            <div id="container-eticket"
                class="p-3 text-[10px] text-[#333333] mb-4 relative cursor-pointer border border-black rounded">
                <div class="flex justify-between items-center mb-1">
                    <div class="flex space-x-2 text-[10px] font-semibold uppercase">
                        <span>S/0</span>
                        <span>ETICKET</span>
                    </div>
                    <input class="w-4 h-4 accent-yellow-500" type="radio" name="formato_entrega" value="eticket"
                        id="radioEticket" checked />
                </div>
                <div id="eticket-detail">
                    <ol class="list-decimal pl-4 space-y-1 text-[9px] text-[#333333]">
                        <li>Descarga tus E-tickets desde www.teleticket.com.pe en "MIS ETICKETS".</li>
                        <li>El E-ticket es válido y no se canjea por entrada física.</li>
                        <li>Puedes usarlo en digital o impreso (deportes requieren impreso).</li>
                        <li>No lo compartas, podría impedir tu ingreso.</li>
                        <li>El primero en usarlo será quien acceda.</li>
                    </ol>
                </div>
            </div>

            <!-- Opción Retiro -->
            <div id="container-retiro"
                class="p-3 text-[10px] text-[#333333] mb-4 relative cursor-pointer border border-black rounded">
                <div class="flex justify-between items-center mb-1">
                    <div class="flex space-x-2 text-[10px] font-semibold uppercase">
                        <span>S/12</span>
                        <span>RETIRO DE TIENDA</span>
                    </div>
                    <input class="w-4 h-4 accent-yellow-500" type="radio" name="formato_entrega" value="retiro"
                        id="radioRetiro" />
                </div>
                <div id="retiro-detail" class="hidden">
                    <ol class="list-decimal pl-4 space-y-1 text-[9px] text-[#333333]">
                        <li>Presenta tu DNI y código de compra.</li>
                        <li>Horario: Lunes a sábado de 10:00 a 19:00 hrs.</li>
                        <li>Solo el comprador o autorizado puede retirar.</li>
                        <li>No hay devoluciones ni cambios.</li>
                        <li>Conserva tu comprobante de compra.</li>
                    </ol>
                </div>
            </div>

            <!-- Tabla de tickets -->
            <div class="border-t border-gray-300 pt-2 text-[10px]">
                <table class="w-full text-gray-600">
                    <tbody>
                        @php $total = $total ?? 0; @endphp
                        @foreach($tickets as $tipo => $ticket)
                            @if ($ticket['cantidad'] > 0)
                                @php $subtotal = $ticket['cantidad'] * $ticket['precio']; @endphp
                                <tr class="border-b border-gray-300">
                                    <td class="py-1">{{ $ticket['cantidad'] }} TICKET{{ $ticket['cantidad'] > 1 ? 'S' : '' }}</td>
                                    <td class="py-1">
                                        @switch($tipo)
                                            @case('vip') CANCHA VIP @break
                                            @case('preferencial') CANCHA PREFERENCIAL @break
                                            @case('general') CANCHA GENERAL @break
                                        @endswitch
                                    </td>
                                    <td class="py-1 text-right">S/ {{ number_format($subtotal, 1) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Total centrado -->
            <div class="mt-2 text-[10px] font-semibold flex justify-center space-x-1 text-center">
                <span>TOTAL</span>
                <span class="text-base font-bold" id="totalFinal">S/. {{ number_format($total, 1) }}</span>
                <input type="hidden" name="total_final" id="inputTotalFinal" value="{{ $total }}">
            </div>
        </form>

        <!-- ASIDE DERECHO -->
        <aside class="flex-1 p-4 md:p-8 max-w-md">
            <img class="w-full object-cover max-h-[300px]" src="{{ asset('images/usuario/dukiderecho.jpg') }}"
                alt="Duki Tour" />
            <div class="p-6 flex flex-col space-y-4">
                <p class="text-xs font-semibold text-gray-700">MÚSICA <span class="text-blue-700">/ PRESENCIAL</span></p>
                <h1 class="text-base font-extrabold text-black leading-tight">DUKI - AMERI WORLD TOUR 2025</h1>
                <p class="text-xs text-gray-500">sábado, 23 de agosto 21:00 hrs.</p>
                <p class="text-xs text-gray-700 leading-relaxed">
                    Luego de batir todos los records con AMERI, que se convirtió en el álbum argentino más escuchado en 24hs,
                    DUKI se prepara para dar la gira más grande de su carrera: WORLD TOUR. El artista hará una parada obligatoria
                    en Perú el próximo 23 de agosto del 2025 para apoderarse y encender el escenario de Multiespacio Costa 21.
                </p>

                <!-- ✅ BOTÓN FUNCIONAL - ACTUALIZADO -->
                <div class="mt-6">
                    <button type="submit"
                        form="formulario-compra"
                        class="bg-[#ff9800] hover:bg-[#f57c00] text-white uppercase font-bold text-xs py-2.5 rounded hover:brightness-110 hover:shadow-xl transition-all duration-200 ease-in-out text-center w-full">
                        CONTINUAR
                    </button>
                </div>
            </div>
        </aside>
    </div>
</div>

@endsection

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const radioEticket = document.getElementById('radioEticket');
        const radioRetiro = document.getElementById('radioRetiro');
        const eticketDetail = document.getElementById('eticket-detail');
        const retiroDetail = document.getElementById('retiro-detail');
        const totalSpan = document.getElementById('totalFinal');
        const totalInput = document.getElementById('inputTotalFinal');
        const totalOriginal = parseFloat("{{ $total }}");

        function actualizarTotal() {
            let envio = 0;
            if (radioRetiro.checked) envio = 12;

            const totalFinal = totalOriginal + envio;
            totalSpan.textContent = `S/. ${totalFinal.toFixed(2)}`;
            totalInput.value = totalFinal.toFixed(2);
        }

        radioEticket.addEventListener('change', () => {
            eticketDetail.classList.remove('hidden');
            retiroDetail.classList.add('hidden');
            actualizarTotal();
        });

        radioRetiro.addEventListener('change', () => {
            retiroDetail.classList.remove('hidden');
            eticketDetail.classList.add('hidden');
            actualizarTotal();
        });

        actualizarTotal();
    });
</script>
