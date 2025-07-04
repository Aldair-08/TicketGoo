@extends('layouts.procesopago')

@section('contenido')
    {{-- Meta tags para JavaScript --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-name" content="{{ Auth::user()->name }}">
    <meta name="user-dni" content="{{ Auth::user()->dni }}">
    <meta name="user-email" content="{{ Auth::user()->email }}">
    <meta name="evento-nombre" content="{{ strtoupper($evento->nombre) }}">
    <meta name="evento-fecha" content="{{ \Carbon\Carbon::parse($evento->fecha)->translatedFormat('l, d \d\e F Y H:i') }}">
    <meta name="evento-ubicacion" content="{{ $evento->ubicacion }}">

    <div class="flex flex-col md:flex-row gap-6 items-start">
        <div class="w-full md:w-2/3">
            {{-- Sección de Selección de Tickets --}}
            @include('usuario.comprar.seccion-tickets', ['evento' => $evento, 'promociones' => $promociones])

            {{-- Sección de Datos de Compra --}}
            @include('usuario.comprar.seccion-datos-compra')

            {{-- Sección de Confirmado --}}
            @include('usuario.comprar.seccion-confirmado')
        </div>

        {{-- Columna derecha: Info del evento SIEMPRE visible --}}
        @include('usuario.comprar.info-evento', ['evento' => $evento])
    </div>

    {{-- Incluir JavaScript --}}
    @include('usuario.comprar.scripts')
@endsection
