<?php

namespace Database\Seeders;

use App\Models\Feed;
use App\Models\Profile;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user) {
            $user->profile()->save(Profile::factory()->make());
            $user->feeds()->saveMany(Feed::factory(3)->make());
            $user->setting()->save(Setting::factory()->make());
        });
    }
}
