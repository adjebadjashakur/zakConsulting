@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Créer un nouveau contrat de bail</h1>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
            <strong class="font-medium">Veuillez corriger les erreurs suivantes:</strong>
            <ul class="mt-2 ml-4 list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contrat_de_bails.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Informations générales -->
        <div class="bg-gray-50 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Informations générales</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="date_debut" class="block text-sm font-medium text-gray-700 mb-1">Date de début *</label>
                    <input
                        type="date"
                        id="date_debut"
                        name="date_debut"
                        value="{{ old('date_debut') }}"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    @error('date_debut')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="date_fin" class="block text-sm font-medium text-gray-700 mb-1">Date de fin *</label>
                    <input
                        type="date"
                        id="date_fin"
                        name="date_fin"
                        value="{{ old('date_fin') }}"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    @error('date_fin')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="statut" class="block text-sm font-medium text-gray-700 mb-1">Statut *</label>
                    <select id="statut" name="statut" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Sélectionner --</option>
                        <option value="actif" {{ old('statut') == 'actif' ? 'selected' : '' }}>Actif</option>
                        <option value="suspendu" {{ old('statut') == 'suspendu' ? 'selected' : '' }}>Suspendu</option>
                        <option value="inactif" {{ old('statut') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                    </select>
                    @error('statut')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Affectations -->
        <div class="bg-gray-50 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Affectations</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="locataire_id" class="block text-sm font-medium text-gray-700 mb-1">Locataire *</label>
                    <select id="locataire_id" name="locataire_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Sélectionner un locataire --</option>
                        @foreach ($locataires as $locataire)
                            <option value="{{ $locataire->id }}" {{ old('locataire_id') == $locataire->id ? 'selected' : '' }}>
                                {{ $locataire->nom }} {{ $locataire->prenom }}
                            </option>
                        @endforeach
                    </select>
                    @error('locataire_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="maison_id" class="block text-sm font-medium text-gray-700 mb-1">Maison *</label>
                    <select id="maison_id" name="maison_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Sélectionner une maison --</option>
                        @foreach ($maisons as $maison)
                            <option value="{{ $maison->id }}" {{ old('maison_id') == $maison->id ? 'selected' : '' }}>
                                {{ $maison->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('maison_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="chambre_id" class="block text-sm font-medium text-gray-700 mb-1">Chambre</label>
                    <select id="chambre_id" name="chambre_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Aucune --</option>
                        @if(isset($chambres))
                            @foreach ($chambres as $chambre)
                                <option value="{{ $chambre->id }}" {{ old('chambre_id') == $chambre->id ? 'selected' : '' }}>
                                    {{ $chambre->code_chambre ?? 'Chambre #'.$chambre->id }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('chambre_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Financier -->
        <div class="bg-gray-50 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Informations financières</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="loyer" class="block text-sm font-medium text-gray-700 mb-1">Loyer (FCFA)</label>
                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        id="loyer"
                        name="loyer"
                        value="{{ old('loyer') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    @error('loyer')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="caution" class="block text-sm font-medium text-gray-700 mb-1">Caution (FCFA)</label>
                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        id="caution"
                        name="caution"
                        value="{{ old('caution') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    @error('caution')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div>
            <label>Fichier PDF </label>
            <input type="file" name="pdf" class="w-full border border-gray-300 rounded-md px-3 py-2">
        </div>

        <!-- Boutons d'action -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('contrat_de_bails.index') }}" 
               class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
                Annuler
            </a>
            <button type="submit" 
                    class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                Créer le contrat
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const maisonSelect = document.getElementById('maison_id');
    const chambreSelect = document.getElementById('chambre_id');

    maisonSelect.addEventListener('change', async function() {
        const maisonId = this.value;
        chambreSelect.innerHTML = '<option value="">-- Aucune --</option>';
        
        if (!maisonId) return;

        try {
            const response = await fetch(`/api/maisons/${maisonId}/chambres`);
            if (!response.ok) throw new Error('Erreur de chargement');
            
            const chambres = await response.json();
            chambres.forEach(chambre => {
                const option = document.createElement('option');
                option.value = chambre.id;
                option.textContent = chambre.code_chambre ?? `Chambre #${chambre.id}`;
                chambreSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Erreur:', error);
        }
    });
});
</script>
@endsection