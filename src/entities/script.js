document.addEventListener('DOMContentLoaded', () => {


    let ccounter = 0;
    const btnAddCreate = document.getElementById("btn-add-create-item");
    if (btnAddCreate) {
        btnAddCreate.addEventListener("click", (e) => {

            //partie frontend===============================
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

                //hna fin katsali=====================================

                let card = `<input type="text" id="item${ccounter}" name="items[]"  class="w-full  hidden border rounded-lg p-3 text-sm">`;
                document.getElementById("form-create-order").insertAdjacentHTML("beforeend", card);
                document.getElementById(`item${ccounter}`).value = document.getElementById("create-item-input").value
                ccounter++;
            }

            input.value = "";
            input.focus();
        });
    }

    const newOrderBtn = document.getElementById("new_order_btn");
    if (newOrderBtn) {
        newOrderBtn.addEventListener("click", () => {
            ccounter = 0
            document.querySelectorAll("[name='items[]']").forEach(item => {
                item.remove();
            })
            document.querySelectorAll(".tag-item").forEach(tag => {
                tag.remove();
            });

            const emptyMsg = document.querySelector('.empty-msg');
            if (emptyMsg) emptyMsg.classList.remove('hidden');

            const input = document.getElementById("create-item-input");
            if (input) input.value = "";
        });
    }


  /////////////////////////////////

    const allButtons = document.querySelectorAll("button");

    allButtons.forEach(btn => {

        if (btn.querySelector('.fa-pen')) {

            btn.addEventListener('click', (e) => {
                e.preventDefault(); 

                const card = btn.closest('.rounded-2xl');

                const id = card.querySelector('.order_card_id').value;
                const title = card.querySelector('h3').innerText;

                const addressIcon = card.querySelector('.fa-map-marker-alt');
                const address = addressIcon.nextElementSibling.innerText;

                const editForm = document.getElementById('form-edit-order');
                const itemsContainer = document.getElementById('edit-items-container');

                editForm.reset();
                itemsContainer.innerHTML = '';
                editForm.querySelectorAll("input[name='items[]']").forEach(i => i.remove());

                document.getElementById('edit-card-id').value = id;
                document.getElementById('edit-title').value = title;
                document.getElementById('edit-address').value = address;

                const hiddenItems = card.querySelectorAll('.hidden-item'); 
                if (hiddenItems.length === 0) {
                    itemsContainer.innerHTML = '<p class="empty-msg text-xs text-gray-400 w-full text-center py-2">Aucun article ajouté</p>';
                } else {
                    hiddenItems.forEach(span => {
                        const val = span.innerText;

                        const visualTag = `
                            <div class="tag-item bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium flex items-center gap-2 animate-fade-in mb-1">
                                <span>${val}</span>
                                <button type="button" class="delete-tag text-indigo-400 hover:text-red-500 focus:outline-none"><i class="fas fa-times"></i></button>
                            </div>`;
                        itemsContainer.insertAdjacentHTML('beforeend', visualTag);

                        const hiddenInput = `<input type="hidden" name="items[]" value="${val}">`;
                        editForm.insertAdjacentHTML('beforeend', hiddenInput);
                    });
                }

                document.getElementById('modal-edit-order').classList.remove('hidden');
            });
        }
    });



////////////////////////////////////

    const closeButtons = document.querySelectorAll('[data-dismiss]');

    closeButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            const targetId = btn.getAttribute('data-dismiss');
            const modal = document.getElementById(targetId);

            if (modal) {
                modal.classList.add('hidden');

                const form = modal.querySelector('form');
                if (form) {
                    form.reset();

                    const container = modal.querySelector('[id$="-items-container"]'); 
                    if (container) {
                        container.innerHTML = '<p class="empty-msg text-xs text-gray-400 w-full text-center py-2">Aucun article ajouté</p>';
                    }
                    form.querySelectorAll("input[name='items[]']").forEach(i => i.remove());
                }
            }
        });
    });



    const btnAddEdit = document.getElementById('btn-add-edit-item');
    if (btnAddEdit) {
        btnAddEdit.addEventListener('click', () => {
            const input = document.getElementById("edit-item-input");
            const container = document.getElementById("edit-items-container");
            const form = document.getElementById("form-edit-order");
            const value = input.value.trim();

            if (value) {
                if (container.innerHTML.includes('Aucun article')) container.innerHTML = '';

                container.insertAdjacentHTML('beforeend', `
                     <div class="tag-item bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium flex items-center gap-2 animate-fade-in mb-1">
                         <span>${value}</span>
                         <button type="button" class="delete-tag text-indigo-400 hover:text-red-500 focus:outline-none"><i class="fas fa-times"></i></button>
                     </div>
                 `);
                form.insertAdjacentHTML('beforeend', `<input type="hidden" name="items[]" value="${value}">`);
                input.value = "";
                input.focus();
            }
        });
    }

    document.addEventListener('click', (e) => {
        if (e.target.closest('.delete-tag')) {
            e.preventDefault();
            const btn = e.target.closest('.delete-tag');
            const tagItem = btn.closest('.tag-item');
            if (tagItem) tagItem.remove();
        }

        if (e.target.classList.contains('bg-opacity-60')) {
            e.target.classList.add('hidden');
        }
    });

    const otherButtons = document.querySelectorAll("button");
    otherButtons.forEach(btn => {
        if (btn.querySelector('.fa-eye')) {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                document.getElementById('modal-item-details').classList.remove('hidden');
            });
        }
        if (btn.innerText.includes('Voir')) {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                document.getElementById('modal-view-offers').classList.remove('hidden');
            });
        }
        if (btn.dataset.toggle === 'modal' && !btn.querySelector('.fa-pen')) {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                document.getElementById(btn.dataset.target).classList.remove('hidden');
            });
        }
    });

});
