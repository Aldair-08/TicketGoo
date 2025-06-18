<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticketgo - @yield('titulo')</title>

    @livewireStyles
</head>
<body>
   <header class="bg-white shadow-md h-20 ">
    <div class="container mx-auto px-6 h-full flex justify-between items-center">
        <div>
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="TicketGO Logo" class="w-32">
            </a>
        </div>

        <nav class="flex-1 flex justify-center space-x-20 text-sm md:text-base font-medium text-black">
            <a href="{{route('welcome')}}" class="hover:text-blue-600">Explorar eventos</a>
            <a href="{{route('nosotros')}}" class="hover:text-blue-600">Sobre nosotros</a>
            <a href="{{route('login')}}" class="hover:text-blue-600">Iniciar sesión</a>
            <a href="{{route('register')}}" class="hover:text-blue-600">Registrarme</a>
        </nav>
    </div>
</header>

  <!-- Contenido del componente Livewire -->
  {{ $slot }}

  <script src="https://cdn.tailwindcss.com"></script>
  @livewireScripts

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
</body>
</html>

