@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Détails du locataire</h2>
    <ul class="space-y-2 text-gray-700">
        <li><strong>Nom :</strong> {{ $locataire->nom }}</li>
        <li><strong>Prénom :</strong> {{ $locataire->prenom }}</li>
        <li><strong>Téléphone :</strong> {{ $locataire->telephone }}</li>
        <li><strong>Email :</strong> {{ $locataire->email }}</li>
        <li><strong>Nationalité :</strong> {{ $locataire->nationalite }}</li>
        <li><strong>Situation matrimoniale :</strong> {{ $locataire->situation_matrimoniale }}</li>

        @if ($locataire->carte_identite_recto)
            <li>
                <strong>Carte identité recto :</strong>
                <a href="{{ asset('storage/' . $locataire->carte_identite_recto) }}" class="text-blue-500 underline" target="_blank">Télécharger</a>
            </li>
        @endif

        @if ($locataire->carte_identite_verso)
            <li>
                <strong>Carte identité verso :</strong>
                <a href="{{ asset('storage/' . $locataire->carte_identite_verso) }}" class="text-blue-500 underline" target="_blank">Télécharger</a>
            </li>
        @endif
    </ul>
    </div>

    <div class="mt-6">
        <h3 class="text-lg font-semibold mb-2">Bails associés :</h3>
        @if($locataire->contratDeBails->count())
            <ul class="list-disc pl-5">
                @foreach($locataire->contratDeBails as $bail)
                    <li>
                        Maison : {{ $bail->maison->nom ?? 'N/A' }} | 
                        Début : {{ $bail->date_debut }} | 
                        Fin : {{ $bail->date_fin }}
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">Aucun bail associé.</p>
        @endif
    </div>

    <div class="flex justify-end space-x-4">
            <a href="{{ route('locataires.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Annuler
            </a>
            
    <a href="{{ route('locataires.edit', $locataire) }}" class="bg-yellow-500  text-white px-4 py-2   rounded hover:bg-yellow-600">Modifier</a>
        </div>
</div>
@endsection
