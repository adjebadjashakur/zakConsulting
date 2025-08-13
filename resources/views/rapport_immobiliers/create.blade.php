@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Créer un Rapport Immobilier</h2>

    @if($errors->any())
        <div class="mb-4 bg-red-100 text-red-800 p-4 rounded">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rapport_immobiliers.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        
                <div class="mb-4">
            <label class="block mb-1">Locataire</label>
            <select name="locataire_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="">-- Sélectionner --</option>
                @foreach($locataires as $locataire)
                    <option value="{{ $locataire->id }}" {{ old('locataire_id') == $locataire->id ? 'selected' : '' }}>
                        {{ $locataire->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Propriétaire</label>
            <select name="proprietaire_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="">-- Sélectionner --</option>
                @foreach($proprietaires as $proprietaire)
                    <option value="{{ $proprietaire->id }}" {{ old('proprietaire_id') == $proprietaire->id ? 'selected' : '' }}>
                        {{ $proprietaire->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block mb-1">Total</label>
                <input type="number" step="0.01" name="total" value="{{ old('total') }}" 
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block mb-1">Commission</label>
                <input type="number" step="0.01" name="commission" value="{{ old('commission') }}" 
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block mb-1">Total Net</label>
                <input type="number" step="0.01" name="total_net" value="{{ old('total_net') }}" 
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Mois/Année</label>
            <input type="text" name="mois_annee" value="{{ old('mois_annee') }}" 
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Date Rapport</label>
            <input type="date" name="date_rapport" value="{{ old('date_rapport') }}" 
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('rapport_immobiliers.index') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Annuler
            </a>
            <button type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Créer
            </button>
        </div>
    </form>
</div>
@endsection
