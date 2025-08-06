<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nom' => 'Admin',
            'prenom' => 'ZAK',
            'email' => 'admin@zakconsulting.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'nom' => 'Secrétaire',
            'prenom' => 'Général',
            'email' => 'secretaire@zakconsulting.com',
            'password' => Hash::make('password'),
        ]);
    }
}