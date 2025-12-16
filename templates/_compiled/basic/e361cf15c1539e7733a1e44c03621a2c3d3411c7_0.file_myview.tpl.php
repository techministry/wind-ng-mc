<?php
/* Smarty version 5.7.0, created on 2025-12-16 20:56:07
  from 'file:includes/pages/nodes/myview.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941c7679732e3_56594126',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e361cf15c1539e7733a1e44c03621a2c3d3411c7' => 
    array (
      0 => 'includes/pages/nodes/myview.tpl',
      1 => 1765902792,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:generic/photosview_image.tpl' => 9,
    'file:generic/title5.tpl' => 1,
  ),
))) {
function content_6941c7679732e3_56594126 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes\\pages\\nodes';
ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/photosview_image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('image'=>$_smarty_tpl->getValue('photosview')['PANORAMIC']), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('panoramic', ob_get_clean(), false, 0);
?>
<table border="0" cellspacing="0" align="center">
	<tr>
	<td colspan="3"><br/></td>
	</tr>
	<tr>
	<td class="node-view-left-top" ><?php $_smarty_tpl->renderSubTemplate("file:generic/photosview_image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('image'=>$_smarty_tpl->getValue('photosview')['NW']), (int) 0, $_smarty_current_dir);
?></td>
	<td class="node-view-left-top" ><?php $_smarty_tpl->renderSubTemplate("file:generic/photosview_image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('image'=>$_smarty_tpl->getValue('photosview')['N']), (int) 0, $_smarty_current_dir);
?></td>
	<td class="node-view-right-top" ><?php $_smarty_tpl->renderSubTemplate("file:generic/photosview_image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('image'=>$_smarty_tpl->getValue('photosview')['NE']), (int) 0, $_smarty_current_dir);
?></td>
	</tr>
	<tr>
	<td class="node-view-left-mid" ><?php $_smarty_tpl->renderSubTemplate("file:generic/photosview_image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('image'=>$_smarty_tpl->getValue('photosview')['W']), (int) 0, $_smarty_current_dir);
?></td>
	<td class="node-view-left-mid" ><img src="<?php echo $_smarty_tpl->getValue('img_dir');?>
compass.png" /></td>
	<td class="node-view-right-mid" ><?php $_smarty_tpl->renderSubTemplate("file:generic/photosview_image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('image'=>$_smarty_tpl->getValue('photosview')['E']), (int) 0, $_smarty_current_dir);
?></td>
	</tr>
	<tr>
	<td class="node-view-left-bottom" ><?php $_smarty_tpl->renderSubTemplate("file:generic/photosview_image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('image'=>$_smarty_tpl->getValue('photosview')['SW']), (int) 0, $_smarty_current_dir);
?></td>
	<td class="node-view-left-bottom" ><?php $_smarty_tpl->renderSubTemplate("file:generic/photosview_image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('image'=>$_smarty_tpl->getValue('photosview')['S']), (int) 0, $_smarty_current_dir);
?></td>
	<td class="node-view-right-bottom" ><?php $_smarty_tpl->renderSubTemplate("file:generic/photosview_image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('image'=>$_smarty_tpl->getValue('photosview')['SE']), (int) 0, $_smarty_current_dir);
?></td>
	</tr>
	<tr>
	<td colspan="3" align="center"><?php $_smarty_tpl->assign('t', "photos__view_point-PANORAMIC", false, NULL);
$_smarty_tpl->renderSubTemplate("file:generic/title5.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['db'][$_smarty_tpl->getValue('t')]),'content'=>$_smarty_tpl->getValue('panoramic')), (int) 0, $_smarty_current_dir);
?></td>
	</tr>
</table><?php }
}
