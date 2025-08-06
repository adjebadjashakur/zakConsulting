@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Nouveau Contrat de Bail</h2>

    @if($errors->any())
        <div class="mb-4 bg-red-100 text-red-800 p-4 rounded-md shadow">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contrat_de_bails.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
        @csrf

        <div class="mb-4">
            <label for="locataire_id" class="block text-sm font-medium text-gray-700 mb-2">Locataire</label>
            <select name="locataire_id" id="locataire_id" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Sélectionner un locataire</option>
                @foreach($locataires as $locataire)
                    <option value="{{ $locataire->id }}" {{ old('locataire_id') == $locataire->id ? 'selected' : '' }}>
                        {{ $locataire->nom }} {{ $locataire->prenom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="maison_id" class="block text-sm font-medium text-gray-700 mb-2">Maison</label>
            <select name="maison_id" id="maison_id" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Sélectionner une maison</option>
                @foreach($maisons as $maison)
                    <option value="{{ $maison->id }}" {{ old('maison_id') == $maison->id ? 'selected' : '' }}>
                        {{ $maison->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="date_debut" class="block text-sm font-medium text-gray-700 mb-2">Date de début</label>
                <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut') }}" required
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="date_fin" class="block text-sm font-medium text-gray-700 mb-2">Date de fin</label>
                <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin') }}" required
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="loyer_mensuel" class="block text-sm font-medium text-gray-700 mb-2">Loyer mensuel (FCFA)</label>
                <input type="number" name="loyer_mensuel" id="loyer_mensuel" value="{{ old('loyer_mensuel') }}" min="0" step="0.01" required
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="caution" class="block text-sm font-medium text-gray-700 mb-2">Caution (FCFA)</label>
                <input type="number" name="caution" id="caution" value="{{ old('caution') }}" min="0" step="0.01" required
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div class="mb-4">
            <label for="statut" class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
            <select name="statut" id="statut" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="actif" {{ old('statut') == 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="terminé" {{ old('statut') == 'terminé' ? 'selected' : '' }}>Terminé</option>
            </select>
        </div>

        <div class="mb-6">
            <label for="pdf" class="block text-sm font-medium text-gray-700 mb-2">Fichier PDF (optionnel)</label>
            <input type="file" name="pdf" id="pdf"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('contrat_de_bails.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Annuler
            </a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection
