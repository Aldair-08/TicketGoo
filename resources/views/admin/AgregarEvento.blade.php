@extends('layouts.ad-plantilla')

@section('titulo', 'Registrar Evento')

@section('contenido')
    <div class="w-full max-w-7x1 mx-auto bg-white p-10 mt-10 rounded shadow border">
        <h2 class="text-2xl font-bold mb-8 text-gray-800 text-center">Registrar Evento</h2>

        <div class="flex justify-end mb-6">
            <a href="{{ route('admin.eventos.index') }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-black px-6 py-2 rounded font-semibold shadow transition">
                Lista de Eventos
            </a>
        </div>

        <form action="{{ route('admin.eventos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Nombre del evento -->
                <div>
                    <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-1">Nombre del evento</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Escribir aquí..." required
                        class="w-full border border-yellow-500 rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-yellow-500" />
                </div>
                <!-- Categoría -->
                <div>
                    <label for="categoria" class="block text-sm font-semibold text-gray-700 mb-1">Categoría</label>
                    <select id="categoria" name="categoria" required
                        class="w-full border border-yellow-500 rounded px-3 py-2 bg-white focus:outline-none focus:ring-1 focus:ring-yellow-500">
                        <option value="" disabled selected>seleccionar</option>
                        <option value="Concierto">Concierto</option>
                        <option value="Teatro">Teatro</option>
                        <option value="Exhibiciones de Arte">Exhibiciones de Arte</option>
                    </select>
                </div>
            </div>
            <!-- Descripción -->
            <div class="mb-6">
                <label for="descripcion" class="block text-sm font-semibold text-gray-700 mb-1">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="3" placeholder="Escribir aquí..." required
                    class="w-full border border-yellow-500 rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-yellow-500"></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Fecha y hora -->
                <div>
                    <label for="fecha" class="block text-sm font-semibold text-gray-700 mb-1">Fecha y hora</label>
                    <input type="datetime-local" id="fecha" name="fecha" required
                        class="w-full border border-yellow-500 rounded px-3 py-2 focus:outline-none focus:ring-1 focus:ring-yellow-500" />
                </div>
                <!-- Ubicación -->
                <div>
                    <label for="ubicacion" class="block text-sm font-semibold text-gray-700 mb-1">Ubicación</label>
                    <select id="ubicacion" name="ubicacion" required
                        class="w-full border border-yellow-500 rounded px-3 py-2 bg-white focus:outline-none focus:ring-1 focus:ring-yellow-500">
                        <option value="" disabled selected>seleccionar</option>
                        <option value="Anfiteatro P. Exposición">Anfiteatro P. Exposición</option>
                        <option value="Costa21">Costa21</option>
                        <option value="Estadio Nacional">Estadio Nacional</option>
                        <option value="Teatro Canout">Teatro Canout</option>
                    </select>
                </div>
            </div>
            <!-- Adjuntar imágenes -->
            <div class="mb-8">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Adjuntar imágenes</label>
                <div
                    class="border-2 border-yellow-400 border-dashed rounded-lg p-8 flex flex-col items-center justify-center bg-yellow-50">
                    <svg class="w-12 h-12 text-yellow-400 mb-2" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 16v-8m0 0l-4 4m4-4l4 4M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2"></path>
                    </svg>
                    <p class="text-gray-500 text-sm mb-2">Abrir o pegue su archivo: PNG, JPG, GIF</p>
                    <input type="file" name="imagen" accept=".png,.jpg,.jpeg,.gif" class="mt-2" />
                </div>
            </div>
            <!-- Botones -->
            <div class="flex justify-center gap-8">
                <button type="submit"
                    class="bg-blue-600 text-white px-8 py-2 rounded font-semibold hover:bg-blue-700 transition">Guardar</button>
                <button type="reset"
                    class="bg-yellow-500 text-black px-8 py-2 rounded font-semibold hover:bg-yellow-600 transition">Limpiar</button>
            </div>
        </form>
    </div>
@endsection
