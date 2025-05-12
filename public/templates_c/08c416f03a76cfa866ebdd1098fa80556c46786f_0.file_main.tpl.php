<?php
/* Smarty version 5.4.5, created on 2025-05-12 20:37:34
  from 'file:main.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_68223feece2a35_50850563',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '08c416f03a76cfa866ebdd1098fa80556c46786f' => 
    array (
      0 => 'main.tpl',
      1 => 1747075053,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68223feece2a35_50850563 (\Smarty\Template $_smarty_tpl) {
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
</head>
<body>
    
    <?php if ($_smarty_tpl->getValue('msgs')->isMessage()) {?>
        <h4>Wystąpiły błędy: </h4>
        <ol class="err" style="margin: 20px; margin-left: 0px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #ff6666; width:100%; opacity: 0.8;">
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('msgs')->getMessages(), 'msg');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('msg')->value) {
$foreach0DoElse = false;
?>
            <li><?php echo $_smarty_tpl->getValue('msg')->text;?>
</li>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
         </ol>
    <?php }?>


    
     <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_92525494368223feecde9f4_63237952', 'content');
?>


</body>
</html>        <?php }
/* {block 'content'} */
class Block_92525494368223feecde9f4_63237952 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\notesapp\\app\\views\\templates';
?>

     <?php
}
}
/* {/block 'content'} */
}
