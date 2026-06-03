<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Comite 1',
            'email' => 'comite1@comite.es',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->syncRoles('comite');

        User::create([
            'name' => 'Comite 2',
            'email' => 'comite2@comite.es',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->syncRoles('comite');
        
        User::create([
            'name' => 'Comite 3',
            'email' => 'comite3@comite.es',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->syncRoles('comite');
    }
}