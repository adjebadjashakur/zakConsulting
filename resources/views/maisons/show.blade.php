@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">{{ $maison->nom }}</h2>
        <div class="space-x-2">
            <a href="{{ route('maisons.edit', $maison) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Modifier
            </a>
            <a href="{{ route('maisons.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Retour
            </a>
        </div>
    </div>
    
    <!-- Informations de la maison -->
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h3 class="text-lg font-semibold mb-4">Informations de la maison</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div>
                <p><strong>Nom:</strong> {{ $maison->nom }}</p>
            </div>
            <div>
                <p><strong>Adresse:</strong> {{ $maison->adresse }}</p>
            </div>
            <div>
                <p><strong>Quartier:</strong> {{ $maison->quartier ?? 'Non renseigné' }}</p>
            </div>
            <div>
                <p><strong>Superficie:</strong> {{ $maison->superficie ?? 'Non renseigné' }}</p>
            </div>
            <div>
                <p><strong>Description:</strong> {{ $maison->description ?? 'Non renseigné' }}</p>
            </div>
            <div>
                <p><strong>Statut:</strong> 
                    <span class="px-2 py-1 text-xs rounded
                        @if($maison->statut == 'libre') bg-green-100 text-green-800
                        @elseif($maison->statut == 'occupé') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                        {{ ucfirst($maison->statut) }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    <!-- Section des Chambres -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold">Chambres de la maison</h3>
            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                {{ $maison->chambres->count() ?? 0 }} chambre(s)
            </span>
        </div>
        
        @if($maison->chambres && $maison->chambres->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6">
                @foreach($maison->chambres as $chambre)
                    <div class="border border-gray-200 rounded-lg p-5 hover:shadow-lg hover:border-blue-300 transition-all duration-200">
                        <!-- Header de la chambre -->
                        <div class="flex justify-between items-start mb-4">
                            <h4 class="font-bold text-lg text-blue-600">{{ $chambre->code_chambre }}</h4>
                            <span class="px-3 py-1 text-xs font-medium rounded-full
                                @if($chambre->statut == 'libre') bg-green-100 text-green-800
                                @elseif($chambre->statut == 'occupé') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ ucfirst($chambre->statut) }}
                            </span>
                        </div>
                        
                        <!-- Informations de la chambre -->
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Type:</span>
                                <span class="text-sm font-medium">{{ $chambre->type ?? 'Non renseigné' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Loyer:</span>
                                <span class="text-sm font-bold text-green-600">{{ number_format($chambre->loyer_individuel) }} FCFA</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Caution:</span>
                                <span class="text-sm font-medium text-orange-600">{{ number_format($chambre->caution ?? $chambre->loyer_individuel * 3 * 0.10) }} FCFA</span>
                            </div>
                        </div>

                        <!-- Informations du locataire -->
                        @if($chambre->locataire)
                            <div class="border-t pt-4 mt-4 bg-gray-50 -m-5 p-5 rounded-b-lg">
                                <p class="text-sm font-semibold text-gray-700 mb-2"> Locataire actuel:</p>
                                <p class="text-sm font-medium">{{ $chambre->locataire->nom }} {{ $chambre->locataire->prenom }}</p>
                                @if($chambre->locataire->telephone)
                                    <p class="text-sm text-gray-600">📞 {{ $chambre->locataire->telephone }}</p>
                                @endif
                                <a href="{{ route('locataires.show', $chambre->locataire) }}" class="inline-block mt-2 text-blue-500 text-sm hover:underline font-medium">
                                    Voir le profil →
                                </a>
                            </div>
                        @else
                            <div class="border-t pt-4 mt-4 text-center">
                                <p class="text-sm text-gray-500 italic"> Chambre libre</p>
                            </div>
                        @endif

                        <!-- Actions -->
                        <div class="mt-4 pt-4 border-t flex justify-between">
                            <a href="{{ route('chambres.show', $chambre) }}" class="text-blue-500 text-sm hover:underline font-medium">
                                Voir détails
                            </a>
                            <a href="{{ route('chambres.edit', $chambre) }}" class="text-yellow-600 text-sm hover:underline font-medium">
                                Modifier
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Résumé financier -->
            <div class="mt-8 p-6 bg-gray-50 rounded-lg">
                <h4 class="font-semibold mb-4"> Résumé financier</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="text-center">
                        <p class="text-sm text-gray-600">Revenus mensuels potentiels</p>
                        <p class="text-lg font-bold text-green-600">
                            {{ number_format($maison->chambres->sum('loyer_individuel')) }} FCFA
                        </p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600">Revenus annuels potentiels</p>
                        <p class="text-lg font-bold text-blue-600">
                            {{ number_format($maison->chambres->sum('loyer_individuel') * 12) }} FCFA
                        </p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600">Chambres occupées</p>
                        <p class="text-lg font-bold text-red-600">
                            {{ $maison->chambres->where('statut', 'occupé')->count() }} / {{ $maison->chambres->count() }}
                        </p>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Aucune chambre enregistrée pour cette maison</p>
                <a href="{{ route('chambres.create') }}" class="inline-block mt-4 bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                    Ajouter une chambre
                </a>
            </div>
        @endif
    </div>
</div>
@endsection