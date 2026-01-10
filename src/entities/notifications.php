<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livri - Notifications</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-100 font-sans text-gray-800">

    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center sticky top-0 z-20">
        <div class="flex items-center gap-3">
            <a href="index.php" class="bg-indigo-600 text-white p-2 rounded-lg shadow-lg hover:bg-indigo-700 transition">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="text-2xl font-bold text-gray-800 tracking-tight">
                Livri <span class="text-sm font-normal text-gray-500">| Notifications</span>
            </h2>
        </div>
        
        <div class="flex items-center gap-6">
            <button id="btn-logout" class="flex items-center gap-2 text-gray-600 hover:text-red-600 font-medium transition group">
                <span class="group-hover:underline">Déconnexion</span>
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </div>
    </nav>

    <main class="flex-1 p-4 md:p-8 max-w-4xl mx-auto w-full animate-fade-in">
        
        <div class="flex justify-between items-end mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Vos Notifications</h1>
                <p class="text-gray-500 mt-1">Restez informé de l'état de vos commandes.</p>
            </div>
            <button class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold hover:underline">
                Tout marquer comme lu
            </button>
        </div>

        <div id="notification-list" class="space-y-4">
            </div>

    </main>

    <script src="script.js"></script>
</body>
</html>