
# Proyecto Web con Laravel + PostgreSQL

Este proyecto es una aplicación web desarrollada con **Laravel** que implementa
autenticación de usuarios, manejo de sesiones y operaciones CRUD sobre una base
de datos relacional.  
El objetivo principal del proyecto es demostrar un **flujo completo de desarrollo
y despliegue a producción**, utilizando herramientas modernas y buenas prácticas.

La aplicación está pensada como **prueba técnica / proyecto demostrativo** para
entornos reales de producción.

---

## Descripción

La aplicación permite a los usuarios:

- **Registrarse**: Crear una cuenta con credenciales seguras.
- **Iniciar sesión**: Acceder a la aplicación mediante autenticación.
- **Cerrar sesión**: Finalizar la sesión de forma segura.
- **Interactuar con la aplicación**: Operaciones CRUD según la lógica del proyecto.
- **Persistir datos**: Toda la información se guarda en una base de datos PostgreSQL.

---

## Tecnologías utilizadas

- **Backend**: Laravel (PHP)
- **Frontend**: Blade + Vite
- **Base de datos**: PostgreSQL
- **ORM**: Eloquent (Laravel)
- **Autenticación**: Sistema nativo de Laravel
- **Despliegue**: Railway
- **Control de versiones**: Git + GitHub

---

## Base de Datos

- **Desarrollo**: PostgreSQL  
- **Producción**: PostgreSQL (Railway)

La aplicación utiliza **Eloquent ORM**, lo que permite trabajar con PostgreSQL
tanto en desarrollo como en producción sin modificar la lógica del código,
únicamente cambiando las variables de entorno.

> ⚠️ Se recomienda usar PostgreSQL también en desarrollo para evitar diferencias
> de comportamiento entre entornos.

---

## Requisitos

Antes de comenzar, asegúrate de tener instalado:

- PHP 8.2 o superior
- Composer
- Node.js 18 o superior
- Git

---

## Instalación y Ejecución (Desarrollo Local)

### 1. Clonar el repositorio

```bash
git clone <URL_DEL_REPOSITORIO>
```

### 2. Acceder al proyecto

```bash
cd nombre-del-proyecto
```

### 3. Instalar dependencias de PHP

```bash
composer install
```

### 4. Instalar dependencias de frontend

```bash
npm install
npm run build
```

### 5. Configurar variables de entorno

Copia el archivo de ejemplo:

```bash
cp .env.example .env
```

Edita el archivo `.env` y configura PostgreSQL:

```env
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=pgsql
DB_HOST=HOST_POSTGRES
DB_PORT=5432
DB_DATABASE=nombre_bd
DB_USERNAME=usuario
DB_PASSWORD=password
```

### 6. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 7. Ejecutar migraciones

```bash
php artisan migrate
```

### 8. Iniciar el servidor de desarrollo

```bash
php artisan serve
```

La aplicación estará disponible en:

```
http://127.0.0.1:8000
```

---

## Despliegue a Producción (Railway)

### 1. Crear proyecto en Railway

- Crear un nuevo proyecto.
- Conectar el repositorio de GitHub.

### 2. Crear base de datos PostgreSQL

- Añadir un servicio **PostgreSQL** dentro del proyecto.
- Railway generará automáticamente las credenciales.

### 3. Configurar variables de entorno en Railway

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tu-app.up.railway.app

DB_CONNECTION=pgsql
DB_HOST=${{Postgres.PGHOST}}
DB_PORT=${{Postgres.PGPORT}}
DB_DATABASE=${{Postgres.PGDATABASE}}
DB_USERNAME=${{Postgres.PGUSER}}
DB_PASSWORD=${{Postgres.PGPASSWORD}}

SESSION_DRIVER=database
CACHE_DRIVER=database
QUEUE_CONNECTION=database
```

### 4. Configurar APP_KEY

Generar la clave en local:

```bash
php artisan key:generate --show
```

Copiar el valor y añadirlo en Railway:

```env
APP_KEY=base64:XXXXXXXX
```

### 5. Ejecutar comandos finales en producción

Desde la consola de Railway:

```bash
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
```

---

## Estado del Proyecto

- Aplicación funcional
- Desplegada en producción
- Base de datos real PostgreSQL
- Autenticación y persistencia de datos

Este proyecto es ideal como **demo técnica** o **portfolio profesional**.

---

## Capturas

_Añade aquí imágenes o GIFs de la aplicación en funcionamiento._
