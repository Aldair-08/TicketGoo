@extends('layouts.ad-plantilla')

@section('contenido')
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Gestionar Carrusel</h2>

        <a href="{{ route('admin.carrusel.create') }}"
            class="inline-block mb-6 bg-yellow-500 text-black px-4 py-2 rounded hover:bg-yellow-600 transition font-semibold shadow">
            + Añadir Imagen
        </a>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 border border-green-300 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($imagenes->count())
            <div class="overflow-x-auto shadow rounded-lg">
                <table class="w-full border-collapse bg-white">
                    <thead>
                        <tr class="bg-blue-100 text-blue-900 text-left">
                            <th class="px-6 py-3 border-b border-blue-300">Imagen</th>
                            <th class="px-6 py-3 border-b border-blue-300 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($imagenes as $imagen)
                            <tr class="hover:bg-gray-200 transition">
                                <td class="px-6 py-4 border-b border-gray-400">
                                    <img src="{{ asset('storage/' . $imagen->ruta) }}" alt="Imagen Carrusel"
                                        class="h-24 w-auto object-cover rounded shadow" />
                                </td>
                                <td class="px-6 py-4 border-b border-gray-400 text-center">
                                    <div class="flex justify-center gap-3">
                                        <a href="{{ route('admin.carrusel.edit', $imagen->id) }}"
                                            class="btn bg-blue-600 hover:bg-blue-500 text-white px-4 py-1 rounded shadow">Editar
                                        </a>

                                        <label for="modal-{{ $imagen->id }}"
                                            class="btn bg-yellow-500 hover:bg-yellow-400 text-black px-4 py-1 rounded shadow cursor-pointer">Quitar</label>
                                        <input type="checkbox" id="modal-{{ $imagen->id }}" class="hidden peer" />

                                        <!-- Modal centrado -->
                                        <div
                                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 peer-checked:flex hidden">
                                            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
                                                <h2 class="text-lg font-semibold mb-4">¿Seguro que quieres eliminar esta
                                                    imagen?</h2>
                                                <div class="flex justify-center gap-4">
                                                    <label for="modal-{{ $imagen->id }}"
                                                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded cursor-pointer">Cancelar</label>
                                                    <form action="{{ route('admin.carrusel.destroy', $imagen->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="bg-red-600 hover:bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-600 mt-4">No hay imágenes en el carrusel.</p>
        @endif

        <h3 class="text-2xl font-semibold mt-10 mb-4 text-gray-700">Imágenes de eventos disponibles</h3>
        @if ($eventos->count())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($eventos as $evento)
                    <div class="bg-white rounded shadow p-4 flex flex-col items-center">
                        <img src="{{ asset('storage/' . $evento->imagen) }}" alt="Imagen Evento"
                            class="h-32 w-auto object-cover rounded mb-2" />
                        <div class="font-semibold text-gray-800 mb-2">{{ $evento->nombre }}</div>
                        <form action="{{ route('admin.carrusel.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="ruta" value="{{ $evento->imagen }}">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-1 rounded shadow mb-2">Añadir al
                                carrusel</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No hay imágenes de eventos disponibles.</p>
        @endif
    </div>
@endsection
