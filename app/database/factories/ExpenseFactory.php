<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
            'price' => $this->faker->numberBetween(100, 1000),
            'mode' => $this->faker->randomElement(['online', 'offline']),
            'feedback' => $this->faker->randomElement(['happy', 'sad', 'worst', 'ok', 'shit', 'not bad', 'worthless', 'wonderful', 'nice', 'good', 'its better', 'unsatisfied', 'satisfied'])
        ];
    }
}
