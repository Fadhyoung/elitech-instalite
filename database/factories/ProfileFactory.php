<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{

     protected $model = Profile::class;
     
    public function definition(): array
    {
        return [
            'username' => $this->faker->userName(),
            'bio' => $this->faker->sentence(),
            'avatar' => 'avatars/default.png',
        ];
    }
}
