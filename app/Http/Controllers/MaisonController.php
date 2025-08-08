<?php

namespace App\Http\Controllers;

use App\Models\Maison;
use App\Models\Proprietaire;
use Illuminate\Http\Request;

class MaisonController extends Controller
{
    public function index()
    { 
        $maisons = Maison::with(['proprietaire', 'chambres'])->get();
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
        $maison->load('proprietaire', 'contratDeBails.locataire');
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
        $maison->delete();
        return redirect()->route('maisons.index')->with('success', 'Maison supprimée avec succès');
    }
}