<?php

namespace Database\Seeders;

use App\Models\Archivo_tipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArchivoTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Archivo_tipo::create(['name' => 'Imagen proyecto']);
        Archivo_tipo::create(['name' => 'PDF guion']);
        Archivo_tipo::create(['name' => 'PDF info extra']);
    }
}
