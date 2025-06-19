@extends('layouts.identificadorlayout')
@section('añaidentificador')

<!-- Contenedor centrado -->
<div class="flex justify-center">
    <div class="flex flex-col md:flex-row gap-6 px-4 py-4 w-full max-w-6xl">

        <!-- LADO IZQUIERDO -->
        <main class="flex-1 md:max-w-[60%]">
            <table class="w-full text-sm text-gray-900 mb-6 border-collapse">
                <thead>
                    <tr>
                        <th class="text-left font-medium pb-3 text-base">RESUMEN</th>
                        <th class="text-right font-medium pb-3 text-base">PRECIO</th>
                        <th class="text-right font-medium pb-3 text-base">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resumen as $item)
                        <tr class="border-t border-gray-300">
                            <td class="py-3">{{ $item['descripcion'] }}</td>
                            <td class="py-3 text-right">S/ {{ number_format($item['precio'], 2) }}</td>
                            <td class="py-3 text-right">S/ {{ number_format($item['total'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right text-[12px] font-semibold text-gray-700 mb-6">
                S/. {{ number_format($totalFinal, 2) }}
            </div>

            <div class="mt-16 mb-4">
                <div class="inline-block bg-[#0a2a6e] text-white text-[10px] font-bold uppercase px-3 py-1">
                    SELECCIONA PARA CONTINUAR
                </div>
            </div>

            <form id="termsForm" class="border border-gray-300 p-4 mb-6 text-xs text-gray-900 leading-relaxed">
                <label class="flex items-start space-x-2 mb-4">
                    <input class="mt-1 w-4 h-4" type="checkbox" />
                    <span>
                        Declaro que he leído y acepto los
                        <a class="underline text-black font-semibold" href="#">Términos y Condiciones</a> y
                        <a class="underline text-black font-semibold" href="#">Política de Privacidad</a> de TicketGo.
                    </span>
                </label>
                <label class="flex items-start space-x-2">
                    <input class="mt-1 w-4 h-4" type="checkbox" />
                    <span>
                        He leído y acepto los
                        <a class="underline text-black font-semibold" href="#">Términos y Condiciones</a> de la tienda.
                    </span>
                </label>
            </form>

            <div class="flex items-center space-x-3 max-w-[320px]">
                <label for="fileInput" class="flex items-center space-x-2 border border-gray-700 rounded px-4 py-2 text-sm font-semibold text-gray-900 cursor-pointer select-none">
                    <i class="fas fa-upload text-base"></i>
                    <span>Subir documento de identidad</span>
                </label>
                <input accept=".png,.jpg,.jpeg" class="hidden" id="fileInput" type="file" />
                <div id="checkIcon" class="hidden border border-gray-700 rounded p-2">
                    <i class="fas fa-check text-green-600 text-base"></i>
                </div>
            </div>

            <p id="uploadMessage" class="text-[8px] mt-1 hidden"></p>
        </main>

        <!-- LADO DERECHO -->
        <aside class="flex-1 p-4 md:pt-0 md:px-8 md:mt-[-10px] max-w-md">
            <img class="w-full object-cover max-h-[300px]" src="{{ asset('images/usuario/dukiderecho.jpg') }}" alt="Duki Tour" />
            <div class="p-6 flex flex-col space-y-4">
                <p class="text-xs font-semibold text-gray-700">MÚSICA <span class="text-blue-700">/ PRESENCIAL</span></p>
                <h1 class="text-base font-extrabold text-black leading-tight">DUKI - AMERI WORLD TOUR 2025</h1>
                <p class="text-xs text-gray-500">sábado, 23 de agosto 21:00 hrs.</p>
                <p class="text-xs text-gray-700 leading-relaxed">
                    Luego de batir todos los records con AMERI, que se convirtió en el álbum argentino más escuchado en 24hs, DUKI se prepara para dar la gira más grande de su carrera: WORLD TOUR. El artista hará una parada obligatoria en Perú el próximo 23 de agosto del 2025 para apoderarse y encender el escenario de Multiespacio Costa 21. Las entradas estarán disponibles desde este viernes 8 de noviembre a las 10:00 am por la plataforma de Teleticket.
                </p>
                <button id="continueBtn" class="bg-[#f7b24a] text-white text-[10px] font-semibold uppercase px-6 py-2 w-full max-w-[220px]" type="button">
                    CONTINUAR
                </button>
                <p id="warningMessage" class="text-[8px] text-red-600 mt-2 hidden">Falta subir el documento de identidad.</p>
            </div>
        </aside>
    </div> <!-- cierre del contenedor max-w-6xl -->
</div> <!-- cierre del centrado -->

<script>
document.getElementById('fileInput').addEventListener('change', async function () {
    const file = this.files[0];
    if (!file) return;

    const formData = new FormData();
    formData.append('documento', file);
    const csrfToken = '{{ csrf_token() }}';

    try {
        const response = await fetch('{{ route("documento.simular") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            body: formData
        });

        if (response.ok) {
            document.getElementById('checkIcon').classList.remove('hidden');
            document.getElementById('uploadMessage').textContent = "Documento cargado correctamente.";
            document.getElementById('uploadMessage').classList.remove('hidden');
            document.getElementById('continueBtn').dataset.valid = 'true';
        } else {
            document.getElementById('uploadMessage').textContent = "Error al subir el documento.";
            document.getElementById('uploadMessage').classList.remove('hidden');
        }
    } catch (error) {
        document.getElementById('uploadMessage').textContent = "Error de red.";
        document.getElementById('uploadMessage').classList.remove('hidden');
    }
});

document.getElementById('continueBtn').addEventListener('click', function () {
    if (this.dataset.valid === 'true') {
        window.location.href = "{{ route('usuario.vaucherduki') }}";
    } else {
        document.getElementById('warningMessage').classList.remove('hidden');
    }
});
</script>

@endsection
