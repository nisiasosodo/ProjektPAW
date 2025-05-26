<?php
/* Smarty version 5.4.5, created on 2025-05-26 20:51:42
  from 'file:MainPageView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_6834b83e090025_61207248',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f8c3c923508aa08dfdd9f33986599fa425cda07d' => 
    array (
      0 => 'MainPageView.tpl',
      1 => 1748285500,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6834b83e090025_61207248 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14062057546834b83e0854c6_11683423', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'main.tpl', $_smarty_current_dir);
}
/* {block 'authenticated_content'} */
class Block_14143179366834b83e08e031_13301383 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
}
}
/* {/block 'authenticated_content'} */
/* {block 'content'} */
class Block_14062057546834b83e0854c6_11683423 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views';
?>

    <div id="app-container">
        <header class="main-header">
            <div class="header-content">
                <a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
mainPage" class="app-title">notesapp.</a>
                
                <div class="header-actions">
                    <form action="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
searchNotes" method="get" class="search-form">
                        <input type="text" name="query" placeholder="Szukaj notatek..." class="search-input">
                        <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
                    </form>
                    <a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
noteNew" class="btn btn-add-note">
                        <i class="fas fa-plus"></i> Dodaj notatkę
                    </a>
                    <div class="user-menu">
                        <span class="username">Witaj, <?php echo $_smarty_tpl->getValue('user_login');?>
 !</span>
                        <a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
logout" class="btn btn-logout">Wyloguj</a>
                    </div>
                </div>
            </div>
        </header>
        <div class="notes-list-container">
        <h1 class="page-header">Twoje Notatki</h1>

        <?php if (!( !$_smarty_tpl->hasVariable('notes') || empty($_smarty_tpl->getValue('notes')))) {?>
            <div class="notes-grid">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('notes'), 'note');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('note')->value) {
$foreach0DoElse = false;
?>
                    <div class="note-card">
                        <h2 class="note-title"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('note')['nazwa'],50,"...");?>
</h2>
                        <p class="note-content"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('note')['tresc'],150,"...");?>
</p>
                        <div class="note-meta">
                            <span class="note-date">Data: <?php echo $_smarty_tpl->getValue('note')['data_utworzenia'];?>
</span>
                        </div>
                        <div class="note-actions">
                            <a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
noteEdit/<?php echo $_smarty_tpl->getValue('note')['ID_notatki'];?>
" class="btn btn-action btn-edit"><i class="fas fa-edit"></i> Edytuj</a>
                            <a href="<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
noteDelete/<?php echo $_smarty_tpl->getValue('note')['ID_notatki'];?>
" class="btn btn-action btn-delete" onclick="return confirm('Na pewno chcesz usunąć tę notatkę?');"><i class="fas fa-trash-alt"></i> Usuń</a>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>
        
            
        <?php }?>
    </div>
    
        <main id="main-content">
            <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14143179366834b83e08e031_13301383', 'authenticated_content', $this->tplIndex);
?>
 
        </main>
    </div>
           
<?php
}
}
/* {/block 'content'} */
}
