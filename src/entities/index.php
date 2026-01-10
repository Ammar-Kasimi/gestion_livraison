

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livri - Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-100 font-sans text-gray-800">
    <section class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-indigo-600 to-purple-700">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-10 animate-fade-in">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900">Livri</h1>
                <p class="text-gray-500">Se connecter</p>
            </div>
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nom d'utilisateur</label>
                    <input type="text" id="login-username" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none transition" placeholder="client, livreur, ou admin">
                    <p class="text-xs text-gray-400 mt-1">Test: 'admin' (123456), 'livreur', ou 'client'</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Mot de passe</label>
                    <input type="password" id="login-password" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none transition" placeholder="••••••••">
                </div>
                <button id="btn-login" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg shadow transition transform hover:scale-[1.02]">
                    Se Connecter
                </button>
            </div>
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">Pas de compte? <a href="register.php" class="text-indigo-600 font-bold hover:underline">S'inscrire</a></p>
            </div>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>