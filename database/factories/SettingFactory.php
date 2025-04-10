<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    protected $model = Setting::class;
    public function definition(): array
    {
        return [
            'feed_columns' => $this->faker->randomElement([2, 3, 4]),
            'show_videos' => $this->faker->boolean(),
        ];
    }
}
