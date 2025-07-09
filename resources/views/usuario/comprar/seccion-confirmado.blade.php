{{-- Sección de Confirmado --}}
<section id="seccion-confirmado" class="hidden">
    <div class="mb-4 bg-white rounded-lg shadow p-6 px-6 w-full md:w-full mx-4">
        <div class="flex items-center gap-6 mb-10 text-sm md:text-base font-semibold uppercase justify-start"
            id="barra-pasos-confirmado">
            <div class="flex items-center space-x-2 text-blue-700 relative">
                <span
                    class="w-6 h-6 md:w-7 md:h-7 rounded-full border-2 border-black flex items-center justify-center bg-blue-700">
                    <i class="fas fa-check text-white text-xs"></i>
                </span>
                <span class="tracking-wide">Tickets</span>
                <span class="absolute bottom-0 left-0 right-0 h-[2px] -mb-5 md:-mb-6"></span>
            </div>
            <span class="text-black text-lg font-bold">/</span>
            <div class="flex items-center space-x-2 text-blue-700 relative">
                <span
                    class="w-6 h-6 md:w-7 md:h-7 rounded-full border-2 border-black flex items-center justify-center bg-blue-700">
                    <i class="fas fa-check text-white text-xs"></i>
                </span>
                <span class="tracking-wide">Datos de compra</span>
                <span class="absolute bottom-0 left-0 right-0 h-[2px] -mb-5 md:-mb-6"></span>
            </div>
            <span class="text-black text-lg font-bold">/</span>
            <div class="flex items-center space-x-2 text-blue-700 relative">
                <span
                    class="w-6 h-6 md:w-7 md:h-7 rounded-full border-2 border-black flex items-center justify-center bg-blue-700">
                    <i class="fas fa-check text-white text-xs"></i>
                </span>
                <span class="tracking-wide">Confirmado</span>
                <span class="absolute bottom-0 left-0 right-0 h-[2px] -mb-5 md:-mb-6"></span>
            </div>
        </div>
        <br>

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
                    <div class="flex space-x-4 mt-2">
                        <a href="/usuario/principallog"
                            class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-2 px-8 rounded-full shadow mt-2 block text-center">
                            Volver Inicio
                        </a>
                        <a href="#"
                            class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-8 rounded-full shadow mt-2 block text-center"
                            target="_blank" id="descargarBoletoBtn">
                            Descargar Boleto
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
