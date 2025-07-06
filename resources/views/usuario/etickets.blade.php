@extends('layouts.eticketslayout')
@section('etickets')

    <section class="bg-[#fff7e3] rounded-2xl shadow-md mb-12 overflow-hidden" role="region">
        <header class="bg-[#eda812] text-center text-lg font-bold text-[#222] px-4 py-2 rounded-t-2xl">
            ETICKETS
        </header>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-[#222]" role="table">
                <thead>
                    <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                        <th scope="col" class="px-4 py-3">N° de Orden</th>
                        <th scope="col" class="px-4 py-3">Evento</th>
                        <th scope="col" class="px-4 py-3">Fecha</th>
                        <th scope="col" class="px-4 py-3">Recinto</th>
                        <th scope="col" class="px-4 py-3">Tipo de Ticket</th>
                        <th scope="col" class="px-4 py-3 text-center">Enviar</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($compras->count() > 0)
                        @foreach ($compras as $compra)
                            @foreach ($compra->detalles as $detalle)
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
                                    <td class="px-4 py-3">{{ $detalle->cantidad }}x {{ strtoupper($detalle->tipo_ticket) }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <button onclick="enviarVoucher({{ $compra->id }})"
                                            class="bg-[#334e86] hover:bg-[#283b66] text-white px-4 py-2 rounded-full font-semibold text-sm transition-colors duration-300"
                                            id="btn-enviar-{{ $compra->id }}">
                                            Enviar al correo
                                        </button>
                                        <div id="loading-{{ $compra->id }}" class="hidden">
                                            <div class="inline-flex items-center px-4 py-2 text-sm">
                                                <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                        stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                    </path>
                                                </svg>
                                                Enviando...
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @else
                        <tr class="bg-white text-sm font-semibold text-[#222] border-b border-gray-300">
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500">
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
            const loading = document.getElementById(`loading-${compraId}`);

            // Mostrar loading
            btnEnviar.classList.add('hidden');
            loading.classList.remove('hidden');

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
                    // Ocultar loading
                    loading.classList.add('hidden');

                    if (data.success) {
                        // Mostrar mensaje de éxito
                        btnEnviar.textContent = 'Enviado ✓';
                        btnEnviar.classList.remove('bg-[#334e86]', 'hover:bg-[#283b66]');
                        btnEnviar.classList.add('bg-green-600', 'cursor-default');

                        // Mostrar notificación
                        mostrarNotificacion('Voucher enviado exitosamente a tu correo', 'success');
                    } else {
                        // Mostrar mensaje de error
                        btnEnviar.classList.remove('hidden');
                        mostrarNotificacion(data.message || 'Error al enviar el voucher', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    loading.classList.add('hidden');
                    btnEnviar.classList.remove('hidden');
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
