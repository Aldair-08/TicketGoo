@extends('layouts.autenticado')

@section('contenido')
    <div class="min-h-screen flex flex-col items-center justify-center bg-black">
        <div class="w-full max-w-2xl mx-auto relative">
            <img src="{{ asset('storage/' . $evento->imagen) }}" alt="{{ $evento->nombre }}"
                class="w-full h-96 object-cover rounded-lg shadow-lg mb-4">
            <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-black/80 to-transparent rounded-lg"></div>
            <div class="absolute top-10 left-0 w-full text-center px-4">
                <h1 class="text-5xl font-extrabold text-white drop-shadow-lg">{{ strtoupper($evento->nombre) }}</h1>
                <h3 class="text-xl text-white mt-2">{{ $evento->categoria }}</h3>
                <h4 class="text-lg text-yellow-300 mt-2">
                    {{ \Carbon\Carbon::parse($evento->fecha)->translatedFormat('l, d \d\e F Y H:i') }}</h4>
                <h5 class="text-white mt-2">{{ $evento->ubicacion }}</h5>
            </div>
        </div>
        <div class="w-full max-w-2xl bg-white bg-opacity-90 rounded-lg shadow-lg mt-8 p-6">
            <h2 class="text-2xl font-bold text-center mb-4">Sectores y Precios</h2>
            <table class="w-full text-center mb-4">
                <thead>
                    <tr>
                        <th class="py-2">Sector</th>
                        <th class="py-2">Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evento->entradas as $entrada)
                        <tr>
                            <td class="py-2 font-semibold">{{ strtoupper($entrada->tipo) }}</td>
                            <td class="py-2 text-yellow-600 font-bold">S/. {{ number_format($entrada->precio, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex justify-center">
                <a href="#"
                    class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-8 rounded-full shadow">Comprar</a>
            </div>
        </div>
    </div>
@endsection
