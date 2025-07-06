# 🎫 TicketGoo

**Sistema de Gestión y Venta de Entradas para Eventos**

TicketGoo es una plataforma web desarrollada en Laravel que permite la gestión completa de eventos, venta de entradas y administración de proveedores. El sistema incluye un panel de administración robusto y una interfaz de usuario moderna para la compra de tickets.

## 📋 Índice

- [Características](#-características)
- [Tecnologías Utilizadas](#-tecnologías-utilizadas)
- [Requisitos del Sistema](#-requisitos-del-sistema)
- [Instalación](#-instalación)
- [Configuración](#-configuración)
- [Uso](#-uso)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [API y Endpoints](#-api-y-endpoints)
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
Edita el archivo `.env` con tu configuración de base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ticketgoo
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

### 6. Ejecutar Migraciones
```bash
php artisan migrate
```

### 7. Ejecutar Seeders (Opcional)
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

### 10. Configurar Colas (Opcional)
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
MAIL_PASSWORD=tu_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tu_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Configuración de Recaptcha
Para el formulario de contacto, configura Google reCAPTCHA:

```env
RECAPTCHA_SITE_KEY=tu_site_key
RECAPTCHA_SECRET_KEY=tu_secret_key
```

### Configuración de Pagos
El sistema está preparado para integrar pasarelas de pago. Configura según tu proveedor preferido.

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

# Optimizar para producción
php artisan optimize

# Ejecutar tests
php artisan test

# Ver rutas disponibles
php artisan route:list
```

### Acceso al Sistema

#### Panel de Usuario
- **URL**: `http://localhost:8000`
- **Registro**: Clic en "Registrarse" en la página principal
- **Login**: Usar credenciales registradas

#### Panel de Administración
- **URL**: `http://localhost:8000/admin/login`
- **Credenciales**: Configurar en el seeder o crear manualmente

## 📁 Estructura del Proyecto

```
TicketGoo/
├── app/
│   ├── Http/Controllers/     # Controladores principales
│   ├── Livewire/            # Componentes Livewire
│   ├── Models/              # Modelos Eloquent
│   ├── Mail/                # Clases de email
│   └── Jobs/                # Trabajos en cola
├── database/
│   ├── migrations/          # Migraciones de BD
│   ├── seeders/            # Datos iniciales
│   └── factories/          # Factories para testing
├── resources/
│   ├── views/              # Vistas Blade
│   ├── css/                # Estilos CSS
│   └── js/                 # JavaScript
├── routes/
│   ├── web.php             # Rutas web
│   └── auth.php            # Rutas de autenticación
├── public/                 # Archivos públicos
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

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 📞 Soporte

- **Email**: soporte@ticketgoo.com
- **Documentación**: [docs.ticketgoo.com](https://docs.ticketgoo.com)
- **Issues**: [GitHub Issues](https://github.com/tu-usuario/ticketgoo/issues)

## 🙏 Agradecimientos

- **Laravel Team** por el framework
- **Tailwind CSS** por el sistema de diseño
- **Livewire** por los componentes dinámicos
- **FontAwesome** por los iconos

---

**Desarrollado con ❤️ para la comunidad de eventos**
