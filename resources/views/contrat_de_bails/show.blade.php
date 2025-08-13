@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Détails du Contrat de Bail</h1>
    
    <!-- Informations du contrat -->
    <div class="bg-gray-50 rounded-lg p-6 mb-6">
        <h5 class="text-xl font-semibold mb-4 text-gray-700">Contrat {{ $contrat->id }}</h5>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
            <div>
                <strong class="font-medium">Date de début :</strong> 
                <span class="ml-2">{{ $contrat->date_debut ?? '-' }}</span>
            </div>
            <div>
                <strong class="font-medium">Date de fin :</strong> 
                <span class="ml-2">{{ $contrat->date_fin ?? '-' }}</span>
            </div>
            <div>
                <strong class="font-medium">Loyer mensuel :</strong> 
                <span class="ml-2">{{ $contrat->loyer ?? '-' }} FCFA</span>
            </div>
            <div>
                <strong class="font-medium">Statut :</strong> 
                <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">{{ $contrat->statut ?? '-' }}</span>
            </div>
            <div>
                @if ($contrat->pdf)
                            <strong class="font-medium">PDF</strong>
                            <a href="{{ asset('storage/' . $contrat->pdf) }}" class="text-blue-500 underline" target="_blank">Télécharger</a>
                        @endif
                </div>
        </div>
    </div>

    <!-- Informations du locataire -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Locataire</h2>
        <div class="bg-gray-50 rounded-lg p-6">
            @if($contrat->locataire)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                    <div>
                        <strong class="font-medium">Nom :</strong> 
                        <span class="ml-2">{{ $contrat->locataire->nom ?? '-' }}</span>
                    </div>
                    <div>
                        <strong class="font-medium">Prénom :</strong> 
                        <span class="ml-2">{{ $contrat->locataire->prenom ?? '-' }}</span>
                    </div>
                    <div>
                        <strong class="font-medium">Email :</strong> 
                        <span class="ml-2">{{ $contrat->locataire->email ?? '-' }}</span>
                    </div>
                    <div>
                        <strong class="font-medium">Téléphone :</strong> 
                        <span class="ml-2">{{ $contrat->locataire->telephone ?? '-' }}</span>
                    </div>
                    {{-- <div>
                        @if ($contrat->pdf)
                            <strong class="font-medium">PDF</strong>
                            <a href="{{ asset('storage/' . $contrat->pdf) }}" class="text-blue-500 underline" target="_blank">Télécharger</a>
                        @endif
                    </div> --}}
                </div>
            @else
                <p class="text-gray-500 italic">Aucun locataire associé.</p>
            @endif
        </div>
    </div>

    <!-- Informations de la maison -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Maison</h2>
        <div class="bg-gray-50 rounded-lg p-6">
            @if($contrat->maison)
                <div class="space-y-3 text-gray-700">
                    <div>
                        <strong class="font-medium">Nom :</strong> 
                        <span class="ml-2">{{ $contrat->maison->nom ?? '-' }}</span>
                    </div>
                    <div>
                        <strong class="font-medium">Adresse :</strong> 
                        <span class="ml-2">{{ $contrat->maison->adresse ?? '-' }}</span>
                    </div>
                </div>
            @else
                <p class="text-gray-500 italic">Aucune maison associée.</p>
            @endif
        </div>
    </div>

    <!-- Informations de la chambre -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Chambre</h2>
        <div class="bg-gray-50 rounded-lg p-6">
            @if($contrat->chambre)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-gray-700">
                    <div>
                        <strong class="font-medium">Numéro :</strong> 
                        <span class="ml-2">{{ $contrat->chambre->code_chambre ?? '-' }}</span>
                    </div>
                    <div>
                        <strong class="font-medium">Type :</strong> 
                        <span class="ml-2">{{ $contrat->chambre->type ?? '-' }}</span>
                    </div>
                    <div>
                        <strong class="font-medium">Caution :</strong> 
                        <span class="ml-2">{{ $contrat->chambre->caution ?? '-' }} FCFA</span>
                    </div>
                </div>
            @else
                <p class="text-gray-500 italic">Aucune chambre associée.</p>
            @endif
        </div>
    </div>

    <!-- Bouton de retour -->
    <div class="flex justify-end">
        <a href="{{ route('contrat_de_bails.index') }}" 
           class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-200 font-medium">
            Retour à la liste
        </a>
    </div>
</div>
@endsection