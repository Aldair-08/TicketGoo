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
                class="bg-yellow-400 hover:bg-yellow-300 text-black font-bold py-2 px-8 rounded-full shadow mt-4">
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
                class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-8 rounded-full shadow mt-4">
                Continuar
            </button>
        </div>
    </div>
</section>
