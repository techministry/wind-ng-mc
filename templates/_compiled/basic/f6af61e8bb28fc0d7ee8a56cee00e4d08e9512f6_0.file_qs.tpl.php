<?php
/* Smarty version 5.7.0, created on 2025-12-16 16:33:23
  from 'file:generic/qs.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_694189d38e6280_66947552',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f6af61e8bb28fc0d7ee8a56cee00e4d08e9512f6' => 
    array (
      0 => 'generic/qs.tpl',
      1 => 1765893818,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_694189d38e6280_66947552 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\generic';
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('qs'), 'item', false, 'key');
$foreach6DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('key')->value => $_smarty_tpl->getVariable('item')->value) {
$foreach6DoElse = false;
?>
<input type="hidden" name="<?php echo $_smarty_tpl->getValue('key');?>
" value="<?php echo $_smarty_tpl->getValue('item');?>
" />
<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);
}
}
