{{-- Sección de Selección de Tickets --}}
<section id="seccion-tickets">
    <div class="mb-4 bg-white rounded-lg shadow p-6 px-6 w-full md:w-full mx-4">
        {{-- Barra de pasos --}}
        <div class="flex items-center gap-2 mb-4" id="barra-pasos-tickets">
            <span id="paso-tickets" class="font-bold text-blue-700">TICKETS</span>
            <span class="text-gray-400">/</span>
            <span id="paso-datos" class="text-gray-400">DATOS DE COMPRA</span>
            <span class="text-gray-400">/</span>
            <span id="paso-confirmado" class="text-gray-400">CONFIRMADO</span>
        </div>

        <div class="mb-4">
            @php
                $ubicacion = strtolower(str_replace(' ', '', $evento->ubicacion));
                $mapa = match ($ubicacion) {
                    'costa21' => 'costa21.png',
                    'estadionacional' => 'estadionacional.png',
                    'teatrocanout' => 'teatro.png',
                    'anfiteatrop.exposición' => 'parqueexpo.png',
                    default => 'mapa_default.png',
                };
            @endphp

            <img src="{{ asset('images/' . $mapa) }}" alt="Mapa" class="w-full max-w-xs mx-auto">
        </div>

        <div class="mb-4">
            {{-- Mensaje de instrucciones --}}
            <div id="mensaje-instrucciones" class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">
                            Instrucciones para continuar:
                        </h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <ul class="list-disc list-inside space-y-1">
                                <li>Selecciona la cantidad de tickets que deseas comprar</li>
                                <li>O elige una promoción disponible (si aplica)</li>
                                <li>Presiona el botón <strong>"Agregar"</strong> para confirmar tu selección</li>
                                <li>Una vez agregado, podrás continuar al siguiente paso</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-2" id="entradas-lista">
                @foreach ($evento->entradas as $entrada)
                    @php
                        $maximo = min($entrada->ticket_por_persona, $entrada->stock);
                    @endphp
                    <div class="flex items-center justify-between entrada-item" data-id="{{ $entrada->id }}"
                        data-tipo="{{ strtoupper($entrada->tipo) }}" data-precio="{{ $entrada->precio }}">
                        <span class="font-semibold">{{ strtoupper($entrada->tipo) }}</span>
                        <span>S/. {{ number_format($entrada->precio, 2) }}</span>
                        <input type="number" min="0" max="{{ $maximo }}" value="0"
                            class="border rounded w-16 text-center cantidad-input" name="cantidad[{{ $entrada->id }}]">
                        <span class="text-xs text-gray-500 ml-2">Máx: {{ $maximo }}</span>
                        <span class="text-xs text-gray-500 ml-2">Stock: {{ $entrada->stock }}</span>
                    </div>
                @endforeach
            </div>

            {{-- BLOQUE DE PROMOCIONES --}}
            <div class="flex flex-col gap-2 mt-6" id="promociones-lista">
                <h4 class="font-bold text-yellow-700">PROMOCIONES DISPONIBLES</h4>
                @foreach ($promociones as $promo)
                    <div class="flex items-center justify-between promo-item border border-yellow-300 rounded p-2 bg-yellow-50"
                        data-id="{{ $promo->id_promocion }}" data-nombre="{{ $promo->nombre }}"
                        data-precio="{{ $promo->valor ?? 0 }}">
                        <div>
                            <span class="font-semibold">{{ $promo->nombre }}</span>
                            <span class="text-xs text-gray-600 ml-2">{{ $promo->descripcion }}</span>
                        </div>
                        <span>S/. {{ number_format($promo->valor ?? 0, 2) }}</span>
                        <input type="radio" name="promo_seleccionada" value="{{ $promo->id_promocion }}"
                            class="promo-radio">
                    </div>
                @endforeach
            </div>

            <button id="agregarBtn"
                class="bg-yellow-400 text-black font-bold py-2 px-8 rounded-full shadow mt-4 opacity-50 cursor-not-allowed"
                disabled>
                Agregar
            </button>


        </div>

        {{-- Resumen --}}
        <div class="mt-6">
            <h3 class="font-bold mb-2">RESUMEN</h3>
            <ul id="resumen-lista" class="mb-2"></ul>
            <div class="font-bold text-right mt-2">SUBTOTAL: S/. <span id="total-monto">0.00</span></div>
        </div>

        <div class="mt-6 flex justify-center gap-4">
            <button id="volverBtn"
                class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-8 rounded-full shadow mt-4">
                Volver
            </button>
            <button id="continuarBtn"
                class="bg-blue-700 text-white font-bold py-2 px-8 rounded-full shadow mt-4 opacity-50 cursor-not-allowed"
                disabled>
                Continuar
            </button>
        </div>
    </div>

    {{-- Mensaje flotante de éxito --}}
    <div id="mensaje-exito" class="fixed top-4 right-4 z-50 opacity-0 invisible transition-all duration-300 ease-in-out">
        <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg max-w-sm">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">
                        ¡Perfecto! Tu selección ha sido agregada.
                    </p>
                </div>
                <div class="ml-4 flex-shrink-0">
                    <button id="cerrar-mensaje" class="text-white hover:text-green-100 focus:outline-none">
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
