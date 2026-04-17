<?php

namespace Database\Seeders;

use App\Models\Valoracion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ValoracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Valoracion::factory(25)->create();
    }
}
