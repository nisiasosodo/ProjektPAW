<?php
/* Smarty version 5.4.5, created on 2025-05-12 21:14:33
  from 'file:RegSucceedView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_6822489942b052_41094795',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5bf50cbe7ee11dc6e4fbeda0e19cd1798b375631' => 
    array (
      0 => 'RegSucceedView.tpl',
      1 => 1747077137,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6822489942b052_41094795 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_45919016768224899429002_70749679', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_45919016768224899429002_70749679 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
?>


<h2>Rejestracja zakończona sukcesem!</h2>
<p>Twoje konto zostało utworzone pomyślnie. Teraz możesz się zalogować.</p>

<a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
login">Zaloguj się</a>

<?php
}
}
/* {/block 'content'} */
}
