@extends('layouts.autenticado')

@section('contenido')
    <div class="flex flex-col md:flex-row gap-6 items-start">
        <div class="w-full md:w-2/3">
            {{-- Selección de tickets --}}
            <div id="seccion-tickets">
                <div class="mb-4">
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
                                'parqueexpo' => 'parqueexpo.png',
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
                                        class="border rounded w-16 text-center cantidad-input"
                                        name="cantidad[{{ $entrada->id }}]">
                                    <span class="text-xs text-gray-500 ml-2">Máx: {{ $maximo }}</span>
                                    <span class="text-xs text-gray-500 ml-2">Stock: {{ $entrada->stock }}</span>
                                </div>
                            @endforeach
                        </div>
                        <button id="agregarBtn"
                            class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-8 rounded-full shadow mt-4">Agregar</button>
                    </div>
                    {{-- Resumen --}}
                    <div class="mt-6">
                        <h3 class="font-bold mb-2">RESUMEN</h3>
                        <ul id="resumen-lista" class="mb-2"></ul>
                        <div class="font-bold text-right mt-2">TOTAL: S/. <span id="total-monto">0.00</span></div>
                    </div>
                    <button id="continuarBtn"
                        class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-8 rounded-full shadow mt-4">CONTINUAR</button>
                </div>
            </div>
            {{-- Sección de Datos de Compra --}}
            <div id="seccion-datos-compra" class="hidden">
                <div class="mb-4">
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
                        <label class="flex items-center border rounded p-3 cursor-pointer border-yellow-400 bg-yellow-50">
                            <input type="radio" name="entrega" value="tienda" class="mr-2">
                            <span>
                                S/ 10 &nbsp; RETIRO DE TIENDA
                                <div class="text-xs text-yellow-700 font-semibold">Retiro disponible solo en Lima - Santa
                                    Anita -
                                    Mall Aventuras.
                                </div>
                            </span>
                        </label>
                    </div>
                    <div class="mt-4 text-xs text-gray-700 bg-yellow-50 border-1  p-3 rounded">
                        <ul class="list-disc pl-5">
                            <li>La tarifa de S/10.00 incluye la impresión de todas las entradas de esta compra.</li>
                            <li>La entrada solo podrá ser canjeada si se presenta la siguiente documentación: </li>
                            <li>Originalidad del Documento de identificación oficial del titular, tales como DNI, CE o
                                Pasaporte.</li>
                            <li>Número de pedido o de orden de compra.</li>
                            <li>En caso de retiro por un autorizado, presentar carta poder y copia de documento.</li>
                        </ul>
                    </div>
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
                <button id="continuarconfirmadoBtn"
                    class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-8 rounded-full shadow mt-4">
                    CONTINUAR
                </button>
                {{-- Modal NIBIZ --}}
                <div id="modal-nibiz"
                    class="absolute left-0 top-0 w-full h-full flex items-center justify-center z-50 hidden">
                    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md relative">
                        <button onclick="cerrarModalNibiz()"
                            class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('images/logo-ticketgo.png') }}" alt="TicketGO" class="w-40 mb-4">
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
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-8 rounded-full shadow w-full mt-2">
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
                <div id="modal-yape"
                    class="absolute left-0 top-0 w-full h-full flex items-center justify-center z-50 hidden">
                    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md relative">
                        <button onclick="cerrarModalYape()"
                            class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('images/logo-ticketgo.png') }}" alt="TicketGO" class="w-40 mb-4">
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
            </div>
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
                            <img src="{{ asset('images/logo-ticketgo.png') }}" alt="TicketGO" class="w-40 mb-4">
                            <h2 class="font-bold text-lg mb-2">Boleto de compra</h2>
                            {{-- Detalles del evento --}}
                            <div class="w-full mb-4 border-b pb-2" id="detalles-evento-confirmado"></div>
                            {{-- Detalle de entradas y total --}}
                            <div class="w-full mb-4 border-b pb-2">
                                <h3 class="font-semibold mb-1">Entradas compradas</h3>
                                <ul class="mb-2" id="resumen-lista-confirmado"></ul>
                                <div class="font-bold text-right mt-2">TOTAL: S/. <span
                                        id="total-monto-confirmado">0.00</span></div>
                            </div>
                            {{-- Método de pago y datos del comprador --}}
                            <div class="w-full mb-4 border-b pb-2">
                                <h3 class="font-semibold mb-1">Método de pago</h3>
                                <div id="metodo-pago-confirmado" class="flex items-center gap-2 mb-2"></div>
                                <div id="datos-comprador-confirmado"></div>
                            </div>
                            <a href="#"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-8 rounded-full shadow mt-2 block text-center"
                                target="_blank" id="descargarBoletoBtn">
                                Descargar Boleto
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Columna derecha: Info del evento SIEMPRE visible --}}
        <div class="bg-white rounded-lg shadow p-6 w-full md:w-1/3">
            <img src="{{ asset('storage/' . $evento->imagen) }}" alt="{{ $evento->nombre }}"
                class="w-full rounded mb-4">
            <div class="text-xs text-gray-500 mb-1">{{ strtoupper($evento->categoria) }} / PRESENCIAL</div>
            <h2 class="text-xl font-bold mb-2">{{ strtoupper($evento->nombre) }}</h2>
            <div class="text-sm text-gray-700 mb-2">
                {{ \Carbon\Carbon::parse($evento->fecha)->translatedFormat('l, d \d\e F Y H:i') }}
            </div>
            <div class="text-sm text-gray-700 mb-4">{{ $evento->ubicacion }}</div>
            <div class="text-sm text-gray-600 mb-4">{{ $evento->descripcion }}</div>
        </div>
    </div>

    <script>
        // Agregar tickets al resumen
        document.getElementById('agregarBtn').addEventListener('click', function() {
            const resumenLista = document.getElementById('resumen-lista');
            resumenLista.innerHTML = '';
            let total = 0;

            document.querySelectorAll('.entrada-item').forEach(function(item) {
                const tipo = item.getAttribute('data-tipo');
                const precio = parseFloat(item.getAttribute('data-precio'));
                const cantidadInput = item.querySelector('.cantidad-input');
                const cantidad = parseInt(cantidadInput.value) || 0;

                if (cantidad > 0) {
                    const subtotal = cantidad * precio;
                    total += subtotal;
                    const li = document.createElement('li');
                    li.className = "flex justify-between items-center border-b py-1 text-sm gap-2";
                    li.innerHTML = `<span>${cantidad} TICKET ${tipo}</span><span>S/. ${subtotal.toFixed(2)}</span>
                <button type="button" class="text-red-500 hover:underline eliminar-resumen">Eliminar</button>`;
                    // Guardar referencia al input para poder resetearlo al eliminar
                    li.inputRef = cantidadInput;
                    resumenLista.appendChild(li);
                }
            });

            document.getElementById('total-monto').textContent = total.toFixed(2);

            // Agregar evento a los botones "Eliminar"
            document.querySelectorAll('.eliminar-resumen').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const li = this.closest('li');
                    if (li.inputRef) {
                        li.inputRef.value = 0;
                    }
                    li.remove();
                    // Recalcular el total después de eliminar
                    let nuevoTotal = 0;
                    document.querySelectorAll('#resumen-lista li').forEach(function(item) {
                        const monto = item.querySelector('span:nth-child(2)');
                        if (monto) {
                            nuevoTotal += parseFloat(monto.textContent.replace('S/.', '')
                                .trim());
                        }
                    });
                    document.getElementById('total-monto').textContent = nuevoTotal.toFixed(2);
                });
            });
        });

        // Pasar a datos de compra
        document.getElementById('continuarBtn').addEventListener('click', function() {
            document.getElementById('seccion-tickets').classList.add('hidden');
            document.getElementById('seccion-datos-compra').classList.remove('hidden');
            document.getElementById('resumen-lista-final').innerHTML = document.getElementById('resumen-lista')
                .innerHTML;
            actualizarResumenFinal();

            // Botón eliminar en resumen final
            document.querySelectorAll('#resumen-lista-final .eliminar-resumen').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const li = this.closest('li');
                    li.remove();
                    actualizarResumenFinal();
                });
            });
        });

        // Actualizar total si cambia el tipo de entrega
        document.querySelectorAll('input[name="entrega"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                actualizarResumenFinal();
            });
        });

        // Actualizar resumen final y total
        function actualizarResumenFinal() {
            let total = 0;
            document.querySelectorAll('#resumen-lista-final li').forEach(function(item) {
                const monto = item.querySelector('span:nth-child(2)');
                if (monto) {
                    total += parseFloat(monto.textContent.replace('S/.', '').trim());
                }
            });
            const retiroTienda = document.querySelector('input[name="entrega"]:checked')?.value === 'tienda';
            if (retiroTienda) {
                total += 10;
            }
            document.getElementById('total-monto-final').textContent = total.toFixed(2);
        }

        // Mostrar modal de pago según método
        document.getElementById('continuarconfirmadoBtn').addEventListener('click', function(event) {
            const metodo = document.querySelector('input[name="metodo_pago"]:checked')?.value || 'nibiz';
            if (metodo === 'nibiz') {
                event.preventDefault();
                document.getElementById('modal-nibiz').classList.remove('hidden');
                document.getElementById('monto-nibiz').textContent = document.getElementById('total-monto-final')
                    .textContent;
            } else if (metodo === 'yape') {
                event.preventDefault();
                document.getElementById('modal-yape').classList.remove('hidden');
                document.getElementById('monto-yape').textContent = document.getElementById('total-monto-final')
                    .textContent;
            }
        });

        // Función para procesar la compra en el backend
        function procesarCompra(callback) {
            // Construir objeto de entradas seleccionadas
            let entradas = {};
            document.querySelectorAll('.entrada-item').forEach(function(item) {
                const id = item.getAttribute('data-id');
                const cantidad = parseInt(item.querySelector('.cantidad-input').value) || 0;
                if (cantidad > 0) {
                    entradas[id] = cantidad;
                }
            });

            fetch('/comprar/procesar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        entradas
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        callback();
                    } else {
                        alert(data.message || 'Error al procesar la compra');
                    }
                })
                .catch(() => alert('Error al conectar con el servidor'));
        }

        // Botón pagar NIBIZ
        document.getElementById('pagarNibizBtn').addEventListener('click', function() {
            document.getElementById('modal-nibiz').classList.add('hidden');
            procesarCompra(mostrarConfirmacion);
        });

        // Botón pagar YAPE
        document.getElementById('pagarYapeBtn').addEventListener('click', function() {
            document.getElementById('modal-yape').classList.add('hidden');
            procesarCompra(mostrarConfirmacion);
        });

        // Mostrar sección de confirmación
        function mostrarConfirmacion() {
            document.getElementById('seccion-datos-compra').classList.add('hidden');
            document.getElementById('seccion-confirmado').classList.remove('hidden');
            // Quitar los botones "Eliminar" del resumen antes de mostrarlo en la boleta
            let resumenHtml = document.getElementById('resumen-lista-final').innerHTML;
            resumenHtml = resumenHtml.replace(/<button[^>]*eliminar-resumen[^>]*>.*?<\/button>/gi, '');
            document.getElementById('resumen-lista-confirmado').innerHTML = resumenHtml;
            document.getElementById('total-monto-confirmado').textContent = document.getElementById('total-monto-final')
                .textContent;

            // Mostrar método de pago seleccionado y datos del comprador
            const metodo = document.querySelector('input[name="metodo_pago"]:checked')?.value || 'nibiz';
            let metodoHtml = '';
            let datosCompradorHtml = '';

            if (metodo === 'nibiz') {
                metodoHtml =
                    `<img src="{{ asset('images/nibiz.png') }}" alt="NIBIZ" class="h-6 inline"> <span class="font-semibold">NIBIZ</span>`;
                const nombre = document.getElementById('nibiz-nombre').value;
                const apellido = document.getElementById('nibiz-apellido').value;
                const email = document.getElementById('nibiz-email').value;
                datosCompradorHtml = `
            <div class="mb-2"><span class="font-semibold">Nombre:</span> ${nombre} ${apellido}</div>
            <div class="mb-2"><span class="font-semibold">Email:</span> ${email}</div>
        `;
            } else if (metodo === 'yape') {
                metodoHtml =
                    `<img src="{{ asset('images/yape.png') }}" alt="Yape" class="h-6 inline"> <span class="font-semibold">Yape</span>`;
                const celular = document.getElementById('yape-celular').value;
                datosCompradorHtml = `
            <div class="mb-2"><span class="font-semibold">Celular Yape:</span> ${celular}</div>
        `;
            }
            document.getElementById('metodo-pago-confirmado').innerHTML = metodoHtml;
            document.getElementById('datos-comprador-confirmado').innerHTML = datosCompradorHtml;

            // Mostrar detalles del evento
            document.getElementById('detalles-evento-confirmado').innerHTML = `
            <div class="mb-2"><span class="font-semibold">Nombre de cuenta:</span> {{ Auth::user()->name }}</div>
        <div class="mb-2"><span class="font-semibold">DNI:</span> {{ Auth::user()->dni }}</div>
        <div class="mb-2"><span class="font-semibold">Correo:</span> {{ Auth::user()->email }}</div>
        <div class="mb-2"><span class="font-semibold">Evento:</span> {{ strtoupper($evento->nombre) }}</div>
        <div class="mb-2"><span class="font-semibold">Fecha:</span> {{ \Carbon\Carbon::parse($evento->fecha)->translatedFormat('l, d \d\e F Y H:i') }}</div>
        <div class="mb-2"><span class="font-semibold">Ubicación:</span> {{ $evento->ubicacion }}</div>
    `;
        }

        // Cerrar modal NIBIZ
        function cerrarModalNibiz() {
            document.getElementById('modal-nibiz').classList.add('hidden');
        }

        // Cerrar modal YAPE
        function cerrarModalYape() {
            document.getElementById('modal-yape').classList.add('hidden');
        }

        // Cerrar confirmación (opcional)
        function cerrarModal() {
            document.getElementById('seccion-confirmado').classList.add('hidden');
        }

        document.getElementById('descargarBoletoBtn').addEventListener('click', function(e) {
    e.preventDefault();

    // Prepara los datos para el PDF
    const nombreCuenta = "{{ Auth::user()->name }}";
    const dni = "{{ Auth::user()->dni }}";
    const correo = "{{ Auth::user()->email }}";
    const evento = "{{ strtoupper($evento->nombre) }}";
    const fecha = "{{ \Carbon\Carbon::parse($evento->fecha)->translatedFormat('l, d \d\e F Y H:i') }}";
    const ubicacion = "{{ $evento->ubicacion }}";
    const metodo = document.querySelector('input[name="metodo_pago"]:checked')?.value || 'nibiz';
    let metodoPago = metodo === 'nibiz' ? 'NIBIZ' : 'YAPE';
    let datosPago = '';
    if (metodo === 'nibiz') {
        const nombre = document.getElementById('nibiz-nombre').value;
        const apellido = document.getElementById('nibiz-apellido').value;
        const email = document.getElementById('nibiz-email').value;
        datosPago = `<div><span class="label">Nombre:</span> ${nombre} ${apellido}</div>
                     <div><span class="label">Email:</span> ${email}</div>`;
    } else {
        const celular = document.getElementById('yape-celular').value;
        datosPago = `<div><span class="label">Celular Yape:</span> ${celular}</div>`;
    }

    // Entradas
    let entradas = [];
    document.querySelectorAll('#resumen-lista-confirmado li').forEach(function(item) {
        const texto = item.querySelector('span:first-child').textContent;
        const cantidad = parseInt(texto);
        const tipo = texto.replace(/^\d+\s/, '');
        const subtotal = parseFloat(item.querySelector('span:nth-child(2)').textContent.replace('S/.', '').trim());
        entradas.push({ cantidad, tipo, subtotal });
    });

    const total = parseFloat(document.getElementById('total-monto-confirmado').textContent);

    // Enviar datos al backend y descargar PDF
    fetch('/comprar/boleta', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            nombre_cuenta: nombreCuenta,
            dni: dni,
            correo: correo,
            evento: evento,
            fecha: fecha,
            ubicacion: ubicacion,
            entradas: entradas,
            total: total,
            metodo_pago: metodoPago,
            datos_pago: datosPago
        })
    })
    .then(response => response.blob())
    .then(blob => {
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'boleta_ticketgo.pdf';
        document.body.appendChild(a);
        a.click();
        a.remove();
        window.URL.revokeObjectURL(url);
    });
});
    </script>
@endsection
