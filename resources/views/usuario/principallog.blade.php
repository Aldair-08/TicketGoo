@extends('layouts.autenticado')
@section('contenido')
    <div class="w-screen px-0 mx-0 relative left-1/2 right-1/2 -translate-x-1/2">

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
    <h3 class=" text-center text-blue-700 text-2xl font-bold mb-6 ">EVENTOS DISPONIBLES</h3>
    <section class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-12">

        @foreach ($eventos as $evento)
            @if ($evento && $evento->id_evento)
                <a href="{{ route('evento.show', $evento->id_evento) }}">
                    <article
                        class="border border-gray-300 rounded-lg overflow-hidden shadow-sm transition transform duration-200 hover:scale-[1.02] hover:shadow-lg continueBtn"
                        tabindex="0">
                        <img src="{{ $evento->imagen ? asset('storage/' . $evento->imagen) : asset('images/default-event.jpg') }}"
                            class="w-full h-[240px] object-cover" />
                        <div class="p-3 text-xs text-gray-700">
                            <p class="mb-1">{{ $evento->categoria }}</p>
                            <p class="font-semibold mt-2">{{ $evento->nombre }}</p>
                            <p class="font-bold mb-1">{{ $evento->ubicacion }}</p>
                            <p class="text-yellow-400 font-semibold">
                                {{ \Carbon\Carbon::parse($evento->fecha)->translatedFormat('d M, H:i') }}</p>
                        </div>
                    </article>
                </a>
            @endif
        @endforeach
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
