# README – Migración de Base de Datos y Configuración del Proyecto

## 📌 Objetivo de este documento

Este README explica **paso a paso, estilo “guía de IKEA para tontos”**, cómo se migró el proyecto:

- De **usar la base de datos original del proveedor**
- A **usar una base de datos PostgreSQL propia en Railway**
- Dejando el proyecto funcionando **en local y en producción**
- Sin romper autenticación, migraciones, seeders ni Livewire

---

## 🧠 Contexto inicial

El proyecto venía con Laravel + Livewire + autenticación.
El problema era no tener control sobre la BD.
La solución fue migrar todo a PostgreSQL en Railway.

---

## 🧩 Paso 1 – Crear BD en Railway

1. Crear proyecto
2. Añadir PostgreSQL
3. Copiar `DATABASE_URL` desde Connect

Ejemplo:
```
postgresql://postgres:PASSWORD@centerbeam.proxy.rlwy.net:39975/railway
```

---

## 🧩 Paso 2 – Configurar `.env`

Archivo:
```
.env
```

```env
DB_CONNECTION=pgsql
DATABASE_URL=postgresql://postgres:PASSWORD@centerbeam.proxy.rlwy.net:39975/railway
```

❗ No usar DB_HOST ni DB_PORT.

---

## 🧩 Paso 3 – `config/database.php`

```php
'pgsql' => [
    'driver' => 'pgsql',
    'url' => env('DATABASE_URL'),
    'host' => env('DB_HOST', null),
    'port' => env('DB_PORT', null),
    'database' => env('DB_DATABASE', null),
    'username' => env('DB_USERNAME', null),
    'password' => env('DB_PASSWORD', null),
    'charset' => 'utf8',
    'prefix' => '',
    'prefix_indexes' => true,
    'search_path' => 'public',
    'sslmode' => 'prefer',
]
```

Laravel prioriza `url`.

---

## 🧩 Paso 4 – Limpiar caché

```bash
php artisan config:clear
php artisan optimize:clear
```

---

### 🧩 Paso 5 – Migraciones

> Este paso crea las tablas de la base de datos según las migraciones definidas en el proyecto. Es el momento en que Laravel prepara tu base de datos para trabajar con los modelos y seeders.

**Comando:**

```bash
php artisan migrate
```

**Qué hace:**

1. Lee los archivos de migración en `database/migrations/`.
2. Crea la tabla `migrations` para llevar control de qué migraciones se han ejecutado.
3. Aplica cada migración pendiente: crea tablas, columnas, claves foráneas y valores por defecto.
4. Deja tu base de datos lista para insertar datos con seeders o manualmente.

**Nota:** Asegúrate de que tu `.env` apunta a tu propia base de datos (`DB_CONNECTION` y `DATABASE_URL`) antes de migrar.

---

## 🧩 Paso 6 – Seeders

Este paso sirve para llenar la base de datos con datos iniciales de prueba, usando los seeders que definimos en el proyecto.

### Comando

```bash
php artisan db:seed
```

### Qué hace cada seeder

1. **DatabaseSeeder.php**

   * Punto de entrada que llama a los demás seeders.
   * Crea un usuario de prueba:

     ```php
     User::factory()->create([
         'name' => 'Test User',
         'email' => 'test@example.com',
     ]);
     ```
   * Llama a `CustomerSeeder` y `ProductSeeder`.

2. **CustomerSeeder.php**

   * Crea 50 clientes de prueba con 1-3 direcciones cada uno.
   * Asegura que cada cliente tenga una dirección por defecto (`is_default = true`).
   * También crea un cliente específico de prueba (`Juan Pérez`) con direcciones home y work.

3. **ProductSeeder.php**

   * Crea 10 categorías con nombres realistas.
   * Para cada categoría, crea mínimo 2 productos.
   * Llena el resto hasta alcanzar 50 productos.
   * Muestra en consola cuántas categorías y productos se crearon.

### Resumen de resultados

* Se crean automáticamente:

  * 1 usuario de prueba
  * 50 clientes con direcciones
  * 10 categorías
  * 50 productos distribuidos entre categorías

### Nota importante

* Esto solo funciona después de ejecutar `php artisan migrate`, ya que depende de que las tablas existan.
* Permite tener datos iniciales para desarrollo y pruebas sin necesidad de introducirlos manualmente.

---

## 🧩 Paso 7 – Límite de productos

Archivo:
```
app/Models/Product.php
```

```php
protected static function booted()
{
    static::creating(function () {
        if (static::count() >= 50) {
            static::orderBy('created_at')->first()?->delete();
        }
    });
}
```

---

## 🏁 Resultado final

- App funcional
- BD propia
- Reglas del enunciado cumplidas

