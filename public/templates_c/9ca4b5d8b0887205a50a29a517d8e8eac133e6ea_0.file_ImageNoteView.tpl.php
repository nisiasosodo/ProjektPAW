<?php
/* Smarty version 5.4.5, created on 2025-05-26 19:31:30
  from 'file:ImageNoteView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_6834a5726a8e44_02929909',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ca4b5d8b0887205a50a29a517d8e8eac133e6ea' => 
    array (
      0 => 'ImageNoteView.tpl',
      1 => 1748280626,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_category_change_script.tpl' => 1,
  ),
))) {
function content_6834a5726a8e44_02929909 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_20420442426834a572690c04_19049484', 'authenticated_content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'MainPageView.tpl', $_smarty_current_dir);
}
/* {block 'authenticated_content'} */
class Block_20420442426834a572690c04_19049484 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
?>

    <div class="note-form-container">
        <h2><?php if ($_smarty_tpl->getValue('form')->id) {?>Edytuj Notatkę Obrazkową<?php } else { ?>Dodaj Nową Notatkę Obrazkową<?php }?></h2>

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
noteSave" method="post" enctype="multipart/form-data" class="note-form">
            <?php if ($_smarty_tpl->getValue('form')->id) {?><input type="hidden" name="id" value="<?php echo $_smarty_tpl->getValue('form')->id;?>
"><?php }?>
            <?php if ($_smarty_tpl->getValue('form')->content) {?>
                <input type="hidden" name="image_url" value="<?php echo $_smarty_tpl->getValue('form')->content;?>
">
            <?php }?>
            
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
                <label for="title">Tytuł Obrazka:</label>
                <input type="text" id="title" name="title" value="<?php echo $_smarty_tpl->getValue('form')->title;?>
" placeholder="Wpisz tytuł obrazka" required>
            </div>

            <div class="form-group">
                <label for="image_file"><?php if ($_smarty_tpl->getValue('form')->id) {?>Zmień Obrazek:<?php } else { ?>Wybierz Obrazek:<?php }?></label>
                <input type="file" id="image_file" name="image_file" accept="image/jpeg, image/png, image/gif" <?php if (!$_smarty_tpl->getValue('form')->id) {?>required<?php }?>>
                <?php if ($_smarty_tpl->getValue('form')->content) {?>
                    <p class="current-image-label">Aktualny obrazek:</p>
                    <img src="<?php echo $_smarty_tpl->getValue('form')->content;?>
" alt="Current Image" class="current-note-image">
                <?php }?>
            </div>

            <div class="form-group">
                <label for="image_description">Opis Obrazka (opcjonalnie):</label>
                <textarea id="image_description" name="image_description" rows="5" placeholder="Wpisz opis obrazka"><?php echo $_smarty_tpl->getValue('form')->image_description;?>
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
