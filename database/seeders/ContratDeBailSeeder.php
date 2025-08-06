<?php

namespace Database\Seeders;

use App\Models\ContratDeBail;
use Illuminate\Database\Seeder;

class ContratDeBailSeeder extends Seeder
{
    public function run(): void
    {
        ContratDeBail::create([
            'date_debut' => '2024-01-01',
            'date_fin' => '2024-12-31',
            'pdf' => 'contrats/contrat_salifou_2024.pdf',
            'loyer_mensuel' => 65000,
            'caution' => 195000,
            'statut' => 'actif',
            'locataire_id' => 1,
            'maison_id' => 2
        ]);

        ContratDeBail::create([
            'date_debut' => '2024-06-01',
            'date_fin' => '2025-05-31',
            'pdf' => 'contrats/contrat_simina_2024.pdf',
            'loyer_mensuel' => 35000,
            'caution' => 105000,
            'statut' => 'actif',
            'locataire_id' => 2,
            'maison_id' => 3
        ]);
    }
}