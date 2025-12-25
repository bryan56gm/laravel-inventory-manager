<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;

    public function definition(): array
    {
        // intentamos reutilizar una categoría existente; si no hay, creamos una nueva
        $categoryId = Category::inRandomOrder()->value('id') ?? null;

        return [
            'name' => $this->faker->unique()->words(3, true),
            'description' => $this->faker->optional()->sentence(),
            'price' => $this->faker->randomFloat(2, 5, 500),
            'stock' => $this->faker->numberBetween(0, 100),
            'category_id' => $categoryId ? $categoryId : Category::factory(),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
