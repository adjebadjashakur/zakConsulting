<?php

namespace App\Http\Controllers;

use App\Models\ContratDeBail;
use App\Models\Maison;
use App\Models\Chambre;
use App\Models\Locataire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContratDeBailController extends Controller
{
    /**
     * Afficher la liste paginée des contrats avec relations.
     */
    public function index()
    {
        $contrats = ContratDeBail::with(['locataire', 'maison', 'chambre'])
            ->orderBy('date_debut', 'desc')
            ->paginate(15);

        return view('contrat_de_bails.index', ['contrats'=>$contrats]);
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create(Request $request)
    {
        $maisons = Maison::all();
        $locataires = Locataire::orderBy('nom', 'asc')->get();

        $chambres = collect();
        if ($request->filled('maison_id')) {
            $chambres = Chambre::where('maison_id', $request->maison_id)
                ->where('statut', 'libre')
                ->get();
        }

        return view('contrat_de_bails.create', [
            'maisons' => $maisons,
            'locataires' => $locataires,
            'chambres' => $chambres,
        ]);
    }

    /**
     * Enregistrer un nouveau contrat.
     */
    private function uploadFile(Request $request, string $fieldName, string $nomPropre, string $type): ?string
    {
        if (!$request->hasFile($fieldName)) {
            return null;
        }

        $file = $request->file($fieldName);
        $extension = $file->getClientOriginalExtension();
        $fileName = $nomPropre . '_contrat_de_bails_' . $type . '.' . $extension;

        return $file->storeAs('Locataires_contrat_de_bails', $fileName, 'public');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_debut'    => ['required', 'date'],
            'date_fin'      => ['required', 'date', 'after:date_debut'],
            'pdf'           => ['nullable', 'file', 'mimes:pdf', 'max:10240'], // max 10 Mo
            'loyer'         => ['required', 'numeric', 'min:0'],
            'caution'       => ['nullable', 'numeric', 'min:0'],
                'statut'        => ['required', 'in:actif,suspendu,inactif'],
               'locataire_id'  => ['required', 'exists:locataires,id'],
            'maison_id'     => ['required', 'exists:maisons,id'],
            'chambre_id'    => ['nullable', 'exists:chambres,id'],
        ]);
        $nom_propre = strtolower(str_replace([' ', "'", '"'], '', $validated['locataire_id']));

        // Traitement des fichiers
        $contrat_path = $this->uploadFile($request, 'pdf', $nom_propre, 'contrat_de_bail');
        // Upload du PDF si fourni
        if ($request->hasFile('pdf')) {
            $validated['pdf'] = $contrat_path;
        }

        // Calcul automatique de la caution si non précisée
        if (!isset($validated['caution']) && isset($validated['loyer'])) {
            $validated['caution'] = round($validated['loyer'] * 0.10, 2);
        }

        ContratDeBail::create($validated);

        // Mettre à jour le statut de la maison et de la chambre à "occupé"
        Maison::where('id', $validated['maison_id'])->update(['statut' => 'occupé']);
        if (!empty($validated['chambre_id'])) {
            Chambre::where('id', $validated['chambre_id'])->update(['statut' => 'occupé']);
        }

        return redirect()->route('contrat_de_bails.index')->with('success', 'Contrat créé avec succès.');
    }

    /**
     * Afficher un contrat spécifique avec relations.
     */
    public function show($id)
    {
        $contrat = ContratDeBail::with(['locataire', 'maison', 'chambre'])->findOrFail($id);
        return view('contrat_de_bails.show', compact('contrat'));
    }

    /**
     * Afficher le formulaire d'édition.
     */
    public function edit(ContratDeBail $contratDeBail)
    {
        $maisons = Maison::all();
        $locataires = Locataire::all();
        $chambres = Chambre::where('maison_id', $contratDeBail->maison_id)->get();

        return view('contrat_de_bails.edit',['contratDeBail'=>$contratDeBail, 'maisons'=>$maisons, 'locataires'=>$locataires, 'chambres'=>$chambres]);
    }

    /**
     * Valider et mettre à jour un contrat.
     */
    public function update(Request $request, ContratDeBail $contratDeBail)
    {
        $validated = $request->validate([
            'date_debut'    => ['required', 'date'],
            'date_fin'      => ['required', 'date', 'after:date_debut'],
            'pdf'           => ['nullable', 'file', 'mimes:pdf', 'max:10240'], 
            'loyer'         => ['nullable', 'numeric', 'min:0'],
            'caution'       => ['nullable', 'numeric', 'min:0'],
            'statut'        => ['required', 'in:actif,suspendu,inactif'],
            'locataire_id'  => ['required', 'exists:locataires,id'],
            'maison_id'     => ['required', 'exists:maisons,id'],
            'chambre_id'    => ['nullable', 'exists:chambres,id'],
        ]);
        $nom_propre = strtolower(str_replace([' ', "'", '"'], '', $validated['locataire_id']));

        // Traitement des fichiers
        $contrat_path = $this->uploadFile($request, 'pdf', $nom_propre, 'contrat_de_bail');

        
        // Si un nouveau PDF est uploadé, on supprime l'ancien et on enregistre le nouveau
        if ($request->hasFile('pdf')) {
            if (!empty($contratDeBail->pdf)) {
                Storage::disk('public')->delete($contratDeBail->pdf);
            }
            $validated['pdf'] = $contrat_path;
        } else {
            // Ne pas écraser la colonne pdf si aucun nouveau fichier
            unset($validated['pdf']);
        }

        // Recalculer la caution si nécessaire
        if (!isset($validated['caution']) && $request->filled('loyer')) {
            $validated['caution'] = round($request->input('loyer') * 0.10, 2);
        }

        $contratDeBail->update($validated);

        return redirect()->route('contrat_de_bails.index')->with('success', 'Contrat mis à jour avec succès.');
    }

    /**
     * Supprimer un contrat et libérer la maison/chambre.
     */
    public function destroy(ContratDeBail $contratDeBail)
    {
        // Supprimer le PDF du stockage si présent
        if (!empty($contratDeBail->pdf)) {
            Storage::disk('public')->delete($contratDeBail->pdf);
        }

        // Libérer les ressources
        if ($contratDeBail->maison) {
            $contratDeBail->maison->update(['statut' => 'libre']);
        }
        if ($contratDeBail->chambre) {
            $contratDeBail->chambre->update(['statut' => 'libre']);
        }

        $contratDeBail->delete();

        return redirect()->route('contrat_de_bails.index')->with('success', 'Contrat supprimé avec succès.');
    }
}