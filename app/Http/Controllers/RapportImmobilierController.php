<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use App\Models\ContratDeBail;
use App\Models\Locataire;
use App\Models\Maison;
use App\Models\RapportImmobilier;
use App\Models\Proprietaire;
use Illuminate\Http\Request;

class RapportImmobilierController extends Controller
{
    public function index(Request $request)
    {
        $mois = $request->get('mois', date('m'));
        $annee = $request->get('annee', date('Y'));

        $rapports = RapportImmobilier::with(['locataire', 'proprietaire', 'maison'])
            ->whereMonth('date_rapport', $mois)
            ->whereYear('date_rapport', $annee)
            ->get()
            ->groupBy('proprietaire.nom');

        return view('rapport_immobiliers.index', compact('rapports', 'mois', 'annee'));
    }
   public function create(Request $request)
    {
        // Charger toujours ces données
        $maisons = [];
        $maison = null;
        $locataires = Locataire::all();
        $proprietaires = Proprietaire::all();
        $contrats = ContratDeBail::all();
        $chambres = [];
        $chambre = null;

        if ($request->filled('proprietaire_id')) {
            $maisons = Maison::where('proprietaire_id', $request->proprietaire_id)->get();
        }

        // Si une maison est sélectionnée, charger uniquement ses chambres
        if ($request->filled('locataire_id')) {
            $chambres = Chambre::where('locataire_id', $request->locataire_id)->get();
        }
        return view('rapport_immobiliers.create', compact('proprietaires', 'locataires', 'maisons', 'chambres', 'contrats', 'chambre'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'locataire_id'    => 'nullable|exists:locataires,id',
            'maison_id'       => 'nullable|exists:maisons,id',
            'chambre_id'      => 'nullable|exists:chambres,id',
            'total'           => 'required|numeric|min:0',
            'commission'      => 'required|numeric|min:0',
            'total_net'       => 'required|numeric|min:0',
            'mois_annee'      => 'required|string|max:255',
            'date_rapport'    => 'required|date',
            'proprietaire_id' => 'required|exists:proprietaires,id',
        ]);
        RapportImmobilier::create($validated);
        return redirect()->route('rapport_immobiliers.index')->with('success', 'Rapport créé avec succès');
    }

    public function show(RapportImmobilier $rapportImmobilier)
    {
        $rapportImmobilier->load(['proprietaire', 'maison', 'locataire', 'chambre']);
        
        return view('rapport_immobiliers.show', compact('rapportImmobilier'));
    }

    public function edit(RapportImmobilier $rapportImmobilier)
    {      
        $proprietaires = Proprietaire::all(); 
        $locataires = Locataire::all(); 
        $maisons = Maison::where('proprietaire_id', $rapportImmobilier->proprietaire_id)->get();
        $chambres = Chambre::where('maison_id', $rapportImmobilier->maison_id)->get(); 
        $contrats = ContratDeBail::all();
        
        return view('rapport_immobiliers.edit', compact( 'rapportImmobilier', 'proprietaires', 'locataires', 'maisons', 'chambres', 'contrats' ));
}

    public function update(Request $request, RapportImmobilier $rapportImmobilier)
    {
        $validated = $request->validate([
            'locataire_id'    => 'nullable|exists:locataires,id',
            'maison_id'       => 'nullable|exists:maisons,id',
            'chambre_id'      => 'nullable|exists:chambres,id',
            'total'           => 'required|numeric|min:0',
            'commission'      => 'required|numeric|min:0',
            'total_net'       => 'required|numeric|min:0',
            'mois_annee'      => 'required|string|max:255',
            'date_rapport'    => 'required|date',
            'proprietaire_id' => 'required|exists:proprietaires,id',
        ]);

        $rapportImmobilier->update($validated);
        return redirect()->route('rapport_immobiliers.index')->with('success', 'Rapport modifié avec succès');
    }

    public function destroy(RapportImmobilier $rapportImmobilier)
    {
        $rapportImmobilier->delete();
        return redirect()->route('rapport_immobiliers.index')->with('success', 'Rapport supprimé avec succès');
    }
}