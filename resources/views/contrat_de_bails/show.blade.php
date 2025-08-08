@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Détails du contrat</h2>

    <ul class="space-y-2 text-gray-700">
        <li><strong>Locataire :</strong> {{ $contratDeBail->locataire->nom }} {{ $contratDeBail->locataire->prenom ?? '' }}</li>
        <li><strong>Maison :</strong> {{ $contratDeBail->maison->nom ?? '—' }}</li>
        <li><strong>Chambre :</strong> {{ $contratDeBail->chambre->code_chambre ?? '—' }}</li>
        <li><strong>Date début :</strong> {{ \Carbon\Carbon::parse($contratDeBail->date_debut)->format('d/m/Y') }}</li>
        <li><strong>Date fin :</strong> {{ \Carbon\Carbon::parse($contratDeBail->date_fin)->format('d/m/Y') }}</li>
        <li>
            <strong>Loyer mensuel :</strong> 
            {{ $contratDeBail->chambre->loyer_individuel ?? $contratDeBail->loyer_mensuel ?? '—' }} FCFA</li>
        {{-- <li><strong>Caution :</strong> {{ $contratDeBail->caution ?? '—' }} FCFA</li> --}}
        <li><strong>Statut :</strong> <span class="capitalize">{{ $contratDeBail->statut }}</span></li>
        <li><strong>PDF :</strong>
            @if($contratDeBail->pdf)
                <a href="{{ asset('storage/' . $contratDeBail->pdf) }}" target="_blank" class="text-blue-600 underline">Voir le fichier</a>
            @else
                Aucun fichier
            @endif
        </li>
    </ul>

    <div class="mt-6">
        <a href="{{ route('contrat_de_bails.edit', $contratDeBail) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</a>
        <a href="{{ route('contrat_de_bails.index') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Retour</a>
    </div>
</div>
@endsection
