<?php

namespace Database\Seeders;

use App\Models\Locataire;
use Illuminate\Database\Seeder;

class LocataireSeeder extends Seeder
{
    public function run(): void
    {
        Locataire::create([
            'nom' => 'SALIFOU',
            'prenom' => 'Moustapha',
            'telephone' => '90111222',
            'email' => 'moustapha@gmail.com',
            'carte_identite_recto' => '0439-135-501',
            'carte_identite_verso' => '0439-135-502',
            'nationalite' => 'Togolaise',
            'situation_matrimoniale' => 'Célibataire',
        ]);

        Locataire::create([
            'nom' => 'SIMINA',
            'prenom' => 'Fad',
            'telephone' => '91222333',
            'email' => 'simina@yahoo.com',
            'carte_identite_recto' => '0439-135-503',
            'carte_identite_verso' => '0439-135-504',
            'nationalite' => 'Togolaise',
            'situation_matrimoniale' => 'Mariée',
        ]);

        Locataire::create([
            'nom' => 'RODRIGUE',
            'prenom' => 'Affo',
            'telephone' => '92333444',
            'email' => 'rodrigue@gmail.com',
            'carte_identite_recto' => '0439-135-505',
            'carte_identite_verso' => '0439-135-506',
            'nationalite' => 'Togolaise',
            'situation_matrimoniale' => 'Divorcé',
        ]);
    }
}