@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-3xl font-bold mb-6">
        Détails du Propriétaire : 
        {{ $proprietaire->nom ?? 'Nom non renseigné' }} 
        {{ $proprietaire->prenom ?? '' }}
    </h2>

    {{-- Infos générales --}}
    <div class="mb-8 space-y-2 text-gray-700">
        <p><strong>Téléphone :</strong> {{ $proprietaire->telephone ?? 'Non renseigné' }}</p>
        <p><strong>Email :</strong> {{ $proprietaire->email ?? 'Non renseigné' }}</p>
        <p><strong>Adresse :</strong> {{ $proprietaire->adresse ?? 'Non renseignée' }}</p>
        <p><strong>Nombre de maisons :</strong> {{ $proprietaire->maisons->count() ?? 0 }}</p>
    </div>

    {{-- Maisons --}}
    <h3 class="text-2xl font-semibold mb-4">Maisons</h3>

    @forelse ($proprietaire->maisons as $maison)
        <div class="mb-6 border rounded p-4 shadow-sm">
            <div class="flex justify-between items-center mb-2">
                <h4 class="text-xl font-semibold">
                    {{ $maison->nom ?? 'Nom non renseigné' }} 
                    <span class="text-sm text-gray-500">({{ $maison->quartier ?? 'Quartier inconnu' }})</span>
                </h4>
                <span class="px-3 py-1 text-sm font-medium rounded-full
                    @if(($maison->statut ?? '') === 'libre') bg-green-100 text-green-800
                    @elseif(($maison->statut ?? '') === 'occupé') bg-red-100 text-red-800
                    @else bg-yellow-100 text-yellow-800 @endif">
                    {{ ucfirst($maison->statut ?? 'Statut inconnu') }}
                </span>
            </div>

            <p><strong>Adresse :</strong> {{ $maison->adresse ?? 'Adresse non renseignée' }}</p>
            <p><strong>Loyer mensuel :</strong>  {{  $loyer_mensuel = $chambre->loyer_individuel ?? old('loyer_mensuel') }}
                </p>
            <p><strong>Nombre de chambres :</strong> {{ $maison->chambres->count() ?? 0 }}</p>

            {{-- Locataires --}}
            <h5 class="mt-4 mb-2 font-semibold">Locataires</h5>
            @if(empty($maison->contratDeBails) || $maison->contratDeBails->isEmpty())
                <p class="text-gray-600 italic ml-4">Aucun locataire enregistré.</p>
            @else
                <ul class="ml-4 list-disc space-y-1">
                    @foreach ($maison->contratDeBails as $contrat)
                        <li>
                            <span class="font-medium">
                                {{ $contrat->locataire->nom ?? 'Nom inconnu' }} 
                                {{ $contrat->locataire->prenom ?? '' }}
                            </span> — 
                            Contrat : 
                            @if($contrat->date_debut)
                                <time datetime="{{ $contrat->date_debut }}">
                                    {{ \Carbon\Carbon::parse($contrat->date_debut)->format('d/m/Y') }}
                                </time>
                            @else
                                Date début non renseignée
                            @endif
                            au 
                            @if($contrat->date_fin)
                                <time datetime="{{ $contrat->date_fin }}">
                                    {{ \Carbon\Carbon::parse($contrat->date_fin)->format('d/m/Y') }}
                                </time>
                            @else
                                Date fin non renseignée
                            @endif
                            @if(!empty($contrat->statut))
                                <span class="ml-2 px-2 py-0.5 text-xs rounded bg-blue-100 text-blue-800">
                                    {{ ucfirst($contrat->statut) }}
                                </span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @empty
        <p class="text-gray-600 italic">Aucune maison enregistrée pour ce propriétaire.</p>
    @endforelse
</div>
@endsection
