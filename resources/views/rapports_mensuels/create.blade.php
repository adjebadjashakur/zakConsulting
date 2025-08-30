@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6" >Ajouter un rapport de loyer</h2>

    @if($errors->any())
        <div class="mb-4 bg-red-100 text-red-800 p-4 rounded">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rapports_mensuels.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf

        <!-- Propriétaire -->
        <div class="mb-4">
            <label class="block mb-1">Propriétaire</label>
            <select name="proprietaire_id" 
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                <option value="">-- Sélectionner --</option>
                @foreach($proprietaires as $proprietaire)
                    <option value="{{ $proprietaire->id }}" {{ old('proprietaire_id') == $proprietaire->id ? 'selected' : '' }}>
                        {{ $proprietaire->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Locataire -->
        <div class="mb-4">
            <label class="block mb-1">Locataire</label>
            <select name="locataire_id" 
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                <option value="">-- Sélectionner --</option>
                @foreach($locataires as $locataire)
                    <option value="{{ $locataire->id }}" {{ old('locataire_id') == $locataire->id ? 'selected' : '' }}>
                        {{ $locataire->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Maison -->
        <div class="mb-4">
            <label class="block mb-1">Maison</label>
            <select name="maison_id" 
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                <option value="">-- Sélectionner --</option>
                @foreach($maisons as $maison)
                    <option value="{{ $maison->id }}" {{ old('maison_id') == $maison->id ? 'selected' : '' }}>
                        {{ $maison->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Montant -->
        <div class="mb-4">
            <label class="block mb-1">Montant payé</label>
            <input type="number" step="0.01" name="total" value="{{ old('total') }}"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
        </div>

        <!-- Date -->
        <div class="mb-4">
            <label class="block mb-1">Date du paiement</label>
            <input type="date" name="date_rapport" value="{{ old('date_rapport') }}"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
        </div>

        <!-- Mode de paiement -->
        <div class="mb-4">
            <label class="block mb-1">Mode de paiement</label>
            <select name="mode_paiement" 
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                <option value="">-- Sélectionner --</option>
                <option value="Espèces" {{ old('mode_paiement') == 'Espèces' ? 'selected' : '' }}>Espèces</option>
                <option value="Virement" {{ old('mode_paiement') == 'Virement' ? 'selected' : '' }}>Virement</option>
                <option value="Mobile Money" {{ old('mode_paiement') == 'Mobile Money' ? 'selected' : '' }}>Mobile Money</option>
            </select>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('rapports_mensuels.index') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Annuler
            </a>
            <button type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection
