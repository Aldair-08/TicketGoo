@extends('layouts.plantilla')
@section('contenido')
  <main class="container px-6 mx-auto">

    <br>
    <h3 class=" text-center text-blue-700 text-2xl font-bold mb-6 ">EVENTOS POPULARES</h3>
    <div id="carouselExample" class="carousel slide mb-6" data-bs-ride="carousel" >
        <div class="carousel-inner h-[550px]">
            <div class="carousel-item active">
            <img src="{{ asset('images/trueno.jpg') }}" class="d-block w-100" alt="Evento Trueno" />
            </div>
            <div class="carousel-item">
            <img src="{{ asset('images/duki.jpg') }}" class="d-block w-100" alt="Evento Duki" />
            </div>
            <div class="carousel-item">
               <img src="{{ asset('images/emilia.jpg') }}" class="d-block w-100 h-[600px] object-cover" />
            </div>
            <div class="carousel-item">
            <img src="{{ asset('images/dualipa.jpg') }}" class="d-block w-100" alt="Dualipa" />
            </div>
            <div class="carousel-item">
            <img src="{{ asset('images/badbunny.jpg') }}" class="d-block w-100" alt="Evento Bad Bunny" />
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
    <h3 class=" text-center text-blue-700 text-2xl font-bold mb-6 ">EVENTOS DESTACADOS</h3>
    <section aria-label="Eventos destacados" class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-12">
       <!-- Evento 1 -->
        <a href="https://www.ticketgo.pe/eventos/deyvis-orozco"
            class="border border-gray-300 rounded-md p-4 text-sm max-w-[240px] mx-auto block transform transition duration-200 hover:scale-105 hover:shadow-lg focus:scale-105 focus:shadow-lg"
            aria-label="Evento Deyvis Orozco en Anfiteatro parque de la Exposición, Lima">

            <img src="{{ asset('images/Eventodeyvis.jpg') }}"
                alt="Cartel del evento Deyvis Orozco"
                class="h-[240px] w-full object-cover rounded-sm mb-3" />

            <h4 class="text-blue-800 font-semibold text-sm mb-1 leading-tight">
                Anfiteatro Parque de la Exposición
            </h4>
            <p class="text-gray-600 text-xs mb-1">
                Av. 28 de Julio - LIMA
            </p>
            <p class="text-yellow-500 text-xs font-medium mb-2">
                Dom. 01 de diciembre, 19:00
            </p>
            <p class="text-black font-bold text-sm">
                Deyvis Orozco
            </p>
        </a>
        <!-- Evento 2 DUKI -->

        <a href="https://www.ticketgo.pe/eventos/duki"
        class="border border-gray-300 rounded-md p-4 text-sm max-w-[240px] mx-auto block transform transition duration-200 hover:scale-105 hover:shadow-lg focus:scale-105 focus:shadow-lg"
            aria-label="Evento DUKI en Multiespacio Costa21, Lima, 31 de octubre, 19:00 hrs">
            <img src="{{ asset('images/Eventoduki.jpg') }}"
                alt="Cartel del evento DUKI"
                class="h-[240px] w-full object-cover rounded-sm mb-3" />

            <h4 class="text-blue-800 font-semibold text-sm mb-1 leading-tight">
                Multiespacio Costa21
            </h4>
            <p class="text-gray-600 text-xs mb-1">
                Av. 28 de Julio - LIMA
            </p>
            <p class="text-yellow-500 text-xs font-medium mb-2">
                Vie. 31 de octubre, 19:00
            </p>
            <p class="text-black font-bold text-sm">
                DUKI
            </p>
        </a>

        <!-- Evento 3  Álvaro -->
        <a href="https://www.ticketgo.pe/eventos/alvaro-de-la-puente-m"
        class="border border-gray-300 rounded-md p-4 text-sm max-w-[240px] mx-auto block transform transition duration-200 hover:scale-105 hover:shadow-lg focus:scale-105 focus:shadow-lg"
        aria-label="Evento Álvaro de la Puente M. en GALERIA ODERS, Barranco, 07 Mar - 30 Mayo 2023">
            
            <img src="{{ asset('images/alvaro.jpg') }}"
                alt="Cartel del evento Álvaro de la Puente M."
                class="h-[240px] w-full object-cover rounded-sm mb-3" />

            <h4 class="text-blue-800 font-semibold text-sm mb-1 leading-tight">
                Jr. Domeyer 270 Barranco - LIMA
            </h4>
            <p class="text-gray-600 text-xs mb-1">
                Av. 28 de Julio - LIMA
            </p>
            <p class="text-yellow-500 text-xs font-medium mb-2">
                07 Mar - 30 Mayo 2023
            </p>
            <p class="text-black font-bold text-sm">
                Álvaro de la Puente M.
            </p>
        </a>

        <!-- Evento 4Hablando Huevadas -->
        <a href="https://www.ticketgo.pe/eventos/hablando-huevadas"
        class="border border-gray-300 rounded-md p-4 text-sm max-w-[240px] mx-auto block transform transition duration-200 hover:scale-105 hover:shadow-lg focus:scale-105 focus:shadow-lg"
        aria-label="Evento Hablando Huevadas en Teatro Canout, Lima, 11 Agosto, 20:00 hrs">

            <img src="{{ asset('images/Eventohablando.jpg') }}"
                alt="Cartel del evento Hablando Huevadas"
                class="h-[240px] w-full object-cover rounded-sm mb-3" />

            <h4 class="text-blue-800 font-semibold text-sm mb-1 leading-tight">
                Teatro CANOUT - LIMA
            </h4>
            <p class="text-yellow-500 text-xs font-medium mb-2">
                Vie. 11 Agosto, 20:00 hrs
            </p>
            <p class="text-black font-bold text-sm">
                Hablando Huevadas
            </p>
        </a>

        <!--Evento 5 Trueno -->
        <a href="https://www.ticketgo.pe/eventos/trueno"
        class="border border-gray-300 rounded-md p-4 text-sm max-w-[240px] mx-auto block transform transition duration-200 hover:scale-105 hover:shadow-lg focus:scale-105 focus:shadow-lg"
        aria-label="Evento Trueno en Costa 21 San Miguel, Lima, 11 Noviembre, 21:00 hrs">

            <img src="{{ asset('images/Eventotrueno.jpg') }}"
                alt="Cartel del evento Trueno"
                class="h-[240px] w-full object-cover rounded-sm mb-3" />

            <h4 class="text-blue-800 font-semibold text-sm mb-1 leading-tight">
                Multiespacio Costa 21 San Miguel - Lima
            </h4>
            <p class="text-yellow-500 text-xs font-medium mb-2">
                Vie. 11 Noviembre, 21:00 hrs
            </p>
            <p class="text-black font-bold text-sm">
                Trueno
            </p>
        </a>

        <!--Evento 6 de  Emilia Mernes -->
        <a href="https://www.ticketgo.pe/eventos/emilia-mernes"
        class="border border-gray-300 rounded-md p-4 text-sm max-w-[240px] mx-auto block transform transition duration-200 hover:scale-105 hover:shadow-lg focus:scale-105 focus:shadow-lg"
        aria-label="Evento Emilia Mernes en Costa 21 San Miguel, Lima, EMILIA TOLLER 2023">

            <img src="{{ asset('images/Eventoemilia.jpg') }}"
                alt="Cartel del evento Emilia Mernes"
                class="h-[240px] w-full object-cover rounded-sm mb-3" />

            <h4 class="text-blue-800 font-semibold text-sm mb-1 leading-tight">
                Multiespacio Costa 21 San Miguel - Lima
            </h4>
            <p class="text-yellow-500 text-xs font-medium mb-2">
                EMILIA TOLLER 2023
            </p>
            <p class="text-black font-bold text-sm">
                Emilia Mernes
            </p>
        </a>
    </section>
  </main>
@endsection