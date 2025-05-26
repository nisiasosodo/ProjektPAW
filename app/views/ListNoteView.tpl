{extends file='MainPageView.tpl'}

{block name=authenticated_content}
    <div class="note-form-container">
        <h2>{if $form->id}Edytuj Listę Zadań{else}Dodaj Nową Listę Zadań{/if}</h2>

        {if isset($msgs)}
            <div class="messages-container">
                {foreach $msgs as $msg}
                    {if $msg->text|strip != ''}
                        <div class="message message-{$msg->type}">
                            <span class="message-type">
                                {if $msg->type == 0}BŁĄD:{elseif $msg->type == 1}UWAGA!{elseif $msg->type == 2}INFO:{/if}
                            </span>
                            <span class="message-text">{$msg->text}</span>
                        </div>
                    {/if}
                {/foreach}
            </div>
        {/if}

        <form action="{$conf->action_root}noteSave" method="post" class="note-form" id="list-note-form">
            {if $form->id}<input type="hidden" name="id" value="{$form->id}">{/if}
            
            <div class="form-group">
                <label for="category_id">Kategoria:</label>
                <select id="category_id" name="category_id" required onchange="handleCategoryChange(this.value)">
                    <option value="{$category.ID_kategorii}">-- Wybierz kategorię --</option>
                    {foreach $categories as $category}
                        <option value="{$category.ID_kategorii}" data-type="{$category.typ_kategorii}" {if $form->category_id == $category.ID_kategorii}selected{/if}>
                            {$category.nazwa}
                        </option>
                    {/foreach}
                </select>
            </div>

            <div class="form-group">
                <label for="title">Tytuł Listy:</label>
                <input type="text" id="title" name="title" value="{$form->title}" placeholder="Wpisz tytuł listy zadań" required>
            </div>

            <div class="form-group">
                <label>Elementy Listy:</label>
                <div id="list-items-container">
                    {if $form->list_items}
                        {foreach $form->list_items as $item}
                            <div class="list-item-row">
                                <input type="text" class="list-item-input" value="{$item}" placeholder="Element listy" required oninput="updateListItemsJson()">
                                <button type="button" class="btn btn-delete-item" onclick="removeListItem(this)">X</button>
                            </div>
                        {/foreach}
                    {/if}
                </div>
                <button type="button" class="btn btn-secondary" onclick="addListItem()">Dodaj Element</button>
                <input type="hidden" name="list_items_json" id="list-items-json">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">{if $form->id}Zapisz Zmiany{else}Dodaj Listę{/if}</button>
                <a href="{$conf->action_root}mainPage" class="btn btn-secondary">Anuluj</a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            updateListItemsJson(); 
        });

        function addListItem() {
            const container = document.getElementById('list-items-container');
            const newRow = document.createElement('div');
            newRow.classList.add('list-item-row');
            newRow.innerHTML = `
                <input type="text" class="list-item-input" placeholder="Element listy" required oninput="updateListItemsJson()">
                <button type="button" class="btn btn-delete-item" onclick="removeListItem(this)">X</button>
            `;
            container.appendChild(newRow);
            newRow.querySelector('input').focus();
            updateListItemsJson();
        }

        function removeListItem(button) {
            button.closest('.list-item-row').remove();
            updateListItemsJson();
        }

        function updateListItemsJson() {
            const inputs = document.querySelectorAll('.list-item-input');
            
            const items = Array.from(inputs).map(input => input.value.trim()).filter(item => item !== '');
            document.getElementById('list-items-json').value = JSON.stringify(items);
        }

        
        document.querySelectorAll('.list-item-input').forEach(input => {
            input.addEventListener('input', updateListItemsJson);
        });
    </script>
    {include file='_category_change_script.tpl'}
{/block}
