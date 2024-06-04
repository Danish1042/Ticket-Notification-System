<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 3 users
        $users = User::factory()->count(3)->create();

        // Create 9 tickets
        $tickets = Ticket::factory()->count(9)->create();

        // Assign each ticket to 1-3 random users
        $tickets->each(function ($ticket) use ($users) {
            $ticket->users()->attach(
                $users->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
