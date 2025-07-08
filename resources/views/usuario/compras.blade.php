@extends('layouts.compraslayout')
@section('compras')

    @if ($compras->count() > 0)
        @foreach ($compras as $compra)
            <section class="bg-[#fff7e3] rounded-2xl shadow-md mb-12 overflow-hidden max-w-[600px] mx-auto">
                <header class="bg-[#eda812] text-center text-lg font-bold text-[#222] px-4 py-2 rounded-t-2xl">
                    COMPRA #{{ $compra->id }}
                </header>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-[#222]" role="table">
                        <tbody>
                            <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                                <td class="px-4 py-2 font-semibold w-[45%]">N° de orden</td>
                                <td class="px-4 py-2">{{ $compra->id }}</td>
                            </tr>
                            <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                                <td class="px-4 py-2 font-semibold">Fecha de Compra</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($compra->created_at)->format('d/m/Y') }}</td>
                            </tr>
                            <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                                <td class="px-4 py-2 font-semibold">Evento</td>
                                <td class="px-4 py-2">
                                    @if ($compra->evento)
                                        {{ $compra->evento->nombre }}
                                    @else
                                        <span class="text-gray-500">Evento no especificado</span>
                                    @endif
                                </td>
                            </tr>
                            <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                                <td class="px-4 py-2 font-semibold">Promoción Aplicada</td>
                                <td class="px-4 py-2">
                                    @if ($compra->promocion)
                                        <span class="text-green-600 font-semibold">{{ $compra->promocion->nombre }}</span>
                                        @if($compra->promocion->descripcion)
                                            <br><span class="text-xs text-gray-600">{{ $compra->promocion->descripcion }}</span>
                                        @endif
                                    @else
                                        <span class="text-gray-500">Sin promoción</span>
                                    @endif
                                </td>
                            </tr>
                            <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                                <td class="px-4 py-2 font-semibold">Tickets</td>
                                <td class="px-4 py-2">
                                    @if($compra->detalles && count($compra->detalles) > 0)
                                        <div class="space-y-2">
                                            @foreach ($compra->detalles as $detalle)
                                                <div class="border-b border-gray-200 pb-1">
                                                    <div class="font-semibold">{{ $detalle->cantidad }}x {{ $detalle->tipo_ticket }}</div>
                                                    @if($detalle->precio_unitario)
                                                        <div class="text-sm text-gray-600">
                                                            Precio: S/. {{ number_format($detalle->precio_unitario, 2) }} c/u
                                                        </div>
                                                    @endif
                                                    @if($detalle->subtotal)
                                                        <div class="text-sm font-medium text-blue-600">
                                                            Subtotal: S/. {{ number_format($detalle->subtotal, 2) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-500">No hay detalles disponibles</span>
                                    @endif
                                </td>
                            </tr>
                            <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                                <td class="px-4 py-2 font-semibold">Medio de Pago</td>
                                <td class="px-4 py-2">Transferencia Bancaria</td>
                            </tr>
                            <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                                <td class="px-4 py-2 font-semibold">Forma de Entrega</td>
                                <td class="px-4 py-2">{{ ucfirst($compra->formato_entrega ?? 'No especificado') }}</td>
                            </tr>
                            <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                                <td class="px-4 py-2 font-semibold">Total</td>
                                <td class="px-4 py-2">S/. {{ number_format($compra->total, 2) }}</td>
                            </tr>
                            <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                                <td class="px-4 py-2 font-semibold">Estado</td>
                                <td class="px-4 py-2">
                                    <span
                                        class="px-2 py-1 rounded text-xs font-bold 
                                @if ($compra->estado == 'pagado') bg-green-100 text-green-800
                                @elseif($compra->estado == 'pendiente') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($compra->estado) }}
                                    </span>
                                </td>
                            </tr>
                            <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                                <td class="px-4 py-2 font-semibold">Documento Electrónico</td>
                                <td class="px-4 py-2">
                                    @if ($compra->estado == 'pagado')
                                        <a href="{{ route('usuario.Voucher', $compra->id) }}"
                                            class="text-blue-600 hover:text-blue-800 underline">
                                            Ver Voucher
                                        </a>
                                    @else
                                        <span class="text-gray-500">No disponible</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        @endforeach
    @else
        <section class="bg-[#fff7e3] rounded-2xl shadow-md mb-12 overflow-hidden max-w-[600px] mx-auto">
            <header class="bg-[#eda812] text-center text-lg font-bold text-[#222] px-4 py-2 rounded-t-2xl">
                MIS COMPRAS
            </header>
            <div class="p-8 text-center">
                <p class="text-gray-600 mb-4">No tienes compras registradas aún.</p>
                <a href="{{ route('usuario.principallog') }}"
                    class="bg-[#eda812] hover:bg-[#d19a0f] text-[#222] font-bold py-2 px-6 rounded-lg transition-colors">
                    Ver Eventos Disponibles
                </a>
            </div>
        </section>
    @endif

@endsection
