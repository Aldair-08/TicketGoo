{{-- Sección de Datos de Compra --}}
<style>
    /* Animaciones personalizadas */
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .animate-pulse-slow {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    .animate-slide-in {
        animation: slideIn 0.5s ease-out;
    }
    
    .animate-fade-in {
        animation: fadeIn 0.3s ease-in;
    }
    
    /* Estilos para el modal de carga */
    .modal-carga-backdrop {
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
    }
    
    .progreso-mensaje {
        transition: all 0.3s ease;
    }
    
    .progreso-mensaje.completado {
        color: #059669;
        font-weight: 600;
    }
    
    .progreso-mensaje.activo {
        color: #1d4ed8;
        font-weight: 600;
    }
</style>

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
                
                {{-- Mensaje informativo --}}
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4 w-full">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-800 font-medium">
                                Ingresa los datos del titular de la tarjeta para su validación
                            </p>
                        </div>
                    </div>
                </div>
                
                <form class="w-full space-y-3">
                    <input type="text" id="nibiz-numero-tarjeta" placeholder="Número de Tarjeta"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        maxlength="19">
                    <div class="flex gap-2">
                        <input type="text" id="nibiz-fecha" placeholder="MM / AA"
                            class="w-1/2 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                            maxlength="5">
                        <input type="text" id="nibiz-cvv" placeholder="CVV"
                            class="w-1/2 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                            maxlength="3">
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
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400"
                        maxlength="11">
                    <label class="block font-semibold">Código de aprobación</label>
                    <input type="text" id="yape-codigo" placeholder=""
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400"
                        maxlength="10">
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

    {{-- Modal de Carga --}}
    <div id="modal-carga" class="absolute left-0 top-0 w-full h-full flex items-center justify-center z-50 hidden bg-black bg-opacity-50 modal-carga-backdrop">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md relative animate-slide-in">
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/logo.png') }}" alt="TicketGO" class="w-32 h-20 mb-6 animate-pulse-slow">
                
                {{-- Animación de carga --}}
                <div class="flex flex-col items-center mb-6">
                    <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-blue-700 mb-4"></div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2 animate-pulse-slow">Procesando pago...</h3>
                    <p class="text-sm text-gray-600 text-center">Estamos procesando tu pago y generando tu boleta</p>
                </div>

                {{-- Barra de progreso --}}
                <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                    <div id="barra-progreso" class="bg-gradient-to-r from-blue-600 to-blue-800 h-2 rounded-full transition-all duration-500 ease-out" style="width: 0%"></div>
                </div>

                {{-- Mensajes de progreso --}}
                <div id="mensajes-progreso" class="text-sm text-gray-600 text-center space-y-2">
                    <div id="mensaje-1" class="progreso-mensaje opacity-50">✓ Validando datos de pago</div>
                    <div id="mensaje-2" class="progreso-mensaje opacity-50">⏳ Procesando transacción</div>
                    <div id="mensaje-3" class="progreso-mensaje opacity-50">⏳ Generando boleta</div>
                    <div id="mensaje-4" class="progreso-mensaje opacity-50">⏳ Enviando email</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Mensaje flotante de error --}}
    <div id="mensaje-error" class="fixed top-4 right-4 z-50 opacity-0 invisible transition-all duration-300 ease-in-out">
        <div class="bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg max-w-sm">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <h3 class="text-sm font-medium">
                        Errores de validación:
                    </h3>
                    <div id="lista-errores" class="mt-1 text-xs">
                        <!-- Los errores se insertarán aquí dinámicamente -->
                    </div>
                </div>
                <div class="ml-4 flex-shrink-0">
                    <button id="cerrar-mensaje-error" class="text-white hover:text-red-100 focus:outline-none">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section> 