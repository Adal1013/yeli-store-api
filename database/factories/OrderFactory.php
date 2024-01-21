<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        return [
            'user_id' => $user->id,
            'type' => fake()->name(),
            'amount' => fake()->randomNumber(),
            'status' => fake()->randomElement(['CRE', 'PAG', 'CAN']),        
        ];
    }
}
