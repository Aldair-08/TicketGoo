@extends('layouts.ad-plantilla')

@section('contenido')
<div class="container mx-auto p-6">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Añadir Imagen al Carrusel</h2>

    <div class="bg-white shadow-md rounded-lg p-6 max-w-xl mx-auto">
        <form action="{{ route('admin.carrusel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label for="imagen" class="block text-gray-700 font-semibold mb-2 text-center">Selecciona una imagen</label>
                
                <div class="flex justify-center">
                    <input type="file" name="imagen" id="imagen" required
                        class="w-full max-w-md text-sm text-gray-600 file:mr-4 file:py-2 file:px-4
                               file:rounded file:border-0 file:text-sm file:font-semibold
                               file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100
                               border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                        accept="image/*" />
                </div>

                @error('imagen')
                    <p class="text-red-600 text-sm mt-2 text-center">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center gap-4 mt-6">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-2 rounded shadow transition font-semibold">
                    Guardar
                </button>

                <a href="{{ route('admin.carrusel.index') }}"
                   class="bg-yellow-500 hover:bg-yellow-400 text-black px-6 py-2 rounded shadow transition font-semibold">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
