@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-6">Modifier Contrat</h2>

<form action="{{ route('contrat_de_bails.update', $contratDeBail) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block">Locataire</label>
        <select name="locataire_id" class="w-full border rounded p-2">
            @foreach($locataires as $locataire)
                <option value="{{ $locataire->id }}" {{ $contratDeBail->locataire_id == $locataire->id ? 'selected' : '' }}>
                    {{ $locataire->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block">Maison</label>
        <select name="maison_id" class="w-full border rounded p-2">
            @foreach($maisons as $maison)
                <option value="{{ $maison->id }}" {{ $contratDeBail->maison_id == $maison->id ? 'selected' : '' }}>
                    {{ $maison->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block">Date de début</label>
        <input type="date" name="date_debut" value="{{ $contratDeBail->date_debut->format('Y-m-d') }}" class="w-full border rounded p-2">
    </div>

    <div>
        <label class="block">Date de fin</label>
        <input type="date" name="date_fin" value="{{ $contratDeBail->date_fin->format('Y-m-d') }}" class="w-full border rounded p-2">
    </div>
{{-- 
    <div>
        <label class="block">Loyer mensuel</label>
        <input type="number" name="loyer_mensuel" value="{{ $contratDeBail->loyer_mensuel }}" class="w-full border rounded p-2" step="0.01">
    </div>

    <div>
        <label class="block">Caution</label>
        <input type="number" name="caution" value="{{ $contratDeBail->caution }}" class="w-full border rounded p-2" step="0.01">
    </div> --}}

    <div>
        <label class="block">Statut</label>
        <select name="statut" class="w-full border rounded p-2">
            <option value="actif" {{ $contratDeBail->statut == 'actif' ? 'selected' : '' }}>Actif</option>
            <option value="terminé" {{ $contratDeBail->statut == 'terminé' ? 'selected' : '' }}>Terminé</option>
        </select>
    </div>

    <div>
        <label class="block">Changer le fichier PDF (optionnel)</label>
        <input type="file" name="pdf" class="w-full border rounded p-2">
    </div>

    <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
        Mettre à jour
    </button>
</form>
@endsection
