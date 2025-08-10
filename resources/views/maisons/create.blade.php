@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Nouvelle Maison</h2>

    {{-- Formulaire de création --}}
    <form action="{{ route('maisons.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow">
        @csrf
        
        {{-- Nom --}}
        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        {{-- Adresse --}}
        <div class="mb-4">
            <label for="adresse" class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
            <textarea id="adresse" name="adresse" rows="3" required
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('adresse') }}</textarea>
        </div>

        {{-- Quartier / Superficie --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="quartier" class="block text-sm font-medium text-gray-700 mb-2">Quartier</label>
                <input type="text" id="quartier" name="quartier" value="{{ old('quartier') }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="superficie" class="block text-sm font-medium text-gray-700 mb-2">Superficie</label>
                <input type="text" id="superficie" name="superficie" value="{{ old('superficie') }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea id="description" name="description" rows="3"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
        </div>

        {{-- Loyer / Statut --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="loyer_mensuel" class="block text-sm font-medium text-gray-700 mb-2">Loyer mensuel (FCFA)</label>
                <input type="number" id="loyer_mensuel" name="loyer_mensuel" value="{{ old('loyer_mensuel') }}" min="0"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="statut" class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                <select id="statut" name="statut" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="libre" {{ old('statut') == 'libre' ? 'selected' : '' }}>Libre</option>
                    <option value="occupé" {{ old('statut') == 'occupé' ? 'selected' : '' }}>Occupé</option>
                    <option value="maintenance" {{ old('statut') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
            </div>
        </div>

        {{-- Propriétaire --}}
        <div class="mb-6">
            <label for="proprietaire_id" class="block text-sm font-medium text-gray-700 mb-2">Propriétaire</label>
            <select id="proprietaire_id" name="proprietaire_id" required
                style="position: relative; transform: none;" {{-- Empêche le bug Chrome/Linux --}}
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Sélectionner un propriétaire</option>
                @foreach($proprietaires as $proprietaire)
                    <option value="{{ $proprietaire->id }}" {{ old('proprietaire_id') == $proprietaire->id ? 'selected' : '' }}>
                        {{ $proprietaire->nom }} {{ $proprietaire->prenom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Boutons --}}
        <div class="flex justify-end space-x-4">
            <a href="{{ route('maisons.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Annuler
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Créer
            </button>
        </div>
    </form>
</div>
@endsection
