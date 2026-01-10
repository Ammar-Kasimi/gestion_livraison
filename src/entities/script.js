document.addEventListener('DOMContentLoaded', () => {


    
let ccounter=0
document.getElementById("btn-add-create-item").addEventListener("click",(e)=>{
let card=`<input type="text" id="item${ccounter}" name="items[]"  class="w-full  hidden border rounded-lg p-3 text-sm"></div>`;

document.getElementById("form-create-order").innerHTML+=card;
document.getElementById(`item${ccounter}`).value=document.getElementById("create-item-input").value
ccounter++;
});
document.getElementById("new_order_btn").addEventListener("click",()=>{
    ccounter=0
    document.querySelectorAll("[name=items[]]").forEach(item =>{
        item.remove();
    })
})

document.getElementById("btn-add-create-item").addEventListener("click", (e) => {
        const input = document.getElementById("create-item-input");
        const container = document.getElementById("create-items-container");
        const form = document.getElementById("form-create-order");
        const value = input.value.trim();

        if (value) {
            const emptyMsg = container.querySelector('.empty-msg');
            if (emptyMsg) emptyMsg.classList.add('hidden');

            const visualHTML = `
                <div class="tag-item bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium flex items-center gap-2 animate-fade-in mb-1">
                    <span>${value}</span>
                    <button type="button" class="delete-tag text-indigo-400 hover:text-red-500 focus:outline-none"><i class="fas fa-times"></i></button>
                </div>`;
            container.insertAdjacentHTML('beforeend', visualHTML);

            const hiddenHTML = `<input type="hidden" name="items[]" value="${value}">`;
            form.insertAdjacentHTML('beforeend', hiddenHTML);

            input.value = "";
            input.focus();
        }
    });
    /* ========================================================================
       SECTION 1: MOCK DATA (Simulating Database)
       ======================================================================== */
    
    // Notifications Data
    const mockNotifications = [
        { id: 1, type: 'success', title: 'Offre Acceptée', message: 'Mohamed L. a accepté votre commande de livraison.', time: 'Il y a 5 min', read: false },
        { id: 2, type: 'info', title: 'Nouveau Message', message: 'Le livreur vous demande des précisions sur l\'adresse.', time: 'Il y a 30 min', read: false },
        { id: 3, type: 'warning', title: 'Rappel', message: 'N\'oubliez pas de confirmer la réception du colis.', time: 'Il y a 2 heures', read: false },
        { id: 4, type: 'system', title: 'Bienvenue', message: 'Bienvenue sur la plateforme Livri v2.0 !', time: 'Hier', read: true }
    ];

    // Admin Users Data
    const adminUsers = [
        { id: 1, name: 'Karim Benz', email: 'karim@livri.com', role: 'livreur', status: 'active' },
        { id: 2, name: 'Sarah Connor', email: 'sarah@gmail.com', role: 'client', status: 'active' },
        { id: 3, name: 'John Doe', email: 'john@yahoo.com', role: 'client', status: 'suspended' },
        { id: 4, name: 'Admin User', email: 'admin@livri.com', role: 'admin', status: 'active' }
    ];


    /* ========================================================================
       SECTION 2: PAGE INITIALIZATION
       ======================================================================== */

    // Check if we are on the Notifications page
    const notifList = document.getElementById('notification-list');
    if (notifList) {
        renderNotifications(notifList);
    }

    // Check if we are on the Admin page
    const adminTable = document.getElementById('admin-users-table');
    if (adminTable) {
        renderAdminTable(adminTable);
    }


    /* ========================================================================
       SECTION 3: GLOBAL EVENT HANDLERS (Clicks, Modals, Auth)
       ======================================================================== */

    document.addEventListener('click', (e) => {
        
        // --- A. Modal Overlay Click (Close) ---
        if (e.target.classList.contains('bg-opacity-60')) {
            e.target.classList.add('hidden');
            return;
        }

        // --- B. Button/Link Detection ---
        const target = e.target.closest('[data-toggle], [data-dismiss], button, a');
        if (!target) return;

        // --- C. Modal Logic (Open) ---
        if (target.dataset.toggle === 'modal') {
            const modal = document.getElementById(target.dataset.target);
            if (modal) {
                // Determine if we need to pre-fill data before opening
                if (target.dataset.target === 'modal-edit-order') prefillEditModal(target);
                if (target.dataset.target === 'modal-item-details') fillDetailsModal(target);
                if (target.dataset.target === 'modal-competitor-offers') fillCompetitors();
                
                // Show the modal
                modal.classList.remove('hidden');
            }
        }

        // --- D. Modal Logic (Close) ---
        if (target.dataset.dismiss) {
            const modalToClose = document.getElementById(target.dataset.dismiss);
            if (modalToClose) modalToClose.classList.add('hidden');
        }

        // --- E. Authentication Actions ---
        if (target.id === 'btn-login') handleLogin();
        if (target.id === 'btn-register') handleRegister();
        if (target.id === 'btn-logout') handleLogout();

        // --- F. Order Actions ---
        // if (target.id === 'btn-add-create-item') addItemTag('create-item-input', 'create-items-container');
        if (target.id === 'btn-add-edit-item') addItemTag('edit-item-input', 'edit-items-container');
        if (target.id === 'btn-publish-order') publishOrder();
        if (target.id === 'btn-save-edit') saveEditOrder();

        // --- G. Deletion Actions ---
        // Delete a tag (chip) inside a modal
        if (target.closest('.delete-tag')) {
            const container = target.closest('[id$="-items-container"]'); 
            target.closest('.tag-item').remove();
            if(container) checkEmptyTags(container);
        }
        // Delete an order card
        if (target.closest('.btn-delete-order')) {
            const card = target.closest('.order-card');
            if(card && confirm('Voulez-vous vraiment supprimer cette commande ?')) {
                card.remove();
            }
        }
    });


    /* ========================================================================
       SECTION 4: LOGIC FUNCTIONS
       ======================================================================== */

    // --- 4.1 Login Logic ---
    function handleLogin() {
        const u = document.getElementById('login-username').value.trim().toLowerCase();
        const p = document.getElementById('login-password').value.trim();

        if (u === 'admin' && p === '123456') window.location.href = 'admin.php';
        else if (u === 'livreur') window.location.href = 'livreur.php';
        else window.location.href = 'client.php';
    }

    function handleRegister() {
        alert("Compte créé avec succès !");
        window.location.href = 'index.php';
    }

    function handleLogout() {
        window.location.href = 'index.php';
    }


    // --- 4.2 Notifications Logic (NEW) ---
    function renderNotifications(container) {
        let html = '';
        
        mockNotifications.forEach(notif => {
            // Define styling based on type
            let icon, colorClass;
            switch(notif.type) {
                case 'success': icon = 'fa-check'; colorClass = 'bg-green-100 text-green-600'; break;
                case 'warning': icon = 'fa-exclamation'; colorClass = 'bg-yellow-100 text-yellow-600'; break;
                case 'info':    icon = 'fa-info'; colorClass = 'bg-blue-100 text-blue-600'; break;
                default:        icon = 'fa-bell'; colorClass = 'bg-gray-100 text-gray-600';
            }

            const readClass = notif.read ? 'read' : 'unread';

            html += `
                <div class="notif-card ${readClass} flex items-start gap-4 p-4 rounded-lg shadow-sm border border-gray-100 transition hover:shadow-md cursor-pointer animate-fade-in">
                    <div class="notif-icon-box ${colorClass}">
                        <i class="fas ${icon}"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-gray-800 text-sm">${notif.title}</h3>
                            <span class="text-xs text-gray-400">${notif.time}</span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1">${notif.message}</p>
                    </div>
                    ${!notif.read ? '<div class="w-2 h-2 bg-indigo-600 rounded-full mt-2"></div>' : ''}
                </div>
            `;
        });

        container.innerHTML = html;
    }


    // --- 4.3 Tag/Chip System Logic ---
    function addItemTag(inputId, containerId) {
        const input = document.getElementById(inputId);
        const container = document.getElementById(containerId);
        const value = input.value.trim();
        
        if (value) {
            // Hide the "Empty" message if it exists
            const emptyMsg = container.querySelector('.empty-msg');
            if(emptyMsg) emptyMsg.classList.add('hidden');

            const tag = document.createElement('div');
            tag.className = 'tag-item bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium flex items-center gap-2 animate-fade-in mb-1';
            tag.innerHTML = `
                <span>${value}</span>
                <button type="button" class="delete-tag text-indigo-400 hover:text-red-500 focus:outline-none">
                    <i class="fas fa-times"></i>
                </button>`;
            container.appendChild(tag);
            input.value = '';
            input.focus();
        }
    }

    function checkEmptyTags(container) {
        if (container.querySelectorAll('.tag-item').length === 0) {
            const emptyMsg = container.querySelector('.empty-msg');
            if(emptyMsg) emptyMsg.classList.remove('hidden');
        }
    }


    // --- 4.4 Modal Pre-filling Logic ---
    function prefillEditModal(target) {
        document.getElementById('edit-card-id').value = target.getAttribute('data-id');
        document.getElementById('edit-title').value = target.getAttribute('data-title');
        document.getElementById('edit-address').value = target.getAttribute('data-address');
        
        const container = document.getElementById('edit-items-container');
        const items = target.getAttribute('data-items');
        
        container.innerHTML = '<p class="empty-msg text-xs text-gray-400 w-full text-center py-2 hidden">Aucun article ajouté</p>';
        
        if (items && items.trim()) {
            items.split(',').forEach(item => {
                // const tag = document.createElement('div');
                // tag.className = 'tag-item bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium flex items-center gap-2 animate-fade-in mb-1';
                // tag.innerHTML = `<span>${item.trim()}</span><button type="button" class="delete-tag text-indigo-400 hover:text-red-500 focus:outline-none"><i class="fas fa-times"></i></button>`;
                // container.appendChild(tag);
                 container.insertAdjacentHTML('beforeend',`<div class="tag-item bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium flex items-center gap-2 animate-fade-in mb-1">
                <span>${item.trim()}</span>
                <button type="button" class="delete-tag text-indigo-400 hover:text-red-500 focus:outline-none">
                    <i class="fas fa-times"></i>
                </button>
            </div>`);
            });
        } else {
            container.querySelector('.empty-msg').classList.remove('hidden');
        }
    }

    function fillDetailsModal(target) {
        const itemsRaw = target.getAttribute('data-items') || '';
        const list = document.getElementById('details-list');
        list.innerHTML = ''; 
        if(!itemsRaw) {
            list.innerHTML = '<li class="text-gray-500 text-sm">Aucun détail.</li>';
        } else {
            itemsRaw.split(',').forEach(item => {
                if(item.trim()) {
                    list.innerHTML += `
                        <li class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-100 animate-fade-in">
                            <div class="bg-indigo-100 text-indigo-600 p-2 rounded"><i class="fas fa-box"></i></div>
                            <span class="text-sm font-medium text-gray-700">${item.trim()}</span>
                        </li>`;
                }
            });
        }
    }

    function fillCompetitors() {
        const list = document.getElementById('competitor-list');
        // Static data for demo
        const staticOffers = [
            { name: 'Yassine B.', price: 45, time: 25, icon: 'fa-bicycle', opts: ['Fragile'] },
            { name: 'Omar K.', price: 60, time: 15, icon: 'fa-motorcycle', opts: ['Express', 'Assurance'] }
        ];
        
        let html = '';
        staticOffers.forEach(o => {
            const badges = o.opts.map(opt => `<span class="bg-indigo-100 text-indigo-700 text-[10px] px-1.5 py-0.5 rounded">${opt}</span>`).join(' ');
            html += `
                <div class="bg-white border rounded-xl p-4 shadow-sm flex justify-between items-center animate-fade-in">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500">
                            <i class="fas ${o.icon}"></i>
                        </div>
                        <div>
                            <div class="font-bold text-sm">${o.name} ${badges}</div>
                            <div class="text-xs text-gray-500">${o.time} min • ${o.price} DH</div>
                        </div>
                    </div>
                </div>`;
        });
        list.innerHTML = html;
    }


    // --- 4.5 Admin Table Logic ---
    function renderAdminTable(tbody) {
        let html = '';
        adminUsers.forEach(user => {
            const isActive = user.status === 'active';
            const badge = isActive 
                ? '<span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">Actif</span>' 
                : '<span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">Suspendu</span>';
            const btnClass = isActive ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600';
            const btnText = isActive ? 'Désactiver' : 'Activer';
            
            html += `
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-900">${user.name}</td>
                    <td class="px-6 py-4 text-gray-600">${user.email}</td>
                    <td class="px-6 py-4">
                         <select onchange="updateUserRole(${user.id}, this.value)" class="border rounded p-1 text-xs bg-white cursor-pointer">
                            <option value="client" ${user.role === 'client' ? 'selected' : ''}>Client</option>
                            <option value="livreur" ${user.role === 'livreur' ? 'selected' : ''}>Livreur</option>
                            <option value="admin" ${user.role === 'admin' ? 'selected' : ''}>Admin</option>
                        </select>
                    </td>
                    <td class="px-6 py-4">${badge}</td>
                    <td class="px-6 py-4 text-right">
                        <button onclick="toggleUserStatus(${user.id})" class="${btnClass} px-3 py-1.5 rounded font-medium text-xs transition">${btnText}</button>
                    </td>
                </tr>
            `;
        });
        tbody.innerHTML = html;
    }

    // Exposed global functions for inline HTML events (like Select onchange)
    window.updateUserRole = (id, role) => { alert(`Rôle mis à jour: ${role}`); };
    window.toggleUserStatus = (id) => { 
        const u = adminUsers.find(x => x.id === id); 
        if(u) { 
            u.status = u.status === 'active' ? 'suspended' : 'active'; 
            renderAdminTable(document.getElementById('admin-users-table')); 
        } 
    };


    // --- 4.6 Publish Order Logic (Client) ---
    let cardCounter = 1;
    function publishOrder() {
        const t = document.getElementById('create-title').value;
        const a = document.getElementById('create-address').value;
        const c = document.getElementById('create-items-container');
        const is = Array.from(c.querySelectorAll('.tag-item span')).map(s => s.innerText).join(', ');

        if (!t || !a) { alert('Veuillez remplir le titre et l\'adresse'); return; }

        cardCounter++;
        const nid = `order-card-${cardCounter}`;
        
        const html = `
            <div class="p-5">
                <div class="flex justify-between items-start mb-4">
                    <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">Nouveau</span>
                    <div class="flex gap-2">
                        <button data-toggle="modal" data-target="modal-edit-order" data-id="${nid}" data-title="${t}" data-address="${a}" data-items="${is}" class="text-gray-400 hover:text-indigo-600 p-1 transition"><i class="fas fa-pen"></i></button>
                        <button class="text-gray-400 hover:text-red-500 p-1 transition btn-delete-order"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
                <h3 class="font-bold text-lg text-gray-800 mb-2 order-title-display">${t}</h3>
                <p class="text-sm text-gray-500 flex items-center gap-2">
                    <i class="fas fa-map-marker-alt text-indigo-400"></i> <span class="order-address-display">${a}</span>
                </p>
            </div>
            <div class="bg-gray-50 px-5 py-3 border-t border-gray-100 flex justify-between items-center">
                <span class="text-gray-400 text-sm italic">Aucune offre</span>
                <button data-toggle="modal" data-target="modal-item-details" data-items="${is}" class="text-gray-500 text-sm hover:text-gray-700 flex items-center gap-1"><i class="fas fa-eye"></i> Détails</button>
            </div>
        `;
        
        const d = document.createElement('div');
        d.id = nid;
        d.className = 'order-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300 animate-fade-in';
        d.innerHTML = html;
        
        document.getElementById('client-orders-container').prepend(d);
        document.getElementById('modal-create-order').classList.add('hidden');
        
        // Reset form
        document.getElementById('form-create-order').reset();
        c.innerHTML = '<p class="empty-msg text-xs text-gray-400 w-full text-center py-2">Aucun article ajouté</p>';
    }

    function saveEditOrder() {
        const id = document.getElementById('edit-card-id').value;
        const t = document.getElementById('edit-title').value;
        const a = document.getElementById('edit-address').value;
        const c = document.getElementById('edit-items-container');
        const is = Array.from(c.querySelectorAll('.tag-item span')).map(s => s.innerText).join(', ');

        const card = document.getElementById(id);
        if(card) {
            // Update UI
            card.querySelector('.order-title-display').innerText = t;
            card.querySelector('.order-address-display').innerText = a;
            
            // Update Data Attributes for the Edit Button
            const editBtn = card.querySelector('[data-target="modal-edit-order"]');
            if(editBtn) {
                editBtn.setAttribute('data-title', t);
                editBtn.setAttribute('data-address', a);
                editBtn.setAttribute('data-items', is);
            }
            
            // Update Data Attributes for Details Button
            const detailsBtn = card.querySelector('[data-target="modal-item-details"]');
            if(detailsBtn) {
                detailsBtn.setAttribute('data-items', is);
            }
        }
        document.getElementById('modal-edit-order').classList.add('hidden');
    }
});
