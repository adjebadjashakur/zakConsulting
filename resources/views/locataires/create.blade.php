@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Ajouter un locataire</h2>

    <form action="{{ route('locataires.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
        @csrf

        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="prenom" class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" required
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}" required
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
                <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label for="carte_identite_recto" class="block text-sm font-medium text-gray-700 mb-2">Carte d'identité (Recto)</label>
                <input type="file" name="carte_identite_recto" id="carte_identite_recto"
                       class="w-full border border-gray-300 rounded-md px-3 py-2">
            </div>

            <div>
                <label for="carte_identite_verso" class="block text-sm font-medium text-gray-700 mb-2">Carte d'identité (Verso)</label>
                <input type="file" name="carte_identite_verso" id="carte_identite_verso"
                       class="w-full border border-gray-300 rounded-md px-3 py-2">
            </div>
        </div>

            <div>
                <label for="nationalite" class="block text-sm font-medium text-gray-700 mb-2">Nationalité</label>
                <input type="text" name="nationalite" id="nationalite" value="{{ old('nationalite', 'Togolaise') }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
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


        </div>


     

        <div class="flex justify-end space-x-4">
            <a href="{{ route('locataires.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Annuler
            </a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection
