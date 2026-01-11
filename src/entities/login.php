<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Classes\User;


session_start();
if(isset($_SESSION["id"])){
    if ($_SESSION['role'] == "client") {
        header("location:client.php");
        exit;
    }
    if ($_SESSION['role'] == "livreur") {
        header("location: livreur.php");
        exit;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login_btn"])) {
    $user = new User;
    $user->login($_POST["email"], $_POST["password"]);
    if(isset($_SESSION["role"])){
    if ($_SESSION['role'] == "client") {
        header("location:client.php");
        exit;
    }
    if ($_SESSION['role'] == "livreur") {
        header("location: livreur.php");
        exit;
    }
    }
   
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Livri</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex items-center justify-center h-screen">

    <div class="bg-white p-10 rounded-2xl shadow-xl w-full max-w-md border border-gray-100">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Content de vous revoir</h2>
            <p class="text-gray-500 mt-2">Accédez à votre espace Livri</p>
        </div>

        <form id="loginForm" action="" method="post" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email adress</label>
                <input type="text" id="email" name="email" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition" placeholder="Votre identifiant">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition" placeholder="••••••••">
            </div>

            <button type="submit" name="login_btn" class="w-full py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-bold text-lg transition shadow-md shadow-purple-500/20">
                Se connecter
            </button>
        </form>

        <p class="mt-8 text-center text-gray-500 text-sm">
            Pas encore de compte ? <a href="register.php" class="text-blue-600 font-semibold hover:underline">Créer un compte</a>
        </p>
        <div class="mt-4 text-center">
            <a href="index.php" class="text-sm text-gray-400 hover:text-gray-600">← Retour à l'accueil</a>
        </div>
    </div>

    <!-- <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault(); 
            const user = document.getElementById('username').value;
            const pass = document.getElementById('password').value;

            if (user === 'admin' && pass === 'admin') {
                window.location.href = 'admin.php'; 
            } else {
                window.location.href = 'index.php'; 
            }
        });
    </script> -->
</body>

</html>