<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TicketGO Login</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .btn-yellow {
            background-color: yellow;
            color: black;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }

        .btn-yellow:hover {
            background-color: #eab308;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    <main class="flex flex-1 flex-col md:flex-row px-8 md:px-16 py-6 gap-8 md:gap-16 max-w-7xl mx-auto w-full">
        <section class="flex flex-col max-w-md w-full">
            <div class="flex space-x-6 mb-6 text-sm font-semibold">
                <button class="text-blue-800">Usuario</button>
                <a href="{{ route('admin.login') }}" class="text-black hover:text-blue-800">Administrador</a>
            </div>

            @if (session('status'))
                <div class="text-green-600 text-sm mb-4">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="text-red-600 text-sm mb-4">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            {{-- FORMULARIO LIVEWIRE --}}
            <form wire:submit.prevent="login" class="flex flex-col space-y-6">
                @csrf

                <!-- Email -->
                <div class="flex flex-col space-y-1">
                    <label class="text-gray-600 text-sm font-normal" for="email">Correo electrónico</label>
                    <input
                        class="border border-yellow-500 rounded px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                        id="email" type="email" placeholder="Ej: jose@gmail.com" required
                        wire:model="email" />
                    @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Contraseña -->
                <div class="flex flex-col space-y-1">
                    <label class="text-gray-600 text-sm font-normal" for="password">Contraseña</label>
                    <input
                        class="border border-yellow-500 rounded px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                        id="password" type="password" placeholder="Contraseña" required
                        wire:model="password" />
                    @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- No soy un robot -->
                <div class="flex items-center space-x-3 bg-gray-300 rounded px-4 py-2 w-max">
                    <input class="w-5 h-5" id="robot" type="checkbox" wire:model="robot" required />
                    <label class="text-xs font-bold select-none" for="robot">No soy un robot</label>
                    <img src="{{ asset('images/recapcha.png') }}" class="h-6 w-auto object-contain rounded shadow" />
                    @error('robot') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Botón -->
                <button type="submit" class="btn-yellow w-full text-center">Iniciar Sesión</button>
            </form>
        </section>

        <section class="flex-1 max-w-lg">
            <img class="rounded-lg w-full h-auto object-cover"
                 src="https://tienda.morrisonmusic.pe/wp-content/uploads/2025/01/0x1900-000000-80-0-0.jpg"
                 alt="Imagen decorativa" />
        </section>
    </main>
</body>
</html>
