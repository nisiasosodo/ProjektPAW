<?php
/* Smarty version 5.4.5, created on 2025-05-12 21:12:56
  from 'file:RegisterView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_682248388e88d0_56291472',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c2e4f9a29854dc24dfee552d34eef3863bef256e' => 
    array (
      0 => 'RegisterView.tpl',
      1 => 1747077064,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_682248388e88d0_56291472 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1492133056682248388e0aa6_18959061', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_1492133056682248388e0aa6_18959061 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
?>

<h2>Rejestracja</h2>

<form action="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
register" method="post">
    <label>Login:
        <input type="text" name="login" value="<?php echo (($tmp = $_smarty_tpl->getValue('form')->login ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />
    </label><br><br>

    <label>Email:
        <input type="email" name="email" value="<?php echo (($tmp = $_smarty_tpl->getValue('form')->email ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />
    </label><br><br>

    <label>Hasło:
        <input type="password" name="pass" />
    </label><br><br>

    <input type="submit" value="Zarejestruj" />
</form>

    </br>
    
<a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
login">Masz już konto? Zaloguj się</a>

<?php
}
}
/* {/block 'content'} */
}
