<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion | ENVISTAT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#A8E6CF] text-gray-800 flex items-center justify-center h-screen px-4">
    <div class="w-full max-w-md space-y-6">
        <div class="bg-white shadow-lg rounded-2xl p-8">
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/armoirie.png') }}" alt="Logo Ministère" class="h-20">
            </div>
            
            <h1 class="text-center text-3xl font-bold text-[#006400] mb-2">ENVISTAT</h1>

            <p class="text-center text-sm text-gray-600 italic mb-4">Suivi des indicateurs environnementaux</p>

            <h2 class="text-2xl font-bold text-center mb-6 text-[#006400]">Connexion</h2>

            @if (session('status'))
                <div class="mb-4 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium mb-1 text-[#006400]">Adresse e-mail</label>
                    <input id="email" name="email" type="email" required autofocus value="{{ old('email') }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#006400]">

                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium mb-1 text-[#006400]">Mot de passe</label>
                    <input id="password" name="password" type="password" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#006400]">

                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 text-[#006400] border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-[#006400]">Se souvenir de moi</label>
                </div>

                <!-- Submit -->
                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-[#006400] hover:underline">Mot de passe oublié ?</a>
                    @endif

                    <button type="submit"
                        class="bg-[#006400] hover:bg-green-900 text-white px-5 py-2 rounded-lg text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[#A8E6CF]">
                        Connexion
                    </button>
                </div>
            </form>
        </div>

       
    </div>
</body>
</html>
