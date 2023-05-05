<?php

namespace Database\Seeders;

use Coderflex\LaravelTicket\Models\Category;
use Coderflex\LaravelTicket\Models\Label;
use Coderflex\LaravelTicket\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tickets = Ticket::all();

        for($i = 0; $i < 20; $i++)
        {
            $category[] = Category::query()->create(['name' => fake()->text(20), 'slug' => fake()->slug(2)]);
            $labels[] = Label::query()->create(['name' => fake()->text(20), 'slug' => fake()->slug(2)]);

        }

        foreach ($tickets as $ticket) {
            $ticket->syncCategories($category[rand(0, count($category)-1)]);
            $ticket->syncLabels($labels[rand(0, count($labels)-1)]);
        }
    }
}
