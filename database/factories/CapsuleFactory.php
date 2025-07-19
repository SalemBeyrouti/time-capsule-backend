<?php

namespace Database\Factories;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Capsule>
 */
class CapsuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [ 
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            "title" => $this->faker->unique()->words(3, true),
            "message" => $this->faker->paragraph,
            "is_surprise"=> false,
            "revealed_at"=>$this->faker->dateTime(),
            "emoji"=>$this->faker->unique()->words(3, true),
            "color"=>$this->faker->safeColorName,
            "cover_image_url"=>$this->faker->imageUrl(),

        ];
    }
}
