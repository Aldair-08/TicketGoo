<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('titulo')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    @livewireStyles
</head>

<body class="bg-gray-100">

    <!-- Barra superior solo con logo y botón cerrar sesión (para administrador) -->
    <header class="h-20 flex items-center justify-between px-6 shadow bg-cover bg-center"
        style="background-image: url('{{ asset('images/degradado.jpg') }}');">
        <!-- Logo -->
        <div>
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="TicketGO Logo" class="w-32">
            </a>
        </div>

        <!-- Botón Cerrar sesión -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-white text-sm font-semibold hover:underline">
                CERRAR SESIÓN
            </button>
        </form>
    </header>



    <!-- Navegación tipo botones para administrador -->
    <nav class="bg-white shadow-md py-4 px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
        <a href="#"
            class="w-full max-w-[220px] mx-auto bg-yellow-500 text-black px-4 py-2 rounded flex items-center gap-2 justify-center hover:bg-yellow-600 transition">
            <i class="fa-solid fa-map-marker-alt text-black"></i> Gestionar Lugares
        </a>
        <a href="{{ route('admin.eventos.create') }}"
            class="w-full max-w-[220px] mx-auto bg-yellow-500 text-black px-4 py-2 rounded flex items-center gap-2 justify-center hover:bg-yellow-600 transition">
            <i class="fa-solid fa-calendar-plus text-black"></i> Registrar Evento
        </a>
        <a href="{{ route('admin.promociones.index') }}"
            class="w-full max-w-[220px] mx-auto bg-yellow-500 text-black px-4 py-2 rounded flex items-center gap-2 justify-center hover:bg-yellow-600 transition">
            <i class="fa-solid fa-tags text-black"></i> Registrar Promociones
        </a>
        <a href="{{ route('admin.proveedores.index') }}"
            class="w-full max-w-[220px] mx-auto bg-yellow-500 text-black px-4 py-2 rounded flex items-center gap-2 justify-center hover:bg-yellow-600 transition">
            <i class="fa-solid fa-handshake text-black"></i> Gestionar Proveedores
        </a>
    </nav>


    <!-- Contenido principal -->
    <main class="p-6">
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
                    <li><a href="{{ route('nosotros') }}" class="hover:underline">Acerca de nosotros</a></li>
                    <li><a href="{{ route('terminos') }}" class="hover:underline">Términos y condiciones</a></li>
                    <li><a href="{{ route('cookies') }}" class="hover:underline">Política de cookies</a></li>
                    <li><a href="{{ route('privacidad') }}" class="hover:underline">Política de privacidad</a></li>
                    <li><a href="{{ route('derechos') }}" class="hover:underline">Derechos Arco</a></li>
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
