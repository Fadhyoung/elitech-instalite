<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);

        User::factory()->create([
            'name' => 'Test User',
            'username' => '12345678',
            'email' => 'test@example.com',
            'bio' => 'This is a sample bio for John Doe.',
        ]);
    }
}
