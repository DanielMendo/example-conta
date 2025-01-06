<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\Counter;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Receipt;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Counter::factory(10)->create();
        // Client::factory(10)->create();
        Receipt::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
