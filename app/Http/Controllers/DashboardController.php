<?php

namespace App\Http\Controllers;
use App\Models\Chambre;
use App\Models\ContratDeBail;
use App\Models\Locataire;
use App\Models\Maison;
use App\Models\Proprietaire;
use App\Models\RapportImmobilier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function menu()
    {
        $stats = [
        'proprietaires' => Proprietaire::count(),
        'locataires' => Locataire::count(),
        'maisons' => Maison::count(),
        'chambres_disponibles' => Chambre::where('statut', 'libre')->count(),
        'contrats_actifs' => ContratDeBail::count(),
        'revenus_totaux' => RapportImmobilier::sum('total_net'),
    ];
    return view('dashboard', compact('stats'));
    }
}