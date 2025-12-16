<?php
/* Smarty version 5.7.0, created on 2025-12-16 16:33:22
  from 'file:constructors/form_enum.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_694189d2621226_61682334',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '07621da8c26f0f63e62874596b57fc5c7bc98eef' => 
    array (
      0 => 'constructors/form_enum.tpl',
      1 => 1765893818,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_694189d2621226_61682334 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\constructors';
$_smarty_tpl->assign('temp', (($_smarty_tpl->getValue('fullField')).("-")).($_smarty_tpl->getValue('value')), false, NULL);
if ($_smarty_tpl->getValue('lang')['db'][$_smarty_tpl->getValue('temp')] != '') {
echo $_smarty_tpl->getValue('lang')['db'][$_smarty_tpl->getValue('temp')];
} else {
echo htmlspecialchars((string)$_smarty_tpl->getValue('value'), ENT_QUOTES, 'UTF-8', true);
}
}
}
