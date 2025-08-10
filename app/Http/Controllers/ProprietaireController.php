<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProprietaireController extends Controller
{
public function indexWithDetails($id)
{
    $proprietaire = Proprietaire::with(['maisons.contratDeBails.locataire', 'maisons.chambres.locataire'])
        ->findOrFail($id);

    return view('proprietaires.details', compact('proprietaire'));
}




    public function index()
    {
        $proprietaires = Proprietaire::with('maisons')->get();
        return view('proprietaires.index', compact('proprietaires'));
    }

    public function create()
    {
        return view('proprietaires.create');
    }
            public function store(Request $request)
{
    // Validation des données
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'telephone' => 'required|string|max:255',
        'email' => 'required|email|unique:proprietaires,email',
        'carte_identite_recto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'carte_identite_verso' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'adresse' => 'nullable|string',
        'commune' => 'nullable|string|max:255'
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
        $recto_path = $file->storeAs('carte_identites', $file_name, 'public');
    }

    // Traitement du fichier carte d'identité VERSO
    if ($request->hasFile('carte_identite_verso')) {
        $file = $request->file('carte_identite_verso');
        $extension = $file->getClientOriginalExtension();
        $file_name = $nom_propre . '_carte_verso.' . $extension;
        $verso_path = $file->storeAs('carte_identites', $file_name, 'public');
    }

    // Création du propriétaire
    Proprietaire::create([
        'nom' => $validated['nom'],
        'prenom' => $validated['prenom'],
        'telephone' => $validated['telephone'],
        'email' => $validated['email'],
        'carte_identite_recto' => $recto_path,
        'carte_identite_verso' => $verso_path,
        'adresse' => $validated['adresse'] ?? null,
    ]);

    return redirect()->route('proprietaires.index')->with('success', 'Propriétaire créé avec succès');
}





    public function show(Proprietaire $proprietaire)
    {
        $proprietaire->load('maisons', 'rapportImmobiliers');
        return view('proprietaires.show', compact('proprietaire'));
    }

    public function edit(Proprietaire $proprietaire)
    {
        return view('proprietaires.edit', compact('proprietaire'));
    }
    public function update(Request $request, Proprietaire $proprietaire)
{
    // Validation des données
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'telephone' => 'required|string|max:255',
        'email' => 'required|email|unique:proprietaires,email,' . $proprietaire->id,
        'carte_identite_recto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'carte_identite_verso' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'adresse' => 'nullable|string',
    ]);
    if ($request->hasFile('carte_identite_recto')) {
    $file = $request->file('carte_identite_recto');
    $ext = $file->getClientOriginalExtension();
    $file_name = strtolower($validated['nom']) . '_recto.' . $ext;
    $recto_path = $file->storeAs('carte_identites', $file_name, 'public');
} else {
    $recto_path = $proprietaire->carte_identite_recto ?? null;
}

if ($request->hasFile('carte_identite_verso')) {
    $file = $request->file('carte_identite_verso');
    $ext = $file->getClientOriginalExtension();
    $file_name = strtolower($validated['nom']) . '_verso.' . $ext;
    $verso_path = $file->storeAs('carte_identites', $file_name, 'public');
} else {
    $verso_path = $proprietaire->carte_identite_verso ?? null;
}

// Puis dans $proprietaire->update()
$proprietaire->update([
    'nom' => $validated['nom'],
    'prenom' => $validated['prenom'],
    'telephone' => $validated['telephone'],
    'email' => $validated['email'],
    'carte_identite_recto' => $recto_path,
    'carte_identite_verso' => $verso_path,
    'adresse' => $validated['adresse'] ?? null,
]);

    return redirect()->route('proprietaires.index')->with('success', 'Propriétaire mis à jour avec succès');
}


    public function destroy(Proprietaire $proprietaire)
    {
        $proprietaire->delete();
        return redirect()->route('proprietaires.index')->with('success', 'Propriétaire supprimé avec succès');
    }
}