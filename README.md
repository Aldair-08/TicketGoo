# 🎫 TicketGoo

**Sistema de Gestión y Venta de Entradas para Eventos**

TicketGoo es una plataforma web desarrollada en Laravel que permite la gestión completa de eventos, venta de entradas y administración de proveedores. El sistema incluye un panel de administración robusto y una interfaz de usuario moderna para la compra de tickets.

## 📋 Índice

- [Características](#-características)
- [Tecnologías Utilizadas](#-tecnologías-utilizadas)
- [Requisitos del Sistema](#-requisitos-del-sistema)
- [Instalación](#-instalación)
- [Configuración](#-configuración)
- [Credenciales de Acceso](#-credenciales-de-acceso)
- [Uso](#-uso)
- [Solución de Problemas](#-solución-de-problemas)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [API y Endpoints](#-api-y-endpoints)
- [Despliegue](#-despliegue)
- [Contribución](#-contribución)
- [Licencia](#-licencia)

## ✨ Características

### 🎭 Gestión de Eventos
- **Creación y edición de eventos** con información completa (nombre, categoría, descripción, fecha, ubicación)
- **Gestión de imágenes** para eventos (imagen principal y de fondo)
- **Categorización** de eventos (Conciertos, Teatro, Exhibiciones de Arte)
- **Ubicaciones predefinidas** (Anfiteatro P. Exposición, Costa21, Estadio Nacional, Teatro Canout)
- **Sistema de publicación** de eventos con configuración de entradas

### 🎟️ Sistema de Entradas
- **Tipos de entradas**: VIP, General, Preferencial
- **Gestión de stock** en tiempo real
- **Precios configurables** por tipo de entrada
- **Límite de tickets por persona** configurable
- **Control de disponibilidad** automático

### 🛒 Proceso de Compra
- **Selección de tickets** con validación de stock
- **Cálculo automático** de totales
- **Formatos de entrega**: E-ticket y Retiro en tienda
- **Generación de boletas** en PDF
- **Envío automático** de confirmaciones por email
- **Historial de compras** para usuarios

### 👥 Gestión de Usuarios
- **Sistema de autenticación** completo con Laravel Fortify
- **Verificación de email** para usuarios
- **Perfiles de usuario** personalizables
- **Historial de compras** y e-tickets
- **Gestión de contraseñas** segura

### 🏢 Panel de Administración
- **Dashboard administrativo** con estadísticas
- **Gestión de proveedores** (CRUD completo)
- **Gestión de eventos** (crear, editar, eliminar, publicar)
- **Sistema de promociones** con fechas de vigencia
- **Gestión de carrusel** para la página principal
- **Control de acceso** basado en roles

### 🎨 Interfaz de Usuario
- **Diseño responsive** con Tailwind CSS
- **Componentes Livewire** para interactividad
- **Navegación intuitiva** y moderna
- **Optimización para móviles**
- **Iconografía FontAwesome**

## 🛠️ Tecnologías Utilizadas

### Backend
- **Laravel 12.x** - Framework PHP
- **PHP 8.2+** - Lenguaje de programación
- **MySQL/SQLite** - Base de datos
- **Laravel Fortify** - Autenticación
- **Laravel Livewire** - Componentes dinámicos
- **DomPDF** - Generación de PDFs

### Frontend
- **Tailwind CSS 4.x** - Framework CSS
- **Vite** - Build tool
- **Alpine.js** - JavaScript reactivo
- **FontAwesome** - Iconos

### Herramientas de Desarrollo
- **Composer** - Gestión de dependencias PHP
- **NPM** - Gestión de dependencias Node.js
- **Laravel Sail** - Entorno de desarrollo Docker
- **Pest** - Framework de testing

## 📋 Requisitos del Sistema

### Requisitos Mínimos
- **PHP**: 8.2 o superior
- **Composer**: 2.0 o superior
- **Node.js**: 18.0 o superior
- **NPM**: 8.0 o superior
- **Base de datos**: MySQL 8.0+ o SQLite 3.x

### Extensiones PHP Requeridas
```bash
- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
```

### Extensiones PHP Opcionales (Recomendadas)
```bash
- Redis PHP Extension (para caché)
- Memcached PHP Extension (para caché)
- GD PHP Extension (para procesamiento de imágenes)
```

## 🚀 Instalación

### 1. Clonar el Repositorio
```bash
git clone https://github.com/tu-usuario/ticketgoo.git
cd ticketgoo
```

### 2. Instalar Dependencias PHP
```bash
composer install
```

### 3. Instalar Dependencias Node.js
```bash
npm install
```

### 4. Configurar Variables de Entorno
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configurar Base de Datos

#### Opción A: MySQL
Edita el archivo `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ticketgoo
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

Crea la base de datos:
```bash
mysql -u root -p
CREATE DATABASE ticketgoo;
exit;
```

#### Opción B: SQLite (Recomendado para desarrollo)
Edita el archivo `.env`:
```env
DB_CONNECTION=sqlite
DB_DATABASE=/ruta/absoluta/a/database/database.sqlite
```

Crea el archivo de base de datos:
```bash
touch database/database.sqlite
```

### 6. Ejecutar Migraciones
```bash
php artisan migrate
```

### 7. Ejecutar Seeders (Datos de Prueba)
```bash
php artisan db:seed
```

### 8. Compilar Assets
```bash
npm run build
```

### 9. Configurar Almacenamiento
```bash
php artisan storage:link
```

### 10. Configurar Permisos (Solo Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
```

### 11. Configurar Colas (Opcional)
```bash
php artisan queue:table
php artisan migrate
```

## ⚙️ Configuración

### Configuración de Email
Edita el archivo `.env` para configurar el envío de emails:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu_email@gmail.com
MAIL_PASSWORD=tu_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tu_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

**Nota**: Para Gmail, usa una "Contraseña de aplicación" en lugar de tu contraseña normal.

### Configuración de Recaptcha
Para el formulario de contacto, configura Google reCAPTCHA:

```env
RECAPTCHA_SITE_KEY=tu_site_key
RECAPTCHA_SECRET_KEY=tu_secret_key
```

### Configuración de Pagos
El sistema está preparado para integrar pasarelas de pago. Configura según tu proveedor preferido:

```env
PAYMENT_GATEWAY=stripe
PAYMENT_API_KEY=tu_api_key
PAYMENT_SECRET_KEY=tu_secret_key
```

## 🔑 Credenciales de Acceso

### Usuario Normal (Datos de Prueba)
- **Email**: `test@example.com`
- **Password**: `password`

### Administrador (Datos de Prueba)
- **Email**: `admin@ticketgoo.com`
- **Password**: `admin123`

### Crear Nuevo Administrador
```bash
php artisan tinker
```
```php
use App\Models\Admin;
Admin::create([
    'name' => 'Tu Nombre',
    'email' => 'tu@email.com',
    'password' => Hash::make('tu_password')
]);
```

## 🎯 Uso

### Iniciar el Servidor de Desarrollo
```bash
# Opción 1: Servidor de desarrollo simple
php artisan serve

# Opción 2: Con todas las herramientas (recomendado)
composer run dev
```

### Comandos Útiles
```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Optimizar para producción
php artisan optimize

# Ejecutar tests
php artisan test

# Ver rutas disponibles
php artisan route:list

# Verificar estado de la aplicación
php artisan about
```

### Acceso al Sistema

#### Panel de Usuario
- **URL**: `http://localhost:8000`
- **Registro**: Clic en "Registrarse" en la página principal
- **Login**: Usar credenciales registradas

#### Panel de Administración
- **URL**: `http://localhost:8000/admin/login`
- **Credenciales**: Ver sección "Credenciales de Acceso"

### Funcionalidades Principales

#### Para Usuarios
1. **Registro/Login** en la plataforma
2. **Explorar eventos** disponibles
3. **Seleccionar entradas** y cantidades
4. **Aplicar promociones** (si están disponibles)
5. **Completar compra** con datos personales
6. **Recibir confirmación** por email
7. **Descargar e-tickets** desde su perfil

#### Para Administradores
1. **Gestionar proveedores** (crear, editar, eliminar)
2. **Crear eventos** con toda la información necesaria
3. **Configurar entradas** y precios
4. **Publicar eventos** para que sean visibles
5. **Gestionar promociones** con fechas de vigencia
6. **Configurar carrusel** de la página principal
7. **Ver estadísticas** de ventas y eventos

## 🔧 Solución de Problemas

### Errores Comunes y Soluciones

#### Error: "Class not found"
```bash
composer dump-autoload
```

#### Error: "Permission denied" en storage
```bash
chmod -R 775 storage bootstrap/cache
```

#### Error: "Migration table not found"
```bash
php artisan migrate:install
php artisan migrate
```

#### Error: "Vite manifest not found"
```bash
npm run build
```

#### Error: "Mail configuration"
Configura el email en `.env` o usa Mailpit para desarrollo:
```bash
# Instalar Mailpit (opcional)
brew install mailpit  # macOS
# O usar Laravel Sail que incluye Mailpit
```

#### Error: "Database connection failed"
Verifica la configuración en `.env`:
- Credenciales correctas
- Base de datos creada
- Servidor de base de datos ejecutándose

#### Error: "Storage link already exists"
```bash
php artisan storage:link --force
```

#### Error: "Composer dependencies"
```bash
composer install --no-dev --optimize-autoloader
```

### Verificación de Instalación

1. ✅ El servidor inicia sin errores
2. ✅ Puedes acceder a `http://localhost:8000`
3. ✅ Puedes hacer login con las credenciales de prueba
4. ✅ Puedes acceder al panel de administración
5. ✅ Las migraciones se ejecutaron correctamente
6. ✅ Los seeders crearon datos de ejemplo
7. ✅ Los assets se compilaron correctamente

## 📁 Estructura del Proyecto

```
TicketGoo/
├── app/
│   ├── Http/Controllers/     # Controladores principales
│   │   ├── AdminController.php
│   │   ├── EventoController.php
│   │   ├── CompraController.php
│   │   └── ...
│   ├── Livewire/            # Componentes Livewire
│   │   ├── Auth/           # Componentes de autenticación
│   │   └── Settings/       # Componentes de configuración
│   ├── Models/              # Modelos Eloquent
│   │   ├── User.php
│   │   ├── Evento.php
│   │   ├── Compra.php
│   │   └── ...
│   ├── Mail/                # Clases de email
│   │   ├── BoletaCompraMail.php
│   │   └── VoucherCompraMail.php
│   └── Jobs/                # Trabajos en cola
├── database/
│   ├── migrations/          # Migraciones de BD
│   ├── seeders/            # Datos iniciales
│   └── factories/          # Factories para testing
├── resources/
│   ├── views/              # Vistas Blade
│   │   ├── admin/         # Vistas del panel admin
│   │   ├── usuario/       # Vistas de usuario
│   │   └── components/    # Componentes reutilizables
│   ├── css/                # Estilos CSS
│   └── js/                 # JavaScript
├── routes/
│   ├── web.php             # Rutas web
│   └── auth.php            # Rutas de autenticación
├── public/                 # Archivos públicos
│   ├── images/            # Imágenes del sistema
│   └── usuario/           # Imágenes subidas por usuarios
├── storage/                # Almacenamiento
└── config/                 # Configuraciones
```

## 🔌 API y Endpoints

### Rutas Principales

#### Usuario
- `GET /` - Página principal
- `GET /eventos` - Lista de eventos públicos
- `GET /evento/{id}` - Detalle de evento
- `GET /comprar/{id}` - Proceso de compra
- `POST /comprar/procesar` - Procesar compra
- `GET /usuario/compras` - Historial de compras
- `GET /usuario/etickets` - E-tickets del usuario

#### Administración
- `GET /admin/login` - Login de administrador
- `GET /admin/dashboard` - Dashboard administrativo
- `GET /admin/eventos` - Gestión de eventos
- `GET /admin/proveedores` - Gestión de proveedores
- `GET /admin/promociones` - Gestión de promociones
- `GET /admin/carrusel` - Gestión de carrusel

### Middleware Utilizados
- `auth` - Autenticación de usuarios
- `admin` - Verificación de administrador
- `verified` - Verificación de email

## 🚀 Despliegue

### Preparación para Producción

1. **Configurar variables de entorno**
```bash
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tu-dominio.com
```

2. **Optimizar la aplicación**
```bash
composer install --no-dev --optimize-autoloader
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

3. **Configurar base de datos de producción**
```env
DB_CONNECTION=mysql
DB_HOST=tu_host
DB_PORT=3306
DB_DATABASE=tu_database
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

4. **Configurar servidor web**
- Apache o Nginx
- SSL/HTTPS
- Configurar directorio público

### Comandos de Despliegue
```bash
# Instalar dependencias
composer install --no-dev --optimize-autoloader

# Compilar assets
npm run build

# Ejecutar migraciones
php artisan migrate --force

# Optimizar
php artisan optimize

# Configurar permisos
chmod -R 775 storage bootstrap/cache
```

## 🤝 Contribución

1. **Fork** el proyecto
2. Crea una **rama** para tu feature (`git checkout -b feature/AmazingFeature`)
3. **Commit** tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. **Push** a la rama (`git push origin feature/AmazingFeature`)
5. Abre un **Pull Request**

### Guías de Contribución
- Sigue las convenciones de Laravel
- Escribe tests para nuevas funcionalidades
- Documenta cambios importantes
- Mantén el código limpio y legible
- Usa commits descriptivos

### Estándares de Código
```bash
# Verificar estándares
./vendor/bin/pint

# Ejecutar tests
php artisan test
```

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 📞 Soporte

### Canales de Soporte
- **Email**: soporte@ticketgoo.com
- **Documentación**: [docs.ticketgoo.com](https://docs.ticketgoo.com)
- **Issues**: [GitHub Issues](https://github.com/tu-usuario/ticketgoo/issues)
- **Discord**: [Canal de Discord](https://discord.gg/ticketgoo)

### Información de Contacto
- **Desarrollador Principal**: [Tu Nombre]
- **Email de Contacto**: [tu@email.com]
- **Sitio Web**: [https://ticketgoo.com]

## 🙏 Agradecimientos

- **Laravel Team** por el framework
- **Tailwind CSS** por el sistema de diseño
- **Livewire** por los componentes dinámicos
- **FontAwesome** por los iconos
- **Comunidad Laravel** por el soporte

## 📊 Estado del Proyecto

- **Versión**: 1.0.0
- **Última actualización**: Julio 2025
- **Estado**: ✅ Estable
- **Compatibilidad**: Laravel 12.x, PHP 8.2+

---

**Desarrollado con ❤️ para la comunidad de eventos**

*TicketGoo - Tu plataforma de confianza para la venta de entradas*
