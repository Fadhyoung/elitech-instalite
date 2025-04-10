<?php

namespace Database\Factories;

use App\Models\Feed;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feed>
 */
class FeedFactory extends Factory
{
    protected $model = Feed::class;

    public function definition(): array
    {
        return [
            'media_path' => 'uploads/' . $this->faker->uuid . '.jpg',
            'media_type' => $this->faker->randomElement(['photo', 'video']),
            'caption' => $this->faker->sentence(),
        ];
    }
}
