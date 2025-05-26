{extends file='main.tpl'}

{block name=content}
    <div id="app-container">
        <header class="main-header">
            <div class="header-content">
                <a href="{$conf->action_root}mainPage" class="app-title">notesapp.</a>
                
                <div class="header-actions">
                    <form action="{$conf->action_root}searchNotes" method="get" class="search-form">
                        <input type="text" name="query" placeholder="Szukaj notatek..." class="search-input">
                        <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
                    </form>
                    <a href="{$conf->action_root}noteNew" class="btn btn-add-note">
                        <i class="fas fa-plus"></i> Dodaj notatkę
                    </a>
                    <div class="user-menu">
                        <span class="username">Witaj, {$user_login} !</span>
                        <a href="{$conf->action_root}logout" class="btn btn-logout">Wyloguj</a>
                    </div>
                </div>
            </div>
        </header>
        <div class="notes-list-container">
        <h1 class="page-header">Twoje Notatki</h1>

        {if !empty($notes)}
            <div class="notes-grid">
                {foreach $notes as $note}
                    <div class="note-card">
                        <h2 class="note-title">{$note.nazwa|truncate:50:"..."}</h2>
                        <p class="note-content">{$note.tresc|truncate:150:"..."}</p>
                        <div class="note-meta">
                            <span class="note-date">Data: {$note.data_utworzenia}</span>
                        </div>
                        <div class="note-actions">
                            <a href="{$conf->action_root}noteEdit/{$note.ID_notatki}" class="btn btn-action btn-edit"><i class="fas fa-edit"></i> Edytuj</a>
                            <a href="{$conf->action_root}noteDelete/{$note.ID_notatki}" class="btn btn-action btn-delete" onclick="return confirm('Na pewno chcesz usunąć tę notatkę?');"><i class="fas fa-trash-alt"></i> Usuń</a>
                        </div>
                    </div>
                {/foreach}
            </div>
        
            
        {/if}
    </div>
    
        <main id="main-content">
            {block name=authenticated_content}{/block} 
        </main>
    </div>
           
{/block}
