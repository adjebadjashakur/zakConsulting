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

        Locataire::create([
        'nom' => 'MENSAH',
        'prenom' => 'Akosua',
        'telephone' => '92987654',
        'email' => 'akosua.mensah@hotmail.com',
        'carte_identite_recto' => '0743-891-234',
        'carte_identite_verso' => '0743-891-235',
        'nationalite' => 'Ghanéenne',
        'situation_matrimoniale' => 'Veuf/Veuve',
        ]);

        Locataire::create([
        'nom' => 'DIABRE',
        'prenom' => 'Fatou',
        'telephone' => '90876543',
        'email' => 'fatou.diabre@outlook.com',
        'carte_identite_recto' => '0856-345-678',
        'carte_identite_verso' => '0856-345-679',
        'nationalite' => 'Burkinabé',
        'situation_matrimoniale' => 'Marié(e)',
        ]);

        Locataire::create([
        'nom' => 'TRAORE',
        'prenom' => 'Sekou',
        'telephone' => '93456789',
        'email' => 'sekou.traore@gmail.com',
        'carte_identite_recto' => '0912-456-789',
        'carte_identite_verso' => '0912-456-790',
        'nationalite' => 'Malienne',
        'situation_matrimoniale' => 'Divorcé(e)',
        ]);


        Locataire::create([
        'nom' => 'OUEDRAOGO',
        'prenom' => 'Aminata',
        'telephone' => '94321087',
        'email' => 'aminata.ouedraogo@yahoo.com',
        'carte_identite_recto' => '1024-567-890',
        'carte_identite_verso' => '1024-567-891',
        'nationalite' => 'Nigérienne',
        'situation_matrimoniale' => 'Célibataire',
        ]);
        } 
    } 