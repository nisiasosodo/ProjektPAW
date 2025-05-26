<?php
/* Smarty version 5.4.5, created on 2025-05-26 14:40:38
  from 'file:main.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_68346146801be0_95343795',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '08c416f03a76cfa866ebdd1098fa80556c46786f' => 
    array (
      0 => 'main.tpl',
      1 => 1748263237,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68346146801be0_95343795 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta charset="utf-8" />
    <title><?php echo (($tmp = $_smarty_tpl->getValue('page_title') ?? null)===null||$tmp==='' ? "Notatki" ?? null : $tmp);?>
</title>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getValue('conf')->app_url;?>
/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <video autoplay muted loop playsinline id="background-video">
        <source src="<?php echo $_smarty_tpl->getValue('conf')->app_url;?>
/video/background.mp4" type="video/mp4">
    </video>
    <div class="video-overlay"></div>

    

        <main id="main-content-wrapper">
            <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1333409460683461467fc0c2_34105007', 'content');
?>

        </main>


    <footer class="main-footer">
        <p>&copy; <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')(time(),"%Y");?>
 notesapp. Wszelkie prawa zastrzeżone.</p>
    </footer>

</body>
</html><?php }
/* {block 'content'} */
class Block_1333409460683461467fc0c2_34105007 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views\\templates';
}
}
/* {/block 'content'} */
}
