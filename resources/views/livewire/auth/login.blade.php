<div class="flex flex-1 flex-col md:flex-row px-8 md:px-16 py-6 gap-8 md:gap-16 max-w-7xl mx-auto w-full">
    <section class="flex flex-col max-w-md w-full">
        <div class="flex space-x-6 mb-8 text-sm font-semibold">
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

        <form wire:submit.prevent="login" class="flex flex-col space-y-6">
            <!-- Email -->
            <div class="flex flex-col space-y-1">
                <label class="text-gray-600 text-sm font-normal" for="email">Correo electrónico</label>
                <input
                    class="border border-yellow-500 rounded px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    id="email" type="email" placeholder="Ej: jose@gmail.com" required
                    wire:model="email" />
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div class="flex flex-col space-y-1">
                <label class="text-gray-600 text-sm font-normal" for="password">Contraseña</label>
                <input
                    class="border border-yellow-500 rounded px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    id="password" type="password" placeholder="Contraseña" required
                    wire:model="password" />
                @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- reCAPTCHA -->
            <div class="flex flex-col space-y-2">
                <label class="text-gray-600 text-sm font-normal">Verificación de seguridad</label>
                <x-recaptcha name="g_recaptcha_response" wireModel="g_recaptcha_response" />
                @error('g_recaptcha_response') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit"
                class="w-full text-center bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded shadow">
                Iniciar Sesión
            </button>
        </form>
    </section>

    <section class="flex-1 max-w-lg">
        <img class="rounded-lg w-full h-auto object-cover"
             src="https://tienda.morrisonmusic.pe/wp-content/uploads/2025/01/0x1900-000000-80-0-0.jpg"
             alt="Imagen decorativa" />
    </section>
</div>
