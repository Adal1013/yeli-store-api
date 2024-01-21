<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::factory()->create();
        return [
            'category_id' => $category->id,
            'code' => fake()->randomNumber(),
            'name' => fake()->name(),
            'stock' => fake()->randomDigit(),
            'value' => fake()->randomFloat(),
        ];
    }
}
