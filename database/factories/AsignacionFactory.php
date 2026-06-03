<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Asignacion;
use App\Models\Inscripcion;
use App\Models\Slate;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asignacion>
 */
class AsignacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [Inscripcion::class, Slate::class];
        $type = fake()->randomElement($types);

        return [
            'user_id' => User::all()->random()->id,
            'asignable_type' => $type,
            'asignable_id' => $type === Inscripcion::class
                ? Inscripcion::all()->random()->id
                : Slate::all()->random()->id,
        ];
    }
}