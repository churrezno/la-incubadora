<?php

namespace Database\Seeders;

use App\Models\Archivo;
use App\Models\Archivo_tipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inscripcion;

class InscripcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        $inscripciones = Inscripcion::factory(10)->create();

        foreach ($inscripciones as $inscripcion) {
            Archivo::factory(1)->create([
                'archivable_id' => $inscripcion->id,
                'archivable_type' => Inscripcion::class,
                'archivo_tipo_id' => Archivo_tipo::all()->random()->id
            ]);
        }
    }
}
