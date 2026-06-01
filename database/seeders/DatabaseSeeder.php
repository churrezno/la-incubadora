<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Inscripcion;
use Illuminate\Database\Seeder;
use App\Models\User;

use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('archivos');
        Storage::makeDirectory('archivos');

        $this->call(RoleSeeder::class);
        User::factory(25)->create();
        $this->call(AdminSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(ArchivoTipoSeeder::class);
        $this->call(InscripcionSeeder::class);
        $this->call(AsignacionSeeder::class);
    }
}
