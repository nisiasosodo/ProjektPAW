{extends file='MainPageView.tpl'}

{block name=authenticated_content}
    <div class="note-form-container">
        <h2>{if $form->id}Edytuj Notatkę Obrazkową{else}Dodaj Nową Notatkę Obrazkową{/if}</h2>

        {if isset($msgs)}
            <div class="messages-container">
                {foreach $msgs as $msg}
                    {if $msg->text|strip != ''}
                        <div class="message message-{$msg->type}">
                            <span class="message-type">
                                {if $msg->type == 2}BŁĄD:{elseif $msg->type == 1}UWAGA!{elseif $msg->type == 0}INFO:{/if}
                            </span>
                            <span class="message-text">{$msg->text}</span>
                        </div>
                    {/if}
                {/foreach}
            </div>
        {/if}

        <form action="{$conf->action_root}noteSave" method="post" enctype="multipart/form-data" class="note-form">
            {if $form->id}<input type="hidden" name="id" value="{$form->id}">{/if}
            {if $form->content}
                <input type="hidden" name="image_url" value="{$form->content}">
            {/if}
            
            <div class="form-group">
                <label for="category_id">Kategoria:</label>
                <select id="category_id" name="category_id" required onchange="handleCategoryChange(this.value)">
                    <option value="">-- Wybierz kategorię --</option>
                    {foreach $categories as $category}
                        <option value="{$category.ID_kategorii}" data-type="{$category.typ_kategorii}" {if $form->category_id == $category.ID_kategorii}selected{/if}>
                            {$category.nazwa}
                        </option>
                    {/foreach}
                </select>
            </div>

            <div class="form-group">
                <label for="title">Tytuł Obrazka:</label>
                <input type="text" id="title" name="title" value="{$form->title}" placeholder="Wpisz tytuł obrazka" required>
            </div>

            <div class="form-group">
                <label for="image_file">{if $form->id}Zmień Obrazek:{else}Wybierz Obrazek:{/if}</label>
                <input type="file" id="image_file" name="image_file" accept="image/jpeg, image/png, image/gif" {if !$form->id}required{/if}>
                {if $form->content}
                    <p class="current-image-label">Aktualny obrazek:</p>
                    <img src="{$form->content}" alt="Current Image" class="current-note-image">
                {/if}
            </div>

            <div class="form-group">
                <label for="image_description">Opis Obrazka (opcjonalnie):</label>
                <textarea id="image_description" name="image_description" rows="5" placeholder="Wpisz opis obrazka">{$form->image_description}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">{if $form->id}Zapisz Zmiany{else}Dodaj Notatkę{/if}</button>
                <a href="{$conf->action_root}mainPage" class="btn btn-secondary">Anuluj</a>
            </div>
        </form>
    </div>

    {include file='_category_change_script.tpl'}
{/block}
