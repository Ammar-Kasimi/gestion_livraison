<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Classes\User;

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout_btn2'])) {

    $user = new User();
    $user->logout();
    header("Location: register.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_offer'])) {

    $offer = new Offer;
    $offer->send_offer($_POST["vehicule"],$_POST["prix"],$_POST["duree"],$post["options"]);
    header("Location: register.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livri - Espace Livreur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-gray-100 font-sans text-gray-800">

    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center sticky top-0 z-20">
        <div class="flex items-center gap-3">
            <div class="bg-indigo-600 text-white p-2 rounded-lg shadow-lg"><i class="fas fa-cube"></i></div>
            <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Livri <span class="text-sm font-normal text-gray-500">| Livreur</span></h2>
        </div>
        <div class="flex items-center gap-6">
            <a href="notifications.php" class="relative text-gray-400 hover:text-indigo-600 transition">
                <i class="fas fa-bell text-xl"></i>
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white">2</span>
            </a>
            <div class="h-6 w-px bg-gray-300"></div>
            <form action="" method="POST">
                <button id="btn-logout2" name="logout_btn2" class="flex items-center gap-2 text-gray-600 hover:text-red-600 font-medium transition group">
                    <span class="group-hover:underline">Déconnexion</span><i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </nav>

    <main class="flex-1 p-4 md:p-8 max-w-7xl mx-auto w-full animate-fade-in">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Marché des courses</h1>
            <div class="bg-white px-4 py-2 rounded-lg shadow-sm border text-sm text-gray-600"><i class="fas fa-map-marker-alt text-red-500"></i> Zone: <b>Casablanca</b></div>
        </div>
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-200">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                    <tr>
                        <th class="p-5">Commande</th>
                        <th class="p-5">Adresse</th>
                        <th class="p-5 text-right w-64">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">

                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-5 font-medium text-gray-900">
                            <div class="flex items-center gap-3">
                                <div class="bg-blue-100 text-blue-600 p-2 rounded-lg"><i class="fas fa-file-alt"></i></div>
                                <span>Livraison Documents</span>
                            </div>
                        </td>
                        <td class="p-5 text-gray-600 flex items-center gap-2">
                            <i class="fas fa-map-pin text-red-400"></i> Centre Ville
                        </td>
                        <td class="p-5 text-right">
                            <div class="flex justify-end gap-2">
                                <button data-toggle="modal" data-target="modal-competitor-offers" class="bg-purple-100 text-purple-700 hover:bg-purple-200 px-3 py-2 rounded-lg text-xs font-bold transition flex items-center gap-1">
                                    <i class="fas fa-users"></i> Voir Offres
                                </button>
                                <button data-toggle="modal" data-target="modal-item-details" data-items="Contrat, Enveloppe" class="bg-gray-100 text-gray-600 hover:bg-gray-200 px-3 py-2 rounded-lg text-xs font-bold transition">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button data-toggle="modal" data-target="modal-make-offer" data-id="1" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded-lg text-xs font-bold shadow-sm transition">
                                    Offrir
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <div id="modal-make-offer" class="hidden fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg modal-content overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Faire une offre</h3>
                <button data-dismiss="modal-make-offer" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
            </div>

            <form action="livreur.php" method="POST" class="p-6 space-y-5">
                <input type="hidden" name="order_id" value="">

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Véhicule</label>
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <input type="radio" name="vehicle" value="velo" id="v-bike" class="vehicle-radio hidden" checked>
                            <label for="v-bike" class="flex flex-col items-center justify-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 border-gray-200 transition">
                                <i class="fas fa-bicycle text-2xl mb-1"></i>
                                <span class="text-xs font-bold">Vélo</span>
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="vehicle" value="moto" id="v-moto" class="vehicle-radio hidden">
                            <label for="v-moto" class="flex flex-col items-center justify-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 border-gray-200 transition">
                                <i class="fas fa-motorcycle text-2xl mb-1"></i>
                                <span class="text-xs font-bold">Moto</span>
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="vehicle" value="voiture" id="v-car" class="vehicle-radio hidden">
                            <label for="v-car" class="flex flex-col items-center justify-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 border-gray-200 transition">
                                <i class="fas fa-car text-2xl mb-1"></i>
                                <span class="text-xs font-bold">Voiture</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1">Prix (DH)</label>
                        <input type="number" name="price" required class="w-full border rounded-lg p-3 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1">Durée (Min)</label>
                        <input type="number" name="duration" required class="w-full border rounded-lg p-3 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Options supplémentaires</label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="flex items-center space-x-2 p-2 border rounded cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="options[]" value="express" class="text-indigo-600 focus:ring-indigo-500 rounded">
                            <span class="text-sm">⚡ Express</span>
                        </label>
                        <label class="flex items-center space-x-2 p-2 border rounded cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="options[]" value="fragile" class="text-indigo-600 focus:ring-indigo-500 rounded">
                            <span class="text-sm">💎 Fragile</span>
                        </label>
                        <label class="flex items-center space-x-2 p-2 border rounded cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="options[]" value="assurance" class="text-indigo-600 focus:ring-indigo-500 rounded">
                            <span class="text-sm">🛡️ Assurance</span>
                        </label>
                    </div>
                </div>

                <button type="submit" name="submit_offer" class="w-full bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-indigo-700 transition shadow-lg">Envoyer</button>
            </form>
        </div>
    </div>

    <div id="modal-competitor-offers" class="hidden fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg modal-content overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Concurrents</h3><button data-dismiss="modal-competitor-offers" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
            </div>
            <div id="competitor-list" class="p-6 space-y-3 bg-gray-50 max-h-96 overflow-y-auto"></div>
        </div>
    </div>

    <div id="modal-item-details" class="hidden fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm modal-content overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Détails</h3><button data-dismiss="modal-item-details" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
            </div>
            <div class="p-6">
                <ul id="details-list" class="space-y-3"></ul>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>