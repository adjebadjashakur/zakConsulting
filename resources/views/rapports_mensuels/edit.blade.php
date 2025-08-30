@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-2xl shadow">
    <h1 class="text-2xl font-bold mb-4 text-green-700">Modifier un rapport de loyer</h1>

 <form action="{{ route('rapports_mensuels.update', $rapport) }}" method="POST">
    @csrf
    @method('PUT')

        <!-- Propriétaire -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Propriétaire</label>
            <select name="proprietaire_id" class="w-full border rounded p-2 focus:ring-green-500 focus:border-green-500">
                @foreach($proprietaires as $proprietaire)
                    <option value="{{ $proprietaire->id }}" {{ $rapport->proprietaire_id == $proprietaire->id ? 'selected' : '' }}>
                        {{ $proprietaire->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Locataire -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Locataire</label>
            <select name="locataire_id" class="w-full border rounded p-2 focus:ring-green-500 focus:border-green-500">
                @foreach($locataires as $locataire)
                    <option value="{{ $locataire->id }}" {{ $rapport->locataire_id == $locataire->id ? 'selected' : '' }}>
                        {{ $locataire->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Maison -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Maison</label>
            <select name="maison_id" class="w-full border rounded p-2 focus:ring-green-500 focus:border-green-500">
                @foreach($maisons as $maison)
                    <option value="{{ $maison->id }}" {{ $rapport->maison_id == $maison->id ? 'selected' : '' }}>
                        {{ $maison->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Montant -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Montant payé</label>
            <input type="number" name="total" value="{{ $rapport->total }}" class="w-full border rounded p-2 focus:ring-green-500 focus:border-green-500" required>
        </div>

        <!-- Date -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Date du paiement</label>
            <input type="date" name="date_rapport" value="{{ $rapport->date_rapport }}" class="w-full border rounded p-2 focus:ring-green-500 focus:border-green-500" required>
        </div>

        <!-- Mode de paiement -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Mode de paiement</label>
            <select name="mode_paiement" class="w-full border rounded p-2 focus:ring-green-500 focus:border-green-500">
                <option value="Espèces" {{ $rapport->mode_paiement == 'Espèces' ? 'selected' : '' }}>Espèces</option>
                <option value="Virement" {{ $rapport->mode_paiement == 'Virement' ? 'selected' : '' }}>Virement</option>
                <option value="Mobile Money" {{ $rapport->mode_paiement == 'Mobile Money' ? 'selected' : '' }}>Mobile Money</option>
            </select>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('rapports_mensuels.index') }}" class="px-4 py-2 bg-gray-300 text-black rounded-lg hover:bg-gray-400">Annuler</a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
