# 🚀 Prueba Técnica para Desarrollador Junior Laravel + Livewire

## 📋 Información General

**Duración estimada**: 3-4 horas
**Tecnologías**: Laravel 12, Livewire 3, Flux UI, MariaDB

### Contexto del Proyecto

Este es un starter kit de Laravel con Livewire 3 y Flux UI que incluye autenticación completa con Laravel Fortify. El proyecto ya cuenta con modelos `Customer` y `Address` implementados como referencia.

## 🎯 Objetivos de la Prueba

Evaluar las siguientes competencias:
- ✅ Creación de modelos Eloquent con relaciones
- ✅ Diseño y creación de migraciones
- ✅ Desarrollo de componentes Livewire
- ✅ Integración con Flux UI
- ✅ Manejo de validaciones
- ✅ Testing básico con Pest PHP

## 📝 Ejercicio: Sistema de Gestión de Productos

Debes implementar un sistema básico de gestión de productos que permita:
1. Listar productos ✅✅
2. Crear nuevos productos ✅✅
3. Editar productos existentes ✅✅
4. Eliminar productos ✅✅
5. Gestionar categorías de productos ✅✅

### Parte 1: Modelos y Base de Datos ✅✅✅✅✅✅

#### 1.1 Crear el modelo Category ✅✅
**Requisitos del modelo Category:** 
- Campos: `name` (string, único), `description` (text, nullable), `is_active` (boolean, default true)
- Relación: Un Category tiene muchos Products
- Implementar método `getActiveProductsCountAttribute()` que retorne el número de productos activos

#### 1.2 Crear el modelo Product ✅✅
**Requisitos del modelo Product:** 
- Campos: `name`, `description`, `price`, `stock`, `category_id`, `is_active`
- Relación: Un Product pertenece a una Category
- Cast: `price` como decimal, `is_active` como boolean
- Scope: `active()` para productos activos
- Método: `getFormattedPriceAttribute()` que retorne el precio con formato "€ X.XX"

#### 1.3 Configurar las migraciones ✅✅

### Parte 2: Factories y Seeders

#### 2.1 Crear CategoryFactory
- Generar nombres de categorías realistas ✅✅
- 80% de probabilidad de estar activas ✅✅

#### 2.2 Crear ProductFactory
- Usar Faker para generar datos realistas ⁉️⁉️⁉️⁉️⁉️
- Precios entre 5.00 y 500.00 euros  ✅✅
- Stock entre 0 y 100 ✅✅
- 90% de probabilidad de estar activos ✅✅

#### 2.3 Crear ProductSeeder
- Crear 10 categorías ✅✅
- Crear 50 productos distribuidos entre las categorías ✅✅
- Asegurar que cada categoría tenga al menos 2 productos ✅✅

### Parte 3: Componentes Livewire

#### 3.1 Componente ProductList
**Ubicación**: `app/Livewire/Products/ProductList.php` ✅✅
**Vista**: `resources/views/livewire/products/product-list.blade.php` ✅✅

**Funcionalidades:**
- Listar productos con paginación (10 por página) ✅✅✅✅✅
- Filtrar por categoría (dropdown con Flux UI) ✅✅✅✅✅
- Filtrar por estado (activo/inactivo) ✅✅✅✅✅
- Buscar por nombre      ✅✅✅✅✅      
- Mostrar información: nombre, categoría, precio formateado, stock, estado ✅✅✅✅✅
- Botones para editar y eliminar cada producto ✅✅✅✅✅
- Botón para crear nuevo producto ✅✅✅✅✅
 
### Parte 4: Rutas y Navegación

#### 4.2 Agregar navegación
Actualizar el layout principal para incluir enlaces a la gestión de productos.

## 🎨 Consideraciones de UI  ✅✅✅✅✅✅

- Usar componentes Flux UI para mantener consistencia ✅✅
- Implementar estados de carga donde sea apropiado ✅✅
- Mostrar mensajes de éxito/error usando notificaciones  ⁉️⁉️⁉️⁉️⁉️
- Diseño responsive ✅✅
- Uso adecuado de iconos y espaciado ✅✅


## 💡 Datos de conexión

Necesitarás estos datos para realizar la prueba:

url del proyecto ([prueba-devs.dev6.bigbangfood.es](https://prueba-devs.dev6.bigbangfood.es/))

server: 91.242.131.16
ssh/ftp user: prueba-devs.dev6.big_b4424pa13pu
pass: LcJTzuiwhp8#b6%2

Datos de conexión la db en el fichero .env

## 🆘 Preguntas Frecuentes

**P: ¿Puedo usar librerías adicionales?**
R: Sí, pero justifica su uso en la documentación.

**P: ¿Qué hago si encuentro un error que no puedo resolver?**
R: Documenta el error, los pasos que intentaste y continúa con otras partes.

**P: ¿Es necesario implementar autenticación?**
R: No, ya está implementada. Solo asegúrate de usar los middlewares correctos.


**¡Buena suerte! 🍀**

*Esta prueba está diseñada para evaluar habilidades prácticas en el desarrollo con Laravel y Livewire. Tómate tu tiempo para entender cada parte antes de implementarla.*