@extends('layouts.eticketslayout')
@section('etickets')

<section class="bg-[#fff7e3] rounded-2xl shadow-md mb-12 overflow-hidden" role="region">
    <header class="bg-[#eda812] text-center text-lg font-bold text-[#222] px-4 py-2 rounded-t-2xl">
        ETICKETS
    </header>
    <div class="overflow-x-auto">
        <table class="min-w-full border border-[#222]" role="table">
            <thead>
                <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                    <th scope="col" class="px-4 py-3">N° de Orden</th>
                    <th scope="col" class="px-4 py-3">Evento</th>
                    <th scope="col" class="px-4 py-3">Fecha</th>
                    <th scope="col" class="px-4 py-3">Recinto</th>
                    <th scope="col" class="px-4 py-3">Tipo de Ticket</th>
                    <th scope="col" class="px-4 py-3 text-center">Enviar</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white text-sm font-semibold text-[#222] border-b border-gray-300">
                    <td class="px-4 py-3">----</td>
                    <td class="px-4 py-3">----</td>
                    <td class="px-4 py-3">----</td>
                    <td class="px-4 py-3">----</td>
                    <td class="px-4 py-3">-----</td>
                    <td class="px-4 py-3 text-center">
                        <button class="bg-[#334e86] hover:bg-[#283b66] text-white px-4 py-2 rounded-full font-semibold text-sm transition-colors duration-300">
                            Enviar al correo
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

@endsection