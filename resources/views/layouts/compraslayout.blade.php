<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Punto Ticket - TicketGO</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col font-[Inter] bg-white text-[#222]">

    <!-- Header -->
    <header class="h-20 flex items-center justify-between px-6 shadow bg-cover bg-center"
        style="background-image: url('{{ asset('images/degradado.jpg') }}');">
        <div>
            <a href="/principallog">
                <img src="{{ asset('images/logo.png') }}" alt="TicketGO Logo" class="w-32">
            </a>
        </div>
    </header>

    <!-- Main -->
    <main class="container mx-auto px-4 flex-1">
        <!-- Nombre y DNI del usuario logueado -->
        <div class="mt-6 px-6 font-bold text-sm text-[#222]" style="font-family: 'Montserrat', sans-serif;">
            <p class="mb-1">{{ Auth::user()->name ?? 'Nombre no disponible' }}</p>
            <p>{{ Auth::user()->dni ?? 'DNI no disponible' }}</p>
        </div>
        @yield('compras')
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
                    <li><a href="{{ route('nosotros') }}" class="hover:underline">Acerca de nosotros</a></li>
                    <li><a href="{{ route('terminos') }}" class="hover:underline">Términos y condiciones</a></li>
                    <li><a href="{{ route('cookies') }}" class="hover:underline">Política de cookies</a></li>
                    <li><a href="{{ route('privacidad') }}" class="hover:underline">Política de privacidad</a></li>
                </ul>
            </div>

            <!-- Necesitas ayuda -->
            <div class="mb-6 md:mb-0 pt-14">
                <h4 class="text-lg font-bold mb-3">¿Necesitas ayuda?</h4>
                <ul class="space-y-1 text-sm">
                    <li><a href="{{ route('comprar') }}" class="hover:underline">Cómo comprar entradas</a></li>
                    <li><a href="{{ route('funciona') }}" class="hover:underline">Cómo funcionan los e-tickets</a></li>
                    <li><a href="{{ route('derechos') }}" class="hover:underline">Derechos Arco</a></li>
                </ul>
            </div>
        </div>
    </footer>

</body>

</html>
