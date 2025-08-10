<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use App\Models\Maison;
use Illuminate\Http\Request;

class ChambreController extends Controller
{   public function index()
    {
        $chambres = Chambre::with(['maison', 'locataire'])->get();
        return view('chambres.index', compact('chambres'));
    }


    public function create()
    {
        // On a besoin de la liste des maisons pour lier la chambre
        $maisons = Maison::all();
        return view('chambres.create', compact('maisons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_chambre' => 'required|string|unique:chambres,code_chambre|max:255',
            'type' => 'nullable|string|max:255',
            'loyer_individuel' => 'required|numeric|min:0',
            'caution' => 'nullable|numeric|min:0',
            'statut' => 'required|in:libre,occupé,maintenance',
            'maison_id' => 'required|exists:maisons,id',
        ]);

        Chambre::create($request->all());

        return redirect()->route('chambres.index')->with('success', 'Chambre créée avec succès');
    }

    public function show(Chambre $chambre)
    {
        $chambre->load('maison');
        return view('chambres.show', compact('chambre'));
    }

    public function edit(Chambre $chambre)
    {
        $maisons = Maison::all();
        return view('chambres.edit', compact('chambre', 'maisons'));
    }

    public function update(Request $request, Chambre $chambre)
    {
        $request->validate([
            'code_chambre' => 'required|string|max:255|unique:chambres,code_chambre,' . $chambre->id,
            'type' => 'nullable|string|max:255',
            'loyer_individuel' => 'required|numeric|min:0',
            'caution' => 'nullable|numeric|min:0',
            'statut' => 'required|in:libre,occupé,maintenance',
            'maison_id' => 'required|exists:maisons,id',
        ]);

        $chambre->update($request->all());

        return redirect()->route('chambres.index')->with('success', 'Chambre modifiée avec succès');
    }

    public function destroy(Chambre $chambre)
    {
        $chambre->delete();
        return redirect()->route('chambres.index')->with('success', 'Chambre supprimée avec succès');
    }
}