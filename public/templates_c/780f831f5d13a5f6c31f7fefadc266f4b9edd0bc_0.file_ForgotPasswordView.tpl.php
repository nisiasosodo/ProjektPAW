<?php
/* Smarty version 5.4.5, created on 2025-05-12 20:08:10
  from 'file:ForgotPasswordView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_6822390aa91037_75966158',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '780f831f5d13a5f6c31f7fefadc266f4b9edd0bc' => 
    array (
      0 => 'ForgotPasswordView.tpl',
      1 => 1746980234,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6822390aa91037_75966158 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_15796015386822390aa832f4_13776410', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_15796015386822390aa832f4_13776410 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
?>

<h2>Reset hasła</h2>

<?php if (!$_smarty_tpl->getValue('user_found')) {?>
    <form method="post" action="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
forgotPassword">
        <label>Login lub e-mail:
            <input type="text" name="identifier" value="<?php echo (($tmp = $_smarty_tpl->getValue('identifier') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />
        </label><br><br>
        <input type="submit" value="Sprawdź" />
    </form>
<?php } else { ?>
    <form method="post" action="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
resetPassword">
        <input type="hidden" name="user_id" value="<?php echo $_smarty_tpl->getValue('user_id');?>
" />
        <label>Nowe hasło:
            <input type="password" name="new_pass" />
        </label><br><br>
        <label>Powtórz nowe hasło:
            <input type="password" name="confirm_pass" />
        </label><br><br>
        <input type="submit" value="Zmień hasło" />
    </form>
<?php }?>

<br>
<a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
login">← Powrót do logowania</a>
<?php
}
}
/* {/block 'content'} */
}
