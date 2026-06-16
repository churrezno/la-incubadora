<?php

namespace Database\Seeders;

use App\Models\Asignacion;
use App\Models\Inscripcion;
use App\Models\Slate;
use App\Models\User;
use App\Models\Valoracion;
use App\Models\ValoracionSlate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsignacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comites = User::role('comite')->get();

        $maxComites = min(3, $comites->count());

        foreach (Inscripcion::all() as $inscripcion) {
            $selectedComites = $comites->random(fake()->numberBetween(0, $maxComites));

            foreach ($selectedComites as $comite) {
                $asignacion = Asignacion::create([
                    'user_id' => $comite->id,
                    'asignable_type' => Inscripcion::class,
                    'asignable_id' => $inscripcion->id,
                ]);

                Valoracion::create([
                    'asignacion_id' => $asignacion->id,
                    'guion' => fake()->paragraph(2),
                    'puntos_guion' => fake()->numberBetween(0, 20) / 2,
                    'financiacion' => fake()->paragraph(2),
                    'puntos_financiacion' => fake()->numberBetween(0, 20) / 2,
                    'solicitante' => fake()->paragraph(2),
                    'puntos_solicitante' => fake()->numberBetween(0, 20) / 2,
                    'puntos_total' => fake()->numberBetween(0, 20) / 2,
                ]);
            }
        }

        foreach (Slate::all() as $slate) {
            $selectedComites = $comites->random(fake()->numberBetween(0, $maxComites));

            foreach ($selectedComites as $comite) {
                $asignacion = Asignacion::create([
                    'user_id' => $comite->id,
                    'asignable_type' => Slate::class,
                    'asignable_id' => $slate->id,
                ]);

                ValoracionSlate::create([
                    'asignacion_id' => $asignacion->id,
                    'comentarios' => fake()->paragraph(2),
                    'puntos' => fake()->numberBetween(0, 20) / 2,
                ]);
            }
        }
    }
}