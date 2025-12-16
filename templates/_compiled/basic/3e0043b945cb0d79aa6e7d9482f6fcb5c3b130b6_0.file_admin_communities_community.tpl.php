<?php
/* Smarty version 5.7.0, created on 2025-12-16 21:03:18
  from 'file:includes\pages\admin/admin_communities_community.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941c91696b691_87902247',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3e0043b945cb0d79aa6e7d9482f6fcb5c3b130b6' => 
    array (
      0 => 'includes\\pages\\admin/admin_communities_community.tpl',
      1 => 1765902792,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:generic/page-title.tpl' => 1,
    'file:generic/title2.tpl' => 1,
  ),
))) {
function content_6941c91696b691_87902247 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes\\pages\\admin';
$_smarty_tpl->assign('t', "communities_".((string)$_smarty_tpl->getValue('communities_method')), false, NULL);
$_smarty_tpl->renderSubTemplate("file:generic/page-title.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')[$_smarty_tpl->getValue('t')])), (int) 0, $_smarty_current_dir);
?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-page">
<tr>
<td class="table-page-pad">
<?php $_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')[$_smarty_tpl->getValue('t')]),'content'=>$_smarty_tpl->getValue('form_community')), (int) 0, $_smarty_current_dir);
?>
</td>
</tr>
</table><?php }
}
