@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Modifier le Contrat de Bail</h2>

    @if($errors->any())
        <div class="mb-4 bg-red-100 text-red-800 p-4 rounded-md">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error) 
                    <li>{{ $error }}</li> 
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contrat_de_bails.update', $contratDeBail) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow space-y-6">
        @csrf
        @method('PUT')

        {{-- Locataire --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Locataire</label>
            <select name="locataire_id" class="w-full border border-gray-300 rounded-md px-3 py-2">
                <option value="">Sélectionner un locataire</option>
                @foreach($locataires as $locataire)
                    <option value="{{ $locataire->id }}" {{ old('locataire_id', $contratDeBail->locataire_id) == $locataire->id ? 'selected' : '' }}>
                        {{ $locataire->nom }} {{ $locataire->prenom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Maison --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Maison</label>
            <select name="maison_id" class="w-full border border-gray-300 rounded-md px-3 py-2">
                <option value="">Sélectionner une maison</option>
                @foreach($maisons as $maison)
                    <option value="{{ $maison->id }}" {{ old('maison_id', $contratDeBail->maison_id) == $maison->id ? 'selected' : '' }}>
                        {{ $maison->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Chambre --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Chambre</label>
            <select name="chambre_id" class="w-full border border-gray-300 rounded-md px-3 py-2">
                <option value="">Sélectionner une chambre</option>
                @foreach($chambres as $chambre)
                    <option value="{{ $chambre->id }}" {{ old('chambre_id', $contratDeBail->chambre_id) == $chambre->id ? 'selected' : '' }}>
                        {{ $chambre->code_chambre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Loyer --}}
        <div>
            <label>Loyer mensuel</label>
            <input type="number" name="loyer" min="0" step="0.01" 
                value="{{ old('loyer', $contratDeBail->loyer) }}" 
                class="w-full border border-gray-300 rounded-md px-3 py-2" readonly>
        </div>

        {{-- Date de début --}}
        <div>
            <label for="date_debut">Date de début</label>
            <input 
                type="date" 
                id="date_debut" 
                name="date_debut" 
                value="{{ old('date_debut', $contratDeBail->date_debut) }}" 
                class="w-full border border-gray-300 rounded-md px-3 py-2"
                required
            >
        </div>

        {{-- Date de fin --}}
        <div>
            <label for="date_fin">Date de fin</label>
            <input 
                type="date" 
                id="date_fin" 
                name="date_fin" 
                value="{{ old('date_fin', $contratDeBail->date_fin) }}" 
                class="w-full border border-gray-300 rounded-md px-3 py-2"
                required
            >
        </div>

        {{-- Statut --}}
        <div>
            <label>Statut</label>
            <select name="statut" class="w-full border border-gray-300 rounded-md px-3 py-2">
                <option value="actif" {{ old('statut', $contratDeBail->statut) == 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="expire" {{ old('statut', $contratDeBail->statut) == 'expire' ? 'selected' : '' }}>Expiré</option>
                <option value="resilie" {{ old('statut', $contratDeBail->statut) == 'resilie' ? 'selected' : '' }}>Résilié</option>
            </select>
        </div>

        {{-- PDF --}}
        <div>
            <label>Fichier PDF (optionnel)</label>
            <input type="file" name="pdf" class="w-full border border-gray-300 rounded-md px-3 py-2">
            @if($contratDeBail->pdf)
                <p class="text-sm mt-2">Fichier actuel : 
                    <a href="{{ asset('storage/'.$contratDeBail->pdf) }}" class="text-blue-600 underline" target="_blank">Voir le PDF</a>
                </p>
            @endif
        </div>

        {{-- Actions --}}
        <div class="flex justify-end space-x-4">
            <a href="{{ route('contrat_de_bails.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Annuler</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection
