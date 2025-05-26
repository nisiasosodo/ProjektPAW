<?php
/* Smarty version 5.4.5, created on 2025-05-26 19:02:39
  from 'file:ListNoteView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_68349eaf91e9d5_76289361',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '25511fc38e53a4942f3f8739e4057858f98b4f26' => 
    array (
      0 => 'ListNoteView.tpl',
      1 => 1748277875,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_category_change_script.tpl' => 1,
  ),
))) {
function content_68349eaf91e9d5_76289361 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_198386843268349eaf90f2f7_99687128', 'authenticated_content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'MainPageView.tpl', $_smarty_current_dir);
}
/* {block 'authenticated_content'} */
class Block_198386843268349eaf90f2f7_99687128 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
?>

    <div class="note-form-container">
        <h2><?php if ($_smarty_tpl->getValue('form')->id) {?>Edytuj Listę Zadań<?php } else { ?>Dodaj Nową Listę Zadań<?php }?></h2>

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
                                <?php if ($_smarty_tpl->getValue('msg')->type == 0) {?>BŁĄD:<?php } elseif ($_smarty_tpl->getValue('msg')->type == 1) {?>UWAGA!<?php } elseif ($_smarty_tpl->getValue('msg')->type == 2) {?>INFO:<?php }?>
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
noteSave" method="post" class="note-form" id="list-note-form">
            <?php if ($_smarty_tpl->getValue('form')->id) {?><input type="hidden" name="id" value="<?php echo $_smarty_tpl->getValue('form')->id;?>
"><?php }?>
            
            <div class="form-group">
                <label for="category_id">Kategoria:</label>
                <select id="category_id" name="category_id" required onchange="handleCategoryChange(this.value)">
                    <option value="<?php echo $_smarty_tpl->getValue('category')['ID_kategorii'];?>
">-- Wybierz kategorię --</option>
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
                <label for="title">Tytuł Listy:</label>
                <input type="text" id="title" name="title" value="<?php echo $_smarty_tpl->getValue('form')->title;?>
" placeholder="Wpisz tytuł listy zadań" required>
            </div>

            <div class="form-group">
                <label>Elementy Listy:</label>
                <div id="list-items-container">
                    <?php if ($_smarty_tpl->getValue('form')->list_items) {?>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('form')->list_items, 'item');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach2DoElse = false;
?>
                            <div class="list-item-row">
                                <input type="text" class="list-item-input" value="<?php echo $_smarty_tpl->getValue('item');?>
" placeholder="Element listy" required oninput="updateListItemsJson()">
                                <button type="button" class="btn btn-delete-item" onclick="removeListItem(this)">X</button>
                            </div>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    <?php }?>
                </div>
                <button type="button" class="btn btn-secondary" onclick="addListItem()">Dodaj Element</button>
                <input type="hidden" name="list_items_json" id="list-items-json">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><?php if ($_smarty_tpl->getValue('form')->id) {?>Zapisz Zmiany<?php } else { ?>Dodaj Listę<?php }?></button>
                <a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
mainPage" class="btn btn-secondary">Anuluj</a>
            </div>
        </form>
    </div>

    <?php echo '<script'; ?>
>
        document.addEventListener('DOMContentLoaded', function() {
            updateListItemsJson(); 
        });

        function addListItem() {
            const container = document.getElementById('list-items-container');
            const newRow = document.createElement('div');
            newRow.classList.add('list-item-row');
            newRow.innerHTML = `
                <input type="text" class="list-item-input" placeholder="Element listy" required oninput="updateListItemsJson()">
                <button type="button" class="btn btn-delete-item" onclick="removeListItem(this)">X</button>
            `;
            container.appendChild(newRow);
            newRow.querySelector('input').focus();
            updateListItemsJson();
        }

        function removeListItem(button) {
            button.closest('.list-item-row').remove();
            updateListItemsJson();
        }

        function updateListItemsJson() {
            const inputs = document.querySelectorAll('.list-item-input');
            
            const items = Array.from(inputs).map(input => input.value.trim()).filter(item => item !== '');
            document.getElementById('list-items-json').value = JSON.stringify(items);
        }

        
        document.querySelectorAll('.list-item-input').forEach(input => {
            input.addEventListener('input', updateListItemsJson);
        });
    <?php echo '</script'; ?>
>
    <?php $_smarty_tpl->renderSubTemplate('file:_category_change_script.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
/* {/block 'authenticated_content'} */
}
