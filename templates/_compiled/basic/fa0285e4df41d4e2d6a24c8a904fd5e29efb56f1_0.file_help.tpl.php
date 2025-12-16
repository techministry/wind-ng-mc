<?php
/* Smarty version 5.7.0, created on 2025-12-16 16:33:22
  from 'file:generic/help.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_694189d2ed8bc1_88151105',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fa0285e4df41d4e2d6a24c8a904fd5e29efb56f1' => 
    array (
      0 => 'generic/help.tpl',
      1 => 1765893818,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_694189d2ed8bc1_88151105 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\generic';
?><a href="javascript:;"><img src="<?php echo $_smarty_tpl->getValue('img_dir');?>
help.png" alt="" onclick="return overlib('<?php echo $_smarty_tpl->getValue('lang')['help'][$_smarty_tpl->getValue('help')]['body'];?>
'<?php if ($_smarty_tpl->getValue('lang')['help'][$_smarty_tpl->getValue('help')]['title'] != '') {?>, CAPTION, '<?php echo $_smarty_tpl->getValue('lang')['help'][$_smarty_tpl->getValue('help')]['title'];?>
'<?php }?>);" onmouseout="nd();" /></a><?php }
}
