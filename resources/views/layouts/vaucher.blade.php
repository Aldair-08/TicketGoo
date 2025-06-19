<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Voucher de Compra - TicketGO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #ffffff;
            color: #6b7280;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <header class="h-20 flex items-center justify-between px-6 shadow bg-cover bg-center" style="background-image: url('{{ asset('images/degradado.jpg') }}');">
        <div>
            <a href="/principallog">
                <img src="{{ asset('images/logo.png') }}" alt="TicketGO Logo" class="w-32">
            </a>
        </div>
        <nav>
            <ul class="flex space-x-6 text-white text-ms">
                <li><a href="{{ route('pagina.principallog') }}" class="hover:text-blue-900 transition">Inicio</a></li>
            </ul>
        </nav>
    </header>


    @yield('añavaucher')


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
</body>
</html>