<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notice>
 */
class NoticeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'summary' => fake()->sentence(10),
            'content' => fake()->paragraphs(3, true),
            'category' => fake()->randomElement(['Academia', 'Aviso', 'Investigación']),
            'is_active' => true,
        ];
    }
}
