# Configuración de Email para Envío de Vouchers

## Descripción
Este sistema permite enviar vouchers de compra por email a los usuarios. Para que funcione correctamente, necesitas configurar las variables de entorno para el envío de emails.

## Configuración Requerida

### 1. Variables de Entorno (.env)
Agrega las siguientes variables a tu archivo `.env`:

```env
# Configuración de Email
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu-email@gmail.com
MAIL_PASSWORD=tu-contraseña-de-aplicación
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tu-email@gmail.com
MAIL_FROM_NAME="TicketGO"
```

### 2. Configuración para Gmail
Si usas Gmail, necesitas:

1. **Habilitar la verificación en dos pasos** en tu cuenta de Google
2. **Generar una contraseña de aplicación**:
   - Ve a Configuración de tu cuenta de Google
   - Seguridad > Verificación en dos pasos
   - Contraseñas de aplicación
   - Genera una nueva contraseña para "Laravel"

### 3. Configuración para Otros Proveedores

#### Mailgun
```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=tu-dominio.mailgun.org
MAILGUN_SECRET=tu-api-key
```

#### SendGrid
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=tu-sendgrid-api-key
```

#### Amazon SES
```env
MAIL_MAILER=ses
AWS_ACCESS_KEY_ID=tu-access-key
AWS_SECRET_ACCESS_KEY=tu-secret-key
AWS_DEFAULT_REGION=us-east-1
```

## Funcionalidades Implementadas

### 1. Clase Mail (VoucherCompraMail)
- **Ubicación**: `app/Mail/VoucherCompraMail.php`
- **Función**: Maneja el envío del email con el voucher
- **Datos incluidos**: Información de la compra, evento, tickets y usuario

### 2. Clase Mail (BoletaCompraMail)
- **Ubicación**: `app/Mail/BoletaCompraMail.php`
- **Función**: Maneja el envío automático de la boleta después del pago
- **Datos incluidos**: Información completa de la compra, pago y boleta PDF adjunta

### 3. Vista del Email (Voucher)
- **Ubicación**: `resources/views/emails/voucher-compra.blade.php`
- **Características**: 
  - Diseño responsive y profesional
  - Información completa de la compra
  - Instrucciones para el usuario
  - Estilos CSS inline para compatibilidad
  - Notificación de PDF adjunto

### 4. Vista del Email (Boleta)
- **Ubicación**: `resources/views/emails/boleta-compra.blade.php`
- **Características**:
  - Diseño profesional para comprobante de pago
  - Información completa de la transacción
  - Detalles del método de pago
  - Notificación de boleta PDF adjunta

### 5. Vista del PDF (Voucher)
- **Ubicación**: `resources/views/emails/voucher-compra-pdf.blade.php`
- **Características**:
  - **Misma estructura** que `voucher_compra.blade.php`
  - Diseño compacto optimizado para impresión
  - Formato automático con márgenes reducidos
  - Código de validación único
  - Información idéntica al voucher web
  - Estilos CSS optimizados para PDF

### 6. Vista del PDF (Boleta)
- **Ubicación**: `resources/views/usuario/boleta_pdf.blade.php`
- **Características**:
  - Diseño oficial para comprobante de pago
  - Información completa de la transacción
  - Detalles del método de pago
  - Formato A4 para impresión

### 7. Controlador
- **Método**: `enviarVoucherPorEmail($compra_id)`
- **Validaciones**:
  - Usuario autenticado
  - Compra pertenece al usuario
  - Compra está pagada
  - Usuario tiene email válido
- **Funcionalidades**:
  - Genera PDF automáticamente
  - Adjunta PDF al email
  - Manejo de errores en generación de PDF

- **Método**: `enviarBoletaAutomatica($compra_id, $datosPago)`
- **Validaciones**:
  - Compra existe y está pagada
  - Usuario tiene email válido
- **Funcionalidades**:
  - Envío automático después del pago
  - Genera boleta PDF automáticamente
  - Incluye datos del método de pago
  - Logs para debugging

- **Método**: `pagarCompleto(Request $request)`
- **Validaciones**:
  - Compra válida y pendiente
  - Método de pago requerido
- **Funcionalidades**:
  - Procesa pago completo
  - Actualiza estado de compra
  - Envía boleta automáticamente
  - Retorna respuesta con estado

### 8. Vista de Etickets
- **Ubicación**: `resources/views/usuario/etickets.blade.php`
- **Funcionalidades**:
  - Lista todas las compras pagadas del usuario
  - Botón para enviar voucher por email
  - Indicador de carga
  - Notificaciones de éxito/error

## Rutas Configuradas

```php
// Mostrar etickets del usuario
GET /etickets → usuario.etickets

// Enviar voucher por email
POST /enviar-voucher/{compra_id} → usuario.enviarVoucher

// Procesar pago completo con envío automático de boleta
POST /pago-completo → compra.pagarCompleto
```

## Uso

### Envío Manual de Vouchers:
1. **Acceder a Etickets**: El usuario debe ir a `/etickets`
2. **Ver Compras**: Se muestran todas las compras pagadas
3. **Enviar Voucher**: Hacer clic en "Enviar al correo"
4. **Confirmación**: El sistema envía el email con PDF adjunto y muestra notificación
5. **Descargar PDF**: El usuario puede descargar e imprimir el PDF adjunto

### Envío Automático de Boletas:
1. **Procesar Pago**: El usuario completa el pago (NIBIZ o YAPE)
2. **Pago Exitoso**: El sistema actualiza el estado de la compra
3. **Envío Automático**: Se envía la boleta automáticamente al email del usuario
4. **Confirmación**: El usuario recibe la boleta con PDF adjunto
5. **Comprobante**: La boleta sirve como comprobante oficial de pago

## Manejo de Errores

El sistema maneja los siguientes errores:

- **403**: Usuario no autorizado para acceder a la compra
- **400**: Compra no pagada o email no válido
- **500**: Error interno del servidor

Todos los errores se registran en los logs de Laravel.

## Pruebas

Para probar el sistema:

1. **Configurar email** en `.env`
2. **Crear una compra** y marcarla como pagada
3. **Ir a `/etickets`**
4. **Hacer clic en "Enviar al correo"**
5. **Verificar** que el email llegue correctamente

## Notas Importantes

- El sistema solo envía vouchers de compras **pagadas**
- Solo el **propietario de la compra** puede enviar el voucher
- Los emails se envían de forma **asíncrona** para mejor rendimiento
- Se incluyen **logs** para debugging en caso de errores
- **PDF adjunto**: Cada email incluye un PDF oficial del voucher
- **Estructura idéntica**: El PDF usa la misma estructura que el voucher web
- **Código de validación**: El PDF incluye un código único para verificación
- **Formato compacto**: El PDF está optimizado para impresión con diseño compacto
- **Envío automático**: Las boletas se envían automáticamente después del pago
- **Comprobante oficial**: La boleta sirve como comprobante oficial de pago
- **Datos de pago**: La boleta incluye información del método de pago utilizado 