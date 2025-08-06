<?php

namespace Database\Seeders;

use App\Models\RapportImmobilier;
use Illuminate\Database\Seeder;

class RapportImmobilierSeeder extends Seeder
{
    public function run(): void
    {
        RapportImmobilier::create([
            'locataire' => 'SALIFOU Moustapha',
            'total' => 65000,
            'commission' => 6500,
            'total_net' => 58500,
            'mois_annee' => 'JANVIER 2025',
            'date_rapport' => '2025-01-31',
            'proprietaire_id' => 2
        ]);

        RapportImmobilier::create([
            'locataire' => 'SIMINA Esther',
            'total' => 35000,
            'commission' => 3500,
            'total_net' => 31500,
            'mois_annee' => 'JANVIER 2025',
            'date_rapport' => '2025-01-31',
            'proprietaire_id' => 3
        ]);
    }
}
