<?php


require_once __DIR__ . '/../../vendor/autoload.php';

use App\Classes\User;
use App\Classes\Item;
use App\Classes\Order;

$countt = 0;
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout_btn'])) {

    $user = new User();
    $user->logout();
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_order_btn'])) {
    $order = new Order();
    $order->fill_order($_SESSION["id"], $_POST["title"], $_POST["address"]);
    $order->insert_order($_SESSION["id"], $_POST["title"], $_POST["address"]);
    $order_id = $order->get_order_id();
    $order_items = $_POST["items"];
    foreach ($order_items as $itemm) {
        $item = new Item($itemm, $order_id);
        $item->insert_item();
    }
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livri - Espace Client</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-gray-100 font-sans text-gray-800">

    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center sticky top-0 z-20">
        <div class="flex items-center gap-3">
            <div class="bg-indigo-600 text-white p-2 rounded-lg shadow-lg"><i class="fas fa-cube"></i></div>
            <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Livri <span class="text-sm font-normal text-gray-500">| Client</span></h2>
        </div>

        <div class="flex items-center gap-6">
            <a href="notifications.php" class="relative text-gray-400 hover:text-indigo-600 transition">
                <i class="fas fa-bell text-xl"></i>
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white">3</span>
            </a>

            <div class="h-6 w-px bg-gray-300"></div>
            <form action="" method="POST">
                <button id="btn-logout" name="logout_btn" class="flex items-center gap-2 text-gray-600 hover:text-red-600 font-medium transition group">
                    <span class="group-hover:underline">Déconnexion</span><i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </nav>

    <main class="flex-1 p-4 md:p-8 max-w-7xl mx-auto w-full animate-fade-in">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Mes Commandes</h1>
            <button data-toggle="modal" data-target="modal-create-order" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl shadow-lg flex items-center gap-2">
                <i class="fas fa-plus-circle"></i> <span>Nouvelle Commande</span>
            </button>
        </div>

        <div id="client-orders-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div id="order-card-1" class="order-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300">
                <div class="p-5">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold uppercase">En Attente</span>
                        <div class="flex gap-2">
                            <button data-toggle="modal" data-target="modal-edit-order" data-id="order-card-1" data-title="Colis Standard" data-address="Sidi Maarouf, Casa" data-items="Laptop, Souris" class="text-gray-400 hover:text-indigo-600 p-1"><i class="fas fa-pen"></i></button>
                            <button class="text-gray-400 hover:text-red-500 p-1 btn-delete-order"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-2 order-title-display">Colis Standard</h3>
                    <p class="text-sm text-gray-500 flex items-center gap-2"><i class="fas fa-map-marker-alt text-indigo-400"></i> <span class="order-address-display">Sidi Maarouf, Casa</span></p>
                </div>
                <div class="bg-gray-50 px-5 py-3 border-t border-gray-100 flex justify-between items-center">
                    <button data-toggle="modal" data-target="modal-view-offers" class="text-indigo-600 font-semibold text-sm hover:text-indigo-800">Voir 2 Offres</button>
                    <button data-toggle="modal" data-target="modal-item-details" data-items="Laptop, Souris" class="text-gray-500 text-sm hover:text-gray-700 flex items-center gap-1"><i class="fas fa-eye"></i> Détails</button>
                </div>
                <?php
                $user2 = new User();

                for ($i = 1; $i <= $user2->get_count(); $i++) {
                    $order = new Order();

                    $order->fetch_order($i);
                    $user2->add_object($order);
                    echo "<div class='bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300 mb-6'>
    
    <div class='p-5'>
        <div class='flex justify-between items-start mb-4'>
            
            <span class='bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold uppercase'>
                " . $order['status'] . "
            </span>

            <form action='' method='POST' class='flex gap-2'>
                <button type='submit' name='delete_order_btn'.$i.''class='text-gray-400 hover:text-indigo-600 p-1'>
                    <i class='fas fa-pen'></i>
                </button>
                <button type='submit' name='offers_btn'.$i.'' class='text-gray-400 hover:text-red-500 p-1'>
                    <i class='fas fa-trash'></i>
                </button>

                <input class='hidden' value='$i' id='order_card_id'$i''>
                
            </form >
        </div>

        <h3 class='font-bold text-lg text-gray-800 mb-2'>
            " . $order['title'] . "
        </h3>

        <p class='text-sm text-gray-500 flex items-center gap-2'>
            <i class='fas fa-map-marker-alt text-indigo-400'></i>
            <span>" . $order['address'] . "</span>
        </p>
    </div>

    <div class='bg-gray-50 px-5 py-3 border-t border-gray-100 flex justify-between items-center'>
        <button class='text-indigo-600 font-semibold text-sm hover:text-indigo-800'>
            Voir Offres
        </button>
        <button class='text-gray-500 text-sm hover:text-gray-700 flex items-center gap-1'>
            <i class='fas fa-eye'></i> Détails
        </button>
    </div>

</div>";
                }
                ?>

            </div>
        </div>
    </main>

    <div id="modal-create-order" class="hidden fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg modal-content overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Nouvelle Commande</h3><button id="new_order_btn" data-dismiss="modal-create-order" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
            </div>
            <form id="form-create-order" action="" class="p-6 space-y-5">
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Titre</label><input type="text" id="create-title" class="w-full border rounded-lg p-3 text-sm"></div>
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Adresse</label><input type="text" id="create-address" class="w-full border rounded-lg p-3 text-sm"></div>
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Articles</label>
                    <div class="flex gap-2 mb-2"><input type="text" id="create-item-input" class="flex-1 border rounded-lg p-2 text-sm"><button type="button" id="btn-add-create-item" class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-lg font-bold">+</button></div>
                    <div id="create-items-container" class="flex flex-wrap gap-2 max-h-32 overflow-y-auto border border-dashed border-gray-300 p-2 rounded-lg bg-gray-50">
                        <p class="empty-msg text-xs text-gray-400 w-full text-center py-2">Aucun article ajouté</p>
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-2"><button type="button" data-dismiss="modal-create-order" class="text-gray-500 px-4 py-2 rounded">Annuler</button><button type="button" name="add_order_btn" id="btn-publish-order" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-bold shadow">Publier</button></div>
            </form>
        </div>
    </div>

    <div id="modal-edit-order" class="hidden fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg modal-content overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Modifier</h3><button data-dismiss="modal-edit-order" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
            </div>
            <form id="form-edit-order" class="p-6 space-y-5">
                <input type="hidden" id="edit-card-id">
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Titre</label><input type="text" id="edit-title" class="w-full border rounded-lg p-3 text-sm"></div>
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Adresse</label><input type="text" id="edit-address" class="w-full border rounded-lg p-3 text-sm"></div>
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Articles</label>
                    <div class="flex gap-2 mb-2"><input type="text" id="edit-item-input" class="flex-1 border rounded-lg p-2 text-sm"><button type="button" id="btn-add-edit-item" class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-lg font-bold">+</button></div>
                    <div id="edit-items-container" class="flex flex-wrap gap-2 max-h-32 overflow-y-auto border border-dashed border-gray-300 p-2 rounded-lg bg-gray-50">
                        <p class="empty-msg text-xs text-gray-400 w-full text-center py-2">Aucun article ajouté</p>
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-2"><button type="button" data-dismiss="modal-edit-order" class="text-gray-500 px-4 py-2 rounded">Annuler</button><button type="button" id="btn-save-edit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold shadow">Sauvegarder</button></div>
            </form>
        </div>
    </div>

    <div id="modal-view-offers" class="hidden fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg modal-content overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Offres</h3><button data-dismiss="modal-view-offers" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
            </div>
            <div class="p-6 space-y-3">
                <div class="border rounded-xl p-4 flex justify-between items-center hover:bg-gray-50 cursor-pointer">
                    <div class="font-bold text-gray-800">Mohamed L. <span class="text-sm font-normal text-gray-500 block">30 DH • 20 mins</span></div><button class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm font-bold">Accepter</button>
                </div>
            </div>
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