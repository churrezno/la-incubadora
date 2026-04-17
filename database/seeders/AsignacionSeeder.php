<?php

namespace Database\Seeders;

use App\Models\Asignacion;
use App\Models\Valoracion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsignacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $asignaciones = Asignacion::factory(25)->create();

        foreach ($asignaciones as $asignacion) {
            Valoracion::factory(1)->create([
                'asignacion_id' => $asignacion->id
            ]);
        }
    }
}
