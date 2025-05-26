{extends file='main.tpl'}

{block name=content}
    <div class="messages-container">
        {if isset($msgs)}
            {foreach $msgs as $msg}
                <div class="message message-{$msg->type}">
                    <span class="message-type">
                        {if $msg->type == 0}BŁĄD:{elseif $msg->type == 1}UWAGA!{elseif $msg->type == 2}INFO:{/if}
                    </span>
                    <span class="message-text">{$msg->text}</span>
                </div>
            {/foreach}
        {/if}
    </div>
    <div class="login-container">
        <div class="login-card">
            <h1 class="login-title">Zarejestruj się</h1>
            
            <form action="{$conf->action_root}register" method="post" class="login-form">
                <div class="form-group-login">
                    <label for="login">Login:</label>
                    <input type="text" id="login" name="login" placeholder="Wprowadź swój login" value="{$form->login|default:''}" required>
                </div>
                
                <div class="form-group-login"> 
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" placeholder="Wprowadź swój adres e-mail" value="{$form->email|default:''}" required>
                </div>

                <div class="form-group-login password-group">
                    <label for="pass">Hasło:</label>
                    <div class="password-input-wrapper">
                        <input type="password" id="pass" name="pass" placeholder="Wprowadź swoje hasło" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility('pass')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                <div class="form-group-login password-group">
                    <label for="pass_confirm">Powtórz hasło:</label>
                    <div class="password-input-wrapper">
                        <input type="password" id="pass_confirm" name="pass_confirm" placeholder="Powtórz hasło" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility('pass_confirm')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Zarejestruj się</button>
            </form>

            <div class="login-links">
                <p>Masz już konto? <a href="{$conf->action_root}login">Zaloguj się</a></p>
            </div>
        </div>
    </div>

 
    <script>
        function togglePasswordVisibility(id) {
            const passwordField = document.getElementById(id);
            const toggleIcon = passwordField.nextElementSibling.querySelector('i');
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