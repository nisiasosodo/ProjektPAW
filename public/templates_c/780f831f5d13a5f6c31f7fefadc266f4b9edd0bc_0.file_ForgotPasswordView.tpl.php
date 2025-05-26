<?php
/* Smarty version 5.4.5, created on 2025-05-26 17:23:27
  from 'file:ForgotPasswordView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_6834876fd19388_84071336',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '780f831f5d13a5f6c31f7fefadc266f4b9edd0bc' => 
    array (
      0 => 'ForgotPasswordView.tpl',
      1 => 1748272887,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6834876fd19388_84071336 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_3928392796834876fd11be3_06703244', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'main.tpl', $_smarty_current_dir);
}
/* {block 'content'} */
class Block_3928392796834876fd11be3_06703244 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
?>

    <div class="login-container">
        <div class="login-card">
            <h1 class="login-title">Reset hasła</h1>


            <form action="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
forgotPassword" method="post" class="login-form">
                <div class="form-group-login">
                    <label for="login_or_email">Login lub E-mail:</label>
                    <input type="text" id="login_or_email" name="login_or_email" 
                           placeholder="Wprowadź swój login lub adres e-mail" 
                           value="<?php echo (($tmp = $_smarty_tpl->getValue('form')->login_or_email ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Zresetuj hasło</button>
            </form>

            <div class="login-links">
                <p><a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
login">← Wróć do logowania</a></p>
                <p>Nie masz konta? <a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
registerShow">Zarejestruj się</a></p>
            </div>
        </div>
    </div>
<?php
}
}
/* {/block 'content'} */
}
