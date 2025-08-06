@extends('layouts.app')

@section('title', 'Nouveau Propriétaire')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Nouveau Propriétaire</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>Erreur !</strong> Veuillez corriger les champs ci-dessous :
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('proprietaires.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
        @csrf

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="prenom" class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" required
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                <input type="text" id="telephone" name="telephone" value="{{ old('telephone') }}" required
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="carte_identite_recto" class="block text-sm font-medium text-gray-700 mb-2">Carte d'identité (Recto)</label>
                <input type="file" id="carte_identite_recto" name="carte_identite_recto" accept=".jpg,.jpeg,.png,.pdf"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="carte_identite_verso" class="block text-sm font-medium text-gray-700 mb-2">Carte d'identité (Verso)</label>
                <input type="file" id="carte_identite_verso" name="carte_identite_verso" accept=".jpg,.jpeg,.png,.pdf"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div class="mb-4">
            <label for="adresse" class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
            <textarea id="adresse" name="adresse" rows="3"
                      class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('adresse') }}</textarea>
        </div>
{{-- 
        <div class="mb-6">
            <label for="commune" class="block text-sm font-medium text-gray-700 mb-2">Commune</label>
            <input type="text" id="commune" name="commune" value="{{ old('commune') }}"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div> --}}

        <div class="flex justify-end space-x-4">
            <a href="{{ route('proprietaires.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Annuler
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Créer
            </button>
        </div>
    </form>
</div>
@endsection
