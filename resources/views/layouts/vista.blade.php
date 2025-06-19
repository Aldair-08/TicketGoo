<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Videojuegos - @yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body>
    <header class="bg-white shadow-md h-20 ">
        <div class="container mx-auto px-6 h-full flex justify-between items-center">
            <div>
                <a href="/">
                    <img src="{{ asset('images/usuario/logo.png') }}"  class="w-32" />
                </a>
            </div>

            <nav class="flex-1 flex justify-center space-x-20 text-sm md:text-base font-medium text-black">
                <a href="{{ route('pagina.principallog') }}" class="hover:text-blue-600">Explorar eventos</a>
                <a href="{{route('nosotros')}}" class="hover:text-blue-600">Sobre nosotros</a>    
            </nav>
        </div>
    </header>

    @yield('aña')

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

    <footer class="bg-black border-t border-[#E6A400] py-1">
        <div class="container mx-auto flex justify-center items-center">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="TicketGO Logo" class="w-28">
            </a>
        </div>
    </footer>


</body>

</html>