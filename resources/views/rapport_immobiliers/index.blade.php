@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Rapports Immobiliers</h2>
    <a href="{{ route('rapport_immobiliers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Nouveau Rapport
    </a>
</div>

@if(session('success'))
    <div class="mb-4 px-4 py-2 bg-green-200 text-green-800 rounded shadow">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded shadow overflow-hidden">
    @if($rapports->count())
    <div class="overflow-x-auto">
    <table class="min-w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Locataire</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Propriétaire</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Total</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Commission</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Total Net</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Mois/Année</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Date</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($rapports as $rapport)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-3">{{ $rapport->locataire->nom ?? '-' }}</td>
                <td class="px-6 py-3">{{ $rapport->proprietaire->nom ?? '-' }}</td>
                <td class="px-6 py-3">{{ number_format($rapport->total, 2, ',', ' ') }}</td>
                <td class="px-6 py-3">{{ number_format($rapport->commission, 2, ',', ' ') }}</td>
                <td class="px-6 py-3">{{ number_format($rapport->total_net, 2, ',', ' ') }}</td>
                <td class="px-6 py-3">{{ $rapport->mois_annee }}</td>
                <td class="px-6 py-3">{{ \Carbon\Carbon::parse($rapport->date_rapport)->format('d/m/Y') }}</td>
                <td class="px-6 py-3 text-right space-x-2">
                    <a href="{{ route('rapport_immobiliers.show', $rapport) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                    <a href="{{ route('rapport_immobiliers.edit', $rapport) }}" class="text-yellow-600 hover:text-yellow-900">Modifier</a>
                    <form action="{{ route('rapport_immobiliers.destroy', $rapport) }}" method="POST" class="inline" onsubmit="return confirm('Confirmer la suppression ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <div class="px-6 py-3">
        {{ $rapports->links() }}
    </div>
    @else
        <div class="p-6 text-center text-gray-500">Aucun rapport pour le moment.</div>
    @endif
</div>
@endsection
