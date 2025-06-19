<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>DUKI A.D.A TOUR 2024</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#111] text-[#eee] font-[Inter]">

    <header class="bg-black text-white sticky top-0 z-50 px-6 py-4 shadow-lg flex items-center justify-between">
        <div class="font-black text-xl tracking-wider">D U K I</div>
        <button id="menu-toggle" class="hamburger text-white text-2xl block md:hidden">
            <span class="material-icons">menu</span>
        </button>
        <nav id="nav-menu" class="hidden md:flex gap-6" role="navigation" aria-label="Navegación principal">
            <a href="{{ route('welcome') }}" class="hover:text-[#7fc7c7] font-semibold text-sm">Inicio</a>
        </nav>
    </header>

    <section class="relative h-[60vh] max-h-[450px] overflow-hidden" role="banner">
        <img src="{{ asset('images/Eventoduki.jpg') }}"
            class="w-full h-full object-cover brightness-50" />
        <div class="absolute top-1/2 left-4 transform -translate-y-1/2 text-white font-black text-[3.5rem] leading-tight shadow-black drop-shadow-xl max-w-[90%] md:text-6xl">
            DUKI<br>A.D.A<br>TOUR 2024
            <div class="mt-4 text-xl font-medium">2 ÚNICAS FUNCIONES<br>13, 14 y 15 de julio</div>
        </div>
    </section>

    <main class="bg-[#121212] px-4 py-8">
        <article class="max-w-3xl mx-auto">
            <h1 class="text-2xl font-black mb-4 text-gray-200">DUKI A.D.A TOUR 2024</h1>
            <p class="text-gray-300 mb-6">A pedido del público regresa el artista que marcó una generación.
                Duki vuelve a los escenarios con un show que atraviesa el alma y hace vibrar el corazón. Un espectáculo único donde el trap, la emoción y la energía se fusionan en una experiencia inolvidable. Solo 3 fechas exclusivas para revivir los temas que hicieron historia y cantar a todo pulmón.
                No te lo pierdas.</p>

            <section aria-labelledby="info-adicional-title">
                <h2 id="info-adicional-title" class="text-xl font-bold border-b-2 border-[#7fc7c7] pb-1 mb-4 max-w-xs">Información adicional</h2>
                <p class="text-gray-300 mb-4"><strong class="text-[#7fc7c7]">Duki es un cantante, compositor y referente del trap argentino con una carrera que revolucionó la escena musical en Latinoamérica. Con múltiples discos de platino y giras internacionales, es creador de hits como She Don’t Give a Fo, Goteo y Givenchy. En 2023, fue reconocido como Artista del Año por su impacto en la cultura urbana y su capacidad para conectar con millones de fans en todo el mundo.</p>
            </section>

            <div class="mt-6 flex gap-4 items-center">
                <span class="font-semibold text-gray-400">Compártelo:</span>
                <a href="https://www.facebook.com/DUKISSJ/"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="bg-[#222] hover:bg-[#7fc7c7] hover:text-black p-2 rounded text-white text-lg flex items-center justify-center">
                    <span class="material-icons">facebook</span>
                </a>
            </div>
        </article>
    </main>

    <footer class="bg-black text-gray-500 text-sm text-center px-4 py-6 mt-20" role="contentinfo">
        <p>© 2024 Derechos Reservados</p>
    </footer>

    <script>
        const toggleBtn = document.getElementById('menu-toggle');
        const navMenu = document.getElementById('nav-menu');

        toggleBtn.addEventListener('click', () => {
            navMenu.classList.toggle('hidden');
            navMenu.classList.toggle('flex');
            navMenu.classList.toggle('flex-col');
            navMenu.classList.toggle('absolute');
            navMenu.classList.toggle('top-[64px]');
            navMenu.classList.toggle('right-0');
            navMenu.classList.toggle('bg-black');
            navMenu.classList.toggle('rounded-bl-lg');
            navMenu.classList.toggle('shadow-lg');
            navMenu.classList.toggle('p-4');
        });

        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                if (!navMenu.classList.contains('md:flex')) {
                    navMenu.classList.add('hidden');
                    navMenu.classList.remove('flex');
                }
            });
        });
    </script>
</body>

</html>