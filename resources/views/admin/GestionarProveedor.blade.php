@extends('layouts.ad-plantilla')
@section('contenido')
<!-- Gestión de Proveedores -->
<div class="w-full bg-white p-8 shadow-md mt-8 rounded-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Gestión de Proveedores</h2>
        <a href="{{ route('admin.proveedores.create') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-md font-semibold">
            + Nuevo Proveedor
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border border-black-200 rounded-md">
            <thead class="bg-blue-800">
                <tr>
                    <th class="px-4 py-2 font-semibold text-white">NOMBRE</th>
                    <th class="px-4 py-2 font-semibold text-white">CORREO</th>
                    <th class="px-4 py-2 font-semibold text-white">ESTADO</th>
                    <th class="px-4 py-2 font-semibold text-white">ACCIONES</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @foreach ($proveedores as $proveedor)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $proveedor->nombre }}</td>
                        <td class="px-4 py-2">{{ $proveedor->correo }}</td>
                        <td class="px-4 py-2 font-bold {{ $proveedor->estado == 'ACTIVO' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $proveedor->estado == 'ACTIVO' ? '🟢 ACTIVO' : '🔴 INACTIVO' }}
                        </td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('admin.proveedores.edit', $proveedor->id_proveedor)}}"
                            class="px-4 py-1 text-sm font-semibold text-blue-600 border border-blue-600 
                            rounded hover:bg-blue-600 hover:text-white transition">
                                Editar
                            </a>
                            <form action="{{ route('admin.proveedores.destroy', $proveedor->id_proveedor) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Estás seguro?')"
                                    class="px-4 py-1 text-sm font-semibold text-red-600 border border-red-600 
                                    rounded hover:bg-red-600 hover:text-white transition">
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