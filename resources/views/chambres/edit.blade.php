@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-6">Modifier la chambre {{ $chambre->code_chambre }}</h2>

<form action="{{ route('chambres.update', $chambre) }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="code_chambre" class="block font-medium mb-1">Code chambre *</label>
        <input type="text" name="code_chambre" id="code_chambre" value="{{ old('code_chambre', $chambre->code_chambre) }}"
            class="w-full border border-gray-300 rounded px-3 py-2 @error('code_chambre') border-red-500 @enderror" required>
        @error('code_chambre')
            <p class="text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="type" class="block font-medium mb-1">Type</label>
        <input type="text" name="type" id="type" value="{{ old('type', $chambre->type) }}"
            class="w-full border border-gray-300 rounded px-3 py-2 @error('type') border-red-500 @enderror">
        @error('type')
            <p class="text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="loyer_individuel" class="block font-medium mb-1">Loyer individuel *</label>
        <input type="number" name="loyer_individuel" id="loyer_individuel" value="{{ old('loyer_individuel', $chambre->loyer_individuel) }}"
            class="w-full border border-gray-300 rounded px-3 py-2 @error('loyer_individuel') border-red-500 @enderror" min="0" step="1000" required>
        @error('loyer_individuel')
            <p class="text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="statut" class="block font-medium mb-1">Statut *</label>
        <select name="statut" id="statut"
            class="w-full border border-gray-300 rounded px-3 py-2 @error('statut') border-red-500 @enderror" required>
            <option value="libre" {{ old('statut', $chambre->statut) == 'libre' ? 'selected' : '' }}>Libre</option>
            <option value="occupé" {{ old('statut', $chambre->statut) == 'occupé' ? 'selected' : '' }}>Occupé</option>
            <option value="maintenance" {{ old('statut', $chambre->statut) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
        </select>
        @error('statut')
            <p class="text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="maison_id" class="block font-medium mb-1">Maison *</label>
        <select name="maison_id" id="maison_id"
            class="w-full border border-gray-300 rounded px-3 py-2 @error('maison_id') border-red-500 @enderror" required>
            @foreach ($maisons as $maison)
                <option value="{{ $maison->id }}" {{ (old('maison_id', $chambre->maison_id) == $maison->id) ? 'selected' : '' }}>
                    {{ $maison->nom }}
                </option>
            @endforeach
        </select>
        @error('maison_id')
            <p class="text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Enregistrer les modifications
    </button>
</form>
@endsection
