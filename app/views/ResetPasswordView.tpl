{extends file='main.tpl'}

{block name=content}
    <div class="messages-container">
        {if isset($msgs)}
            {foreach $msgs as $msg}
                <div class="message message-{$msg->type}">
                    <span class="message-type">
                        {if $msg->type == 2}BŁĄD:{elseif $msg->type == 1}UWAGA!{elseif $msg->type == 0}INFO:{/if}
                    </span>
                    <span class="message-text">{$msg->text}</span>
                </div>
            {/foreach}
        {/if}
    </div>
    <div class="login-container">
        <div class="login-card">
            <h1 class="login-title">Ustaw nowe hasło</h1>
          
            <form action="{$conf->action_root}resetPassword" method="post" class="login-form">
                 <input type="hidden" name="user_id" value="{$form->user_id|escape:'html'}" />

                <div class="form-group-login password-group">
                    <label for="new_pass">Nowe hasło:</label>
                    <div class="password-input-wrapper">
                        <input type="password" id="new_pass" name="new_pass" placeholder="Wprowadź nowe hasło" value="{$form->new_pass|default:''}" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility('new_pass')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                <div class="form-group-login password-group">
                    <label for="confirm_pass">Powtórz nowe hasło:</label>
                    <div class="password-input-wrapper">
                        <input type="password" id="confirm_pass" name="confirm_pass" placeholder="Powtórz nowe hasło" value="{$form->confirm_pass|default:''}" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility('confirm_pass')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Zmień hasło</button>
            </form>

            <div class="login-links">
                <p><a href="{$conf->action_root}loginShow">← Wróć do logowania</a></p>
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
