<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slate>
 */
class SlateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'productor' => $this->faker->name(),
            'fecha_nac_productor' => $this->faker->date(),
            'sexo_productor' => $this->faker->randomElement(['masculino', 'femenino', 'otro']),
            'productora' => $this->faker->words(1, true),
            'tel_productor' => $this->faker->phoneNumber(),
            'cod_postal_productor' => $this->faker->numberBetween(10000, 99999),
            'ciudad_productor' => $this->faker->city(),
            'pais_productor' => $this->faker->country(),
            'email_productor' => $this->faker->email(),
            'web_productor' => $this->faker->url(),
            'user_id' => User::all()->random()->id,
            'categoria_id' => Categoria::all()->random()->id,
        ];
    }
}