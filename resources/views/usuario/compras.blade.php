@extends('layouts.compraslayout')
@section('compras')

<section class="bg-[#fff7e3] rounded-2xl shadow-md mb-12 overflow-hidden max-w-[600px] mx-auto" >
    <header class="bg-[#eda812] text-center text-lg font-bold text-[#222] px-4 py-2 rounded-t-2xl">
        MIS COMPRAS
    </header>
    <div class="overflow-x-auto">
        <table class="min-w-full border border-[#222]" role="table">
            <tbody>
                <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                    <td class="px-4 py-2 font-semibold w-[45%]">N° de orden</td>
                    <td class="px-4 py-2">--------------</td>
                </tr>
                <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                    <td class="px-4 py-2 font-semibold">Fecha de Compra</td>
                    <td class="px-4 py-2">-----------</td>
                </tr>
                <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                    <td class="px-4 py-2 font-semibold">Evento</td>
                    <td class="px-4 py-2">---------------</td>
                </tr>
                <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                    <td class="px-4 py-2 font-semibold">Medio de Pago</td>
                    <td class="px-4 py-2">-------------</td>
                </tr>
                <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                    <td class="px-4 py-2 font-semibold">Tipo de envío</td>
                    <td class="px-4 py-2">+------------</td>
                </tr>
                <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                    <td class="px-4 py-2 font-semibold">Total</td>
                    <td class="px-4 py-2">------------</td>
                </tr>
                <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                    <td class="px-4 py-2 font-semibold">Estado</td>
                    <td class="px-4 py-2">---------------</td>
                </tr>
                <tr class="bg-white text-left text-sm font-bold uppercase text-[#222] border-b border-[#222]">
                    <td class="px-4 py-2 font-semibold">Documento Electrónico</td>
                    <td class="px-4 py-2">------------------ </td>
                </tr>
            </tbody>
        </table>
</section>


@endsection