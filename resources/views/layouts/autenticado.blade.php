<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'TicketGO')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body class="bg-white text-gray-900">

<header class="flex items-center justify-between px-4 py border-b border-gray-300">
    <div>
        <a href="/prinpallog">
            <img src="{{ asset('images/logo.png') }}" alt="TicketGO Logo" class="w-32">
        </a>
    </div>

    <!-- Buscador -->
    <form aria-label="Buscar eventos" class="flex items-center border border-gray-300 rounded-full px-3 py-1 max-w-xs w-full" role="search" onsubmit="event.preventDefault();">
        <input class="flex-grow text-xs placeholder-gray-400 focus:outline-none" id="searchInput" placeholder="Hacer búsqueda aquí" type="search" />
        <button class="text-gray-500 ml-2" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>

    <nav class="relative min-w-[160px]">
        <button aria-expanded="false" aria-haspopup="true" class="text-xs font-semibold text-gray-700 flex items-center space-x-1 focus:outline-none" id="comprasBtn">
            <span>COMPRAS & TICKETS</span>
            <i class="fas fa-chevron-down text-xs"></i>
        </button>
        <ul class="absolute left-1/2 -translate-x-1/2 mt-1 w-40 bg-white border border-gray-300 rounded shadow-md hidden z-10" id="comprasMenu" role="menu">
            <li><a href="{{route('usuario.compras')}}" class="block px-3 py-2 text-xs text-gray-700 hover:bg-gray-100" role="menuitem">MIS COMPRAS</a></li>
            <li><a href="{{route('usuario.etickets')}}" class="block px-3 py-2 text-xs text-gray-700 hover:bg-gray-100" role="menuitem">E-TICKETS</a></li>
            <li>
                <a href="#" class="block px-3 py-2 text-xs text-gray-700 hover:bg-gray-100"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">CERRAR SESIÓN</a>
            </li>
        </ul>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </nav>
</header>

<main class="px-4 max-w-7xl mx-auto">
    @yield('contenido')
</main>

<footer class="bg-black text-white py-4 min-h-[100px] mt-10">
    <div class="container px-6 flex flex-col md:flex-row items-start gap-80">
        <div class="mb-6 md:mb-0">
            <img src="{{ asset('images/logo.png') }}" alt="Logo TicketGO" class="w-80">
        </div>
        <div class="mb-6 md:mb-0 pt-14" style="margin-left: -10px;">
            <h4 class="text-lg font-bold mb-3">CONOZCÁMONOS</h4>
            <ul class="space-y-1 text-sm">
                <li><a href="{{route('nosotros')}}" class="hover:underline">Acerca de nosotros</a></li>
                <li><a href="{{route('terminos')}}" class="hover:underline">Términos y condiciones</a></li>
                <li><a href="{{route('cookies')}}" class="hover:underline">Política de cookies</a></li>
                <li><a href="{{route('privacidad')}}" class="hover:underline">Política de privacidad</a></li>
            </ul>
        </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script>
    const comprasBtn = document.getElementById('comprasBtn');
    const comprasMenu = document.getElementById('comprasMenu');

    comprasBtn.addEventListener('click', () => {
        const expanded = comprasBtn.getAttribute('aria-expanded') === 'true';
        comprasBtn.setAttribute('aria-expanded', !expanded);
        comprasMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!comprasBtn.contains(e.target) && !comprasMenu.contains(e.target)) {
            comprasMenu.classList.add('hidden');
            comprasBtn.setAttribute('aria-expanded', false);
        }
    });

    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function () {
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