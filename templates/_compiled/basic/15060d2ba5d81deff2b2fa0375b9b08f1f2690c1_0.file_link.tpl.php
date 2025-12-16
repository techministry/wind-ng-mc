<?php
/* Smarty version 5.7.0, created on 2025-12-16 16:33:22
  from 'file:generic/link.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_694189d2ef0180_95402754',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15060d2ba5d81deff2b2fa0375b9b08f1f2690c1' => 
    array (
      0 => 'generic/link.tpl',
      1 => 1765893818,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_694189d2ef0180_95402754 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\generic';
if ($_smarty_tpl->getValue('confirm') == TRUE) {
$_smarty_tpl->assign('link', "javascript: if (confirm('".((string)$_smarty_tpl->getValue('content'))."?') == true) window.open('".((string)$_smarty_tpl->getValue('link'))."','_parent');", false, NULL);
}?>
<span style="font-weight:bold; font-size: 9px; color: orange;">|<a href="<?php echo $_smarty_tpl->getValue('link');?>
"<?php if ($_smarty_tpl->getValue('onclick') != '') {?> onclick="<?php echo $_smarty_tpl->getValue('onclick');?>
"<?php }
if ($_smarty_tpl->getValue('target') != '') {?> target="<?php echo $_smarty_tpl->getValue('target');?>
"<?php }?>><?php echo $_smarty_tpl->getValue('content');?>
</a>|</span><?php }
}
