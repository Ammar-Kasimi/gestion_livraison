<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livri - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-100 font-sans text-gray-800">
    
    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center sticky top-0 z-20">
        <div class="flex items-center gap-3">
            <div class="bg-indigo-600 text-white p-2 rounded-lg shadow-lg"><i class="fas fa-cube"></i></div>
            <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Livri <span class="text-sm font-normal text-gray-500">| Admin</span></h2>
        </div>
        
        <div class="flex items-center gap-6">
            <a href="notifications.php" class="relative text-gray-400 hover:text-indigo-600 transition">
                <i class="fas fa-bell text-xl"></i>
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white">5</span>
            </a>

            <div class="h-6 w-px bg-gray-300"></div>

            <button id="btn-logout" class="flex items-center gap-2 text-gray-600 hover:text-red-600 font-medium transition group">
                <span class="group-hover:underline">Déconnexion</span><i class="fas fa-sign-out-alt"></i>
            </button>
        </div>
    </nav>

    <main class="flex-1 p-4 md:p-8 max-w-7xl mx-auto w-full animate-fade-in">
        <div class="flex items-center gap-3 mb-6">
            <div class="p-3 bg-red-100 text-red-600 rounded-lg"><i class="fas fa-user-shield text-2xl"></i></div>
            <div><h1 class="text-3xl font-bold text-gray-900">Administration</h1><p class="text-gray-500 text-sm">Supervision & Gestion</p></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <p class="text-gray-500 text-xs font-bold uppercase">Utilisateurs Total</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">1,204</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <p class="text-gray-500 text-xs font-bold uppercase">Commandes Terminées</p>
                <p class="text-3xl font-bold text-green-500 mt-1">850</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <p class="text-gray-500 text-xs font-bold uppercase">Commandes Annulées</p>
                <p class="text-3xl font-bold text-red-500 mt-1">24</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <p class="text-gray-500 text-xs font-bold uppercase">En Cours</p>
                <p class="text-3xl font-bold text-blue-500 mt-1">45</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
            <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
                <h3 class="font-bold text-gray-700">Gestion des Utilisateurs</h3>
                <div class="text-xs text-gray-400"><i class="fas fa-info-circle"></i> Gérez les rôles et statuts</div>
            </div>
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                    <tr>
                        <th class="px-6 py-3">Utilisateur</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Rôle</th>
                        <th class="px-6 py-3">Statut</th>
                        <th class="px-6 py-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody id="admin-users-table" class="divide-y divide-gray-100 text-sm">
                    </tbody>
            </table>
        </div>
    </main>
    <script src="script.js"></script>
</body>
</html>