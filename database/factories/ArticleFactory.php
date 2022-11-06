<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ArticleFactory extends Factory
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
            'author' => fake()->name(),
            'featured_image' => fake()->imageUrl(640, 480, 'animals', true),
            'content' => collect(fake()->paragraphs(mt_rand(5, 10)))->map(fn ($p) => "<p>$p</p>")->implode(''),
        ];
    }
}
