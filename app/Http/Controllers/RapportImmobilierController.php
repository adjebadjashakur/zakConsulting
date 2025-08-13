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
    public function index()
    {
        $rapports = RapportImmobilier::with('proprietaire')
            ->orderByDesc('date_rapport')
            ->paginate(15);

        return view('rapport_immobiliers.index', compact('rapports'));
    }

    public function create()
    {  
        $locataires = Locataire::all();
        $proprietaires = Proprietaire::all();
        return view('rapport_immobiliers.create', compact( 'proprietaires', 'locataires'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'locataire' => 'required|string|max:255',
            'total' => 'required|numeric|min:0',
            'commission' => 'required|numeric|min:0',
            'total_net' => 'required|numeric|min:0',
            'mois_annee' => 'required|string|max:255',
            'date_rapport' => 'required|date',
            'proprietaire_id' => 'required|exists:proprietaires,id'
        ]);

        RapportImmobilier::create($validated);
        return redirect()->route('rapport_immobiliers.index')->with('success', 'Rapport créé avec succès');
    }

    public function show(RapportImmobilier $rapportImmobilier)
    {
        $rapportImmobilier->load('proprietaire');
        return view('rapport_immobiliers.show', compact('rapportImmobilier'));
    }

    public function edit(RapportImmobilier $rapportImmobilier)
    {       
        $locataires = Locataire::all();
        $proprietaires = Proprietaire::all();
        return view('rapport_immobiliers.edit', compact('rapportImmobilier', 'proprietaires', 'locataires'));
    }

    public function update(Request $request, RapportImmobilier $rapportImmobilier)
    {
        $validated = $request->validate([
            'locataire' => 'required|string|max:255',
            'total' => 'required|numeric|min:0',
            'commission' => 'required|numeric|min:0',
            'total_net' => 'required|numeric|min:0',
            'mois_annee' => 'required|string|max:255',
            'date_rapport' => 'required|date',
            'proprietaire_id' => 'required|exists:proprietaires,id'
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