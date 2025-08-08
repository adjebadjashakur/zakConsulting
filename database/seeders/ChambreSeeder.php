<?php

namespace Database\Seeders;

use App\Models\Chambre;
use Illuminate\Database\Seeder;

class ChambreSeeder extends Seeder
{
    public function run(): void
    {
        // Chambres pour Maison 1
        Chambre::create([
            'code_chambre' => 'CH-V1-01',
            'type' => 'Chambre simple',
            'loyer_individuel' => 25000,
            'statut' => 'libre',
            'maison_id' => 1 
        ]);

        Chambre::create([
            'code_chambre' => 'CH-V1-02',
            'type' => 'Chambre double',
            'loyer_individuel' => 30000,
            'statut' => 'occupé',
            'maison_id' => 1
        ]);
        Chambre::create([
            'code_chambre' => 'CH-V1-03',
            'type' => 'Chambre simple',
            'loyer_individuel' => 22000,
            'statut' => 'libre',
            'maison_id' => 1
        ]);
        // Chambres pour Maison 2
        Chambre::create([
            'code_chambre' => 'CH-V2-01',
            'type' => 'Chambre double',
            'loyer_individuel' => 28000,
            'statut' => 'libre',
            'maison_id' => 2
        ]);

        Chambre::create([
            'code_chambre' => 'CH-V2-02',
            'type' => 'Chambre simple',
            'loyer_individuel' => 20000,
            'statut' => 'maintenance',
            'maison_id' => 2
            
        ]);

        // Chambres pour Maison 3
        Chambre::create([
            'code_chambre' => 'CH-V3-01',
            'type' => 'Studio',
            'loyer_individuel' => 35000,
            'statut' => 'libre',
            'maison_id' => 3
        ]);
    }
}