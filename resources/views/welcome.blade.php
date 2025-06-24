@extends('layouts.plantilla')
@section('contenido')
    <div class="w-full max-w-8xl mx-auto">
        <br>
        <div class="relative overflow-hidden h-[650px] mb-6" id="custom-carousel">
            @if ($imagenes->count())
                @foreach ($imagenes as $i => $img)
                    <img src="{{ asset('storage/' . $img->ruta) }}" alt="Imagen carrusel {{ $i + 1 }}"
                        class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700 {{ $i === 0 ? 'opacity-100 z-10' : 'opacity-0 z-10' }}"
                        data-carousel-item="{{ $i }}">
                @endforeach
                <button type="button" id="prevBtn"
                    class="absolute left-0 top-0 h-full w-1/6 flex items-center justify-start bg-transparent hover:bg-white/0 rounded-none p-0 z-10">
                    <span class="bg-white/70 hover:bg-white rounded-full p-2 shadow ml-2">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </span>
                </button>
                <button type="button" id="nextBtn"
                    class="absolute right-0 top-0 h-full w-1/6 flex items-center justify-end bg-transparent hover:bg-white/0 rounded-none p-0 z-10">
                    <span class="bg-white/70 hover:bg-white rounded-full p-2 shadow mr-2">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </button>
                <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-2 z-20">
                    @foreach ($imagenes as $i => $img)
                        <button type="button"
                            class="w-4 h-4 rounded-full bg-black/70 backdrop-blur-sm transition {{ $i === 0 ? 'bg-white/50' : '' }}"
                            data-carousel-dot="{{ $i }}"></button>
                    @endforeach
                </div>
            @else
                <div class="flex items-center justify-center h-full bg-gray-200">
                    <span class="text-gray-500">No hay imágenes en el carrusel.</span>
                </div>
            @endif
        </div>
    </div>
    <main class="container px-6 mx-auto">
        <h3 class=" text-center text-blue-700 text-2xl font-bold mb-6 ">EVENTOS DISPONIBLES</h3>
        <section class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-12">

            @foreach ($eventos as $evento)
                <article
                    class="border border-gray-300 rounded-lg overflow-hidden shadow-sm transition transform duration-200 hover:scale-[1.02] hover:shadow-lg continueBtn"
                    tabindex="0" data-img="{{ asset('images/Eventodeyvis.jpg') }}">
                    <img src="{{ $evento->imagen ? asset('storage/' . $evento->imagen) : asset('images/default-event.jpg') }}"
                        class="w-full h-[240px] object-cover" />
                    <div class="p-3 text-xs text-gray-700">
                        <p class="mb-1">{{ $evento->categoria }}</p>
                        <p class="font-semibold mt-2">{{ $evento->nombre }}</p>
                        <p class="font-bold mb-1">{{ $evento->ubicacion }}</p>

                        <p class="text-gray-700 font-semibold">
                            {{ \Carbon\Carbon::parse($evento->fecha)->translatedFormat('d M, H:i') }}</p>

                    </div>
                </article>
            @endforeach
        </section>
        <div id="successModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden z-50">
            <div class="bg-white p-6 rounded shadow-lg text-center">
                <h2 class="text-lg font-bold">Proximamente 😀 </h2>
            </div>
    </main>
    <script>
        // Carrusel simple con Tailwind y JS
        const items = document.querySelectorAll('[data-carousel-item]');
        const dots = document.querySelectorAll('[data-carousel-dot]');
        let current = 0;

        function showSlide(idx) {
            items.forEach((img, i) => {
                img.classList.toggle('opacity-100', i === idx);
                img.classList.toggle('z-10', i === idx);
                img.classList.toggle('opacity-0', i !== idx);
                img.classList.toggle('z-0', i !== idx);
            });
            dots.forEach((dot, i) => {
                dot.classList.toggle('bg-white/50', i === idx);
            });
            current = idx;
        }

        document.getElementById('prevBtn').onclick = () => showSlide((current - 1 + items.length) % items.length);
        document.getElementById('nextBtn').onclick = () => showSlide((current + 1) % items.length);
        dots.forEach((dot, i) => dot.onclick = () => showSlide(i));

        // Auto-slide
        setInterval(() => showSlide((current + 1) % items.length), 5000);

        // Modal
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
