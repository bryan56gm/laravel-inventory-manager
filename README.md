# Inventory Manager (Laravel + Livewire)

Esta aplicación web permite gestionar un inventario de productos y categorías, con operaciones completas de creación, edición, eliminación y consulta. Incluye autenticación de usuarios y una interfaz interactiva basada en Livewire y Flux UI para facilitar la gestión de datos de manera rápida y visual.

---

## 🧠 ¿Objetivos del proyecto?

- Autenticación de usuarios
- Modelos y relaciones con Eloquent
- CRUD completo de entidades
- Componentes Livewire reactivos
- UI moderna con Flux + Tailwind
- Seeders con datos legibles (no lorem ipsum)
- Despliegue en Railway con PostgreSQL

---

## 🧱 Stack tecnológico

- **Backend**: Laravel 12 (PHP 8.2)
- **Frontend**: Blade + Livewire 3
- **UI**: Flux UI + Tailwind CSS
- **Base de datos**: PostgreSQL
- **ORM**: Eloquent
- **Build**: Vite
- **Deploy**: Railway

---

## 🚀 Puesta en marcha (local)

### 1. Clonar el repositorio

```bash
git clone <url-del-repositorio>
cd nombre-del-proyecto
```

### 2. Instalar dependencias PHP
```bash
composer install
```

### 3. Instalar dependencias NodeJS y construir assets
```bash
npm install
npm run build
```

### 4. Configurar variables de entorno
```bash
cp .env.example .env
```
Editar `.env` con datos de PostgreSQL:
```env
APP_ENV=local   <--------- OBLIGATORIO (solo en local)
APP_KEY=BASE64:XXXXXXXX  <--------- PASO 5 (generar clave APP_KEY)
DB_CONNECTION=pgsql
DATABASE_URL=postgresql://usuario:password@host:puerto/base_de_datos
```

Por qué es OBLIGATORIO en local

Laravel asume production si APP_ENV no existe.
Eso implica:

- Se activan optimizaciones de producción
- Se puede forzar HTTPS
- Se cachea configuración
- Se desactiva debug

🆘 INFO exta para este caso concreto:

- PHP Artisan serve NO soporta HTTPS
- Resultado: Invalid request (Unsupported SSL request)
- Forzar HTTPS en AppServiceProvider.php

```php
if (app()->environment('production')) {
    URL::forceScheme('https');
}
```

### 5. Generar APP_KEY
```bash
php artisan key:generate
```

### 6. Ejecutar migraciones y seeders
```bash
php artisan migrate --seed
```
Con esto, se crearán las tablas de la base de datos (database/migraciones) y se cargarán los datos de prueba (database/seeders).

### 7. Levantar servidor de desarrollo
```bash
php artisan serve
```

La aplicación estará disponible en `http://127.0.0.1:8000`


## 🌍 Producción (Railway – resumen)
```env
APP_KEY=BASE64:XXXXXXXX
DB_CONNECTION=pgsql
DATABASE_URL=postgresql://usuario:password@host:puerto/base_de_datos
```

Generar clave en local:
```bash
php artisan key:generate --show
```

Añadir en Railway:
```env
APP_KEY=base64:XXXXXXXX
```

Generar clave en local:
```bash
php artisan migrate --force
php artisan config:cache
```

#### 🆘 INFO exta para este caso concreto:
Modificar config/database.php y añadir `url` a la conexión PostgreSQL:
```php
'pgsql' => [
    'url' => env('DATABASE_URL'),
]
```
Laravel prioriza `url`.

Modificar y añadir a vite.config.js:
```js
base: '/',  // Usar rutas relativas evita HTTP absoluto, ayudando con los estilos en producción
```

📚 Documentación adicional:

- Para más información sobre la base de datos, migraciones y seeders: [Siguiente --> README_DB.md](README_DB.md)
- Para más información sobre Livewire y UI: [Final --> README_LIVEWIRE.md](README_LIVEWIRE.md)


![Inventory Manager](https://raw.githubusercontent.com/bryan56gm/portfolio/refs/heads/main/preview.webp)