@extends('layouts.vista')
@section('aña')

<main class="relative flex flex-col items-center px-4 mx-auto bg-[url('{{ asset('images/evento.png') }}')] bg-cover bg-center bg-no-repeat rounded-md min-h-screen overflow-hidden">

    <!-- Imagen del personaje centrada y al fondo -->
    <div class="relative z-10">
        <img src="{{ asset('images/duki.png') }}" alt="DUKI" class="w-auto max-h-[65vh] object-contain mx-auto" />
    </div>

    <!-- Contenedor absoluto en la parte inferior -->
    <div class="absolute bottom-4 w-full flex flex-col items-center z-20 space-y-4">
        
        <!-- Mapa superpuesto -->
        <img src="{{ asset('images/mapa.png') }}" alt="Mapa" class="w-full max-w-md drop-shadow-lg" />

        <!-- Tabla de precios con fondo plomo claro -->
        <div class="w-full max-w-md bg-[#E0E0E0] rounded-md p-4 shadow-lg">
            <div class="bg-[#5A5A5A] bg-opacity-80 text-white rounded-sm overflow-hidden drop-shadow-md">
                <div class="flex items-center justify-between px-3 py-1 border-b border-[#3B3B3B]">
                    <div class="flex items-center space-x-1">
                        <i class="fas fa-star text-[#D20B0B]"></i>
                        <span class="text-xs font-semibold">Paquetes VIP</span>
                    </div>
                    <a href="#" class="text-xs text-[#7B7B7B] hover:underline">Más información</a>
                </div>
                <table class="w-full text-xs text-[#B3B3B3]">
                    <thead>
                        <tr class="text-[#D20B0B] text-[10px] font-bold">
                            <th class="py-1 px-2 text-left">SECTORES</th>
                            <th class="py-1 px-2 text-right bg-[#D20B0B] rounded-tr-md">REGULAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t border-[#3B3B3B]">
                            <td class="py-1 px-2">PRIMERAS FILAS</td>
                            <td class="py-1 px-2 text-right">S/633.00</td>
                        </tr>
                        <tr class="border-t border-[#3B3B3B] bg-[#3B3B3B]">
                            <td class="py-1 px-2">DIAMANTE</td>
                            <td class="py-1 px-2 text-right">S/518.00</td>
                        </tr>
                        <tr class="border-t border-[#3B3B3B]">
                            <td class="py-1 px-2">PLATINIUM</td>
                            <td class="py-1 px-2 text-right">S/460.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Botón REGULAR -->
        <a href="{{ route('usuario.compraduki') }}" class="bg-[#E6A400] hover:bg-[#C48B00] text-white font-bold text-[12px] py-2 px-8 rounded-full shadow-md">
            REGULAR
        </a>
    </div>

</main>

@endsection
