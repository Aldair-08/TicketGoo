@extends('layouts.compraslayout')

@section('compras')
<div class="max-w-4xl mx-auto p-6 print:flex print:items-center print:justify-center print:min-h-screen print:p-0">
    <!-- Voucher Compacto tipo Ticket -->
    <div class="bg-white border-2 border-gray-300 rounded-lg shadow-lg print:shadow-none print:border-0 print:max-w-none print:mx-0 print:w-auto print:max-w-none">
        <!-- Header del Voucher -->
        <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 p-3 text-center text-white print:bg-yellow-400 print:p-2">
            <div class="flex items-center justify-center mb-1">
                <img src="{{ asset('images/logo.png') }}" alt="TicketGO" class="h-6 mr-2 print:h-4">
                <h1 class="text-xl font-bold print:text-lg">VOUCHER DE COMPRA</h1>
            </div>
            <p class="text-xs print:text-xs">¡Gracias por tu compra!</p>
        </div>

        <!-- Contenido Compacto -->
        <div class="p-3 print:p-2">
            <!-- Información Principal en Grid -->
            <div class="grid grid-cols-2 gap-2 mb-3 print:gap-1">
                <div class="text-xs">
                    <div class="font-semibold text-gray-600">N° Orden:</div>
                    <div class="text-gray-800 font-bold">#{{ $compra->id }}</div>
                </div>
                <div class="text-xs">
                    <div class="font-semibold text-gray-600">Fecha y Hora:</div>
                    <div class="text-gray-800">{{ $compra->fecha_compra_formateada }}</div>
                </div>
                <div class="text-xs">
                    <div class="font-semibold text-gray-600">Estado:</div>
                    <div class="px-1 py-0.5 bg-green-100 text-green-800 rounded text-xs font-bold inline-block">PAGADO</div>
                </div>
                <div class="text-xs">
                    <div class="font-semibold text-gray-600">Entrega:</div>
                    <div class="text-gray-800">{{ ucfirst($compra->formato_entrega) }}</div>
                </div>
            </div>

            <!-- Información del Evento -->
            @if($compra->evento)
            <div class="border-t border-gray-200 pt-2 mb-3 print:pt-1">
                <h3 class="font-bold text-gray-800 mb-1 print:text-xs">EVENTO</h3>
                <div class="text-xs space-y-0.5">
                    <div><span class="font-semibold">Nombre:</span> {{ $compra->evento->nombre }}</div>
                    <div><span class="font-semibold">Fecha:</span> {{ $compra->evento->fecha_evento_formateada }}</div>
                    <div><span class="font-semibold">Ubicación:</span> {{ $compra->evento->ubicacion }}</div>
                </div>
            </div>
            @endif

            <!-- Tickets Compactos -->
            <div class="border-t border-gray-200 pt-2 mb-3 print:pt-1">
                <h3 class="font-bold text-gray-800 mb-1 print:text-xs">TICKETS</h3>
                <div class="space-y-0.5">
                    @foreach($compra->detalles as $detalle)
                    <div class="flex justify-between text-xs">
                        <span>{{ $detalle->cantidad }}x {{ strtoupper($detalle->tipo_ticket) }}</span>
                        <span>S/. {{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="border-t border-gray-300 mt-1 pt-1">
                    <div class="flex justify-between font-bold text-sm">
                        <span>TOTAL:</span>
                        <span>S/. {{ number_format($compra->total, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Comprador Compacto -->
            <div class="border-t border-gray-200 pt-2 mb-3 print:pt-1">
                <h3 class="font-bold text-gray-800 mb-1 print:text-xs">COMPRADOR</h3>
                <div class="grid grid-cols-2 gap-2 text-xs">
                    <div><span class="font-semibold">Nombre:</span> {{ $compra->usuario->name }}</div>
                    <div><span class="font-semibold">DNI:</span> {{ $compra->usuario->dni }}</div>
                    <div><span class="font-semibold">Email:</span> {{ $compra->usuario->email }}</div>
                    <div><span class="font-semibold">Celular:</span> {{ $compra->usuario->phone ?: 'No disponible' }}</div>
                </div>
            </div>

            <!-- Instrucciones Muy Compactas -->
            <div class="border-t border-gray-200 pt-2 mb-3 print:pt-1">
                <h3 class="font-bold text-gray-800 mb-1 print:text-xs">INSTRUCCIONES</h3>
                <ul class="text-xs text-gray-600 space-y-0.5">
                    <li>• Presenta este voucher al ingresar al evento</li>
                    <li>• Llega con anticipación</li>
                    <li>• Válido solo para la fecha indicada</li>
                </ul>
            </div>

            <!-- Código de Validación -->
            <div class="border-t border-gray-200 pt-2 text-center print:pt-1">
                <div class="inline-block border border-gray-300 p-1 rounded">
                    <div class="text-xs text-gray-500">CÓDIGO</div>
                    <div class="font-mono text-xs font-bold">{{ strtoupper(substr(md5($compra->id), 0, 8)) }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botones de Acción (solo en pantalla) -->
    <div class="bg-white p-4 shadow-lg mt-4 text-center print:hidden">
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button onclick="window.print()" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                🖨️ Imprimir Voucher
            </button>
            <a href="{{ route('usuario.compras') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                📋 Volver a Mis Compras
            </a>
        </div>
    </div>
</div>

<style>
@media print {
    @page {
        size: auto;
        margin: 0.5cm;
    }
    
    body {
        background: white !important;
        font-size: 10px !important;
        line-height: 1.1 !important;
        margin: 0 !important;
        padding: 0 !important;
        width: auto !important;
        height: auto !important;
    }
    
    html {
        width: auto !important;
        height: auto !important;
    }
    
    /* Ocultar footer y otros elementos del layout */
    footer {
        display: none !important;
    }
    
    header {
        display: none !important;
    }
    
    /* Ocultar elementos del layout de compras */
    .container {
        padding: 0 !important;
        margin: 0 !important;
    }
    
    main {
        padding: 0 !important;
        margin: 0 !important;
    }
    
    /* Ocultar información del usuario en el layout */
    .mt-6.px-6 {
        display: none !important;
    }
    
    .print\\:hidden {
        display: none !important;
    }
    
    .shadow-lg {
        box-shadow: none !important;
    }
    
    .border-2 {
        border-width: 1px !important;
    }
    
    .p-3 {
        padding: 0.3rem !important;
    }
    
    .p-6 {
        padding: 0 !important;
    }
    
    .mb-3 {
        margin-bottom: 0.3rem !important;
    }
    
    .pt-2 {
        padding-top: 0.3rem !important;
    }
    
    .text-xl {
        font-size: 1rem !important;
    }
    
    .text-lg {
        font-size: 0.9rem !important;
    }
    
    .text-sm {
        font-size: 0.8rem !important;
    }
    
    .text-xs {
        font-size: 0.7rem !important;
    }
    
    /* Centrar el voucher en la página */
    .print\\:flex {
        display: flex !important;
        width: 100% !important;
        min-height: 100vh !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .print\\:items-center {
        align-items: center !important;
    }
    
    .print\\:justify-center {
        justify-content: center !important;
    }
    
    .print\\:min-h-screen {
        min-height: auto !important;
        height: auto !important;
    }
    
    .print\\:max-w-md {
        max-width: none !important;
        width: auto !important;
    }
    
    /* Asegurar que el voucher se adapte al contenido */
    .print\\:w-auto {
        width: auto !important;
        min-width: 200px !important;
        max-width: 80% !important;
    }
    
    .print\\:max-w-none {
        max-width: none !important;
    }
    
    /* Hacer que el contenido se adapte mejor */
    .grid {
        display: grid !important;
    }
    
    .grid-cols-2 {
        grid-template-columns: 1fr 1fr !important;
    }
    
    /* Asegurar que el texto se ajuste */
    .text-xs {
        font-size: 0.7rem !important;
        line-height: 1.2 !important;
        word-wrap: break-word !important;
    }
    
    /* Hacer que las celdas de la tabla se adapten */
    td {
        word-wrap: break-word !important;
        overflow-wrap: break-word !important;
    }
    
    /* Reducir espaciado general */
    .space-y-0\\.5 > * + * {
        margin-top: 0.1rem !important;
    }
    
    .gap-2 {
        gap: 0.3rem !important;
    }
    
    /* Hacer el voucher más compacto */
    .rounded-lg {
        border-radius: 0.2rem !important;
    }
    
    /* Asegurar que las imágenes se impriman */
    img {
        print-color-adjust: exact !important;
        -webkit-print-color-adjust: exact !important;
    }
    
    /* Ocultar cualquier elemento que no sea el voucher */
    *:not(.print\\:flex):not(.print\\:flex *) {
        display: none !important;
    }
    
    .print\\:flex,
    .print\\:flex * {
        display: revert !important;
    }
    
    /* Hacer que el contenedor principal se ajuste al contenido */
    .print\\:flex {
        display: flex !important;
        width: auto !important;
        height: auto !important;
        min-height: auto !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 !important;
        padding: 0.5cm !important;
    }
    
    /* Asegurar que el voucher no tenga altura fija */
    .bg-white {
        height: auto !important;
        min-height: auto !important;
    }
}
</style>
@endsection 