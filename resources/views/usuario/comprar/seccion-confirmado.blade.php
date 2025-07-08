{{-- Sección de Confirmado --}}
<div id="seccion-confirmado" class="hidden">
    <div class="flex items-center gap-2 mb-4">
        <span id="paso-tickets-confirmado" class="text-gray-400">TICKETS</span>
        <span class="text-gray-400">/</span>
        <span id="paso-datos-confirmado" class="text-gray-400">DATOS DE COMPRA</span>
        <span class="text-gray-400">/</span>
        <span id="paso-confirmado-confirmado" class="font-bold text-blue-700">CONFIRMADO</span>
    </div>

    <div class="flex flex-col items-center justify-center min-h-[60vh]">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md relative">
            <button onclick="cerrarModal()"
                class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/logo.png') }}" alt="TicketGO" class="w-32 h-20 mb-4">
                <h2 class="font-bold text-lg mb-2">Boleto de compra</h2>

                {{-- Detalles del evento --}}
                <div class="w-full mb-4 border-b pb-2" id="detalles-evento-confirmado"></div>

                {{-- Detalle de entradas y total --}}
                <div class="w-full mb-4 border-b pb-2">
                    <h3 class="font-semibold mb-1">Entradas compradas</h3>
                    <ul class="mb-2" id="resumen-lista-confirmado"></ul>
                    <div class="text-sm text-gray-600 mt-2">
                        <div class="flex justify-between">
                            <span>Subtotal entradas:</span>
                            <span>S/. <span id="subtotal-entradas-confirmado">0.00</span></span>
                        </div>
                        <div class="flex justify-between">
                            <span>Costo de entrega:</span>
                            <span>S/. <span id="costo-entrega-confirmado">0.00</span></span>
                        </div>
                    </div>
                    <div class="font-bold text-right mt-2">TOTAL: S/. <span id="total-monto-confirmado">0.00</span>
                    </div>
                </div>

                {{-- Método de pago y datos del comprador --}}
                <div class="w-full mb-4 border-b pb-2">
                    <h3 class="font-semibold mb-1">Método de pago</h3>
                    <div id="metodo-pago-confirmado" class="flex items-center gap-2 mb-2"></div>
                    <div id="datos-comprador-confirmado"></div>
                    <div class="mt-2 text-sm text-gray-600">
                        <span class="font-semibold">Fecha de pago:</span> <span id="fecha-pago-confirmado"></span>
                    </div>
                </div>

                {{-- Forma de entrega --}}
                <div class="w-full mb-4 border-b pb-2">
                    <h3 class="font-semibold mb-1">Forma de entrega</h3>
                    <div id="forma-entrega-confirmado" class="text-sm"></div>
                </div>

                <a href="#"
                    class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-8 rounded-full shadow mt-2 block text-center"
                    target="_blank" id="descargarBoletoBtn">
                    Descargar Boleto
                </a>
                <a href="/usuario/principallog"
                    class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-8 rounded-full shadow mt-2 block text-center">
                    Volver Inicio
                </a>
            </div>
        </div>
    </div>
</div>
