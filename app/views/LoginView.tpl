{extends file="main.tpl"}

{block name=content}
<div class="messages-container">
        {if isset($msgs)}
            {foreach $msgs as $msg}
                <div class="message message-{$msg->type}">
                    <span class="message-type">
                        {if $msg->type == '2'}BŁĄD:{elseif $msg->type == '1'}UWAGA!{elseif $msg->type == '0'}INFO:{/if}
                    </span>
                    <span class="message-text">{$msg->text}</span>
                </div>
            {/foreach}
        {/if}
    </div>
<div class="login-container">
    <div class="login-card">
        <h2 class="login-title">Zaloguj się do Notatek</h2>

        <form action="{$conf->action_root}login" method="post" class="login-form">
            <div class="form-group-login">
                <label for="login">Login:</label>
                <input type="text" id="login" name="login" value="{$form->login|default:''}" placeholder="Wprowadź swój login" required />
            </div>

            <div class="form-group-login password-group">
                <label for="pass">Hasło:</label>
                <div class="password-input-wrapper"> 
                    <input type="password" id="pass" name="pass" placeholder="Wprowadź swoje hasło" required />
                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Zaloguj się</button>
        </form>

        <div class="login-links">
            <p><a href="{$conf->action_root}register">Nie masz konta? Zarejestruj się</a></p>
            <p><a href="{$conf->action_root}forgotPassword">Zapomniałeś hasła?</a></p>
        </div>
         </div>
   </div>

<script>
function togglePasswordVisibility() {
    const passwordField = document.getElementById('pass');
    const toggleIcon = document.querySelector('.toggle-password i');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash'); 
    } else {
        passwordField.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye'); 
    }
}
</script>

{/block}
