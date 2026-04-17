<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'churro',
            'email' => 'jorge@devala.es',
            'email_verified_at' => now(),
            'password' => bcrypt('yu4daas2')
        ])->syncRoles('admin');

        User::create([
            'name' => 'juancarlos',
            'email' => 'juancarlos.calvo@ecam.es',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ])->syncRoles('admin');
    }
}
