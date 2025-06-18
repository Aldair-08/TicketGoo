@extends('layouts.ad-plantilla')
@section('contenido')
    @php
        // Normaliza la ubicación para comparar @if ($ubicacion == 'costa21, ')
        $ubicacion = strtolower(preg_replace('/\s+/', '', $evento->ubicacion));
    @endphp

    <div class="flex flex-col md:flex-row gap-8 items-start">
        <!-- Formularios de entradas -->
        <div class="flex-1 space-y-8">
            <form action="{{ route('admin.eventos.publicar', $evento->id_evento) }}" method="POST">
                @csrf
                <!-- VIP -->
                <div class="border-2 border-yellow-500 rounded-lg p-6 bg-white shadow-md">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Tipo de Entrada:</label>
                        <div
                            class="w-full border border-gray-300 rounded px-3 py-2 text-lg font-semibold text-center bg-gray-50">
                            VIP</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Precio (S/):</label>
                        <input type="number" name="precio_vip" required
                            class="w-full border border-yellow-500 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-yellow-400 text-lg font-bold text-right">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Ticket Por Persona:</label>
                        <input type="number" name="ticket_vip" required
                            class="w-full border border-gray-300 px-3 py-2 rounded text-lg font-semibold text-right">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">Stock:</label>
                        <input type="number" name="stock_vip" required
                            class="w-full border border-gray-300 px-3 py-2 rounded text-lg font-semibold text-right">
                    </div>
                </div>
                <!-- GENERAL -->
                <div class="border-2 border-yellow-500 rounded-lg p-6 bg-white shadow-md">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Tipo de Entrada:</label>
                        <input type="text" value="GENERAL" readonly
                            class="w-full border border-gray-300 rounded px-3 py-2 text-lg font-semibold text-center bg-gray-50">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Precio (S/):</label>
                        <input type="number" name="precio_general" required
                            class="w-full border border-yellow-500 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-yellow-400 text-lg font-bold text-right">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Ticket Por Persona:</label>
                        <input type="number" name="ticket_general" required
                            class="w-full border border-gray-300 px-3 py-2 rounded text-lg font-semibold text-right">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">Stock:</label>
                        <input type="number" name="stock_general" required
                            class="w-full border border-gray-300 px-3 py-2 rounded text-lg font-semibold text-right">
                    </div>
                </div>
                <!-- PREFERENCIAL -->
                <div class="border-2 border-yellow-500 rounded-lg p-6 bg-white shadow-md">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Tipo de Entrada:</label>
                        <input type="text" value="PREFERENCIAL" readonly
                            class="w-full border border-gray-300 rounded px-3 py-2 text-lg font-semibold text-center bg-gray-50">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Precio (S/):</label>
                        <input type="number" name="precio_preferencial" required
                            class="w-full border border-yellow-500 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-yellow-400 text-lg font-bold text-right">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Ticket Por Persona:</label>
                        <input type="number" name="ticket_preferencial" required
                            class="w-full border border-gray-300 px-3 py-2 rounded text-lg font-semibold text-right">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1">Stock:</label>
                        <input type="number" name="stock_preferencial" required
                            class="w-full border border-gray-300 px-3 py-2 rounded text-lg font-semibold text-right">
                    </div>
                </div>
                <!-- Botones -->
                <div class="flex gap-8 mt-6">
                    <button type="submit"
                        class="bg-blue-800 hover:bg-blue-900 text-white px-12 py-3 rounded-lg font-bold text-lg shadow">Publicar</button>
                    <a href="{{ route('admin.eventos.index') }}"
                        class="bg-yellow-400 hover:bg-yellow-500 text-black px-12 py-3 rounded-lg font-bold text-lg shadow text-center">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
        <!-- Esquema y tarjeta evento -->
        <div class="flex-1 flex flex-col items-center gap-8">
            @if ($ubicacion == 'costa21')
                <img src="{{ asset('images/costa21.png') }}" alt="Esquema Costa 21"
                    class="w-full max-w-xs rounded shadow mb-8">
            @elseif ($ubicacion == 'estadionacional')
                <img src="{{ asset('images/estadionacional.png') }}" alt="Esquema Estadio Nacional"
                    class="w-full max-w-xs rounded shadow mb-8">
            @elseif ($ubicacion == 'teatrocanout')
                <img src="{{ asset('images/teatro.png') }}" alt="Esquema Teatro Central"
                    class="w-full max-w-xs rounded shadow mb-8">
            @elseif ($ubicacion == 'anfiteatrop.exposición')
                <img src="{{ asset('images/parqueexpo.png') }}" alt="Esquema Parque de la Exposición"
                    class="w-full max-w-xs rounded shadow mb-8">
            @else
                <img src="{{ asset('images/default-esquema.png') }}" alt="Esquema del Evento"
                    class="w-full max-w-xs rounded shadow mb-8">
            @endif
            <!-- Tarjeta del evento (dinámica) -->
            <div class="bg-white rounded-lg shadow-lg p-4 w-full max-w-xs">
                {{-- Imagen del evento (usa la imagen guardada o una por defecto) --}}
                <img src="{{ $evento->imagen ? asset('storage/' . $evento->imagen) : asset('images/default-event.jpg') }}"
                    alt="{{ $evento->nombre }}" class="w-full h-40 object-cover rounded mb-3">
                <div class="text-xs text-gray-600 mb-1">
                    {{ strtoupper($evento->categoria ?? 'EVENTO') }} /
                    <span class="text-blue-700 font-bold">PRESENCIAL</span>
                </div>
                <div class="font-bold text-lg mb-1">{{ $evento->nombre }}</div>
                <div class="text-gray-500 text-xs mb-2">
                    {{ \Carbon\Carbon::parse($evento->fecha)->translatedFormat('l, d \d\e F H:i \h\r\s.') }}
                </div>
                <div class="text-gray-700 text-sm mb-2">
                    {{ $evento->descripcion ?? 'Sin descripción.' }}
                </div>
            </div>
        </div>
    </div>
@endsection
