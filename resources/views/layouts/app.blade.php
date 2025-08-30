<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Zak_Consulting</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">
    <!-- Navigation simple -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="text-xl font-bold text-blue-600">
                <a href="{{ route('dashboard') }}">Zak_Consulting</a>
                </div>
                
                <!-- Liens de navigation -->
                <div class="hidden md:flex space-x-4">
                    <a href="{{ route('rapports_mensuels.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">RapportsM</a>
                    <a href="{{ route('proprietaires.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">Propriétaires</a>
                    <a href="{{ route('maisons.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">Maisons</a>
                    <a href="{{ route('chambres.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">Chambres</a>
                    <a href="{{ route('locataires.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">Locataires</a>
                    <a href="{{ route('contrat_de_bails.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">Contrats</a>
                    <a href="{{ route('rapport_immobiliers.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">Rapports</a>
                    
                </div>
                
                <!-- Menu utilisateur -->
                @auth
                <div class="text-gray-700">
                    {{-- Bonjour, Mr {{ Auth::user()->prenom }} --}}
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="ml-4 text-red-600 hover:text-red-800">
                        Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    
    <main class="max-w-7xl mx-auto py-6 px-4">
        @if(session('success'))
            <div class="mb-4 px-4 py-2 bg-green-200 text-green-800 rounded shadow">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 px-4 py-2 bg-red-200 text-red-800 rounded shadow">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </main>
{{-- 
@include('layouts.footer') --}}
</body>
</html>