# Configuración de Google reCAPTCHA v2 en TicketGO

## Problema Resuelto: "The g recaptcha response field is required"

### Descripción del Problema
El error "The g recaptcha response field is required" ocurre cuando el token de reCAPTCHA no se envía correctamente desde el frontend al componente Livewire. Esto sucede porque:

1. El token de reCAPTCHA no se captura correctamente en el campo hidden
2. Livewire no recibe el valor del token
3. La validación falla porque el campo está vacío

### Solución Implementada

#### 1. Componente reCAPTCHA Mejorado
El componente `resources/views/components/recaptcha.blade.php` ha sido actualizado para:

- Usar `wire:ignore` para evitar que Livewire interfiera con reCAPTCHA
- Implementar callbacks específicos para cada estado (success, expired, error)
- Actualizar directamente el componente Livewire usando `Livewire.find().set()`
- Disparar eventos de input para asegurar la captura del valor

#### 2. Integración con Livewire
Los componentes de Login y Register ahora:

- Usan `wire:model="g_recaptcha_response"` en el componente reCAPTCHA
- Tienen validación mejorada que verifica si el token está presente
- Manejan errores de manera más específica

#### 3. Estilos CSS
Se agregaron estilos para mejorar la apariencia:

```css
.recaptcha-wrapper {
  border: 1px solid #e5e7eb;
  border-radius: 0.375rem;
  padding: 1rem;
  background-color: #f9fafb;
}

.recaptcha-wrapper.border-red-500 {
  border-color: #ef4444;
  background-color: #fef2f2;
}
```

## Configuración Inicial

### 1. Obtener Claves de reCAPTCHA

