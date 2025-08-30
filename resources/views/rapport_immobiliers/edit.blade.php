@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-green-700">Modifier le Rapport Immobilier</h2>

    {{-- Messages d'erreurs --}}
    @if($errors->any())
        <div class="mb-4 bg-red-100 text-red-800 p-4 rounded-md">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire --}}
    <form action="{{ route('rapport_immobiliers.update', ['rapportImmobilier' => $rapportImmobilier->id]) }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-6">
        @csrf
        @method('PUT')
        {{-- Propriétaire --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Propriétaire</label>
            <select name="proprietaire_id" class="w-full border border-gray-300 rounded-md px-3 py-2">
                <option value="">Sélectionner un propriétaire</option>
                @foreach($proprietaires as $proprietaire)
                    <option value="{{ $proprietaire->id }}" {{ (old('proprietaire_id', $rapportImmobilier->proprietaire_id) == $proprietaire->id) ? 'selected' : '' }}>
                        {{ $proprietaire->nom }}
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
                    <option value="{{ $maison->id }}" {{ (old('maison_id', $rapportImmobilier->maison_id) == $maison->id) ? 'selected' : '' }}>
                        {{ $maison->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Locataire --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Locataire</label>
            <select name="locataire_id" class="w-full border border-gray-300 rounded-md px-3 py-2">
                <option value="">Sélectionner un locataire</option>
                @foreach($locataires as $locataire)
                    <option value="{{ $locataire->id }}" {{ (old('locataire_id', $rapportImmobilier->locataire_id) == $locataire->id) ? 'selected' : '' }}>
                        {{ $locataire->nom }} {{ $locataire->prenom }}
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
                    <option value="{{ $chambre->id }}" {{ (old('chambre_id', $rapportImmobilier->chambre_id) == $chambre->id) ? 'selected' : '' }}>
                        {{ $chambre->code_chambre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Total, commission, net --}}
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Montant total</label>
                <input type="number" step="0.01" name="total" value="{{ old('total', $rapportImmobilier->total) }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Commission</label>
                <input type="number" step="0.01" name="commission" value="{{ old('commission', $rapportImmobilier->commission) }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Total net</label>
                <input type="number" step="0.01" name="total_net" value="{{ old('total_net', $rapportImmobilier->total_net) }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2" required>
            </div>
        </div>

        {{-- Mois / Année --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Mois / Année</label>
            <input type="text" name="mois_annee" value="{{ old('mois_annee', $rapportImmobilier->mois_annee) }}"
                class="w-full border border-gray-300 rounded-md px-3 py-2" required>
        </div>

        {{-- Date du rapport --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Date du rapport</label>
            <input type="date" name="date_rapport" value="{{ old('date_rapport', $rapportImmobilier->date_rapport) }}"
                class="w-full border border-gray-300 rounded-md px-3 py-2" required>
        </div>
        {{-- Actions --}}
        <div class="flex justify-end space-x-4">
            <a href="{{ route('rapport_immobiliers.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                Annuler
            </a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection
