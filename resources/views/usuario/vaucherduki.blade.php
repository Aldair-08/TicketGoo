@extends('layouts.vaucher')

@section('añavaucher')
<main class="max-w-5xl mx-auto p-8 pt-20">
    <section class="bg-white rounded-xl shadow-lg p-10 max-w-3xl mx-auto">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-6">
            ¡Compra Confirmada!
        </h1>
        <p class="text-lg mb-8 text-gray-600 leading-relaxed">
            Gracias por tu compra. A continuación, encontrarás el voucher con los detalles de tu adquisición.
        </p>

        <div class="border border-gray-200 rounded-lg p-6 bg-gray-50">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Voucher de Compra</h2>

            <dl class="grid grid-cols-1 gap-6 text-sm text-gray-700">
                <div>
                    <dt class="font-semibold">Evento</dt>
                    <dd>DUKI - AMERI WORLD TOUR 2025</dd>
                </div>
                <div>
                    <dt class="font-semibold">Fecha y Hora</dt>
                    <dd>{{ $compra->fecha ? $compra->fecha->format('d/m/Y H:i') : $compra->created_at->format('d/m/Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="font-semibold">Entradas</dt>
                    @foreach ($compra->detalles as $detalle)
                        <dd>
                            {{ $detalle->cantidad }} Ticket {{ strtoupper($detalle->tipo_ticket) }} - 
                            S/ {{ number_format($detalle->precio_unitario, 2) }} 
                            (Subtotal: S/ {{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }})
                        </dd>
                    @endforeach
                </div>
                <div>
                    <dt class="font-semibold">Total Pagado</dt>
                    <dd class="text-lg font-bold">S/ {{ number_format($compra->total, 2) }}</dd>
                </div>
                <div>
                    <dt class="font-semibold">Número de Orden</dt>
                    <dd>TG-{{ $compra->id }}</dd>
                </div>
                <div>
                    <dt class="font-semibold">Método de Pago</dt>
                    <dd>Tarjeta de crédito</dd> {{-- Puedes hacerlo dinámico si lo guardas --}}
                </div>
                <div>
                    <dt class="font-semibold">Comprador</dt>
                    <dd>{{ $compra->usuario->name ?? 'Usuario' }}</dd>
                </div>
            </dl>

            <div class="mt-10 flex justify-center">
                <button onclick="window.print();" class="bg-black text-white uppercase font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-gray-900 transition">
                    Imprimir Voucher
                </button>
            </div>
        </div>
    </section>
</main>
@endsection
