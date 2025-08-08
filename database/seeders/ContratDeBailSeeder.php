<?php

namespace Database\Seeders;

use App\Models\ContratDeBail;
use App\Models\Chambre;
use Illuminate\Database\Seeder;

class ContratDeBailSeeder extends Seeder
{
    public function run(): void
    {
        function loyerDeChambre(int $chambre_id): int {
            $chambre = Chambre::find($chambre_id);
            return $chambre ? $chambre->loyer_individuel : 0;
        }

        ContratDeBail::create([
            'date_debut' => '2024-01-01',
            'date_fin' => '2024-12-31',
            'pdf' => 'contrats/contrat_salifou_2024.pdf',
            'statut' => 'actif',
            'locataire_id' => 1,
            'maison_id' => 2,
            'chambre_id' => 4,
            'loyer_mensuel' => loyerDeChambre(4),
            'caution' => loyerDeChambre(4) * 0.10,
        ]);

        ContratDeBail::create([
            'date_debut' => '2024-06-01',
            'date_fin' => '2025-05-31',
            'pdf' => 'contrats/contrat_simina_2024.pdf',
            'statut' => 'actif',
            'locataire_id' => 2,
            'maison_id' => 3,
            'chambre_id' => 6,
            'loyer_mensuel' => loyerDeChambre(6),
            'caution' => loyerDeChambre(6) * 0.10,
        ]);

        ContratDeBail::create([
            'date_debut' => '2024-03-15',
            'date_fin' => '2025-03-14',
            'pdf' => 'contrats/contrat_rodrigue_2024.pdf',
            'statut' => 'actif',
            'locataire_id' => 3,
            'maison_id' => 1,
            'chambre_id' => 2,
            'loyer_mensuel' => loyerDeChambre(2),
            'caution' => loyerDeChambre(2) * 0.10,
        ]);

        ContratDeBail::create([
            'date_debut' => '2024-02-01',
            'date_fin' => '2025-01-31',
            'pdf' => 'contrats/contrat_mensah_2024.pdf',
            'statut' => 'termine', 
            'locataire_id' => 4,
            'maison_id' => 1,
            'chambre_id' => 1,
            'loyer_mensuel' => loyerDeChambre(1),
            'caution' => loyerDeChambre(1) * 0.10,
        ]);

        ContratDeBail::create([
            'date_debut' => '2024-04-01',
            'date_fin' => '2025-03-31',
            'pdf' => 'contrats/contrat_diabre_2024.pdf',
            'statut' => 'suspendu',
            'locataire_id' => 5,
            'maison_id' => 2,
            'chambre_id' => 5,
            'loyer_mensuel' => loyerDeChambre(5),
            'caution' => loyerDeChambre(5) * 0.10,
        ]);

        ContratDeBail::create([
            'date_debut' => '2024-05-15',
            'date_fin' => '2025-05-14',
            'pdf' => 'contrats/contrat_traore_2024.pdf',
            'statut' => 'actif',
            'locataire_id' => 6,
            'maison_id' => 1,
            'chambre_id' => 3,
            'loyer_mensuel' => loyerDeChambre(3),
            'caution' => loyerDeChambre(3) * 0.10,
        ]);
    }
}