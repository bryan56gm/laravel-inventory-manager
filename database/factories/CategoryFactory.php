<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = \App\Models\Category::class;

    public function definition(): array
    {
        $categories = [
            'Electrónica',
            'Ropa y Moda',
            'Hogar y Cocina',
            'Deportes y Fitness',
            'Juguetes y Niños',
            'Belleza y Salud',
            'Automotriz',
            'Mascotas',
            'Oficina y Papelería',
            'Jardinería',
            'Herramientas',
            'Computación',
            'Móviles y Tablets',
            'TV, Audio y Video',
            'Videojuegos',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($categories),
            'description' => $this->faker->optional(0.6)->sentence(),
            'is_active' => $this->faker->boolean(80),
        ];
    }
}
