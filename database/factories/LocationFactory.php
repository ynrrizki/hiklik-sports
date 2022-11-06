<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id' => mt_rand(1, 3),
            'title' => fake()->sentence(mt_rand(2, 8)),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
