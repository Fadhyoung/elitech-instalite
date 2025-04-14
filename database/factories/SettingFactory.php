<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    protected $model = Setting::class;

    public function definition(): array
    {
        return [
            'feeds_per_row' => $this->faker->numberBetween(2, 5),
            'feed_columns' => $this->faker->numberBetween(2, 5),
            'show_videos' => $this->faker->boolean(),
            'show_photos' => $this->faker->boolean(),
        ];
    }
}
