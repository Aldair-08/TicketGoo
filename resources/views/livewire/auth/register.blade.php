<div class="flex flex-col md:flex-row max-w-7xl mx-auto my-10 px-4 md:px-0 gap-12">

    <!-- Formulario de registro -->
    <section class="flex flex-col max-w-xl w-full space-y-6">

        <form wire:submit.prevent="register" class="flex flex-col space-y-4" novalidate autocomplete="off">
            @csrf

            <!-- Nombres -->
            <div>
                <label class="text-sm font-semibold text-gray-600" for="nombres">Nombres</label>
                <input
                    class="border border-yellow-500 rounded px-3 py-2 w-full text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    id="nombres" type="text" placeholder="Ingrese su nombre" required wire:model.defer="nombres"
                    oninput="this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '')" />
                @error('nombres')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Apellidos -->
            <div>
                <label class="text-sm font-semibold text-gray-600" for="apellidos">Apellidos</label>
                <input
                    class="border border-yellow-500 rounded px-3 py-2 w-full text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    id="apellidos" type="text" placeholder="Ingrese su apellido" required
                    wire:model.defer="apellidos"
                    oninput="this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '')" />
                @error('apellidos')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Correo electrónico -->
            <div>
                <label class="text-sm font-semibold text-gray-600" for="correo">Correo electrónico</label>
                <input
                    class="border border-yellow-500 rounded px-3 py-2 w-full text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    id="correo" type="email" placeholder="Correo electrónico" required wire:model.defer="correo" />
                @error('correo')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Celular -->
            <div>
                <label class="text-sm font-semibold text-gray-600" for="celular">Celular</label>
                <input
                    class="border border-yellow-500 rounded px-3 py-2 w-full text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    id="celular" type="text" placeholder="Número de celular" maxlength="11" required
                    wire:model.defer="celular" inputmode="numeric"
                    oninput="let val = this.value.replace(/[^0-9]/g, '').slice(0,9);
                        this.value = val.replace(/(\d{3})(\d{3})(\d{0,3})/, function(_, a, b, c){ return a + (b ? ' ' + b : '') + (c ? ' ' + c : ''); });" />
                @error('celular')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- País -->
            <div>
                <label class="text-sm font-semibold text-gray-600" for="pais">País</label>
                <select id="pais" required
                    class="border border-yellow-500 rounded px-3 py-2 w-full text-sm focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    wire:model.defer="pais">
                    <option value="" disabled>Selecciona tu país</option>
                    <option value="PE">Perú</option>
                </select>
                @error('pais')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Documento -->
            <div>
                <label class="text-sm font-semibold text-gray-600" for="dni" autocomplete="off">DNI</label>
                <input
                    class="border border-yellow-500 rounded px-3 py-2 w-full text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    id="dni" type="text" placeholder="Número de dni" maxlength="8" pattern="\d{8}" required
                    wire:model.defer="dni" inputmode="numeric"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,8)" />
                @error('dni')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Género -->
            <div>
                <label class="text-sm font-semibold text-gray-600">Género</label>
                <div class="flex space-x-4 text-sm mt-1">
                    <label><input type="radio" name="genero" value="M" wire:model.defer="genero" required />
                        Masculino</label>
                    <label><input type="radio" name="genero" value="F" wire:model.defer="genero" />
                        Femenino</label>
                </div>
                @error('genero')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha de nacimiento -->
            <div>
                <label class="text-sm font-semibold text-gray-600" for="cumple">Fecha de nacimiento</label>
                <input
                    class="border border-yellow-500 rounded px-3 py-2 w-full text-sm text-gray-500 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    id="cumple" type="date" required wire:model.defer="cumple" />
                <p class="text-xs text-gray-500 mt-1">* Debes ser mayor de edad para poder registrarte</p>
                @error('cumple')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Contraseña -->
            <div>
                <label class="text-sm font-semibold text-gray-600" for="contrasena">Contraseña</label>
                <input
                    class="border border-yellow-500 rounded px-3 py-2 w-full text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    id="contrasena" type="password" placeholder="Contraseña" required wire:model.defer="contrasena" />
                <p class="text-xs text-gray-500 mt-1">Entre 8 a 16 caracteres, 1 mayúscula, una minúscula, un carácter
                    especial (@$*#) y al menos un número.</p>
                @error('contrasena')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirmar contraseña -->
            <div>
                <label class="text-sm font-semibold text-gray-600" for="confirmar_contrasena">Confirmar
                    contraseña</label>
                <input
                    class="border border-yellow-500 rounded px-3 py-2 w-full text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    id="confirmar_contrasena" type="password" placeholder="Confirmar contraseña" required
                    wire:model.defer="confirmar_contrasena" />
                @error('confirmar_contrasena')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Términos y autorizaciones -->
            <div class="flex flex-col space-y-2 text-sm">
                <label>
                    <input type="checkbox" required wire:model.defer="acepto_terminos" />
                    Declaro que he leído y acepto los <a href="#" class="underline">Términos y Condiciones</a> y
                    la Política de Privacidad de TicketGO
                </label>
                @error('acepto_terminos')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror

                <label>
                    <input type="checkbox" wire:model.defer="acepto_promociones" />
                    Autorizo que TicketGO envíe información sobre eventos y promociones
                </label>
            </div>

            <!-- reCAPTCHA -->
            <div class="flex flex-col space-y-2">
                <label class="text-sm font-semibold text-gray-600">Verificación de seguridad</label>
                <x-recaptcha name="g_recaptcha_response" wireModel="g_recaptcha_response" />
                @error('g_recaptcha_response')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botón -->
            <button type="submit"
                class="w-full text-center bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded shadow">Registrarme</button>
        </form>

        <script>
            // Escuchar evento para reiniciar reCAPTCHA inmediatamente
            document.addEventListener('livewire:init', () => {
                Livewire.on('recaptcha-reset', () => {
                    // Reiniciar reCAPTCHA inmediatamente
                    if (typeof grecaptcha !== 'undefined') {
                        grecaptcha.reset();
                    }
                });
            });
        </script>
    </section>

    <!-- Imagen decorativa -->
    <section class="flex-1 max-w-lg hidden md:block">
        <img class="rounded-lg w-full h-auto object-cover" src="{{ asset('images/9P93.gif') }}"
            alt="Imagen decorativa" />
    </section>
</div>
