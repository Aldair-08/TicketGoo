{{-- Sección de Selección de Tickets --}}
<style>
    /* Ocultar flechitas del input number */
    .cantidad-input::-webkit-outer-spin-button,
    .cantidad-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
    .cantidad-input[type=number] {
        -moz-appearance: textfield;
    }
    
    /* Estilos para entradas sin stock */
    .entrada-item.sin-stock {
        opacity: 0.7;
        background-color: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 8px;
    }
    
    .entrada-item.sin-stock:hover {
        opacity: 0.8;
    }
</style>
<section id="seccion-tickets">
    <div class="mb-4 bg-white rounded-lg shadow p-6 px-6 w-full md:w-full mx-4">
        {{-- Barra de pasos --}}
        <div class="flex items-center gap-6 mb-10 text-sm md:text-base font-semibold uppercase justify-start"
            id="barra-pasos-tickets">
            <div class="flex items-center space-x-2 text-blue-700 relative">
                <span
                    class="w-6 h-6 md:w-7 md:h-7 rounded-full border-2 border-black flex items-center justify-center bg-blue-700">
                    <span class="block w-3 h-3 rounded-full bg-white"></span>
                </span>
                <span class="tracking-wide">Tickets</span>
                <span class="absolute bottom-0 left-0 right-0 h-[2px] -mb-5 md:-mb-6"></span>
            </div>
            <span class="text-gray-400 text-lg font-bold">/</span>
            <div class="flex items-center space-x-2 text-gray-400">
                <span
                    class="w-6 h-6 md:w-7 md:h-7 rounded-full border border-gray-400 flex items-center justify-center">
                    <span class="block w-3 h-3 rounded-full bg-gray-400"></span>
                </span>
                <span class="tracking-wide">Datos de compra</span>
            </div>
            <span class="text-gray-400 text-lg font-bold">/</span>
            <div class="flex items-center space-x-2 text-gray-400">
                <span
                    class="w-6 h-6 md:w-7 md:h-7 rounded-full border border-gray-400 flex items-center justify-center">
                    <span class="block w-3 h-3 rounded-full bg-gray-400"></span>
                </span>
                <span class="tracking-wide">Confirmado</span>
            </div>
        </div>

        <div class="px-4 py-2 bg-blue-700">
            <p class="text-xs font-bold text-white uppercase">SELECCIONA TU UBICACIÓN EN EL MAPA</p>
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
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
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

            <div class="mb-4">
                @php
                    $todasSinStock = $evento->entradas->every(function($entrada) {
                        return $entrada->stock <= 0;
                    });
                @endphp
                
                @if($todasSinStock)
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">
                                    Evento agotado
                                </h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <p>Lo sentimos, todas las entradas para este evento están agotadas.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
                <div class="flex flex-col gap-2" id="entradas-lista">
                    @foreach ($evento->entradas as $entrada)
                        @php
                            $maximo = min($entrada->ticket_por_persona, $entrada->stock);
                            $sinStock = $entrada->stock <= 0;
                        @endphp
                        <div class="flex items-center justify-between entrada-item {{ $sinStock ? 'sin-stock' : '' }}" 
                            data-id="{{ $entrada->id }}"
                            data-tipo="{{ strtoupper($entrada->tipo) }}" data-precio="{{ $entrada->precio }}"
                            style="gap: 1rem;">

                            <div class="w-1/3 font-semibold {{ $sinStock ? 'text-gray-400' : '' }}">
                                {{ strtoupper($entrada->tipo) }}
                                @if($sinStock)
                                    <span class="text-red-500 text-xs block">SIN STOCK</span>
                                @endif
                            </div>

                            <div class="w-1/3 {{ $sinStock ? 'text-gray-400' : '' }}">
                                S/. {{ number_format($entrada->precio, 2) }}
                            </div>

                            <div class="w-1/3 flex items-center space-x-2">
                                @if($sinStock)
                                    <div class="text-red-500 text-xs font-bold bg-red-50 border border-red-200 rounded px-3 py-1">
                                        NO DISPONIBLE
                                    </div>
                                @else
                                    <button type="button"
                                        class="decrease border border-gray-300 rounded px-2 py-0.5 text-xs font-bold hover:bg-gray-100">-</button>
                                    <input type="number" min="0" max="{{ $maximo }}" value="0"
                                        class="border rounded w-16 text-center cantidad-input"
                                        name="cantidad[{{ $entrada->id }}]"
                                        style="-webkit-appearance: none; -moz-appearance: textfield; appearance: textfield;">
                                    <button type="button"
                                        class="increase border border-gray-300 rounded px-2 py-0.5 text-xs font-bold hover:bg-gray-100">+</button>
                                @endif
                            </div>

                            <div class="flex flex-col text-xs text-gray-500 ml-4">
                                @if($sinStock)
                                    <span class="text-red-500 font-bold">Stock: 0</span>
                                @else
                                    <span>Máx: {{ $maximo }}</span>
                                    <span>Stock: {{ $entrada->stock }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- BLOQUE DE PROMOCIONES --}}
            <div class="flex flex-col gap-2 mt-6" id="promociones-lista">
                <h4 class="font-bold text-yellow-500">PROMOCIONES DISPONIBLES</h4>
                @if($promociones->count() > 0)
                    @foreach ($promociones as $promo)
                        <div class="flex items-center justify-between promo-item border border-yellow-300 rounded p-2 bg-yellow-50 cursor-pointer hover:bg-yellow-100 transition-colors duration-200"
                            data-id="{{ $promo->id_promocion }}" data-nombre="{{ $promo->nombre }}"
                            data-precio="{{ $promo->valor ?? 0 }}" onclick="seleccionarPromocion(this)">
                            <div>
                                <span class="font-semibold">{{ $promo->nombre }}</span>
                                <span class="text-xs text-gray-600 ml-2">{{ $promo->descripcion }}</span>
                            </div>
                            <span>S/. {{ number_format($promo->valor ?? 0, 2) }}</span>
                            <input type="radio" name="promo_seleccionada" value="{{ $promo->id_promocion }}"
                                class="promo-radio" onclick="event.stopPropagation()">
                        </div>
                    @endforeach
                @else
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-800">
                                    No hay promociones disponibles
                                </h3>
                                <div class="mt-2 text-sm text-gray-700">
                                    <p>Ya has utilizado todas las promociones disponibles para este evento o no hay promociones activas en este momento.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <button id="agregarBtn"
                class="bg-blue-700 text-white font-bold py-2 px-8 rounded-full shadow mt-4 opacity-50 cursor-not-allowed"
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
                class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-2 px-8 rounded-full shadow mt-4">
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
    <div id="mensaje-exito"
        class="fixed top-4 right-4 z-50 opacity-0 invisible transition-all duration-300 ease-in-out">
        <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg max-w-sm">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
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
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
