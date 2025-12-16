<?php
/* Smarty version 5.7.0, created on 2025-12-16 16:33:31
  from 'file:constructors/message.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_694189dbeed543_17046912',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '414cbf2fa0291012f50020de356d82067b1c5a51' => 
    array (
      0 => 'constructors/message.tpl',
      1 => 1765902792,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:generic/title1.tpl' => 1,
  ),
))) {
function content_694189dbeed543_17046912 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\constructors';
if ($_smarty_tpl->getValue('image') != '') {
echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_image')->handle(array('file'=>$_smarty_tpl->getValue('image')), $_smarty_tpl);
}
if ($_smarty_tpl->getValue('forward') != '') {
$_smarty_tpl->assign('f', "<br /><br /><div align=\"center\"><a href=\"".((string)$_smarty_tpl->getValue('forward'))."\">".((string)$_smarty_tpl->getValue('forward_text'))."</a></div>", false, NULL);
}?>
<table width="400" align="center">
<tr><td><?php $_smarty_tpl->renderSubTemplate("file:generic/title1.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>$_smarty_tpl->getValue('title'),'content'=>nl2br((string) ((string)$_smarty_tpl->getValue('message'))." ".((string)$_smarty_tpl->getValue('f')), (bool) 1)), (int) 0, $_smarty_current_dir);
?></td></tr>
</table><?php }
}
