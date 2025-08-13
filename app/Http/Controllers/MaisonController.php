<?php

namespace App\Http\Controllers;

use App\Models\Maison;
use App\Models\Proprietaire;
use Illuminate\Http\Request;

class MaisonController extends Controller
{
    // API: Chambres par maison (libres uniquement)
    public function chambres($maisonId)
    {
        $chambres = \App\Models\Chambre::where('maison_id', $maisonId)
            ->where('statut', 'libre')
            ->orderBy('code_chambre')
            ->get(['id', 'code_chambre']);
        return response()->json($chambres);
    }

    public function index()
    { 
        // Utiliser paginate() au lieu de get() pour avoir la pagination
        $maisons = Maison::with(['proprietaire', 'chambres'])->paginate(5);
        return view('maisons.index', compact('maisons'));
    }

    public function create()
    {
        $proprietaires = Proprietaire::all();
        return view('maisons.create', compact('proprietaires'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string',
            'quartier' => 'nullable|string|max:255',
            'superficie' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'loyer_mensuel' => 'nullable|numeric|min:0',
            'statut' => 'required|in:libre,occupé,maintenance',
            'proprietaire_id' => 'required|exists:proprietaires,id'
        ]);

        Maison::create($request->all());
        return redirect()->route('maisons.index')->with('success', 'Maison créée avec succès');
    }

    public function show(Maison $maison)
    {
        // Charger les chambres avec leurs locataires pour la vue show
        $maison->load(['proprietaire', 'chambres.locataire']);
        return view('maisons.show', compact('maison'));
    }

    public function edit(Maison $maison)
    {
        $proprietaires = Proprietaire::all();
        return view('maisons.edit', compact('maison', 'proprietaires'));
    }

    public function update(Request $request, Maison $maison)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string',
            'quartier' => 'nullable|string|max:255',
            'superficie' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'loyer_mensuel' => 'nullable|numeric|min:0',
            'statut' => 'required|in:libre,occupé,maintenance',
            'proprietaire_id' => 'required|exists:proprietaires,id'
        ]);

        $maison->update($request->all());
        return redirect()->route('maisons.index')->with('success', 'Maison modifiée avec succès');
    }

    public function destroy(Maison $maison)
    {
        // Supprimer les chambres associées en premier (si cascade n'est pas configuré)
        $maison->chambres()->delete();
        $maison->delete();
        return redirect()->route('maisons.index')->with('success', 'Maison supprimée avec succès');
    }
}