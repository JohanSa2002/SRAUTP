<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(6),
            'students' => fake()->name() . ', ' . fake()->name(),
            'year' => fake()->year(),
            'career' => fake()->randomElement(['Ingeniería de Sistemas', 'Ingeniería Mecánica', 'Licenciatura en Comunicación']),
            'pdf_path' => 'articles/sample.pdf',
            'status' => fake()->randomElement(['revisión', 'aprobado', 'rechazado']),
            'user_id' => User::factory(),
            'advisor_id' => User::factory()->state(['is_advisor' => true]),
            'comments' => fake()->paragraph(),
            'event_id' => Event::factory(),
        ];
    }
}
