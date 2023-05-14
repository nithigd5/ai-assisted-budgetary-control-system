<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

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
        $sentiment = '';

        $feedback = $this->faker->randomElement(['happy', 'sad', 'worst', 'ok', 'shit', 'not bad', 'worthless', 'wonderful', 'nice', 'good', 'its better', 'unsatisfied', 'satisfied']);

        try {
            $response = Http::timeout(3)->post(
                config('app.api_host') . '/purchases/analyze-sentiment' ,
                ['text' => $feedback]
            );
            $sentiment = $response->json()['TextBlob_Analysis'];

        } catch (\Exception $exception) {

        }

        return [
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
            'price' => $this->faker->numberBetween(50, 100),
            'mode' => $this->faker->randomElement(['online', 'offline']),
            'feedback' => $feedback,
            'sentiment' => $sentiment
        ];
    }
}
