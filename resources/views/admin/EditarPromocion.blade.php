@extends('layouts.ad-plantilla')

@section('titulo', 'Editar Promoción')

@section('contenido')
<div class="w-full max-w-2xl mx-auto bg-white p-8 mt-10 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Editar Promoción</h2>

    <form action="{{ route('admin.promociones.update', $promocion->id_promocion) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="flex items-center mb-4">
            <label for="nombre" class="block font-semibold text-gray-700">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $promocion->nombre) }}"
                class="w-full border border-yellow-500 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-yellow-400"
                required>
        </div>

        <div class="flex items-center mb-4">
            <label for="tipo" class="block font-semibold text-gray-700">Tipo</label>
            <input type="text" id="tipo" name="tipo" value="{{ old('tipo', $promocion->tipo) }}"
                class="w-full border border-yellow-500 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-yellow-400"
                required>
        </div>

        <div class="flex items-center mb-4">
            <label for="valor" class="block font-semibold text-gray-700">Valor</label>
            <input type="number" step="0.01" id="valor" name="valor" value="{{ old('valor', $promocion->valor) }}"
                class="w-full border border-yellow-500 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-yellow-400"
                required>
        </div>

        <div class="flex items-center mb-4">
            <label for="id_evento" class="block font-semibold text-gray-700">Evento</label>
            <select id="id_evento" name="id_evento"
                class="w-full border border-yellow-500 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-yellow-400"
                required>
                <option value="">Seleccionar</option>
                @foreach ($eventos as $evento)
                    <option value="{{ $evento->id_evento }}"
                        {{ $evento->id_evento == $promocion->id_evento ? 'selected' : '' }}>
                        {{ $evento->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center mb-4">
            <label for="fecha_inicio" class="block font-semibold text-gray-700">Fecha Inicio</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio"
                value="{{ old('fecha_inicio', $promocion->fecha_inicio) }}"
                class="w-full border border-yellow-500 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-yellow-400"
                required>
        </div>

        <div class="flex items-center mb-4">
            <label for="fecha_fin" class="block font-semibold text-gray-700">Fecha Fin</label>
            <input type="date" id="fecha_fin" name="fecha_fin"
                value="{{ old('fecha_fin', $promocion->fecha_fin) }}"
                class="w-full border border-yellow-500 px-3 py-2 rounded focus:outline-none focus:ring focus:ring-yellow-400"
                required>
        </div>

        <div class="mb-6 flex items-center">
            <input type="checkbox" id="estado" name="estado" value="ACTIVO" class="mr-2"
                {{ $promocion->estado === 'ACTIVO' ? 'checked' : '' }}>
            <label for="estado" class="text-gray-700 font-semibold">Activo</label>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.promociones.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</a>
            <button type="submit"
                class="bg-yellow-500 text-black px-6 py-2 rounded font-semibold hover:bg-yellow-600">Actualizar</button>
        </div>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const tipoInput = document.getElementById('tipo');
        const valorInput = document.getElementById('valor');

        function ajustarValidacion() {
            const tipo = tipoInput.value.toLowerCase();

            if (tipo.includes('porcentaje')) {
                valorInput.type = 'number';
                valorInput.min = 0;
                valorInput.max = 100;
                valorInput.placeholder = 'Ingrese un valor entre 0 y 100';
            } else if (tipo.includes('monto')) {
                valorInput.type = 'number';
                valorInput.min = 0;
                valorInput.removeAttribute('max');
                valorInput.placeholder = 'Ingrese el monto del descuento';
            } else {
                valorInput.type = 'text';
                valorInput.placeholder = 'Este tipo no requiere un valor numérico';
                valorInput.removeAttribute('min');
                valorInput.removeAttribute('max');
            }
        }

        tipoInput.addEventListener('input', ajustarValidacion);
        ajustarValidacion(); // Inicial
    });
</script>

</div>
@endsection
