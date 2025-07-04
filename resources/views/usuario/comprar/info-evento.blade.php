{{-- Columna derecha: Info del evento SIEMPRE visible --}}
<div class="bg-white rounded-lg shadow p-6 w-full md:w-1/3 mx-4">
    <img src="{{ asset('storage/' . $evento->imagen) }}" alt="{{ $evento->nombre }}" class="w-full rounded mb-4">
    <div class="text-xs text-gray-500 mb-1">{{ strtoupper($evento->categoria) }} / PRESENCIAL</div>
    <h2 class="text-xl font-bold mb-2">{{ strtoupper($evento->nombre) }}</h2>
    <div class="text-sm text-gray-700 mb-2">
        {{ \Carbon\Carbon::parse($evento->fecha)->translatedFormat('l, d \d\e F Y H:i') }}
    </div>
    <div class="text-sm text-gray-700 mb-4">{{ $evento->ubicacion }}</div>
    <div class="text-sm text-gray-600 mb-4">{{ $evento->descripcion }}</div>
</div> 