<?php
/* Smarty version 5.7.0, created on 2025-12-16 16:33:27
  from 'file:includes\pages\ranges/ranges_search.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_694189d725dbf3_82168406',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b771f618ab0227bb4122e5b85d0ef318763fe324' => 
    array (
      0 => 'includes\\pages\\ranges/ranges_search.tpl',
      1 => 1765902792,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:generic/help.tpl' => 1,
    'file:generic/link.tpl' => 2,
    'file:generic/page-title.tpl' => 1,
    'file:generic/title1.tpl' => 1,
    'file:generic/title2.tpl' => 1,
  ),
))) {
function content_694189d725dbf3_82168406 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes\\pages\\ranges';
ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/help.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('help'=>"ranges_search"), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('help', ob_get_clean(), false, 0);
ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_ranges_search'),'content'=>((string)$_smarty_tpl->getValue('lang')['ip_ranges_search'])), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('t1', ob_get_clean(), false, 0);
ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_ranges_allocation'),'content'=>((string)$_smarty_tpl->getValue('lang')['ip_ranges_allocation'])), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('t2', ob_get_clean(), false, 0);
$_smarty_tpl->renderSubTemplate("file:generic/page-title.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['all_ranges'])." ".((string)$_smarty_tpl->getValue('t1'))." ".((string)$_smarty_tpl->getValue('t2')),'right'=>((string)$_smarty_tpl->getValue('help'))), (int) 0, $_smarty_current_dir);
?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-page">
<tr>
<td class="table-page-pad">
<?php $_smarty_tpl->renderSubTemplate("file:generic/title1.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['ip_ranges_search']),'content'=>$_smarty_tpl->getValue('form_search_ranges')), (int) 0, $_smarty_current_dir);
?>
</td>
</tr>
<tr>
<td class="table-page-pad">
<?php $_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['ip_ranges_found']),'content'=>$_smarty_tpl->getValue('table_ranges')), (int) 0, $_smarty_current_dir);
?>
</td>
</tr>
</table><?php }
}
