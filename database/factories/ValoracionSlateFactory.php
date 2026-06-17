<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Asignacion;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ValoracionSlate>
 */
class ValoracionSlateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comentarios' => $this->faker->paragraph(2),
            'puntos' => $this->faker->randomFloat(1, 0, 10),
        ];
    }
}