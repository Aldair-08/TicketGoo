@extends('layouts.plantilla')
@section('contenido')
<main class="container px-6 mx-auto">

    <br>
    <h3 class=" text-center text-blue-700 text-2xl font-bold mb-6 ">EVENTOS POPULARES</h3>
    <div id="carouselExample" class="carousel slide mb-6" data-bs-ride="carousel">
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
    </div>
    <h3 class=" text-center text-blue-700 text-2xl font-bold mb-6 ">EVENTOS DESTACADOS</h3>
    <section class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-12">

        <article class="border border-gray-300 rounded-lg overflow-hidden shadow-sm transition transform duration-200 hover:scale-[1.02] hover:shadow-lg continueBtn" tabindex="0" data-img="{{ asset('images/Eventodeyvis.jpg') }}">
            <img src="{{ asset('images/Eventodeyvis.jpg') }}" class="w-full h-[240px] object-cover" />
            <div class="p-3 text-xs text-gray-700">
                <p class="font-bold mb-1">Anfiteatro Parque de la Exposición</p>
                <p class="mb-1">Av. 28 de Julio - LIMA</p>
                <p class="text-yellow-400 font-semibold">Dom. 01 de diciembre, 19:00</p>
                <p class="font-semibold mt-2">Deyvis Orozco</p>
            </div>
        </article>

        <a href="{{ route('usuario.dukipreview') }}" aria-label="Ver más sobre el evento DUKI">
            <article class="border border-gray-300 rounded-lg overflow-hidden shadow-sm transition transform duration-200 hover:scale-[1.02] hover:shadow-lg" tabindex="0" data-img="{{ asset('images/Eventoduki.jpg') }}">
                <img src="{{ asset('images/Eventoduki.jpg') }}" class="w-full h-[240px] object-cover" />
                <div class="p-3 text-xs text-gray-700">
                    <p class="font-bold mb-1">Multiespacio Costa21</p>
                    <p class="mb-1">Av. 28 de Julio - LIMA</p>
                    <p class="text-yellow-400 font-semibold">Vie. 31 de octubre, 19:00</p>
                    <p class="font-semibold mt-2">DUKI</p>
                </div>
            </article>
        </a>

        <article class="border border-gray-300 rounded-lg overflow-hidden shadow-sm transition transform duration-200 hover:scale-[1.02] hover:shadow-lg continueBtn" tabindex="0" data-img="{{ asset('images/alvaro.jpg') }}">
            <img src="{{ asset('images/alvaro.jpg') }}" class="w-full h-[240px] object-cover" />
            <div class="p-3 text-xs text-gray-700">
                <p class="font-bold mb-1">Jr. Domeyer 270 Barranco - LIMA</p>
                <p class="mb-1">Av. 28 de Julio - LIMA</p>
                <p class="text-yellow-400 font-semibold">07 Mar - 30 Mayo 2023</p>
                <p class="font-semibold mt-2">Álvaro de la Puente M.</p>
            </div>
        </article>

        <article class="border border-gray-300 rounded-lg overflow-hidden shadow-sm transition transform duration-200 hover:scale-[1.02] hover:shadow-lg continueBtn" tabindex="0" data-img="{{ asset('images/Eventohablando.jpg') }}">
            <img src="{{ asset('images/Eventohablando.jpg') }}" class="w-full h-[240px] object-cover" />
            <div class="p-3 text-xs text-gray-700">
                <p class="font-bold mb-1">Teatro CANOUT - LIMA</p>
                <p class="text-yellow-400 font-semibold">Vie. 11 Agosto, 20:00 hrs</p>
                <p class="font-semibold mt-2">Hablando Huevadas</p>
            </div>
        </article>

        <article class="border border-gray-300 rounded-lg overflow-hidden shadow-sm transition transform duration-200 hover:scale-[1.02] hover:shadow-lg continueBtn" tabindex="0" data-img="{{ asset('images/Eventotrueno.jpg') }}">
            <img src="{{ asset('images/Eventotrueno.jpg') }}" class="w-full h-[240px] object-cover" />
            <div class="p-3 text-xs text-gray-700">
                <p class="font-bold mb-1">Multiespacio Costa 21 San Miguel - Lima</p>
                <p class="text-yellow-400 font-semibold">Vie. 11 Noviembre, 21:00 hrs</p>
                <p class="font-semibold mt-2">Trueno</p>
            </div>
        </article>

        <article class="border border-gray-300 rounded-lg overflow-hidden shadow-sm transition transform duration-200 hover:scale-[1.02] hover:shadow-lg continueBtn" tabindex="0" data-img="{{ asset('images/Eventoemilia.jpg') }}">
            <img src="{{ asset('images/Eventoemilia.jpg') }}" class="w-full h-[240px] object-cover" />
            <div class="p-3 text-xs text-gray-700">
                <p class="font-bold mb-1">Multiespacio Costa 21 San Miguel - Lima</p>
                <p class="text-yellow-400 font-semibold">EMILIA TOLLER 2023</p>
                <p class="font-semibold mt-2">Emilia Mernes</p>
            </div>
        </article>
    </section>
    <div id="successModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded shadow-lg text-center">
            <h2 class="text-lg font-bold">Proximamente 😀 </h2>
        </div>
</main>
<script>
    const successModal = document.getElementById("successModal");
    const continueBtns = document.querySelectorAll(".continueBtn");

    continueBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            successModal.classList.remove("hidden");
            setTimeout(() => {
                successModal.classList.add("hidden");
            }, 2500);
        });
    });
</script>
@endsection