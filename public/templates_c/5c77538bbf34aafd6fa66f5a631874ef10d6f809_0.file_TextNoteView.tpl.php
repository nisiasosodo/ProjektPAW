<?php
/* Smarty version 5.4.5, created on 2025-05-26 17:11:53
  from 'file:TextNoteView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_683484b9815871_63937480',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5c77538bbf34aafd6fa66f5a631874ef10d6f809' => 
    array (
      0 => 'TextNoteView.tpl',
      1 => 1748272153,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_category_change_script.tpl' => 1,
  ),
))) {
function content_683484b9815871_63937480 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_57236787683484b97facb8_36676249', 'authenticated_content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'MainPageView.tpl', $_smarty_current_dir);
}
/* {block 'authenticated_content'} */
class Block_57236787683484b97facb8_36676249 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
?>

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

    <div class="note-form-container">
        <h2><?php if ($_smarty_tpl->getValue('form')->id) {?>Edytuj Notatkę Tekstową<?php } else { ?>Dodaj Nową Notatkę Tekstową<?php }?></h2>

        <form action="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
noteSave" method="post" class="note-form">
            <?php if ($_smarty_tpl->getValue('form')->id) {?><input type="hidden" name="id" value="<?php echo $_smarty_tpl->getValue('form')->id;?>
"><?php }?>
            
            <div class="form-group">
                <label for="category_id">Kategoria:</label>
                <select id="category_id" name="category_id" required onchange="handleCategoryChange(this.value)">
                    <option value="">-- Wybierz kategorię --</option>
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('categories'), 'category');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('category')->value) {
$foreach1DoElse = false;
?>
                        <option value="<?php echo $_smarty_tpl->getValue('category')['ID_kategorii'];?>
" data-type="<?php echo $_smarty_tpl->getValue('category')['typ_kategorii'];?>
" <?php if ($_smarty_tpl->getValue('form')->category_id == $_smarty_tpl->getValue('category')['ID_kategorii']) {?>selected<?php }?>>
                            <?php echo $_smarty_tpl->getValue('category')['nazwa'];?>

                        </option>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </select>
            </div>

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

            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><?php if ($_smarty_tpl->getValue('form')->id) {?>Zapisz Zmiany<?php } else { ?>Dodaj Notatkę<?php }?></button>
                <a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
mainPage" class="btn btn-secondary">Anuluj</a>
            </div>
        </form>
    </div>

    <?php $_smarty_tpl->renderSubTemplate('file:_category_change_script.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
/* {/block 'authenticated_content'} */
}
