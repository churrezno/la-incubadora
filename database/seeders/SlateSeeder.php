<?php

namespace Database\Seeders;

use App\Models\Archivo;
use App\Models\Archivo_tipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Slate;

class SlateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        $slates = Slate::factory(10)->create();

        foreach ($slates as $slate) {
            Archivo::factory(1)->create([
                'archivable_id' => $slate->id,
                'archivable_type' => Slate::class,
                'archivo_tipo_id' => Archivo_tipo::all()->random()->id
            ]);
        }
    }
}
