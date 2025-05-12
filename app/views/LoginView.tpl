{extends file="main.tpl"}

{block name=content}
<h2>Logowanie</h2>

<form action="{$conf->action_root}login" method="post">
    <label>Login:
        <input type="text" name="login" value="{$form->login|default:''}" />
    </label><br><br>

    <label>Hasło:
        <input type="password" name="pass" />
    </label><br><br>

    <input type="submit" value="Zaloguj" />
</form>

<br>
<a href="{$conf->action_root}register">Nie masz konta? Zarejestruj się</a></br>
<a href="{$conf->action_root}forgotPassword">Zapomniałeś hasła?</a>
{/block}
