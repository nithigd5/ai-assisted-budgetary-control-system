<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\Product;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users  = User::all();

        $products = Product::query()->latest()->limit(1000)->get('id')->toArray();

        foreach ($users as $user)
        {
            $month = CarbonPeriod::create(now()->subMonths(3), now());

            foreach ($month as $date) {
                Expense::factory(3)->create([
                    'user_id' => $user->id ,
                    'created_at' => $date,
                    'product_id' => fake()->randomElement($products)['id']
                ]);
            }
        }
    }
}
