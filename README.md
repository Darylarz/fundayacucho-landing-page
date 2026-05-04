# 🏛️ Fundayacucho — Sitio Web Institucional

> Migración del sitio institucional de Fundayacucho a **Laravel 11** con panel administrativo (CMS) para gestión dinámica de contenido.

---

## 📋 Tabla de Contenidos

- [Descripción](#descripción)
- [Requisitos del Sistema](#requisitos-del-sistema)
- [Instalación](#instalación)
- [Configuración del Entorno](#configuración-del-entorno)
- [Base de Datos](#base-de-datos)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Panel Administrativo](#panel-administrativo)
- [Módulos del CMS](#módulos-del-cms)
- [Paleta de Colores](#paleta-de-colores)
- [Despliegue en Producción](#despliegue-en-producción)
- [Comandos Útiles](#comandos-útiles)
- [Créditos](#créditos)

---

## Descripción

Aplicación web institucional para la **Fundación Gran Mariscal de Ayacucho (Fundayacucho)**, organismo del Estado venezolano que impulsa la universalización de la educación universitaria.

Este proyecto reemplaza el sitio estático en HTML/PHP por una aplicación Laravel completamente dinámica. Todo el contenido visible en el home (carrusel, invitaciones, noticias, libros, información) es gestionado desde un panel administrativo sin necesidad de editar código.

**Stack principal:**

| Tecnología | Versión | Rol |
|---|---|---|
| PHP | 8.2+ | Lenguaje base |
| Laravel | 11.x | Framework backend |
| MySQL | 8.0+ | Base de datos |
| Bootstrap | 5.x | CSS / UI |
| Bootstrap Icons | 1.x | Iconografía |
| Vite | — | Compilación de assets |

---

## Requisitos del Sistema

Antes de instalar, asegurarse de tener:

- PHP 8.2 o superior
- Composer 2.x
- MySQL 8.0+ o PostgreSQL 14+
- Node.js 18+ y npm
- Servidor web: Apache 2.4+ o Nginx 1.18+
- Extensiones PHP habilitadas: `BCMath`, `Ctype`, `Fileinfo`, `JSON`, `Mbstring`, `OpenSSL`, `PDO`, `Tokenizer`, `XML`, `GD` o `Imagick`

---

## Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/fundayacucho/sitio-web.git
cd sitio-web
```

### 2. Instalar dependencias PHP

```bash
composer install
```

### 3. Instalar dependencias JavaScript

```bash
npm install
```

### 4. Copiar el archivo de entorno

```bash
cp .env.example .env
```

### 5. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 6. Crear enlace simbólico para el storage

```bash
php artisan storage:link
```

---

## Configuración del Entorno

Editar el archivo `.env` con los datos del entorno:

```env
APP_NAME=Fundayacucho
APP_ENV=local          # Cambiar a "production" en el servidor
APP_DEBUG=true         # Cambiar a "false" en producción
APP_URL=http://localhost/fundayacucho/public

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fundayacucho_db
DB_USERNAME=root
DB_PASSWORD=tu_password_aqui
```

---

## Base de Datos

### Ejecutar migraciones

```bash
php artisan migrate
```

### Poblar con datos iniciales (redes sociales, contacto, etc.)

```bash
php artisan db:seed
```

### Tablas del sistema

| Tabla | Descripción |
|---|---|
| `carousel_slides` | Imágenes del carrusel principal del home |
| `invitaciones` | Cards de invitación con imagen y enlace al formulario |
| `noticias` | Imágenes y texto de la sección noticias |
| `libros` | Portadas y archivos PDF descargables |
| `informaciones` | Cards de la sección Información |
| `site_configs` | Configuración global: logo, cintillo, contacto, redes |
| `users` | Usuarios del sistema con roles (admin / editor) |

---

## Estructura del Proyecto

```
fundayacucho/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php          ← Página principal pública
│   │   │   ├── PageController.php          ← Historia, Misión/Visión
│   │   │   └── Admin/
│   │   │       ├── AdminController.php     ← Dashboard del CMS
│   │   │       ├── CarouselController.php
│   │   │       ├── InvitacionController.php
│   │   │       ├── NoticiaController.php
│   │   │       ├── LibroController.php
│   │   │       └── ConfigController.php
│   │   └── Requests/Admin/                 ← Validaciones de formularios
│   └── Models/
│       ├── CarouselSlide.php
│       ├── Invitacion.php
│       ├── Noticia.php
│       ├── Libro.php
│       ├── Informacion.php
│       └── SiteConfig.php
├── database/
│   ├── migrations/                         ← Definición de tablas
│   └── seeders/                            ← Datos iniciales
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php               ← Layout principal
│       ├── components/
│       │   ├── navbar.blade.php
│       │   └── footer.blade.php
│       ├── home.blade.php                  ← Página principal
│       ├── historia.blade.php
│       ├── mision.blade.php
│       └── admin/
│           ├── layouts/admin.blade.php     ← Layout del CMS
│           ├── dashboard.blade.php
│           ├── carousel/
│           ├── invitaciones/
│           ├── noticias/
│           ├── libros/
│           └── config/
├── routes/
│   └── web.php                             ← Definición de rutas
├── storage/
│   └── app/public/uploads/                 ← Imágenes subidas por el admin
└── public/
    └── storage/                            ← Enlace simbólico (storage:link)
```

---

## Panel Administrativo

El CMS es accesible en `/admin` únicamente para usuarios con rol `admin`.

### Crear usuario administrador

```bash
php artisan tinker
```

```php
use App\Models\User;
use Spatie\Permission\Models\Role;

// Crear roles (solo la primera vez)
Role::create(['name' => 'admin']);
Role::create(['name' => 'editor']);

// Crear usuario admin
$user = User::create([
    'name'     => 'Administrador',
    'email'    => 'admin@fundayacucho.gob.ve',
    'password' => bcrypt('contraseña_segura_aqui'),
]);

$user->assignRole('admin');
```

### Acceso

```
URL:       http://tu-dominio/admin
Usuario:   admin@fundayacucho.gob.ve
Contraseña: (la definida en el paso anterior)
```

> ⚠️ **Cambiar la contraseña inmediatamente después del primer ingreso en producción.**

---

## Módulos del CMS

### 🖼️ Carrusel
Gestiona las imágenes del carrusel principal del home.
- Subir imagen (JPG, PNG, WEBP — máx. 5MB)
- Cambiar orden con botones Subir / Bajar
- Activar o desactivar slides individualmente

### 📋 Invitaciones
Gestiona las cards de invitación (actualmente 4 cards que enlazan al formulario de becarios).
- Subir imagen de la invitación
- Asignar URL de destino (formulario de becarios u otro enlace)
- Ordenar y activar/desactivar

### 📰 Noticias
Gestiona las imágenes y textos de la sección Noticias.
- Subir imagen
- Título y cuerpo de texto
- Publicar o despublicar

### 📚 Libros
Gestiona la sección de libros descargables.
- Subir imagen de portada
- Subir archivo PDF
- Definir nombre del archivo al descargar

### ⚙️ Configuración General
Panel centralizado para los datos globales del sitio.

| Campo | Descripción |
|---|---|
| Logo | Imagen del logo en navbar |
| Cintillo | Imagen del encabezado institucional |
| Teléfono | Número visible en el footer |
| Email | Correo de contacto |
| Facebook | URL del perfil oficial |
| Instagram | URL del perfil oficial |
| Twitter / X | URL del perfil oficial |
| YouTube | URL del canal |

---

## Paleta de Colores

```css
/* Colores institucionales de Fundayacucho */
--color-primario:   #002B48;  /* Azul oscuro — navbar, footer */
--color-acento:     #ff8000;  /* Naranja — botones, destacados */
--color-texto:      #ffffff;  /* Blanco — texto sobre fondo oscuro */
--color-fondo:      #f8f9fa;  /* Gris claro — fondo de secciones */
```

---

## Despliegue en Producción

### Apache — Configuración del VirtualHost

```apache
<VirtualHost *:80>
    ServerName fundayacucho.gob.ve
    DocumentRoot /var/www/fundayacucho/public

    <Directory /var/www/fundayacucho/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Asegurarse de tener el módulo `mod_rewrite` habilitado:

```bash
a2enmod rewrite
systemctl restart apache2
```

### Nginx — Configuración del Server Block

```nginx
server {
    listen 80;
    server_name fundayacucho.gob.ve;
    root /var/www/fundayacucho/public;

    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### Comandos de optimización para producción

```bash
# Permisos de carpetas
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Migraciones y datos
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link

# Caché de configuración (acelera la app)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Compilar assets para producción
npm run build
```

---

## Comandos Útiles

| Comando | Descripción |
|---|---|
| `php artisan serve` | Iniciar servidor de desarrollo local |
| `php artisan migrate:fresh --seed` | Reiniciar BD completa con datos de prueba |
| `php artisan storage:link` | Recrear enlace simbólico del storage |
| `php artisan cache:clear` | Limpiar caché de la aplicación |
| `php artisan config:clear` | Limpiar caché de configuración |
| `php artisan route:list` | Ver todas las rutas registradas |
| `npm run dev` | Compilar assets en modo desarrollo (con hot-reload) |
| `npm run build` | Compilar assets optimizados para producción |

---

## Créditos

**Desarrollado por:**
Dirección General de Tecnología de la Información — Fundayacucho

**Institución:**
Fundación Gran Mariscal de Ayacucho
C. 3B, Caracas 1073, Miranda, Venezuela

**Contacto:**
- 📧 contacto@fundayacucho.com
- 📞 0800-2322746
- 🌐 [fundayacucho.gob.ve](https://fundayacucho.gob.ve)

---

> © 2024 Fundayacucho — Todos los derechos reservados.
