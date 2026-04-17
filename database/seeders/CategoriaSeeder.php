<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        Categoria::create(['name' => 'Sin categoría', 'order' => '0']);
        Categoria::create(['name' => 'Descartada', 'order' => '10']);
        Categoria::create(['name' => 'Preseleccionada', 'order' => '20']);
        Categoria::create(['name' => 'Seleccionada', 'order' => '30']);
    }
}
