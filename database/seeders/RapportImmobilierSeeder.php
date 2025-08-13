<?php

namespace Database\Seeders;

use App\Models\RapportImmobilier;
use App\Models\ContratDeBail;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RapportImmobilierSeeder extends Seeder
{
    public function run(): void
    {
        // Génère un rapport pour chaque contrat (locataire, propriétaire) pour le mois courant
        $now = Carbon::now()->locale('fr');
        $moisAnnee = mb_strtoupper($now->isoFormat('MMMM YYYY'), 'UTF-8');
        $dateRapport = $now->copy()->endOfMonth()->toDateString();

        $contrats = ContratDeBail::with('maison')->get();

        foreach ($contrats as $contrat) {
            $maison = $contrat->maison; // Permet d'accéder au propriétaire via la maison
            if (!$maison || !$maison->proprietaire_id) {
                continue; // Ignore si la maison ou le propriétaire est manquant
            }

            $total = (float) ($contrat->loyer ?? 0);
            $commission = round($total * 0.10, 2); // 10% de commission
            $totalNet = round($total - $commission, 2);

            RapportImmobilier::firstOrCreate(
                [
                    'locataire_id' => (string) $contrat->locataire_id,
                    'maison_id' => (string) $contrat->maison_id,
                    'chambre_id' => (string) $contrat->chambre_id,
                    'proprietaire_id' => $maison->proprietaire_id,
                    'date_rapport' => $dateRapport,
                ],
                [
                    'total' => $total,
                    'commission' => $commission,
                    'total_net' => $totalNet,
                    'mois_annee' => $moisAnnee,
                ]
            );
        }
    }
}