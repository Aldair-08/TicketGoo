@extends('layouts.ad-plantilla')

@section('titulo', 'Editar Proveedor')

@section('contenido')
<div class="w-full max-w-2xl mx-auto bg-white p-8 mt-10 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Editar proveedor</h2>

    <form action="{{ route('admin.proveedores.update', $proveedor->id_proveedor) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="flex items-center mb-4">
            <label for="nombre" class="w-32 text-gray-700 font-semibold">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $proveedor->nombre) }}"class="flex-1 border border-yellow-500 px-3 py-2 rounded-md focus:outline-none focus:ring focus:ring-yellow-400"
                placeholder="Ingresa el nombre del encargado">
        </div>

        <div class="flex items-center mb-4">
            <label for="correo" class="w-32 text-gray-700 font-semibold">Correo</label>
            <input type="email" name="correo" id="correo" value="{{ old('correo', $proveedor->correo) }}" class="flex-1 border border-yellow-500 px-3 py-2 rounded-md focus:outline-none focus:ring focus:ring-yellow-400"
                placeholder="Ingresa el correo del proveedor" required>
        </div>

        <div class="flex items-center mb-4">
            <label for="telefono" class="w-32 text-gray-700 font-semibold">Teléfono</label>
            <input type="text" name="telefono" id="telefono"
                value="{{ old('telefono', $proveedor->telefono) }}"
                class="flex-1 border border-yellow-500 px-3 py-2 rounded-md focus:outline-none focus:ring focus:ring-yellow-400"
                placeholder="Ingresa el teléfono del proveedor">
        </div>

        <div class="flex items-center mb-4">
            <label for="empresa" class="w-32 text-gray-700 font-semibold">Empresa</label>
            <input type="text" name="empresa" id="empresa"
                value="{{ old('empresa', $proveedor->empresa) }}"
                class="flex-1 border border-yellow-500 px-3 py-2 rounded-md focus:outline-none focus:ring focus:ring-yellow-400"
                placeholder="Ingresa la empresa del proveedor">
        </div>


        <div class="mb-6">
            <label for="estado" class="block text-gray-700 font-semibold mb-1">Estado</label>
            <select name="estado" id="estado" class="w-full border border-gray-300 px-4 py-2 rounded">
                <option value="ACTIVO" {{ $proveedor->estado == 'ACTIVO' ? 'selected' : '' }}>Activo</option>
                <option value="INACTIVO" {{ $proveedor->estado == 'INACTIVO' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-yellow-500 text-black px-6 py-2 rounded font-semibold hover:bg-yellow-600">Actualizar</button>
            <a href="{{ route('admin.proveedores.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cancelar</a>
        </div>
    </form>
</div>
@endsection
