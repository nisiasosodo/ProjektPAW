<?php
/* Smarty version 5.4.5, created on 2025-05-26 12:18:03
  from 'file:RegSucceedView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_68343fdbd84624_22892957',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5bf50cbe7ee11dc6e4fbeda0e19cd1798b375631' => 
    array (
      0 => 'RegSucceedView.tpl',
      1 => 1748254681,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68343fdbd84624_22892957 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_175111140768343fdbd822e4_14879021', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'main.tpl', $_smarty_current_dir);
}
/* {block 'content'} */
class Block_175111140768343fdbd822e4_14879021 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
?>

    <div id="main-content-wrapper">
        <div class="info-card">
            <h1 class="info-title">Rejestracja zakończona sukcesem!</h1>
            <p class="info-message">Twoje konto zostało pomyślnie utworzone.</p>
            <p class="info-message">Możesz teraz zalogować się do aplikacji i zacząć korzystać z notatek.</p>
            <a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
loginShow" class="btn btn-primary btn-login-now">Zaloguj się teraz</a>
        </div>
    </div>
<?php
}
}
/* {/block 'content'} */
}
