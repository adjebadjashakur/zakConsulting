@extends('layouts.app')
@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-gray-200 p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Login</h1>
        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-black mb-2 font-medium">Email</label>
                <input type="email" id="email" name="email" required 
                    class="w-full px-4 py-2 border border-gray-300 text-black rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-black mb-2 font-medium">Mot de passe</label>
                <input type="password" id="password" name="password" required 
                    class="w-full px-4 py-2 border border-gray-300 text-black rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200">Se connecter</button>
        </form>
    </div>
</div>
@endsection

<!--

<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>
        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" required class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Login</button>
        </form>
    </div>
</div>

-->




<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>


    <body> 
    <div class="bg-gray-400 flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-black border  flex flex-col items-center">
        <h1>Login</h1>
        <form class="sm:w-lg" action="{{route('login')}}" method="POST">
        @csrf
    <div>
        <fieldset class="fieldset">
            <legend class="fieldset-legend">Email?</legend>
            <input type="email" class=" w-full input" placeholder="Ex: name@email.com" />
            @error('email')         
                <p class="label error-m">{{$message}}</p>
            @enderror
        </fieldset>
    </div>
    <div>
        <fieldset class="fieldset">
            <legend class="fieldset-legend">Password?</legend>
            <input type="password" class=" w-full input" placeholder="Enter your password" />
            @error('password')
                <p class="label error-m">{{$message}}</p>
            @enderror
        </fieldset>
    </div>
    <button class="btn btn-neutral margin-top-4 w-full" type="submit">Login</button>
</div>
</form>
</html>-->