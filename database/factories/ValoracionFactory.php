<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Inscripcion;
use App\Models\Asignacion;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Valoracion>
 */
class ValoracionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'guion' => $this->faker->paragraph(2),
            'puntos_guion' => $pg = $this->faker->randomFloat(1, 0, 10),
            'financiacion' => $this->faker->paragraph(2),
            'puntos_financiacion' => $pf = $this->faker->randomFloat(1, 0, 10),
            'solicitante' => $this->faker->paragraph(2),
            'puntos_solicitante' => $ps = $this->faker->randomFloat(1, 0, 10),
            'puntos_total' => round( ($pg + $pf + $ps) / 3, 1 ),
            //'asignacion_id' => Asignacion::all()->random()->id
        ];
    }
}
