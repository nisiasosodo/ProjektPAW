{extends file="main.tpl"}

{block name=content}
<h2>Rejestracja</h2>

<form action="{$conf->action_root}register" method="post">
    <label>Login:
        <input type="text" name="login" value="{$form->login|default:''}" />
    </label><br><br>

    <label>Email:
        <input type="email" name="email" value="{$form->email|default:''}" />
    </label><br><br>

    <label>Hasło:
        <input type="password" name="pass" />
    </label><br><br>

    <input type="submit" value="Zarejestruj" />
</form>

    </br>
    
<a href="{$conf->action_root}login">Masz już konto? Zaloguj się</a>

{/block}
