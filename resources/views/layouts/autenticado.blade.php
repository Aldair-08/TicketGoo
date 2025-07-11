<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'TicketGO')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />

</head>

<body class="bg-white text-gray-900 min-h-screen flex flex-col">

    <header class="flex items-center justify-between px-4 py border-b border-gray-300">
        <div class="flex-1 flex justify-start">
            <a href="/usuario/principallog">
                <img src="{{ asset('images/logo.png') }}" alt="TicketGO Logo" class="w-32 h-22">
            </a>
        </div>

        <!-- Buscador centrado -->
        <div class="flex-1 flex justify-center">
            <form aria-label="Buscar eventos"
                class="flex items-center border border-gray-300 rounded-full px-3 py-1 max-w-lg w-full" role="search"
                onsubmit="event.preventDefault();">
                <input class="flex-grow text-xs placeholder-gray-400 focus:outline-none" id="searchInput"
                    placeholder="Hacer búsqueda aquí" type="search" />
                <button class="text-gray-500 ml-2" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Menú horizontal simple -->
        <nav class="flex-1 flex justify-end space-x-8 text-sm md:text-base font-medium text-black">
            <a href="{{ route('usuario.compras') }}" class="hover:text-blue-600">Mis Compras</a>
            <a href="{{ route('usuario.etickets') }}" class="hover:text-blue-600">E-Tickets</a>
            <a href="#" class="hover:text-blue-600"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
        </nav>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </header>


    @yield('contenido')



    <footer class="bg-black text-white py-4 min-h-[100px] mt-auto">
        <div class="container px-6 pl-32 flex flex-col md:flex-row items-start justify-between gap-8">
            <!-- Logo -->
            <div class="mb-6 md:mb-0">
                <img src="{{ asset('images/logo.png') }}" alt="Logo TicketGO" class="w-60">
            </div>
            <!-- Conozcámonos -->
            <div class="mb-6 md:mb-0 pt-14">
                <h4 class="text-lg font-bold mb-3">CONOZCÁMONOS</h4>
                <ul class="space-y-1 text-sm">
                    <li><a href="{{ route('nosotros') }}" class="hover:underline">Acerca de nosotros</a></li>
                    <li><a href="{{ route('terminos') }}" class="hover:underline">Términos y condiciones</a></li>
                    <li><a href="{{ route('cookies') }}" class="hover:underline">Política de cookies</a></li>
                    <li><a href="{{ route('privacidad') }}" class="hover:underline">Política de privacidad</a></li>
                    <li><a href="{{ route('derechos') }}" class="hover:underline">Derechos Arco</a></li>
                </ul>
            </div>
            <!-- Necesitas ayuda -->
            <div class="mb-6 md:mb-0 pt-14">
                <h4 class="text-lg font-bold mb-3">¿NECESITAS AYUDA?</h4>
                <ul class="space-y-1 text-sm">
                    <li><a href="{{ route('comprar') }}" class="hover:underline">Cómo comprar entradas</a></li>
                    <li><a href="{{ route('funciona') }}" class="hover:underline">Cómo funcionan los e-tickets</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <script>
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const eventos = document.querySelectorAll('article');

            eventos.forEach(evento => {
                const text = evento.textContent.toLowerCase();
                evento.style.display = text.includes(query) ? 'block' : 'none';
            });
        });
    </script>

</body>

</html>
