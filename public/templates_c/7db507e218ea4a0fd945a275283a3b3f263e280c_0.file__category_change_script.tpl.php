<?php
/* Smarty version 5.4.5, created on 2025-05-26 18:58:01
  from 'file:_category_change_script.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_68349d9925d726_07808234',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7db507e218ea4a0fd945a275283a3b3f263e280c' => 
    array (
      0 => '_category_change_script.tpl',
      1 => 1748277952,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68349d9925d726_07808234 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
echo '<script'; ?>
>
    function handleCategoryChange(selectedCategoryId) {
        if (!selectedCategoryId) {
            
            console.log("Nie wybrano kategorii.");
            return;
        }

        const selectElement = document.getElementById('category_id');
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const selectedType = selectedOption.dataset.type; 

        if (!selectedType) {
            console.error("Brak przypisanego typu dla wybranej kategorii.");
            return;
        }

        
        const noteIdInput = document.querySelector('input[name="id"]');
        const noteId = noteIdInput ? noteIdInput.value : null;

        
        const tempForm = document.createElement('form');
        tempForm.method = 'GET'; 

        if (noteId) {
            
            tempForm.action = "<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
noteEdit/" + noteId;
            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'id';
            idInput.value = noteId;
            tempForm.appendChild(idInput);
        } else {
            
            tempForm.action = "<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
noteNew";
        }
        
        
        const categoryInput = document.createElement('input');
        categoryInput.type = 'hidden';
        categoryInput.name = 'category_id';
        categoryInput.value = selectedCategoryId;
        tempForm.appendChild(categoryInput);

        const typeInput = document.createElement('input');
        typeInput.type = 'hidden';
        typeInput.name = 'type'; 
        typeInput.value = selectedType;
        tempForm.appendChild(typeInput);

        document.body.appendChild(tempForm);
        tempForm.submit();
    }

    
    
    document.addEventListener('DOMContentLoaded', function() {
        
        
    });
<?php echo '</script'; ?>
>
<?php }
}
