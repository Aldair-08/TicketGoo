@extends('layouts.plantilla')
@section('title', 'Acerca de Nosotros | TicketGO')

@section('contenido')

<!-- Hero / Banner similar a Classcraft -->
<div class="w-full h-[85vh] relative overflow-hidden">
    <img src="{{ asset('images/fondomovimiento.gif') }}" alt="Banner Movimiento" class="absolute inset-0 w-full h-full object-cover" />
    <div class="absolute inset-0 bg-black/70"></div>
    <div class="relative z-10 flex items-center justify-center h-full text-center px-4">
        <h1 class="text-white text-5xl font-bold leading-tight drop-shadow-md animate-fadeInUp">TicketGO: Vive el evento desde el inicio</h1>
    </div>
</div>

<!-- Sección principal con animación y layout visual -->
<div class="max-w-6xl mx-auto px-4 py-16 space-y-20 animate-fadeIn">
    <!-- Intro -->
    <section class="text-center">
        <h2 class="text-3xl font-bold text-yellow-500 mb-4">¿Quiénes somos?</h2>
        <p class="text-gray-600 text-lg max-w-3xl mx-auto">
            Somos una plataforma 100% digital que te conecta con los mejores eventos del país. En TicketGO, comprar entradas es fácil, rápido y seguro.
        </p>
    </section>

    <!-- Misión -->
    <section class="flex flex-col md:flex-row items-center gap-12">
        <div class="md:w-1/2">
            <img src="{{ asset('images/mision.png') }}" class="rounded-lg shadow-lg w-full h-80 object-contain hover:scale-105 transition" alt="Misión TicketGO">
        </div>
        <div class="md:w-1/2">
            <h3 class="text-2xl font-bold text-blue-700 mb-4">Nuestra Misión</h3>
            <p class="text-gray-600 text-lg">
                Ofrecer una plataforma digital confiable, ágil y segura para la venta de entradas, mejorando la experiencia de los asistentes y facilitando la gestión para los organizadores.
            </p>
        </div>
    </section>

    <!-- Visión -->
    <section class="flex flex-col md:flex-row-reverse items-center gap-12">
        <div class="md:w-1/2">
            <img src="{{ asset('images/vision.png') }}" class="rounded-lg shadow-lg w-full h-80 object-cover hover:scale-105 transition" alt="Visión TicketGO">
        </div>
        <div class="md:w-1/2">
            <h3 class="text-2xl font-bold text-blue-700 mb-4">Nuestra Visión</h3>
            <p class="text-gray-600 text-lg">
                Ser la plataforma de ticketing líder en Perú, reconocida por su innovación tecnológica, accesibilidad y compromiso con los usuarios.
            </p>
        </div>
    </section>

    
    <!-- Sección de características / beneficios estilo tarjetas -->
<section class="max-w-6xl mx-auto px-4 py-16">
    <h2 class="text-center text-3xl font-bold text-yellow-500 mb-12">LO QUE NOS DIFERENCIA</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Tarjeta 1 -->
        <div class="bg-white border border-black shadow-xl rounded-lg p-6 text-center hover:scale-105 transition transform">
            <img src="{{ asset('images/entrelazo.png') }}" alt="Seguridad" class="mx-auto mb-4 w-16 h-16 object-contain" />
            <h3 class="text-lg font-bold text-blue-700 mb-2">Seguridad</h3>
            <p class="text-gray-600">Tus datos y pagos están protegidos con los más altos estándares. Compra con total confianza.</p>
        </div>

        <!-- Tarjeta 2 -->
        <div class="bg-white border border-black shadow-xl rounded-lg p-6 text-center hover:scale-105 transition transform">
            <img src="{{ asset('images/estrellas.png') }}" alt="Rapidez" class="mx-auto mb-4 w-28 h-14 object-contain" />
            <h3 class="text-lg font-bold text-blue-700 mb-2">Rapidez</h3>
            <p class="text-gray-600">Compra tus entradas en segundos. Sin colas, sin complicaciones. 100% digital.</p>
        </div>

        <!-- Tarjeta 3 -->
        <div class="bg-white border border-black shadow-xl rounded-lg p-6 text-center hover:scale-105 transition transform">
            <img src="{{ asset('images/corazon.png') }}" alt="Experiencia" class="mx-auto mb-4 w-14 h-14 object-cover" />
            <h3 class="text-lg font-bold text-blue-700 mb-2">Experiencia</h3>
            <p class="text-gray-600">Hacemos que cada paso de tu compra sea fluido, claro y sencillo para que solo te preocupes por disfrutar.</p>
        </div>
    </div>
</section>


    <!-- Contacto -->
    <section class="bg-black-100 p-8 rounded-lg shadow-lg text-center max-w-3xl mx-auto">
        <h3 class="text-xl font-bold text-blue-700 mb-4">Contáctanos</h3>
        <p class="text-gray-700 mb-2">📍 Av. Cascanueces, Santa Anita - Lima</p>
        <p class="text-gray-700 mb-2">📧 ticket_go@eventos.com</p>
        <p class="text-gray-700 mb-4">¿Deseas más información? ¡Estamos para ayudarte!</p>
        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=ticket_go@eventos.com&su=Consulta%20sobre%20entradas" target="_blank" rel="noopener noreferrer" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-full font-bold transition">
    Contáctanos
</a>




    </section>
</div>

@endsection
