{extends file='MainPageView.tpl'}

{block name=authenticated_content}
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

    <div class="note-form-container">
        <h2>{if $form->id}Edytuj Notatkę Tekstową{else}Dodaj Nową Notatkę Tekstową{/if}</h2>

        <form action="{$conf->action_root}noteSave" method="post" class="note-form">
            {if $form->id}<input type="hidden" name="id" value="{$form->id}">{/if}
            
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
                <label for="title">Tytuł Notatki:</label>
                <input type="text" id="title" name="title" value="{$form->title}" placeholder="Wpisz tytuł notatki" required>
            </div>

            <div class="form-group">
                <label for="content">Treść Notatki:</label>
                <textarea id="content" name="content" rows="10" placeholder="Wpisz treść notatki" required>{$form->content}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">{if $form->id}Zapisz Zmiany{else}Dodaj Notatkę{/if}</button>
                <a href="{$conf->action_root}mainPage" class="btn btn-secondary">Anuluj</a>
            </div>
        </form>
    </div>

    {include file='_category_change_script.tpl'}
{/block}
