<?php
/* Smarty version 5.7.0, created on 2025-12-16 21:02:57
  from 'file:includes\pages\admin/admin_areas.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941c901708979_70084407',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4c9a45dcdccf4d8f1a689f587dfded9bd24d186d' => 
    array (
      0 => 'includes\\pages\\admin/admin_areas.tpl',
      1 => 1765902792,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:generic/page-title.tpl' => 1,
    'file:generic/link.tpl' => 1,
    'file:generic/title2.tpl' => 1,
  ),
))) {
function content_6941c901708979_70084407 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes\\pages\\admin';
$_smarty_tpl->renderSubTemplate("file:generic/page-title.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['admin_panel'])." > ".((string)$_smarty_tpl->getValue('lang')['areas'])), (int) 0, $_smarty_current_dir);
?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-page">
<tr>
<td class="table-page-pad">
<?php ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_area_add'),'content'=>((string)$_smarty_tpl->getValue('lang')['area_add'])), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('t1', ob_get_clean(), false, 0);
$_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['areas'])." ".((string)$_smarty_tpl->getValue('t1')),'content'=>$_smarty_tpl->getValue('table_areas')), (int) 0, $_smarty_current_dir);
?>
</td>
</tr>
</table><?php }
}
