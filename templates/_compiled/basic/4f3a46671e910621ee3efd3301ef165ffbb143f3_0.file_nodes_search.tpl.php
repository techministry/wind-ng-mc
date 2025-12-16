<?php
/* Smarty version 5.7.0, created on 2025-12-16 16:33:22
  from 'file:includes\pages\nodes/nodes_search.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_694189d2ecb4b3_71233534',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4f3a46671e910621ee3efd3301ef165ffbb143f3' => 
    array (
      0 => 'includes\\pages\\nodes/nodes_search.tpl',
      1 => 1765902750,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:generic/help.tpl' => 1,
    'file:generic/page-title.tpl' => 1,
    'file:generic/link.tpl' => 2,
    'file:generic/title1.tpl' => 1,
    'file:generic/title2.tpl' => 1,
  ),
))) {
function content_694189d2ecb4b3_71233534 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes\\pages\\nodes';
ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/help.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('help'=>"nodes_search"), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('help', ob_get_clean(), false, 0);
$_smarty_tpl->renderSubTemplate("file:generic/page-title.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['all_nodes']),'right'=>((string)$_smarty_tpl->getValue('help'))), (int) 0, $_smarty_current_dir);
?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-page">
	<tr>
		<td class="table-page-split" width="100%">
		<?php if ($_smarty_tpl->getValue('gmap_key_ok') !== "nomap") {?>
			<table align="center" bgcolor="#DBE0D7" cellpadding="0" cellspacing="2" width="100%">
				<tr>
					<td align="left"><?php $_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_gearth'),'content'=>((string)$_smarty_tpl->getValue('lang')['google_earth'])), (int) 0, $_smarty_current_dir);
?></td><td align="right"><?php $_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_fullmap'),'content'=>((string)$_smarty_tpl->getValue('lang')['new_window']),'target'=>"_blank"), (int) 0, $_smarty_current_dir);
?></td>
				</tr>
				<tr>
					<td style="font-size:12px; text-align:center;" colspan="2">
					<?php if ($_smarty_tpl->getValue('gmap_key_ok')) {?>
						<div id="map" style="width: 100%; height: 500px;"></div>
					<?php } else { ?>
						<?php echo nl2br((string) smarty_mb_wordwrap($_smarty_tpl->getValue('lang')['message']['error']['gmap_key_failed']['body'],40,"\n",false), (bool) 1);?>

					<?php }?>
					</td>
				</tr>
				<tr>
					<td style="font-size:12px;">
						<input type="checkbox" name="p2p" checked="checked" onclick="gmap_refresh();" /><?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_image')->handle(array('file'=>((string)$_smarty_tpl->getValue('img_dir'))."/gmap/mm_20_orange.png",'alt'=>$_smarty_tpl->getValue('lang')['backbone']), $_smarty_tpl);
echo $_smarty_tpl->getValue('lang')['backbone'];?>

						<input type="checkbox" name="aps" checked="checked" onclick="gmap_refresh();" /><?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_image')->handle(array('file'=>((string)$_smarty_tpl->getValue('img_dir'))."/gmap/mm_20_green.png",'alt'=>$_smarty_tpl->getValue('lang')['aps']), $_smarty_tpl);
echo $_smarty_tpl->getValue('lang')['aps'];?>

						<input type="checkbox" name="clients" checked="checked" onclick="gmap_refresh();" /><?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_image')->handle(array('file'=>((string)$_smarty_tpl->getValue('img_dir'))."/gmap/mm_20_blue.png",'alt'=>$_smarty_tpl->getValue('lang')['clients']), $_smarty_tpl);
echo $_smarty_tpl->getValue('lang')['clients'];?>

						<input type="checkbox" name="unlinked" checked="checked" onclick="gmap_refresh();" /><?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_image')->handle(array('file'=>((string)$_smarty_tpl->getValue('img_dir'))."/gmap/mm_20_red.png",'alt'=>$_smarty_tpl->getValue('lang')['unlinked']), $_smarty_tpl);
echo $_smarty_tpl->getValue('lang')['unlinked'];?>

					</td>
				</tr>
			</table>
		<?php }?>
		</td>
	</tr>
	<tr>
		<td class="table-page-split">
			<?php $_smarty_tpl->renderSubTemplate("file:generic/title1.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['nodes_search']),'content'=>$_smarty_tpl->getValue('form_search_nodes')), (int) 0, $_smarty_current_dir);
?>
		</td>
	</tr>
	<tr>
		<td class="table-page-pad">
			<?php $_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['nodes_found']),'content'=>$_smarty_tpl->getValue('table_nodes')), (int) 0, $_smarty_current_dir);
?>
		</td>
	</tr>
</table>
<?php }
}
