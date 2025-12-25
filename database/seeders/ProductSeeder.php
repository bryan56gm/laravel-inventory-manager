<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1) Crear 10 categorías
        $categories = Category::factory(10)->create();

        // 2) Para cada categoría, mínimo 2 productos
        foreach ($categories as $category) {
            Product::factory(2)->create([
                'category_id' => $category->id,
            ]);
        }

        // 3) Crear el resto hasta llegar a 50 productos
        $remaining = 50 - Product::count(); // si ya hay más, evita error
        if ($remaining > 0) {
            Product::factory($remaining)->create();
        }

        // 4) Mensaje en consola para saber que fue bien
        echo "ProductSeeder completado: "
            . Category::count() . " categorías, "
            . Product::count() . " productos.\n";
    }
}
