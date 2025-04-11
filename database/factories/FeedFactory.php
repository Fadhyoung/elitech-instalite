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
            'media_path' => 'uploads/8edea7cd-f787-3e20-8c92-14b82ad58668.jpg',
            'media_type' => $this->faker->randomElement(['photo', 'video']),
            'caption' => $this->faker->sentence(),
        ];
    }
}
