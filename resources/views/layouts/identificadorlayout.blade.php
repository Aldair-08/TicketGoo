<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'TicketGO Confirmation')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap");

        body {
            font-family: "Montserrat", sans-serif;
        }
    </style>
</head>

<header class="h-20 flex items-center justify-between px-6 shadow bg-cover bg-center" style="background-image: url('{{ asset('images/degradado.jpg') }}');">
    <div class="container mx-auto h-full flex justify-between items-center">
        <div>
            <a href="/principallog">
                <img src="{{ asset('images/usuario/logo.png') }}" class="w-32" />
            </a>
        </div>
    </div>
</header>

<main class="flex flex-col md:flex-row max-w-full mx-auto mt-4 px-4 md:px-8 gap-6">
    <section class="flex-1 bg-white px-6 py-6 w-full max-w-full">
        <nav class="flex items-center space-x-6 mb-8">
            <div class="flex items-center space-x-2 text-gray-300 text-xs uppercase font-semibold">
                <button onclick="history.back()" class="text-black text-xl mr-1">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <span class="w-5 h-5 rounded-full border border-gray-300 flex items-center justify-center">
                    <span class="block w-2.5 h-2.5 rounded-full bg-gray-300"></span>
                </span>
                <span>TICKETS</span>
            </div>
            <button class="flex items-center space-x-2 text-gray-300 text-xs uppercase font-semibold" disabled>
                <span class="w-5 h-5 rounded-full border border-gray-300 flex items-center justify-center">
                    <span class="block w-2.5 h-2.5 rounded-full bg-gray-300"></span>
                </span>
                <span>DATOS DE COMPRA</span>
            </button>
            <button class="flex items-center space-x-2 text-xs uppercase font-semibold text-black relative">
                <span class="w-5 h-5 rounded-full border-2 border-black flex items-center justify-center bg-black">
                    <span class="block w-2.5 h-2.5 rounded-full bg-white"></span>
                </span>
                <span>CONFIRMACIÓN</span>
                <span class="absolute bottom-0 left-0 right-0 h-[2px] bg-black -mb-6"></span>
            </button>
        </nav>

        @yield('añaidentificador')

</main>

<footer class="bg-black text-white py-4 min-h-[100px]">
        <div class="container px-6 flex flex-col md:flex-row items-start gap-80 ">
            
            <!-- Logo -->
            <div class="mb-6 md:mb-0">
                <img src="{{ asset('images/logo.png') }}" alt="Logo TicketGO" class="w-80">
            </div>

            <!-- Conozcámonos -->
            <div class="mb-6 md:mb-0 pt-14" style="margin-left: -10px;">
                <h4 class="text-lg font-bold mb-3">CONOZCÁMONOS</h4>
                <ul class="space-y-1 text-sm">
                    <li><a href="{{route('nosotros')}}" class="hover:underline">Acerca de nosotros</a></li>
                    <li><a href="{{ route('terminos') }}" class="hover:underline">Términos y condiciones</a></li>
                    <li><a href="{{ route('cookies') }}" class="hover:underline">Política de cookies</a></li>
                    <li><a href="{{route('privacidad')}}" class="hover:underline">Política de privacidad</a></li>
                    <li><a href="{{route('derechos')}}" class="hover:underline">Derechos Arco</a></li>
                </ul>
            </div>
            <!-- Necesitas ayuda -->
            <div class="mb-6 md:mb-0 pt-14">
                <h4 class="text-lg font-bold mb-3">¿Necesitas ayuda?</h4>
                <ul class="space-y-1 text-sm">
                    <li><a href="{{route('comprar')}}" class="hover:underline">Cómo comprar entradas</a></li>
                    <li><a href="{{route('funciona')}}" class="hover:underline">Cómo funcionan los e-tickets</a></li>
                    <li><a href="{{route('derechos')}}" class="hover:underline">Derechos Arco</a></li>
                </ul>
            </div>
        </div>
    </footer>

<div id="successModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded shadow-lg text-center">
        <h2 class="text-lg font-bold">Pago realizado con éxito</h2>
        <p class="mt-2">Gracias por tu compra. Serás redirigido en breve.</p>
    </div>
</div>

<script>
    const fileInput = document.getElementById("fileInput");
    const checkIcon = document.getElementById("checkIcon");
    const uploadMessage = document.getElementById("uploadMessage");
    const continueBtn = document.getElementById("continueBtn");
    const continueBtnLeft = document.getElementById("continueBtnLeft");
    const continueBtnRight = document.getElementById("continueBtnRight");
    const warningMessage = document.getElementById("warningMessage");
    const successModal = document.getElementById("successModal");
    const voucherUrl = "{{ route('usuario.vaucherduki') }}";

    function handleFileValidation() {
        warningMessage?.classList.add("hidden");
        if (fileInput?.files.length > 0) {
            const file = fileInput.files[0];
            const validTypes = ["image/png", "image/jpeg"];
            if (validTypes.includes(file.type)) {
                checkIcon?.classList.remove("hidden");
                uploadMessage.textContent = "(Documento aceptado correctamente)";
                uploadMessage.classList.remove("hidden", "text-red-600");
                uploadMessage.classList.add("text-green-600");
                return true;
            } else {
                checkIcon?.classList.add("hidden");
                uploadMessage.textContent = "Solo se permiten archivos PNG o JPG.";
                uploadMessage.classList.remove("hidden", "text-green-600");
                uploadMessage.classList.add("text-red-600");
                fileInput.value = "";
                return false;
            }
        } else {
            checkIcon?.classList.add("hidden");
            uploadMessage?.classList.add("hidden");
            return false;
        }
    }

    fileInput?.addEventListener("change", handleFileValidation);

    function handleContinue() {
        if (!fileInput?.files.length) {
            warningMessage?.classList.remove("hidden");
        } else {
            successModal?.classList.remove("hidden");
            setTimeout(() => {
                window.location.href = voucherUrl;
            }, 2500);
        }
    }

    continueBtn?.addEventListener("click", handleContinue);
    continueBtnLeft?.addEventListener("click", handleContinue);
    continueBtnRight?.addEventListener("click", handleContinue);
</script>

</body>

</html>