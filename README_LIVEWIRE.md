# README_LIVEWIRE.md - Componentes Livewire y UI

## Crear componente Livewire
```bash
php artisan make:livewire Products/ProductList
```
Archivos creados:
```
1. app/Livewire/Products/ProductList.php
2. resources/views/livewire/products/product-list.blade.php
```
1) **Genera la clase del componente**: Aquí se escribirá la lógica de la aplicación: cómo obtener los productos de la base de datos, filtrar por categoría o estado, paginar los resultados y manejar acciones CRUD (crear, editar, eliminar).
2) **Vista Blade**: 

  - Aquí se define la interfaz de usuario.
  - Usaremos Flux UI para los estilos y componentes (botones, tablas, dropdowns).
  - Se integra automáticamente con la clase PHP del componente.

🔹 Tip: Livewire conecta automáticamente la vista con la clase, de modo que cualquier propiedad o método definido en la clase PHP puede usarse en la vista Blade.

## Compilar assets y limpiar caché
```bash
npm run build # Construye los assets con Vite/Tailwind
php artisan optimize:clear # Limpia caché de configuración y rutas
composer dump-autoload # Refresca el autoload de PHP
```

📚 Documentación adicional:

- Para más información : [Inicio --> README.md](README.md)
- Para más información sobre la base de datos, migraciones y seeders: [Anterior --> README_DB.md](README_DB.md)