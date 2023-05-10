<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Expense;
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

//        Product::factory(10)->create();

        \App\Models\User::factory(10)->create();

        $users  = User::all();
//
//        foreach ($users as $user) {
//            Ticket::query()->insert(array_fill_keys([0, 1, 2], [
//                'title' => fake()->sentence, 'created_at' => now(), 'updated_at' => now(),
//                'message' => fake()->paragraph(2),
//                'user_id' => $user->id,
//                'assigned_to' => $user->id == ($id = fake()->randomElement([1,2])) ? $user->id + 1 : $id
//            ]));
//        }


        foreach ($users as $user)
        {
            $month = CarbonPeriod::create(now()->startOfMonth(), now());

            foreach ($month as $date)
            {
                Expense::factory(3)->create([
                    'user_id' => $user->id,
                    'created_at' => $date
                ]);
            }
        }
    }
}
