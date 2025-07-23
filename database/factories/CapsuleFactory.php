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
            "title" => $this->faker->realText(),
            "message" => $this->faker->realText(180),
            "is_surprise"=>$this-> faker->boolean(30),
            "revealed_at"=>$this->faker->dateTimeBetween('-1 month', 'now'),
            "emoji"=>null,
            "color"=>$this->faker->hexColor(),
            "cover_image_url"=>$this->faker->boolean(50) ?'https://picsum.photos/seed/' . $this->faker->uuid() . '/640/480' : null,

        ];
    }
}
