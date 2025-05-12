<?php
/* Smarty version 5.4.5, created on 2025-05-12 20:55:14
  from 'file:LoginView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_6822441279db21_15010482',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aef69e592c1b6fc0be72030c3df6b310dcf483b5' => 
    array (
      0 => 'LoginView.tpl',
      1 => 1747076113,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6822441279db21_15010482 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_5800205196822441270da48_53847042', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_5800205196822441270da48_53847042 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
?>

<h2>Logowanie</h2>

<form action="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
login" method="post">
    <label>Login:
        <input type="text" name="login" value="<?php echo (($tmp = $_smarty_tpl->getValue('form')->login ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />
    </label><br><br>

    <label>Hasło:
        <input type="password" name="pass" />
    </label><br><br>

    <input type="submit" value="Zaloguj" />
</form>

<br>
<a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
register">Nie masz konta? Zarejestruj się</a></br>
<a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
forgotPassword">Zapomniałeś hasła?</a>
<?php
}
}
/* {/block 'content'} */
}
