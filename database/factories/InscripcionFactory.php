<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\inscripcion>
 */
class InscripcionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Paso 1
            'titulo' => $this->faker->words(3, true),
            'director' => $this->faker->name(),
            'fecha_nac_director' => $this->faker->date(),
            'sexo_director' => $this->faker->randomElement(['masculino', 'femenino', 'otro']),
            'switch_largometrajes' => $this->faker->boolean(),
            'largometrajes' => $this->faker->randomElement([null, 'Los Goonies', 'Seven', 'Fargo']),
            'switch_codirector' => $this->faker->boolean(),
            'codirector' => $this->faker->name(),
            'switch_guionista' => $this->faker->boolean(),
            'guionista' => $this->faker->name(),
            'switch_coguionista' => $this->faker->boolean(),   
            'coguionista' => $this->faker->name(),

            // Paso 2
            'productora' => $this->faker->words(1, true),
            'tel_productor' => $this->faker->phoneNumber(),
            'cod_postal_productor' => $this->faker->numberBetween(10000, 99999),
            'ciudad_productor' => $this->faker->city(),
            'pais_productor' => $this->faker->country(),
            'email_productor' => $this->faker->email(),
            'web_productor' => $this->faker->url(),
            'productor' => $this->faker->name(),
            'fecha_nac_productor' => $this->faker->date(),
            'sexo_productor' => $this->faker->randomElement(['masculino', 'femenino', 'otro']),
            'switch_coproductor' => $this->faker->boolean(),
            'coproductor' => $this->faker->name(),
            'switch_paises_coproduccion' => $this->faker->boolean(),
            'paises_coproduccion' => $this->faker->country(),

            // Paso 3
            'biofilmografia_director' => $this->faker->text(150),
            'titulo_1' => $this->faker->words(2, true),
            'link_1' => $this->faker->url(),
            'password_1' => $this->faker->word(),
            'titulo_2' => $this->faker->words(2, true),
            'link_2' => $this->faker->url(),
            'password_2' => $this->faker->word(),
            'titulo_3' => $this->faker->words(2, true),
            'link_3' => $this->faker->url(),
            'password_3' => $this->faker->word(),
            'nota_director' => $this->faker->text(150),
            'biofilmografia_productora' => $this->faker->text(150),
            'nota_productor' => $this->faker->text(150),
            'biofilmografia_guionista' => $this->faker->text(150),
            'idioma' => $this->faker->word(),
            'duracion' => $this->faker->numberBetween(70, 150),
            'genero' => $this->faker->randomElement(['Terror', 'Comedia', 'Drama']),
            'logline' => $this->faker->text(150),
            'sinopsis' => $this->faker->text(150),
            'presupuesto' => $this->faker->numberBetween(35000, 1500000),
            'plan_financiacion' => $this->faker->text(150),
            'plan_promocion' => $this->faker->text(150),
            'switch_otros_programas' => $this->faker->boolean(),
            'otros_programas' => $this->faker->text(50),
            'switch_otras_incubadora' => $this->faker->boolean(),
            'status' => $this->faker->text(150),
            'otros_proyectos' => $this->faker->text(50),
            'motivaciones' => $this->faker->text(150),
            'conocido' => $this->faker->text(150),
            'switch_acepta_bases' => true,
            'switch_acepta_politica' => true,
            
            'user_id' => User::all()->random()->id,
            'categoria_id' => Categoria::all()->random()->id,
            'complete' => $this->faker->boolean()
        ];
    }
}
