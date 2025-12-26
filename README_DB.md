# Migraciones, Factories y Seeders

## 🎯 Objetivo
Este documento explica cómo se creó y pobló la base de datos, desde cero, usando herramientas nativas de Laravel.

## 🧩 Crear modelos con migraciones y factories
Comando usado:
```bash
php artisan make:model Category -mf
php artisan make:model Product -mf
```

Esto genera automáticamente:

- **Modelo**: app/Models → define la lógica y relaciones
- **Migración**: database/migrations → define la estructura de la tabla
- **Factory**: database/factories → genera datos de prueba realistas


Estructura:
```
app/Models/Category.php
database/migrations/xxxx_xx_xx_create_categories_table.php
database/factories/CategoryFactory.php

app/Models/Product.php
database/migrations/xxxx_xx_xx_create_products_table.php
database/factories/ProductFactory.php
```
## 🧩 Migraciones
```bash
php artisan migrate
```
Qué hace:
- Crea las tablas
- Registra el historial de migraciones
- Prepara la BD para datos reales

## 🧩 Seeders
```bash
php artisan db:seed
```

Datos creados:
- 10 categorías
- 50 productos
- Productos distribuidos por categoría
- Precios, stock y estados realistas

Ejemplo ruta que usa Laravel para ejecutar seeders:
```
database/seeders/ProductSeeder.php
```

## 🧪 Comprobación rápida (Tinker)
```bash
php artisan tinker
\App\Models\Category::factory()->create();
\App\Models\Product::factory()->create();
exit
```

## 🔒 Límite de productos (regla de negocio)
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


## Reiniciar base de datos y seeders
```bash
php artisan migrate:fresh --seed
```

📚 Documentación adicional:

- Para más información sobre Livewire y UI: [Siguiente --> README_LIVEWIRE.md](README_LIVEWIRE.md)
- Para más información sobre el proyecto: [Inicio --> README.md](README.md)