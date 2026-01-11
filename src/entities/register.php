<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Classes\User;

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register_btn"])){
    $user = new User;
    $user->signup($_POST["name"], $_POST["email"], $_POST["password"], $_POST["role"], $_POST["address"], $_POST["username"]);
    
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livri - Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-100 font-sans text-gray-800">
    <section class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-indigo-600 to-purple-700">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-10 animate-fade-in">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-extrabold text-gray-900">Livri</h1>
                <p class="text-gray-500">Créer un compte</p>
            </div>
            
            <form id='registerForm' action="" method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nom Complet</label>
                    <input type="text" name="name" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="exemple@mail.com">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Adresse</label>
                    <input type="text" name="address" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="Votre ville, quartier...">
                </div>
               
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Rôle</label>
                    <select name="role" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                        <option value="client">Je suis Client</option>
                        <option value="livreur">Je suis Livreur</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Mot de passe</label>
                    <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                
                <button type="submit" name="register_btn" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg shadow transition transform hover:scale-[1.02] mt-4">
                    S'inscrire
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">Déjà un compte? <a href="index.php" class="text-indigo-600 font-bold hover:underline">Se connecter</a></p>
            </div>
        </div>
    </section>
</body>
</html>