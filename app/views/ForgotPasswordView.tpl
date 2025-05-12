{extends file="main.tpl"}

{block name=content}
<h2>Reset hasła</h2>

{if !$user_found}
    <form method="post" action="{$conf->action_root}forgotPassword">
        <label>Login lub e-mail:
            <input type="text" name="identifier" value="{$identifier|default:''}" />
        </label><br><br>
        <input type="submit" value="Sprawdź" />
    </form>
{else}
    <form method="post" action="{$conf->action_root}resetPassword">
        <input type="hidden" name="user_id" value="{$user_id}" />
        <label>Nowe hasło:
            <input type="password" name="new_pass" />
        </label><br><br>
        <label>Powtórz nowe hasło:
            <input type="password" name="confirm_pass" />
        </label><br><br>
        <input type="submit" value="Zmień hasło" />
    </form>
{/if}

<br>
<a href="{$conf->action_root}login">← Powrót do logowania</a>
{/block}
