@extends('layouts.eticketslayout')

<style>
    /* Animaciones para los botones */
    .btn-enviar {
        transition: all 0.3s ease;
    }
    
    .btn-enviar:disabled {
        transform: scale(0.98);
    }
    
    .spinner {
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
    
    /* Efecto de pulso para el botón durante el envío */
    .btn-enviar.enviando {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.8;
        }
    }
    
    /* Estilos para los badges de tickets */
    .ticket-badge {
        transition: all 0.2s ease;
    }
    
    .ticket-badge:hover {
        transform: scale(1.05);
    }
    
    /* Estilos para la tabla */
    .etickets-table {
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .etickets-table th {
        position: sticky;
        top: 0;
        background: white;
        z-index: 10;
    }
</style>

@section('etickets')

    <section class="bg-[#fff7e3] rounded-2xl shadow-md mb-12 overflow-hidden" role="region">
        <header class="bg-[#eda812] text-center text-lg font-bold text-[#222] px-4 py-2 rounded-t-2xl">
            ETICKETS
        </header>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-[#222] etickets-table" role="table">
                <thead>
                    <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                        <th scope="col" class="px-4 py-3">N° de Orden</th>
                        <th scope="col" class="px-4 py-3">Evento</th>
                        <th scope="col" class="px-4 py-3">Fecha</th>
                        <th scope="col" class="px-4 py-3">Recinto</th>
                        <th scope="col" class="px-4 py-3">Tickets</th>
                        <th scope="col" class="px-4 py-3 text-center">Total</th>
                        <th scope="col" class="px-4 py-3 text-center">Enviar</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($compras->count() > 0)
                        @foreach ($compras as $compra)
                            <tr class="bg-white text-sm font-semibold text-[#222] border-b border-gray-300">
                                <td class="px-4 py-3">TG-{{ $compra->id }}</td>
                                <td class="px-4 py-3">{{ $compra->evento->nombre ?? 'Evento no disponible' }}</td>
                                <td class="px-4 py-3">
                                    @if ($compra->evento && $compra->evento->fecha)
                                        {{ \Carbon\Carbon::parse($compra->evento->fecha)->format('d/m/Y H:i') }}
                                    @else
                                        Por definir
                                    @endif
                                </td>
                                <td class="px-4 py-3">{{ $compra->evento->ubicacion ?? 'Por definir' }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $tickets = [];
                                        $totalTickets = 0;
                                        foreach ($compra->detalles as $detalle) {
                                            $tipo = strtoupper($detalle->tipo_ticket);
                                            $cantidad = $detalle->cantidad;
                                            $totalTickets += $cantidad;
                                            if (isset($tickets[$tipo])) {
                                                $tickets[$tipo] += $cantidad;
                                            } else {
                                                $tickets[$tipo] = $cantidad;
                                            }
                                        }
                                    @endphp
                                    <div class="space-y-1">
                                        @if (count($tickets) === 1)
                                            {{-- Si solo hay un tipo de ticket, mostrar de forma simple --}}
                                            @foreach ($tickets as $tipo => $cantidad)
                                                <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-medium ticket-badge">
                                                    {{ $cantidad }}x {{ $tipo }}
                                                </span>
                                            @endforeach
                                        @else
                                            {{-- Si hay múltiples tipos, mostrar con badges --}}
                                            @foreach ($tickets as $tipo => $cantidad)
                                                <div class="flex items-center justify-between text-xs">
                                                    <span class="font-medium">{{ $tipo }}:</span>
                                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded ticket-badge">{{ $cantidad }}</span>
                                                </div>
                                            @endforeach
                                            <div class="border-t border-gray-200 pt-1 mt-1">
                                                <span class="text-xs font-bold text-gray-600">Total: {{ $totalTickets }} tickets</span>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="font-bold text-green-600">S/. {{ number_format($compra->total, 2) }}</span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <button onclick="enviarVoucher({{ $compra->id }})"
                                        class="bg-[#334e86] hover:bg-[#283b66] text-white px-4 py-2 rounded-full font-semibold text-sm transition-colors duration-300 flex items-center justify-center min-w-[120px] btn-enviar"
                                        id="btn-enviar-{{ $compra->id }}">
                                        <span id="btn-text-{{ $compra->id }}">Enviar al correo</span>
                                        <div id="spinner-{{ $compra->id }}" class="hidden ml-2">
                                            <svg class="spinner h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                        </div>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="bg-white text-sm font-semibold text-[#222] border-b border-gray-300">
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <p class="text-lg font-medium">No tienes etickets disponibles</p>
                                    <p class="text-sm">Realiza una compra para ver tus etickets aquí</p>
                                    <a href="{{ route('usuario.principallog') }}"
                                        class="bg-[#eda812] hover:bg-[#d19a0f] text-[#222] font-bold py-2 px-6 rounded-lg transition-colors">
                                        Ver Eventos Disponibles
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </section>

    <script>
        function enviarVoucher(compraId) {
            const btnEnviar = document.getElementById(`btn-enviar-${compraId}`);
            const btnText = document.getElementById(`btn-text-${compraId}`);
            const spinner = document.getElementById(`spinner-${compraId}`);

            // Deshabilitar botón y mostrar spinner
            btnEnviar.disabled = true;
            btnEnviar.classList.add('opacity-75', 'cursor-not-allowed', 'enviando');
            btnText.textContent = 'Enviando...';
            spinner.classList.remove('hidden');

            // Realizar la petición AJAX
            fetch(`/enviar-voucher/${compraId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Ocultar spinner
                    spinner.classList.add('hidden');

                    if (data.success) {
                        // Mostrar mensaje de éxito
                        btnText.textContent = 'Enviado ✓';
                        btnEnviar.classList.remove('bg-[#334e86]', 'hover:bg-[#283b66]', 'opacity-75', 'cursor-not-allowed', 'enviando');
                        btnEnviar.classList.add('bg-green-600', 'cursor-default');

                        // Mostrar notificación
                        mostrarNotificacion('Voucher enviado exitosamente a tu correo', 'success');
                    } else {
                        // Restaurar botón en caso de error
                        btnEnviar.disabled = false;
                        btnEnviar.classList.remove('opacity-75', 'cursor-not-allowed', 'enviando');
                        btnText.textContent = 'Enviar al correo';
                        mostrarNotificacion(data.message || 'Error al enviar el voucher', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Restaurar botón en caso de error
                    spinner.classList.add('hidden');
                    btnEnviar.disabled = false;
                    btnEnviar.classList.remove('opacity-75', 'cursor-not-allowed', 'enviando');
                    btnText.textContent = 'Enviar al correo';
                    mostrarNotificacion('Error al enviar el voucher. Intenta nuevamente.', 'error');
                });
        }

        function mostrarNotificacion(mensaje, tipo) {
            // Crear elemento de notificación
            const notificacion = document.createElement('div');
            notificacion.className =
                `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm transform transition-all duration-300 translate-x-full`;

            if (tipo === 'success') {
                notificacion.classList.add('bg-green-500', 'text-white');
            } else {
                notificacion.classList.add('bg-red-500', 'text-white');
            }

            notificacion.innerHTML = `
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                ${tipo === 'success' 
                    ? '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>'
                    : '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>'
                }
            </svg>
            <span>${mensaje}</span>
        </div>
    `;

            document.body.appendChild(notificacion);

            // Animar entrada
            setTimeout(() => {
                notificacion.classList.remove('translate-x-full');
            }, 100);

            // Remover después de 5 segundos
            setTimeout(() => {
                notificacion.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(notificacion);
                }, 300);
            }, 5000);
        }
    </script>

@endsection
