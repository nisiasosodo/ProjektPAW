<?php
/* Smarty version 5.4.5, created on 2025-05-26 19:37:19
  from 'file:LoginView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_6834a6cf11fb30_17220565',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aef69e592c1b6fc0be72030c3df6b310dcf483b5' => 
    array (
      0 => 'LoginView.tpl',
      1 => 1748277884,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6834a6cf11fb30_17220565 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_20681641776834a6cf115b47_57607255', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_20681641776834a6cf115b47_57607255 extends \Smarty\Runtime\Block
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
                        <?php if ($_smarty_tpl->getValue('msg')->type == '2') {?>BŁĄD:<?php } elseif ($_smarty_tpl->getValue('msg')->type == '1') {?>UWAGA!<?php } elseif ($_smarty_tpl->getValue('msg')->type == '0') {?>INFO:<?php }?>
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
        <h2 class="login-title">Zaloguj się do Notatek</h2>

        <form action="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
login" method="post" class="login-form">
            <div class="form-group-login">
                <label for="login">Login:</label>
                <input type="text" id="login" name="login" value="<?php echo (($tmp = $_smarty_tpl->getValue('form')->login ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" placeholder="Wprowadź swój login" required />
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
            <p><a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
register">Nie masz konta? Zarejestruj się</a></p>
            <p><a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
forgotPassword">Zapomniałeś hasła?</a></p>
        </div>
         </div>
   </div>

<?php echo '<script'; ?>
>
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
<?php echo '</script'; ?>
>

<?php
}
}
/* {/block 'content'} */
}