1. Ve a [Google reCAPTCHA Admin Console](https://www.google.com/recaptcha/admin)
2. Crea un nuevo sitio
3. Selecciona "reCAPTCHA v2" → "I'm not a robot" Checkbox
4. Agrega tu dominio (ej: `localhost`, `tudominio.com`)
5. Copia las claves Site Key y Secret Key

### 2. Configurar Variables de Entorno

Agrega estas líneas a tu archivo `.env`:

```env
RECAPTCHA_SITE_KEY=tu_site_key_aqui
RECAPTCHA_SECRET_KEY=tu_secret_key_aqui
```

### 3. Configurar Services

El archivo `config/services.php` ya incluye la configuración:

```php
'recaptcha' => [
    'site_key' => env('RECAPTCHA_SITE_KEY'),
    'secret_key' => env('RECAPTCHA_SECRET_KEY'),
],
```

### 4. Middleware de Validación

El middleware `app/Http/Middleware/VerifyRecaptcha.php` está configurado para validar tokens.

### 5. Registro en Kernel

El middleware está registrado en `app/Http/Kernel.php`:

```php
protected $routeMiddleware = [
    // ... otros middlewares
    'recaptcha' => \App\Http\Middleware\VerifyRecaptcha::class,
];
```

## Uso en Formularios

### Login
```php
// app/Livewire/Auth/Login.php
public $g_recaptcha_response = '';

protected function rules()
{
    return [
        'email' => 'required|email',
        'password' => 'required',
        'g_recaptcha_response' => 'required',
    ];
}

public function authenticate()
{
    $this->validate();
    $this->verifyRecaptcha();
    // ... resto del código
}
```

### Register
```php
// app/Livewire/Auth/Register.php
public $g_recaptcha_response = '';

protected function rules()
{
    return [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'g_recaptcha_response' => 'required',
    ];
}

public function register()
{
    $this->validate();
    $this->verifyRecaptcha();
    // ... resto del código
}
```

### Vista
```blade
<!-- resources/views/livewire/auth/login.blade.php -->
<div class="flex flex-col space-y-2">
    <label class="text-gray-600 text-sm font-normal">Verificación de seguridad</label>
    <x-recaptcha name="g_recaptcha_response" wire:model="g_recaptcha_response" />
    @error('g_recaptcha_response') 
        <span class="text-red-600 text-sm">{{ $message }}</span> 
    @enderror
</div>
```

## Verificación del Token

### Método de Verificación
```php
protected function verifyRecaptcha(): void
{
    // Verificar si el token está presente
    if (empty($this->g_recaptcha_response)) {
        throw ValidationException::withMessages([
            'g_recaptcha_response' => 'Por favor, completa el reCAPTCHA.',
        ]);
    }

    $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret' => config('services.recaptcha.secret_key'),
        'response' => $this->g_recaptcha_response,
        'remoteip' => request()->ip(),
    ]);

    $result = $response->json();

    if (!$result['success']) {
        throw ValidationException::withMessages([
            'g_recaptcha_response' => 'Verificación reCAPTCHA fallida. Por favor, intenta nuevamente.',
        ]);
    }
}
```

## Scripts Requeridos

### En el Layout Principal
```html
<!-- resources/views/components/layouts/plantilla.blade.php -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
```

## Solución de Problemas

### 1. Error "The g recaptcha response field is required"

**Causa:** El token no se está enviando correctamente al backend.

**Solución:**
- Verifica que las claves de reCAPTCHA estén configuradas correctamente
- Asegúrate de que el dominio esté autorizado en la consola de reCAPTCHA
- Verifica que el script de reCAPTCHA se esté cargando correctamente

### 2. reCAPTCHA no aparece

**Causa:** El script no se carga o hay errores de JavaScript.

**Solución:**
- Verifica que el script esté incluido en el layout
- Revisa la consola del navegador para errores de JavaScript
- Asegúrate de que la Site Key sea correcta

### 3. Validación falla aunque reCAPTCHA esté completado

**Causa:** El token no se está capturando correctamente en Livewire.

**Solución:**
- Verifica que el componente use `wire:model="g_recaptcha_response"`
- Asegúrate de que el campo hidden tenga el nombre correcto
- Revisa que los callbacks de reCAPTCHA estén funcionando

### 4. reCAPTCHA se resetea al enviar el formulario

**Causa:** Livewire está recargando el componente.

**Solución:**
- El componente usa `wire:ignore` para evitar esto
- Si persiste, verifica que no haya otros elementos causando recargas

## Testing

### 1. Verificar Configuración
```bash
php artisan tinker
>>> config('services.recaptcha.site_key')
>>> config('services.recaptcha.secret_key')
```

### 2. Probar Validación
- Completa el reCAPTCHA y envía el formulario
- Verifica que no aparezca el error de campo requerido
- Revisa los logs de Laravel para errores de validación

### 3. Verificar en Producción
- Asegúrate de que las claves de producción estén configuradas
- Verifica que el dominio esté autorizado en la consola de reCAPTCHA
- Prueba el flujo completo de login/registro

## Notas Importantes

1. **Dominios Autorizados:** Asegúrate de agregar todos los dominios necesarios en la consola de reCAPTCHA (localhost para desarrollo, dominio real para producción).

2. **Claves Diferentes:** Usa claves diferentes para desarrollo y producción.

3. **Rate Limiting:** Google reCAPTCHA tiene límites de uso. Para sitios con mucho tráfico, considera usar reCAPTCHA v3.

4. **Accesibilidad:** reCAPTCHA v2 puede ser problemático para usuarios con discapacidades. Considera alternativas como hCaptcha para mejor accesibilidad.

5. **Backup:** Si reCAPTCHA falla, considera implementar un fallback o método alternativo de verificación.

## Archivos Modificados

- `resources/views/components/recaptcha.blade.php` - Componente reCAPTCHA
- `resources/views/livewire/auth/login.blade.php` - Vista de login de usuario
- `resources/views/livewire/auth/register.blade.php` - Vista de registro de usuario
- `resources/views/admin/login.blade.php` - Vista de login de administrador
- `app/Livewire/Auth/Login.php` - Componente Livewire de login de usuario
- `app/Livewire/Auth/Register.php` - Componente Livewire de registro de usuario
- `app/Http/Controllers/AdminAuthController.php` - Controlador de login de administrador
- `resources/views/components/layouts/plantilla.blade.php` - Layout principal
- `app/Http/Middleware/VerifyRecaptcha.php` - Middleware de validación
- `app/Http/Kernel.php` - Registro del middleware
- `config/services.php` - Configuración de servicios

## Implementación en Login de Administrador

### Características Específicas

1. **Controlador Tradicional**: El login de administrador usa un controlador tradicional en lugar de Livewire
2. **Validación en Controlador**: La validación de reCAPTCHA se realiza directamente en el método `login()`
3. **Manejo de Errores**: Los errores se manejan usando `ValidationException` y se muestran en la vista
4. **Sin wire:model**: No se usa `wire:model` ya que no es un componente Livewire

### Diferencias con Login de Usuario

| Aspecto | Login Usuario (Livewire) | Login Admin (Controlador) |
|---------|-------------------------|---------------------------|
| Tecnología | Livewire | Controlador tradicional |
| Validación | En componente Livewire | En método del controlador |
| Vista | `wire:model` requerido | Sin `wire:model` |
| Manejo de errores | `$this->addError()` | `ValidationException` |
| ReCAPTCHA | `wireModel="g_recaptcha_response"` | `name="g_recaptcha_response"` | 