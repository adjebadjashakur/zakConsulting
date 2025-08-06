@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Modifier Locataire</h2>

    <form action="{{ route('locataires.update', $locataire) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
        @csrf
        @method('PUT')

        <div class="space-y-4">
    <div>
        <label class="block mb-1 font-semibold">Nom</label>
        <input type="text" name="nom" value="{{ old('nom', $locataire->nom ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
        @error('nom') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block mb-1 font-semibold">Prénom</label>
        <input type="text" name="prenom" value="{{ old('prenom', $locataire->prenom ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
        @error('prenom') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block mb-1 font-semibold">Téléphone</label>
        <input type="text" name="telephone" value="{{ old('telephone', $locataire->telephone ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
        @error('telephone') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block mb-1 font-semibold">Email</label>
        <input type="email" name="email" value="{{ old('email', $locataire->email ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
        @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block mb-1 font-semibold">Carte identité recto</label>
        <input type="file" name="carte_identite_recto" class="w-full">
        @error('carte_identite_recto') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

        @if(!empty($locataire?->carte_identite_recto))
            <p class="text-sm mt-1">Fichier actuel : 
                <a href="{{ asset('storage/' . $locataire->carte_identite_recto) }}" class="text-blue-500 underline" target="_blank">Télécharger</a>
            </p>
        @endif
    </div>

    <div>
        <label class="block mb-1 font-semibold">Carte identité verso</label>
        <input type="file" name="carte_identite_verso" class="w-full">
        @error('carte_identite_verso') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

        @if(!empty($locataire?->carte_identite_verso))
            <p class="text-sm mt-1">Fichier actuel : 
                <a href="{{ asset('storage/' . $locataire->carte_identite_verso) }}" class="text-blue-500 underline" target="_blank">Télécharger</a>
            </p>
        @endif
    </div>
<div class="mb-4">
    <label for="situation_matrimoniale" class="block text-sm font-medium text-gray-700 mb-2">Situation matrimoniale</label>
    <select name="situation_matrimoniale" id="situation_matrimoniale"
            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="">-- Sélectionnez une situation --</option>
        <option value="Célibataire" {{ old('situation_matrimoniale') == 'Célibataire' ? 'selected' : '' }}>Célibataire</option>
        <option value="Marié(e)" {{ old('situation_matrimoniale') == 'Marié(e)' ? 'selected' : '' }}>Marié(e)</option>
        <option value="Divorcé(e)" {{ old('situation_matrimoniale') == 'Divorcé(e)' ? 'selected' : '' }}>Divorcé(e)</option>
        <option value="Veuf(ve)" {{ old('situation_matrimoniale') == 'Veuf(ve)' ? 'selected' : '' }}>Veuf(ve)</option>
    </select>
</div>

    <div>
        <label class="block mb-1 font-semibold">Nationalité</label>
        <input type="text" name="nationalite" value="{{ old('nationalite', $locataire->nationalite ?? 'Togolaise') }}" class="w-full border border-gray-300 rounded px-3 py-2">
        @error('nationalite') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>
    <div class="flex justify-end space-x-4">
            <a href="{{ route('locataires.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Annuler
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Mettre à jour</button>
        
        </div>
</div>
    </form>
</div>
@endsection
