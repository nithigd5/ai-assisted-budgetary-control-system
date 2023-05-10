<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->text(100),
            'category' => $this->faker->word,
            'type' => $this->faker->word,
            'min_price' => $this->faker->randomFloat(2, 0, 1000),
            'max_price' => $this->faker->randomFloat(2, 0, 1000),
            'brand' => $this->faker->word,
        ];
    }
}
