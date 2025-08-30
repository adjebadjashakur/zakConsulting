<?php

namespace App\Http\Controllers;

use App\Models\Locataire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LocataireController extends Controller
{
    public function index(Request $request)
    {
        $query = Locataire::with(['contratDeBails' => function($query) {
            $query->with('maison');
        }]);

        // Recherche par nom, prénom, téléphone ou email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'LIKE', "%{$search}%")
                  ->orWhere('prenom', 'LIKE', "%{$search}%")
                  ->orWhere('telephone', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Filtre par statut de bail
        if ($request->filled('statut')) {
            if ($request->statut === 'actif') {
                $query->whereHas('contratDeBails', function($q) {
                    $q->where('statut', 'actif');
                });
            } elseif ($request->statut === 'inactif') {
                $query->whereDoesntHave('contratDeBails', function($q) {
                    $q->where('statut', 'actif');
                });
            }
        }

        // Utiliser paginate() pour la pagination
        $locataires = $query->paginate(15)->withQueryString();
        
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
        $locataire->load(['contratDeBails' => function($query) {
            $query->with('maison')->orderBy('date_debut', 'desc');
        }]);
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
            'telephone' => 'required|string|max:255|unique:locataires,telephone,' . $locataire->id,
            'email' => 'nullable|email|unique:locataires,email,' . $locataire->id,
            'carte_identite_recto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'carte_identite_verso' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'situation_matrimoniale' => 'nullable|in:célibataire,marié(e),divorcé(e),veuf(ve)',
            'nationalite' => 'nullable|string|max:255',
        ]);

        $nom_propre = strtolower(str_replace([' ', "'", '"'], '', $validated['nom']));

        // Préparer les données à mettre à jour
        $updateData = [
            'nom' => ucfirst(strtolower($validated['nom'])),
            'prenom' => ucfirst(strtolower($validated['prenom'])),
            'telephone' => $validated['telephone'],
            'email' => $validated['email'] ?? null,
            'situation_matrimoniale' => $validated['situation_matrimoniale'] ?? null,
            'nationalite' => $validated['nationalite'] ?? 'Togolaise',
        ];

        // Traitement des nouveaux fichiers seulement si uploadés
        if ($request->hasFile('carte_identite_recto')) {
            // Supprimer l'ancien fichier
            if ($locataire->carte_identite_recto) {
                Storage::disk('public')->delete($locataire->carte_identite_recto);
            }
            $updateData['carte_identite_recto'] = $this->uploadFile($request, 'carte_identite_recto', $nom_propre, 'recto');
        }

        if ($request->hasFile('carte_identite_verso')) {
            // Supprimer l'ancien fichier
            if ($locataire->carte_identite_verso) {
                Storage::disk('public')->delete($locataire->carte_identite_verso);
            }
            $updateData['carte_identite_verso'] = $this->uploadFile($request, 'carte_identite_verso', $nom_propre, 'verso');
        }

        // Mise à jour du locataire
        $locataire->update($updateData);

        return redirect()->route('locataires.index')->with('success', 'Locataire modifié avec succès');
    }

    public function destroy(Locataire $locataire)
    {
        // Vérifier s'il a des baux actifs
        $bailsActifs = $locataire->contratDeBails()->where('statut', 'actif')->count();
        
        if ($bailsActifs > 0) {
            return redirect()->route('locataires.index')->with('error', 
                'Impossible de supprimer ce locataire car il a des baux actifs.');
        }

        // Supprimer les fichiers associés
        if ($locataire->carte_identite_recto) {
            Storage::disk('public')->delete($locataire->carte_identite_recto);
        }
        if ($locataire->carte_identite_verso) {
            Storage::disk('public')->delete($locataire->carte_identite_verso);
        }

        $locataire->delete();
        
        return redirect()->route('locataires.index')->with('success', 'Locataire supprimé avec succès');
    }

    /**
     * Méthode utilitaire pour uploader les fichiers
     */
    private function uploadFile(Request $request, string $fieldName, string $nomPropre, string $type): ?string
    {
        if (!$request->hasFile($fieldName)) {
            return null;
        }

        $file = $request->file($fieldName);
        $extension = $file->getClientOriginalExtension();
        $fileName = $nomPropre . '_carte_' . $type . '.' . $extension;
        
        return $file->storeAs('Locataires_carte_identites', $fileName, 'public');
    }

}