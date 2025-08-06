<?php

namespace App\Http\Controllers;

use App\Models\Locataire;
use Illuminate\Http\Request;

class LocataireController extends Controller
{
    public function index()
    {
        $locataires = Locataire::with('contratDeBails')->get();
        return view('locataires.index', compact('locataires'));
    }

    public function create()
    {
        return view('locataires.create');
    }
            public function store(Request $request)
{
    // Validation des données
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'telephone' => 'required|string|max:255',
        'email' => 'nullable|email|unique:locataires,email',
        'carte_identite_recto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'carte_identite_verso' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'situation_matrimoniale' => 'nullable|string|max:255',
        'nationalite' => 'nullable|string|max:255',
    ]);

    $nom_propre = strtolower(str_replace(' ', '', $validated['nom']));

    // Initialiser les chemins
    $recto_path = null;
    $verso_path = null;

    // Traitement du fichier carte d'identité RECTO
    if ($request->hasFile('carte_identite_recto')) {
        $file = $request->file('carte_identite_recto');
        $extension = $file->getClientOriginalExtension();
        $file_name = $nom_propre . '_carte_recto.' . $extension;
        $recto_path = $file->storeAs('Locataires_carte_identites', $file_name, 'public');
    }

    // Traitement du fichier carte d'identité VERSO
    if ($request->hasFile('carte_identite_verso')) {
        $file = $request->file('carte_identite_verso');
        $extension = $file->getClientOriginalExtension();
        $file_name = $nom_propre . '_carte_verso.' . $extension;
        $verso_path = $file->storeAs('Locataires_carte_identites', $file_name, 'public');
    }

    // Création du locataire
    Locataire::create([
        'nom' => $validated['nom'],
        'prenom' => $validated['prenom'],
        'telephone' => $validated['telephone'],
        'email' => $validated['email'] ?? null,
        'carte_identite_recto' => $recto_path,
        'carte_identite_verso' => $verso_path,
        'situation_matrimoniale' => $validated['situation_matrimoniale'] ?? null,
        'nationalite' => $validated['nationalite'] ?? 'Togolaise',
    ]);

    return redirect()->route('locataires.index')->with('success', 'Locataire créé avec succès');
}


    public function show(Locataire $locataire)
    {
        $locataire->load('contratDeBails.maison');
        return view('locataires.show', compact('locataire'));
    }

    public function edit(Locataire $locataire)
    {
        return view('locataires.edit', compact('locataire'));
    }

    public function update(Request $request, Locataire $locataire)
    {
    // Validation des données
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'telephone' => 'required|string|max:255',
        'email' => 'nullable|email|unique:locataires,email,' . $locataire->id,
        'carte_identite_recto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'carte_identite_verso' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'situation_matrimoniale' => 'nullable|string|max:255',
        'nationalite' => 'nullable|string|max:255',
    ]);

    $nom_propre = strtolower(str_replace(' ', '', $validated['nom']));

    // Initialiser les chemins
    $recto_path = null;
    $verso_path = null;

    // Traitement du fichier carte d'identité RECTO
    if ($request->hasFile('carte_identite_recto')) {
        $file = $request->file('carte_identite_recto');
        $extension = $file->getClientOriginalExtension();
        $file_name = $nom_propre . '_carte_recto.' . $extension;
        $recto_path = $file->storeAs('Locataires_carte_identites', $file_name, 'public');
    }

    // Traitement du fichier carte d'identité VERSO
    if ($request->hasFile('carte_identite_verso')) {
        $file = $request->file('carte_identite_verso');
        $extension = $file->getClientOriginalExtension();
        $file_name = $nom_propre . '_carte_verso.' . $extension;
        $verso_path = $file->storeAs('Locataires_carte_identites', $file_name, 'public');
    }

    // Création du locataire
    $locataire->update([
        'nom' => $validated['nom'],
        'prenom' => $validated['prenom'],
        'telephone' => $validated['telephone'],
        'email' => $validated['email'] ?? null,
        'carte_identite_recto' => $recto_path,
        'carte_identite_verso' => $verso_path,
        'situation_matrimoniale' => $validated['situation_matrimoniale'] ?? null,
        'nationalite' => $validated['nationalite'] ?? 'Togolaise',
    ]);
        return redirect()->route('locataires.index')->with('success', 'Locataire modifié avec succès');
    }

    public function destroy(Locataire $locataire)
    {
        $locataire->delete();
        return redirect()->route('locataires.index')->with('success', 'Locataire supprimé avec succès');
    }
}