@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-green-700">Détails du Rapport Immobilier</h2>

    <div class="bg-white p-6 rounded-lg shadow space-y-4">

        {{-- Propriétaire --}}
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Propriétaire</h3>
            <p>{{ $rapportImmobilier->proprietaire->nom  }}</p>
        </div>

        {{-- Maison --}}
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Maison</h3>
            <p>{{ $rapportImmobilier->maison->nom  }}</p>
        </div>

        {{-- Chambre --}}
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Chambre</h3>
            <p>{{ $rapportImmobilier->chambre->code_chambre  }}</p>
        </div>

        {{-- Locataire --}}
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Locataire</h3>
            <p>{{ $rapportImmobilier->locataire->nom  }} {{ $rapportImmobilier->locataire->prenom  }}</p>
        </div>

        {{-- Montants --}}
        <div class="grid grid-cols-3 gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Montant total</h3>
                <p>{{ number_format($rapportImmobilier->total) }} FCFA</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Commission</h3>
                <p>{{ number_format($rapportImmobilier->commission) }} FCFA</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Total net</h3>
                <p>{{ number_format($rapportImmobilier->total_net) }} FCFA</p>
            </div>
        </div>

        {{-- Mois / Année --}}
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Mois / Année</h3>
            <p>{{ $rapportImmobilier->mois_annee }}</p>
        </div>

        {{-- Date du rapport --}}
        <div>
            <h3 class="text-lg font-semibold text-gray-700">Date du rapport</h3>
            <p>{{ \Carbon\Carbon::parse($rapportImmobilier->date_rapport)->format('d/m/Y') }}</p>
        </div>

        {{-- Actions --}}
        <div class="flex justify-end space-x-4 mt-4">
            <a href="{{ route('rapport_immobiliers.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                Retour
            </a>
            <a href="{{ route('rapport_immobiliers.edit', $rapportImmobilier->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                Modifier
            </a>
        </div>

    </div>
</div>
@endsection
