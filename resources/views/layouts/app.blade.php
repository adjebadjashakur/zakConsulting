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
                    Zak_Consulting
                </div>
                
                <!-- Liens de navigation -->
                <div class="hidden md:flex space-x-4">
                    {{-- <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">Tableau de bord</a> --}}
                    <a href="{{ route('proprietaires.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">Propriétaires</a>
                    <a href="{{ route('maisons.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">Maisons</a>
                    <a href="{{ route('locataires.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">Locataires</a>
                    <a href="{{ route('contrat_de_bails.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">Contrats</a>
                </div>
                
                <!-- Menu utilisateur -->
                @auth
                <div class="text-gray-700">
                    {{-- Bonjour, {{ Auth::user()->nom }} --}}
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
        @yield('content')
    </main>
{{-- 
@include('layouts.footer') --}}
</body>
</html>