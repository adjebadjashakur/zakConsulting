<?php

namespace App\Http\Controllers;

use App\Models\RapportImmobilier;
use App\Models\Proprietaire;
use Illuminate\Http\Request;

class RapportImmobilierController extends Controller
{
    public function index()
    {
        $rapports = RapportImmobilier::with('proprietaire')->get();
        return view('rapport_immobiliers.index', compact('rapports'));
    }

    public function create()
    {
        $proprietaires = Proprietaire::all();
        return view('rapport_immobiliers.create', compact('proprietaires'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'locataire' => 'required|string|max:255',
            'total' => 'required|numeric|min:0',
            'commission' => 'required|numeric|min:0',
            'total_net' => 'required|numeric|min:0',
            'mois_annee' => 'required|string|max:255',
            'date_rapport' => 'required|date',
            'proprietaire_id' => 'required|exists:proprietaires,id'
        ]);

        RapportImmobilier::create($request->all());
        return redirect()->route('rapport_immobiliers.index')->with('success', 'Rapport créé avec succès');
    }

    public function show(RapportImmobilier $rapportImmobilier)
    {
        $rapportImmobilier->load('proprietaire');
        return view('rapport_immobiliers.show', compact('rapportImmobilier'));
    }

    public function edit(RapportImmobilier $rapportImmobilier)
    {
        $proprietaires = Proprietaire::all();
        return view('rapport_immobiliers.edit', compact('rapportImmobilier', 'proprietaires'));
    }

    public function update(Request $request, RapportImmobilier $rapportImmobilier)
    {
        $request->validate([
            'locataire' => 'required|string|max:255',
            'total' => 'required|numeric|min:0',
            'commission' => 'required|numeric|min:0',
            'total_net' => 'required|numeric|min:0',
            'mois_annee' => 'required|string|max:255',
            'date_rapport' => 'required|date',
            'proprietaire_id' => 'required|exists:proprietaires,id'
        ]);

        $rapportImmobilier->update($request->all());
        return redirect()->route('rapport_immobiliers.index')->with('success', 'Rapport modifié avec succès');
    }

    public function destroy(RapportImmobilier $rapportImmobilier)
    {
        $rapportImmobilier->delete();
        return redirect()->route('rapport_immobiliers.index')->with('success', 'Rapport supprimé avec succès');
    }
}
