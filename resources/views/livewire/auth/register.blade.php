<div class="flex flex-col md:flex-row max-w-7xl mx-auto my-10 px-4 md:px-0 gap-12">

    <!-- Formulario de registro -->
    <section class="flex flex-col max-w-xl w-full space-y-6">

        <div class="flex space-x-6 mb-6 text-sm font-semibold">
            <button class="text-blue-800">Usuario</button>
        </div>

        <form wire:submit.prevent="register" class="flex flex-col space-y-4" novalidate>
            @csrf

            <!-- Nombres -->
            <div>
                <label class="text-sm font-semibold text-gray-600" for="nombres">Nombres</label>
                <input
                    class="border border-yellow-500 rounded px-3 py-2 w-full text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    id="nombres" type="text" placeholder="Ej: JOSE" required
                    wire:model.defer="nombres"
                />
                @error('nombres') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Apellidos -->
            <div>
                <label class="text-sm font-semibold text-gray-600" for="apellidos">Apellidos</label>
                <input
                    class="border border-yellow-500 rounded px-3 py-2 w-full text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    id="apellidos" type="text" placeholder="Ej: MUÑOZ" required
                    wire:model.defer="apellidos"
                />
                @error('apellidos') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Correo electrónico -->
            <div>
                <label class="text-sm font-semibold text-gray-600" for="correo">Correo electrónico</label>
                <input
                    class="border border-yellow-500 rounded px-3 py-2 w-full text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    id="correo" type="email" placeholder="Ej: jose@gmail.com" required
                    wire:model.defer="correo"
                />
                @error('correo') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Celular -->
            <div>
                <label class="text-sm font-semibold text-gray-600" for="celular">Celular</label>
                <input
                    class="border border-yellow-500 rounded px-3 py-2 w-full text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    id="celular" type="tel" placeholder="+51 945 567 921" required
                    wire:model.defer="celular"
                />
                @error('celular') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- País -->
            <div>
                <label class="text-sm font-semibold text-gray-600" for="pais">País</label>
                <select
                    id="pais"
                    required
                    class="border border-yellow-500 rounded px-3 py-2 w-full text-sm focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    wire:model.defer="pais"
                >
                    <option value="" disabled>Selecciona tu país</option>
                    <option value="PE">Perú</option>
                    <option value="CL">Chile</option>
                    <option value="AR">Argentina</option>
                </select>
                @error('pais') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Documento -->
            <div>
                <label class="text-sm font-semibold text-gray-600" for="dni">DNI</label>
                <input
                    class="border border-yellow-500 rounded px-3 py-2 w-full text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    id="dni" type="text" placeholder="Ej: 33333333" maxlength="8" required
                    wire:model.defer="dni"
                />
                @error('dni') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Género -->
            <div>
                <label class="text-sm font-semibold text-gray-600">Género</label>
                <div class="flex space-x-4 text-sm mt-1">
                    <label><input type="radio" name="genero" value="M" wire:model.defer="genero" required /> Masculino</label>
                    <label><input type="radio" name="genero" value="F" wire:model.defer="genero" /> Femenino</label>
                </div>
                @error('genero') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Fecha de nacimiento -->
            <div>
                <label class="text-sm font-semibold text-gray-600" for="cumple">Fecha de nacimiento</label>
                <input
                    class="border border-yellow-500 rounded px-3 py-2 w-full text-sm text-gray-500 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    id="cumple" type="date" required
                    wire:model.defer="cumple"
                />
                <p class="text-xs text-gray-500 mt-1">* Debes ser mayor de edad para poder registrarte</p>
                @error('cumple') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Contraseña -->
            <div>
                <label class="text-sm font-semibold text-gray-600" for="contrasena">Contraseña</label>
                <input
                    class="border border-yellow-500 rounded px-3 py-2 w-full text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    id="contrasena" type="password" placeholder="Contraseña" required
                    wire:model.defer="contrasena"
                />
                <p class="text-xs text-gray-500 mt-1">Entre 8 a 16 caracteres, 1 mayúscula, una minúscula, un carácter especial (@$*#) y al menos un número.</p>
                @error('contrasena') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Confirmar contraseña -->
            <div>
                <label class="text-sm font-semibold text-gray-600" for="confirmar_contrasena">Confirmar contraseña</label>
                <input
                    class="border border-yellow-500 rounded px-3 py-2 w-full text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-yellow-500"
                    id="confirmar_contrasena" type="password" placeholder="Confirmar contraseña" required
                    wire:model.defer="confirmar_contrasena"
                />
                @error('confirmar_contrasena') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Términos y autorizaciones -->
            <div class="flex flex-col space-y-2 text-sm">
                <label>
                    <input type="checkbox" required wire:model.defer="acepto_terminos" />
                    Declaro que he leído y acepto los <a href="#" class="underline">Términos y Condiciones</a> y la Política de Privacidad de TicketGO
                </label>
                @error('acepto_terminos') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

                <label>
                    <input type="checkbox" wire:model.defer="acepto_promociones" />
                    Autorizo que TicketGO envíe información sobre eventos y promociones
                </label>
            </div>

            <!-- No soy un robot -->
            <div class="flex items-center space-x-3 bg-gray-300 rounded px-4 py-2 w-max">
                <input class="w-5 h-5" id="no_robot" type="checkbox" required wire:model.defer="no_robot" />
                <label class="text-xs font-bold select-none" for="no_robot">No soy un robot</label>
                <img src="{{ asset('images/recapcha.png') }}" class="h-6 w-auto object-contain rounded shadow" />
                @error('no_robot') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Botón -->
            <button type="submit" class="btn-yellow w-full text-center mt-4">Registrarme</button>
        </form>
    </section>

    <!-- Imagen decorativa -->
    <section class="flex-1 max-w-lg hidden md:block">
        <img class="rounded-lg w-full h-auto object-cover"
             src="{{ asset('images/9P93.gif') }}"
             alt="Imagen decorativa" />
    </section>
</div>
