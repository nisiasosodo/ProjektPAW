{extends file='main.tpl'}

{block name=content}
    <div class="login-container">
        <div class="login-card">
            <h1 class="login-title">Reset hasła</h1>


            <form action="{$conf->action_root}forgotPassword" method="post" class="login-form">
                <div class="form-group-login">
                    <label for="login_or_email">Login lub E-mail:</label>
                    <input type="text" id="login_or_email" name="login_or_email" 
                           placeholder="Wprowadź swój login lub adres e-mail" 
                           value="{$form->login_or_email|default:''}" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Zresetuj hasło</button>
            </form>

            <div class="login-links">
                <p><a href="{$conf->action_root}login">← Wróć do logowania</a></p>
                <p>Nie masz konta? <a href="{$conf->action_root}registerShow">Zarejestruj się</a></p>
            </div>
        </div>
    </div>
{/block}
