<?php
/* Smarty version 5.4.5, created on 2025-05-26 17:52:06
  from 'file:ResetPasswordView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_68348e267c2569_61261660',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7703c9b459ece732fc8ed047ae3d67d6a6b40da' => 
    array (
      0 => 'ResetPasswordView.tpl',
      1 => 1748274687,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68348e267c2569_61261660 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14016350568348e267ad245_52947963', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'main.tpl', $_smarty_current_dir);
}
/* {block 'content'} */
class Block_14016350568348e267ad245_52947963 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
?>

    <div class="messages-container">
        <?php if ((true && ($_smarty_tpl->hasVariable('msgs') && null !== ($_smarty_tpl->getValue('msgs') ?? null)))) {?>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('msgs'), 'msg');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('msg')->value) {
$foreach0DoElse = false;
?>
                <div class="message message-<?php echo $_smarty_tpl->getValue('msg')->type;?>
">
                    <span class="message-type">
                        <?php if ($_smarty_tpl->getValue('msg')->type == 2) {?>BŁĄD:<?php } elseif ($_smarty_tpl->getValue('msg')->type == 1) {?>UWAGA!<?php } elseif ($_smarty_tpl->getValue('msg')->type == 0) {?>INFO:<?php }?>
                    </span>
                    <span class="message-text"><?php echo $_smarty_tpl->getValue('msg')->text;?>
</span>
                </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        <?php }?>
    </div>
    <div class="login-container">
        <div class="login-card">
            <h1 class="login-title">Ustaw nowe hasło</h1>
          
            <form action="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
resetPassword" method="post" class="login-form">
                 <input type="hidden" name="user_id" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('form')->user_id, ENT_QUOTES, 'UTF-8', true);?>
" />

                <div class="form-group-login password-group">
                    <label for="new_pass">Nowe hasło:</label>
                    <div class="password-input-wrapper">
                        <input type="password" id="new_pass" name="new_pass" placeholder="Wprowadź nowe hasło" value="<?php echo (($tmp = $_smarty_tpl->getValue('form')->new_pass ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility('new_pass')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                <div class="form-group-login password-group">
                    <label for="confirm_pass">Powtórz nowe hasło:</label>
                    <div class="password-input-wrapper">
                        <input type="password" id="confirm_pass" name="confirm_pass" placeholder="Powtórz nowe hasło" value="<?php echo (($tmp = $_smarty_tpl->getValue('form')->confirm_pass ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility('confirm_pass')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Zmień hasło</button>
            </form>

            <div class="login-links">
                <p><a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
loginShow">← Wróć do logowania</a></p>
            </div>
        </div>
    </div>

    <?php echo '<script'; ?>
>
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
    <?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'content'} */
}
