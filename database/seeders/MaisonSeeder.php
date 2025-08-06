<?php

namespace Database\Seeders;

use App\Models\Maison;
use Illuminate\Database\Seeder;

class MaisonSeeder extends Seeder
{
    public function run(): void
    {
        Maison::create([
            'nom' => 'Villa Agbessi',
            'adresse' => 'Agoe Adjougba, près du marché',
            'quartier' => 'Agoe Adjougba',
            'superficie' => '120 m²',
            'description' => 'Belle villa avec 3 chambres, salon, cuisine équipée',
            'loyer_mensuel' => 85000,
            'statut' => 'libre',
            'proprietaire_id' => 1
        ]);

        Maison::create([
            'nom' => 'Appartement Hindou',
            'adresse' => 'Bè Kpota, route de Kpalimé',
            'quartier' => 'Bè Kpota',
            'superficie' => '90 m²',
            'description' => 'Appartement 2 chambres salon avec terrasse',
            'loyer_mensuel' => 65000,
            'statut' => 'occupé',
            'proprietaire_id' => 2
        ]);

        Maison::create([
            'nom' => 'Studio Dossou',
            'adresse' => 'Nyékonakpoè, près de l\'université',
            'quartier' => 'Nyékonakpoè',
            'superficie' => '45 m²',
            'description' => 'Studio moderne pour étudiant',
            'loyer_mensuel' => 35000,
            'statut' => 'libre',
            'proprietaire_id' => 3
        ]);
    }
}
