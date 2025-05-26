{extends file='main.tpl'}

{block name=content}
    <div id="main-content-wrapper">
        <div class="info-card">
            <h1 class="info-title">Rejestracja zakończona sukcesem!</h1>
            <p class="info-message">Twoje konto zostało pomyślnie utworzone.</p>
            <p class="info-message">Możesz teraz zalogować się do aplikacji i zacząć korzystać z notatek.</p>
            <a href="{$conf->action_root}loginShow" class="btn btn-primary btn-login-now">Zaloguj się teraz</a>
        </div>
    </div>
{/block}