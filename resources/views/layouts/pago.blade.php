<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TicketGO - @yield('titulo')</title>

    <!-- Recomiendo usar solo Tailwind o Bootstrap para evitar conflictos -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />-->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

     <header class="h-20 flex items-center justify-between px-6 shadow bg-cover bg-center" style="background-image: url('{{ asset('images/degradado.jpg') }}');">
        <div>
            <a href="/principallog">
                <img src="{{ asset('images/logo.png') }}" alt="TicketGO Logo" class="w-32">
            </a>
        </div>
    </header>

   <main class="flex flex-1 w-full">
    <section class="flex-1 bg-white px-6 py-6 w-full">
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
                <button
                    class="flex items-center space-x-2 text-xs uppercase font-semibold text-black relative">
                    <span
                        class="w-5 h-5 rounded-full border-2 border-black flex items-center justify-center bg-black">
                        <span class="block w-2.5 h-2.5 rounded-full bg-white"></span>
                    </span>
                    <span>DATOS DE COMPRA</span>
                    <span aria-hidden="true"
                        class="absolute bottom-0 left-0 right-0 h-[2px] bg-black -mb-6"></span>
                </button>
                <button class="flex items-center space-x-2 text-gray-300 text-xs uppercase font-semibold" disabled>
                    <span
                        class="w-5 h-5 rounded-full border border-gray-300 flex items-center justify-center">
                        <span class="block w-2.5 h-2.5 rounded-full bg-gray-300"></span>
                    </span>
                    <span>CONFIRMACIÓN</span>
                </button>
            </nav>

            @yield('pago')
        </section>
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

    @stack('scripts')

    <script>
        // Script para mostrar/ocultar pasos NIUBIZ
        document.addEventListener('DOMContentLoaded', () => {
            const label = document.getElementById('niubizLabel');
            const input = document.getElementById('niubiz');
            const steps = document.getElementById('niubizSteps');

            function toggleSteps() {
                if (steps.style.display === 'none' || steps.style.display === '') {
                    steps.style.display = 'block';
                } else {
                    steps.style.display = 'none';
                }
            }

            label.addEventListener('click', (e) => {
                e.preventDefault();
                toggleSteps();
            });

            function updateHighlight() {
                if (input.checked) {
                    label.classList.add('bg-yellow-100', 'border-yellow-500');
                } else {
                    label.classList.remove('bg-yellow-100', 'border-yellow-500');
                }
            }

            input.addEventListener('change', updateHighlight);
            updateHighlight();
        });
    </script>

</body>

            label.addEventListener('click', (e) => {
                e.preventDefault();
                toggleSteps();
            });

            function updateHighlight() {
                if (input.checked) {
                    label.classList.add('bg-yellow-100', 'border-yellow-500');
                } else {
                    label.classList.remove('bg-yellow-100', 'border-yellow-500');
                }
            }

            input.addEventListener('change', updateHighlight);
            updateHighlight();
        });
    </script>

</body>

</html>
