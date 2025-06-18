<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>@yield('title', 'TicketGO')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&amp;display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body class="bg-white text-gray-900">
    <header class="flex items-center justify-between px-4 py border-b border-gray-300">
        <div>
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="TicketGO Logo" class="w-32">
            </a>
        </div>

        <!-- Buscador -->
        <form aria-label="Buscar eventos" class="flex items-center border border-gray-300 rounded-full px-3 py-1 max-w-xs w-full" role="search">
            <input aria-label="Buscar eventos" class="flex-grow text-xs placeholder-gray-400 focus:outline-none" id="searchInput" placeholder="Hacer búsqueda aquí" type="search" />
            <button class="text-gray-500 ml-2" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>

        <!-- Menú de Compras -->
        <nav class="relative min-w-[160px]">
            <button aria-expanded="false" aria-haspopup="true" class="text-xs font-semibold text-gray-700 flex items-center space-x-1 focus:outline-none" id="comprasBtn">
                <span>COMPRAS &amp; TICKETS</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </button>
            <!-- En tu menú -->
            <ul class="absolute left-1/2 -translate-x-1/2 mt-1 w-40 bg-white border border-gray-300 rounded shadow-md hidden z-10" id="comprasMenu" role="menu">
                <li><a class="block px-3 py-2 text-xs text-gray-700 hover:bg-gray-100" href="#" role="menuitem">MIS COMPRAS</a></li>
                <li><a class="block px-3 py-2 text-xs text-gray-700 hover:bg-gray-100" href="#" role="menuitem">E-TICKETS</a></li>
                <li>
                    <a href="#" class="block px-3 py-2 text-xs text-gray-700 hover:bg-gray-100" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        CERRAR SESIÓN
                    </a>
                </li>
            </ul>

            <!-- Formulario oculto para cerrar sesión -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>

        </nav>
    </header>

    <main class="px-4 max-w-7xl mx-auto">
        @yield('contenido')
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
                <li><a href="#" class="hover:underline">Acerca de nosotros</a></li>
                <li><a href="{{ route('terminos') }}" class="hover:underline">Términos y condiciones</a></li>
                <li><a href="#" class="hover:underline">Política de cookies</a></li>
                <li><a href="#" class="hover:underline">Política de privacidad</a></li>
                <li><a href="#" class="hover:underline">Derechos Arco</a></li>
                <li><a href="#" class="hover:underline">Revisa tu boleta</a></li>
            </ul>
        </div>

        <!-- Trabajemos juntos -->
        <div class="mb-6 md:mb-0 pt-14">
            <h4 class="text-lg font-bold mb-3">¡TRABAJEMOS JUNTOS!</h4>
            <ul class="space-y-1 text-sm">
                <li><a href="#" class="hover:underline">¿Tienes un evento?</a></li>
                <li><a href="#" class="hover:underline">Venta empresas</a></li>
                <li><a href="#" class="hover:underline">Módulo promotores</a></li>
            </ul>
        </div>
    </div>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script>
        const comprasBtn = document.getElementById('comprasBtn');
        const comprasMenu = document.getElementById('comprasMenu');

        comprasBtn.addEventListener('click', () => {
            const expanded = comprasBtn.getAttribute('aria-expanded') === 'true' || false;
            comprasBtn.setAttribute('aria-expanded', !expanded);
            comprasMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!comprasBtn.contains(e.target) && !comprasMenu.contains(e.target)) {
                comprasMenu.classList.add('hidden');
                comprasBtn.setAttribute('aria-expanded', false);
            }
        });

        const eventosDestacados = document.querySelectorAll('article[data-img]');
        const popularImage = document.getElementById('popularImage');
        let currentIndex = 0;

        function showImage(index) {
            const imgSrc = eventosDestacados[index].getAttribute('data-img');
            popularImage.src = imgSrc;
            popularImage.alt = eventosDestacados[index].querySelector('img').alt;
        }

        function nextImage() {
            currentIndex = (currentIndex + 1) % eventosDestacados.length;
            showImage(currentIndex);
        }

        showImage(currentIndex);

        setInterval(nextImage, 3000);
    </script>
</body>

</html>
