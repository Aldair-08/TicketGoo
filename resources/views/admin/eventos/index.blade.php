@extends('layouts.ad-plantilla')

@section('contenido')
    <div class="w-full bg-white p-8 shadow-md mt-8 rounded-md">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Lista de Eventos</h2>
            <a href="{{ route('admin.eventos.create') }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-md font-semibold">
                + Nuevo Evento
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 text-green-700 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left border border-black-200 rounded-md">
                <thead class="bg-blue-800">
                    <tr>
                        <th class="px-4 py-2 font-semibold text-white">Nombre de Evento</th>
                        <th class="px-4 py-2 font-semibold text-white">Categoría</th>
                        <th class="px-4 py-2 font-semibold text-white">Fecha</th>
                        <th class="px-4 py-2 font-semibold text-white">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @foreach ($eventos as $evento)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $evento->nombre }}</td>
                            <td class="px-4 py-2">{{ $evento->categoria }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($evento->fecha)->format('d-m-Y') }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('admin.eventos.gestionar', $evento->id_evento) }}"
                                    class="px-4 py-1 text-sm font-semibold text-blue-600 border border-blue-600 rounded hover:bg-blue-600 hover:text-white transition">
                                    Gestionar
                                </a>
                                <form action="{{ route('admin.eventos.destroy', $evento->id_evento) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('¿Estás seguro de eliminar este evento?')"
                                        class="px-4 py-1 text-sm font-semibold text-yellow-700 border border-yellow-500 rounded hover:bg-yellow-500 hover:text-white transition">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
