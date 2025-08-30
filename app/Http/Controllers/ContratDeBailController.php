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

        return view('contrat_de_bails.index', ['contrats' => $contrats]);
    }

    /**
     * Afficher le formulaire de création d'un contrat.
     */
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

    /**
     * Enregistrer un nouveau contrat.
     */ public function store(Request $request)
    {
        $validated = $request->validate([
            'date_debut'   => 'required|date',
            'date_fin'     => 'required|date|after:date_debut',
            'pdf'          => 'nullable|file|mimes:pdf|max:10240',
            'caution'      => 'nullable|numeric|min:0',
            'statut'       => 'required|in:actif,expire,resilie',
            'locataire_id' => 'required|exists:locataires,id',
            'maison_id'    => 'required|exists:maisons,id',
            'chambre_id'   => 'nullable|exists:chambres,id'
        ]);

        $nom_propre = strtolower(str_replace([' ', "'", '"'], '', $validated['locataire_id']));

        // Récupérer le loyer depuis la chambre
        if (!empty($validated['chambre_id'])) {
            $chambre = Chambre::findOrFail($validated['chambre_id']);
            $validated['loyer'] = $chambre->loyer_individuel; // <-- correspond à ta DB
        } else {
            $validated['loyer'] = 0; // ou tu peux mettre null si ta DB l’autorise
        }

        // Upload du PDF
        if ($request->hasFile('pdf')) {
            $validated['pdf'] = $this->uploadFile($request, 'pdf', $nom_propre, 'contrat_de_bail');
        }

        // Calcul automatique de la caution si non précisée
        if (!isset($validated['caution']) && $validated['loyer'] > 0) {
            $validated['caution'] = round($validated['loyer'] * 0.10, 2);
        }

        ContratDeBail::create($validated);

        // Mettre à jour le statut de la maison/chambre
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

        return view('contrat_de_bails.edit', [
            'contratDeBail' => $contratDeBail,
            'maisons'       => $maisons,
            'locataires'    => $locataires,
            'chambres'      => $chambres
        ]);
    }

    /**
     * Valider et mettre à jour un contrat.
     */

    public function update(Request $request, ContratDeBail $contratDeBail)
    {
        $validated = $request->validate([
            'date_debut'   => ['required', 'date'],
            'date_fin'     => ['required', 'date', 'after:date_debut'],
            'pdf'          => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'caution'      => ['nullable', 'numeric', 'min:0'],
            'statut'       => ['required', 'in:actif,expire,resilie'],
            'locataire_id' => ['required', 'exists:locataires,id'],
            'maison_id'    => ['required', 'exists:maisons,id'],
            'chambre_id'   => ['nullable', 'exists:chambres,id'],
        ]);

        $nom_propre = strtolower(str_replace([' ', "'", '"'], '', $validated['locataire_id']));

        // Récupérer le loyer depuis la chambre
        if (!empty($validated['chambre_id'])) {
            $chambre = Chambre::findOrFail($validated['chambre_id']);
            $validated['loyer'] = $chambre->loyer_individuel;
        } else {
            $validated['loyer'] = $contratDeBail->loyer; // garder l'ancien
        }

        // Upload du PDF
        if ($request->hasFile('pdf')) {
            if (!empty($contratDeBail->pdf)) {
                Storage::disk('public')->delete($contratDeBail->pdf);
            }
            $validated['pdf'] = $this->uploadFile($request, 'pdf', $nom_propre, 'contrat_de_bail');
        } else {
            unset($validated['pdf']);
        }

        // Recalculer la caution si nécessaire
        if (!isset($validated['caution']) && $validated['loyer'] > 0) {
            $validated['caution'] = round($validated['loyer'] * 0.10, 2);
        }

        $contratDeBail->update($validated);

        return redirect()->route('contrat_de_bails.index')->with('success', 'Contrat mis à jour avec succès.');
    }







    /**
     * Gérer l’upload d’un fichier.
     */
    private function uploadFile(Request $request, string $fieldName, string $nomPropre, string $type): ?string
    {
        if (!$request->hasFile($fieldName)) {
            return null;
        }

        $file = $request->file($fieldName);
        $extension = $file->getClientOriginalExtension();
        $fileName = $nomPropre . '_' . $type . '_' . time() . '.' . $extension;

        return $file->storeAs('Locataires_contrat_de_bails', $fileName, 'public');
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