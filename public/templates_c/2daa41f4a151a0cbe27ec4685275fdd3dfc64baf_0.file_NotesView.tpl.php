<?php
/* Smarty version 5.4.5, created on 2025-05-26 15:20:13
  from 'file:NotesView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_68346a8d165e80_18405649',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2daa41f4a151a0cbe27ec4685275fdd3dfc64baf' => 
    array (
      0 => 'NotesView.tpl',
      1 => 1748265610,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68346a8d165e80_18405649 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_108287199968346a8d14ab11_33831273', 'authenticated_content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'MainPageView.tpl', $_smarty_current_dir);
}
/* {block 'authenticated_content'} */
class Block_108287199968346a8d14ab11_33831273 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
?>

    <div class="note-form-container">
        <h2><?php if ($_smarty_tpl->getValue('form')->id) {?>Edytuj Notatkę<?php } else { ?>Dodaj Nową Notatkę<?php }?></h2>

                <?php if ((true && ($_smarty_tpl->hasVariable('msgs') && null !== ($_smarty_tpl->getValue('msgs') ?? null)))) {?>
            <div class="messages-container">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('msgs'), 'msg');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('msg')->value) {
$foreach0DoElse = false;
?>
                    <?php if (preg_replace('!\s+!u', ' ',$_smarty_tpl->getValue('msg')->text) != '') {?>
                        <div class="message message-<?php echo $_smarty_tpl->getValue('msg')->type;?>
">
                            <span class="message-type">
                                <?php if ($_smarty_tpl->getValue('msg')->type == 2) {?>BŁĄD:<?php } elseif ($_smarty_tpl->getValue('msg')->type == 1) {?>UWAGA!<?php } elseif ($_smarty_tpl->getValue('msg')->type == 0) {?>INFO:<?php }?>
                            </span>
                            <span class="message-text"><?php echo $_smarty_tpl->getValue('msg')->text;?>
</span>
                        </div>
                    <?php }?>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>
        <?php }?>

        <form action="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
noteSave" method="post" class="note-form">
            <?php if ($_smarty_tpl->getValue('form')->id) {?>
                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getValue('form')->id;?>
">
            <?php }?>

            <div class="form-group">
                <label for="title">Tytuł Notatki:</label>
                <input type="text" id="title" name="title" value="<?php echo $_smarty_tpl->getValue('form')->title;?>
" placeholder="Wpisz tytuł notatki" required>
            </div>

            <div class="form-group">
                <label for="content">Treść Notatki:</label>
                <textarea id="content" name="content" rows="10" placeholder="Wpisz treść notatki" required><?php echo $_smarty_tpl->getValue('form')->content;?>
</textarea>
            </div>

            <div class="form-group"> 
                <label for="category_id">Kategoria:</label>
                <select id="category_id" name="category_id" required>
                    <option value="">-- Wybierz kategorię --</option>
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('categories'), 'category');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('category')->value) {
$foreach1DoElse = false;
?>
                        <option value="<?php echo $_smarty_tpl->getValue('category')['ID_kategorii'];?>
" <?php if ($_smarty_tpl->getValue('form')->category_id == $_smarty_tpl->getValue('category')['ID_kategorii']) {?>selected<?php }?>>
                            <?php echo $_smarty_tpl->getValue('category')['nazwa'];?>

                        </option>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><?php if ($_smarty_tpl->getValue('form')->id) {?>Zapisz Zmiany<?php } else { ?>Dodaj Notatkę<?php }?></button>
                <a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
mainPage" class="btn btn-secondary">Anuluj</a>
            </div>
        </form>
    </div>
<?php
}
}
/* {/block 'authenticated_content'} */
}
