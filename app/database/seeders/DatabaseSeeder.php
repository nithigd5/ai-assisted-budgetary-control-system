<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Expense;
use App\Models\ExpensesBudget;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Coderflex\LaravelTicket\Models\Ticket;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Nithi',
            'email' => 'nithi@email.com',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Ameen',
            'email' => 'ameen@email.com',
        ]);

        Product::factory(10)->create();

        $users = User::all();

        foreach ($users as $user) {
            Ticket::query()->insert(array_fill_keys([0, 1, 2], [
                'title' => fake()->sentence, 'created_at' => now(), 'updated_at' => now(),
                'message' => fake()->paragraph(2),
                'user_id' => $user->id,
                'assigned_to' => $user->id == ($id = fake()->randomElement([1,2])) ? $user->id + 1 : $id
            ]));
        }


        $this->call(ProductSeeder::class);
        $this->call(ExpenseSeeder::class);

    }
}
