<?php

namespace App\Http\Controllers;

use App\Models\RapportImmobilier;
use App\Models\Locataire;
use App\Models\Maison;
use App\Models\Proprietaire;
use Illuminate\Http\Request;

class RapportMensuelController extends Controller
{
    // Liste des rapports, regroupés par propriétaire
    public function index(Request $request)
    {
        $mois = $request->get('mois', date('m'));
        $annee = $request->get('annee', date('Y'));

        $rapports = RapportImmobilier::with(['locataire', 'proprietaire', 'maison'])
            ->whereMonth('date_rapport', $mois)
            ->whereYear('date_rapport', $annee)
            ->get()
            ->groupBy('proprietaire.nom');

        return view('rapports_mensuels.index', compact('rapports', 'mois', 'annee'));
    }

    // Formulaire de création
    public function create()
    {   $maisons = Maison::all();   
        $locataires = Locataire::all();
        $proprietaires = Proprietaire::all();
        return view('rapports_mensuels.create', compact('locataires', 'proprietaires', 'maisons'));
    }

    // Enregistrer un rapport
    public function store(Request $request)
    {
        $validated = $request->validate([
            'locataire_id' => 'required|exists:locataires,id',
            'proprietaire_id' => 'required|exists:proprietaires,id',
            'maison_id' => 'nullable|exists:maisons,id',
            'total' => 'required|numeric|min:0',
            'commission' => 'required|numeric|min:0',
            'total_net' => 'required|numeric|min:0',
            'mois_annee' => 'required|string|max:255',
            'date_rapport' => 'required|date',
            'mode_paiement' => 'nullable|string|max:50',
        ]);

        RapportImmobilier::create($validated);

        return redirect()->route('rapports_mensuels.index')->with('success', 'Rapport créé avec succès');
    }
// Formulaire édition
public function edit(RapportMensuel $rapportMensuel)
{
    $locataires = Locataire::all();
    $proprietaires = Proprietaire::all();
    $maisons = Maison::all();

    return view('rapports_mensuels.edit', [
        'rapport' => $rapportMensuel, 
        'locataires' => $locataires,
        'proprietaires' => $proprietaires,
        'maisons' => $maisons,
    ]);
}

// Mettre à jour un rapport
public function update(Request $request, RapportMensuel $rapportMensuel)
{
    $validated = $request->validate([
        'locataire_id' => 'required|exists:locataires,id',
        'proprietaire_id' => 'required|exists:proprietaires,id',
        'maison_id' => 'nullable|exists:maisons,id',
        'total' => 'required|numeric|min:0',
        'commission' => 'required|numeric|min:0',
        'total_net' => 'required|numeric|min:0',
        'mois_annee' => 'required|string|max:255',
        'date_rapport' => 'required|date',
        'mode_paiement' => 'nullable|string|max:50',
    ]);

    $rapportMensuel->update($validated);

    return redirect()->route('rapports_mensuels.index')
        ->with('success', 'Rapport mis à jour');
}

    // Supprimer un rapport
    public function destroy(RapportImmobilier $rapport)
    {
        $rapport->delete();
        return redirect()->route('rapports_mensuels.index')->with('success', 'Rapport supprimé');
    }

    // Voir un rapport
    public function show(RapportImmobilier $rapport)
    {
        $rapport->load(['locataire', 'proprietaire', 'maison']);
        return view('rapports_mensuels.show', compact('rapport'));
    }
}