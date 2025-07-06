@props(['name' => 'g-recaptcha-response', 'required' => true, 'wireModel' => null])

<div class="recaptcha-wrapper" wire:ignore>
    <div class="g-recaptcha" 
         data-sitekey="{{ config('services.recaptcha.site_key') }}"
         data-callback="onRecaptchaSuccess"
         data-expired-callback="onRecaptchaExpired"
         data-error-callback="onRecaptchaError">
    </div>

    <input type="hidden" name="{{ $name }}" id="{{ $name }}" 
           @if($wireModel) wire:model="{{ $wireModel }}" @endif required>
</div>

<script>
    function onRecaptchaSuccess(token) {
        const hiddenInput = document.getElementById('{{ $name }}');
        hiddenInput.value = token;
        
        // Para Livewire, necesitamos disparar el evento de manera específica
        if (typeof Livewire !== 'undefined') {
            // Encontrar el componente Livewire padre
            const livewireComponent = hiddenInput.closest('[wire\\:id]');
            if (livewireComponent) {
                const wireId = livewireComponent.getAttribute('wire:id');
                const component = Livewire.find(wireId);
                if (component) {
                    // Actualizar el valor en Livewire
                    component.set('{{ $name }}', token);
                }
            }
        }
        
        // También disparar el evento input para asegurar que se capture
        hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
        
        // Remover errores visuales
        const wrapper = hiddenInput.closest('.recaptcha-wrapper');
        wrapper.classList.remove('border-red-500');
        const errorElement = wrapper.querySelector('.recaptcha-error');
        if (errorElement) {
            errorElement.remove();
        }
    }

    function onRecaptchaExpired() {
        const hiddenInput = document.getElementById('{{ $name }}');
        hiddenInput.value = '';
        
        // Limpiar en Livewire
        if (typeof Livewire !== 'undefined') {
            const livewireComponent = hiddenInput.closest('[wire\\:id]');
            if (livewireComponent) {
                const wireId = livewireComponent.getAttribute('wire:id');
                const component = Livewire.find(wireId);
                if (component) {
                    component.set('{{ $name }}', '');
                }
            }
        }
        
        hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
    }

    function onRecaptchaError() {
        const hiddenInput = document.getElementById('{{ $name }}');
        hiddenInput.value = '';
        
        // Limpiar en Livewire
        if (typeof Livewire !== 'undefined') {
            const livewireComponent = hiddenInput.closest('[wire\\:id]');
            if (livewireComponent) {
                const wireId = livewireComponent.getAttribute('wire:id');
                const component = Livewire.find(wireId);
                if (component) {
                    component.set('{{ $name }}', '');
                }
            }
        }
        
        hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
        
        // Mostrar error visual
        const wrapper = hiddenInput.closest('.recaptcha-wrapper');
        wrapper.classList.add('border-red-500');
        
        // Agregar mensaje de error si no existe
        if (!wrapper.querySelector('.recaptcha-error')) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'recaptcha-error text-red-600 text-sm mt-1';
            errorDiv.textContent = 'Por favor, completa el reCAPTCHA.';
            wrapper.appendChild(errorDiv);
        }
    }

    // Función para resetear reCAPTCHA
    function resetRecaptcha() {
        if (typeof grecaptcha !== 'undefined') {
            grecaptcha.reset();
        }
    }
</script> 