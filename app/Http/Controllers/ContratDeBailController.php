<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use App\Models\ContratDeBail;
use App\Models\Locataire;
use App\Models\Maison;
use App\Models\Proprietaire;

use Illuminate\Http\Request;

class ContratDeBailController extends Controller
{
    public function index()
    {
        $contrats = ContratDeBail::with('locataire', 'proprietaire', 'maison', 'chambre')->get();
        return view('contrat_de_bails.index', compact('contrats'));
    }
    public function create(Request $request)
    {
        $maisons = Maison::all();
        $chambres = [];
        $chambre = null;
        $locataires = Locataire::all();

        if ($request->filled('maison_id')) {
            $chambres = Chambre::where('maison_id', $request->maison_id)->get();
        }

        if ($request->filled('chambre_id')) {
            $chambre = Chambre::find($request->chambre_id);
        }

        return view('contrat_de_bails.create', compact('maisons', 'chambres', 'chambre', 'locataires'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'pdf' => 'nullable|file',
            'loyer_mensuel' => 'required|numeric|min:0',
            'caution' => 'nullable|numeric|min:0',
            'statut' => 'required|in:actif,expire,resilie',
            'locataire_id' => 'required|exists:locataires,id',
            'maison_id' => 'required|exists:maisons,id',
            'chambre_id' => 'nullable|exists:chambres,id'
        ]);
            $data = $request->all();

        // Calculer 10% du loyer
        $caution_auto = $request->loyer_mensuel * 0.10;

        // Si caution non renseignée, on fixe la caution à 10% du loyer
        if (empty($request->caution)) {
            $data['caution'] = $caution_auto;
        }
        if ($request->hasFile('pdf')) {
        $validated['pdf'] = $request->file('pdf')->store('pdfs', 'public');
    }

        ContratDeBail::create($request->all());
        
        // Mettre à jour le statut de la maison
        Maison::find($request->maison_id)->update(['statut' => 'occupé']);
        
        return redirect()->route('contrat_de_bails.index')->with('success', 'Contrat créé avec succès');
    }

    public function show(ContratDeBail $contratDeBail)
    {
        $contratDeBail->load('locataire', 'maison.proprietaire');
        return view('contrat_de_bails.show', compact('contratDeBail'));
    }

    public function edit(ContratDeBail $contratDeBail)
    {
        $locataires = Locataire::all();
        $maisons = Maison::all();
        return view('contrat_de_bails.edit', compact('contratDeBail', 'locataires', 'maisons'));
    }

    public function update(Request $request, ContratDeBail $contratDeBail)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'pdf' => 'nullable|string|max:255',
            'loyer_mensuel' => 'required|numeric|min:0',
            'caution' => 'nullable|numeric|min:0',
            'statut' => 'required|in:actif,expire,resilie',
            'locataire_id' => 'required|exists:locataires,id',
            'maison_id' => 'required|exists:maisons,id',
            'chambre_id' => 'nullable|exists:chambres,id'
        ]);

        $contratDeBail->update($request->all());
        return redirect()->route('contrat_de_bails.index')->with('success', 'Contrat modifié avec succès');
    }

    public function destroy(ContratDeBail $contratDeBail)
    {
        // Libérer la maison
        $contratDeBail->maison->update(['statut' => 'libre']);
        
        $contratDeBail->delete();
        return redirect()->route('contrat_de_bails.index')->with('success', 'Contrat supprimé avec succès');
    }
}