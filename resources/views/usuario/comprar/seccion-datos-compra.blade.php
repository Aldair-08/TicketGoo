{{-- Sección de Datos de Compra --}}
<section id="seccion-datos-compra" class="hidden">
    <div class="mb-4 bg-white rounded-lg shadow p-6 px-6 w-full md:w-full mx-4">
        {{-- Barra de pasos --}}
        <div class="flex items-center gap-2 mb-4" id="barra-pasos-datos">
            <span id="paso-tickets-datos" class="text-gray-400">TICKETS</span>
            <span class="text-gray-400">/</span>
            <span id="paso-datos-datos" class="font-bold text-blue-700">DATOS DE COMPRA</span>
            <span class="text-gray-400">/</span>
            <span id="paso-confirmado-datos" class="text-gray-400">CONFIRMADO</span>
        </div>
        
        <h4 class="font-bold mb-2 text-blue-700">SELECCIONA TU FORMATO DE ENTREGA</h4>
        <div class="space-y-4">
            <label class="flex items-center border rounded p-3 cursor-pointer">
                <input type="radio" name="entrega" value="correo" class="mr-2" checked>
                <span>S/ 0 &nbsp; ONLINE CORREO</span>
            </label>
            <label class="flex items-center border rounded p-3 cursor-pointer bg-yellow-50">
                <input type="radio" name="entrega" value="tienda" class="mr-2">
                <span>
                    S/ 10 &nbsp; RETIRO DE TIENDA
                    <div class="text-xs text-yellow-700 font-semibold">Retiro disponible solo en Lima -
                        Santa
                        Anita -
                        Mall Aventuras.
                    </div>
                </span>
            </label>
        </div>
        
        <div class="mt-4 text-xs text-gray-700 border bg-yellow-50 border-1  p-3 rounded">
            <ul class="list-disc pl-5">
                <li>La tarifa de S/10.00 incluye la impresión de todas las entradas de esta compra.</li>
                <li>La entrada solo podrá ser canjeada si se presenta la siguiente documentación: </li>
                <li>Originalidad del Documento de identificación oficial del titular, tales como DNI, CE o
                    Pasaporte.</li>
                <li>Número de pedido o de orden de compra.</li>
                <li>En caso de retiro por un autorizado, presentar carta poder y copia de documento.</li>
            </ul>
        </div>

        {{-- Resumen de compra --}}
        <div class="mt-6">
            <h3 class="font-bold mb-2">RESUMEN</h3>
            <ul id="resumen-lista-final" class="mb-2"></ul>
            <div class="font-bold text-right mt-2">TOTAL: S/. <span id="total-monto-final">0.00</span></div>
        </div>
        
        <div class="mt-6">
            <h3 class="font-bold mb-2">Selecciona tu método de pago</h3>
            <label class="flex items-center mb-2">
                <input type="radio" name="metodo_pago" value="nibiz" class="mr-2" checked>
                Tarjeta de crédito/débito (NIBIZ)
                <img src="{{ asset('images/nibiz.png') }}" alt="NIBIZ" class="h-5 ml-2">
            </label>
            <label class="flex items-center">
                <input type="radio" name="metodo_pago" value="yape" class="mr-2">
                Pago con Yape
                <img src="{{ asset('images/yape.png') }}" alt="Yape" class="h-5 ml-2">
            </label>
        </div>
        
        <div class="mt-6 flex justify-center gap-4">
            <button id="volverDatosBtn"
                class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-8 rounded-full shadow mt-4">
                Volver
            </button>
            <button id="continuarconfirmadoBtn"
                class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-8 rounded-full shadow mt-4">
                Continuar
            </button>
        </div>
    </div>
    
    {{-- Modal NIBIZ --}}
    <div id="modal-nibiz" class="absolute left-0 top-0 w-full h-full flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg bg-gray-100 shadow-lg p-4 w-full max-w-md relative">
            <button onclick="cerrarModalNibiz()"
                class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/logo.png') }}" alt="TicketGO" class="w-32 h-20 mb-4">
                <form class="w-full space-y-3">
                    <input type="text" id="nibiz-numero-tarjeta" placeholder="Número de Tarjeta"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <div class="flex gap-2">
                        <input type="text" placeholder="MM / AA"
                            class="w-1/2 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        <input type="text" placeholder="CVV"
                            class="w-1/2 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    <div class="flex gap-2">
                        <input type="text" id="nibiz-nombre" placeholder="Nombre"
                            class="w-1/2 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        <input type="text" id="nibiz-apellido" placeholder="Apellido"
                            class="w-1/2 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    <input type="email" id="nibiz-email" placeholder="Email"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <button type="button" id="pagarNibizBtn"
                        class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-8 rounded-full shadow w-full mt-2">
                        Pagar s/ <span id="monto-nibiz"></span>
                    </button>
                </form>
                <div class="flex justify-center gap-2 mt-4">
                    <img src="{{ asset('images/visa.png') }}" alt="Visa" class="h-6">
                    <img src="{{ asset('images/mastercard.png') }}" alt="Mastercard" class="h-6">
                    <img src="{{ asset('images/diners.png') }}" alt="Diners" class="h-6">
                </div>
            </div>
        </div>
    </div>
    
    {{-- Modal YAPE --}}
    <div id="modal-yape" class="absolute left-0 top-0 w-full h-full flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md relative">
            <button onclick="cerrarModalYape()"
                class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/logo.png') }}" alt="TicketGO" class="w-40 h-20 mb-4">
                <form class="w-full space-y-3">
                    <label class="block font-semibold">Ingresa tu celular Yape</label>
                    <input type="text" id="yape-celular" placeholder=""
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">
                    <label class="block font-semibold">Código de aprobación</label>
                    <input type="text" id="yape-codigo" placeholder=""
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400">
                    <span class="text-xs text-gray-500">Encuéntrelo en el menú de Yape</span>
                    <button type="button" id="pagarYapeBtn"
                        class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-8 rounded-full shadow w-full mt-2">
                        Yapear s/ <span id="monto-yape"></span>
                    </button>
                </form>
                <div class="flex flex-col items-center mt-4">
                    <img src="{{ asset('images/yape.png') }}" alt="Yape" class="h-8">
                </div>
            </div>
        </div>
    </div>
</section> 