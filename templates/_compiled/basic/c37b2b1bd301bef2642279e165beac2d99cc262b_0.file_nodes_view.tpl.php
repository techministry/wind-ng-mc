<?php
/* Smarty version 5.7.0, created on 2025-12-16 19:52:46
  from 'file:includes\pages\nodes/nodes_view.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941b88e5789a5_17343359',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c37b2b1bd301bef2642279e165beac2d99cc262b' => 
    array (
      0 => 'includes\\pages\\nodes/nodes_view.tpl',
      1 => 1765902792,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:generic/page-title.tpl' => 1,
    'file:generic/title2.tpl' => 6,
    'file:includes/pages/nodes/node_info.tpl' => 1,
    'file:generic/link.tpl' => 4,
    'file:generic/title3.tpl' => 1,
    'file:generic/title4.tpl' => 1,
    'file:generic/title5.tpl' => 3,
    'file:includes/pages/nodes/myview.tpl' => 1,
  ),
))) {
function content_6941b88e5789a5_17343359 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes\\pages\\nodes';
?> <!-- start nodes_view_tpl -->
<?php $_smarty_tpl->renderSubTemplate("file:generic/page-title.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>htmlspecialchars((string)((string)$_smarty_tpl->getValue('lang')['node'])." ".((string)$_smarty_tpl->getValue('node')['name'])." (#".((string)$_smarty_tpl->getValue('node')['id']).")", ENT_QUOTES, 'UTF-8', true),'right'=>((string)$_smarty_tpl->getValue('help'))), (int) 0, $_smarty_current_dir);
?>

<div class="wavetabs" style="position:relative">
	<ul class="tabs">
		<li><a href="#tab_generic" class="selected"><?php echo $_smarty_tpl->getValue('lang')['node'];?>
</a></li>
		<li><a href="#tab_links"><?php echo $_smarty_tpl->getValue('lang')['links'];?>
</a></li>
		<li><a href="#tab_mynetwork"><?php echo $_smarty_tpl->getValue('lang')['mynetwork'];?>
</a></li>	
		<li><a href="#tab_service"><?php echo $_smarty_tpl->getValue('lang')['services'];?>
</a></li>	
		<li><a href="#tab_view"><?php echo $_smarty_tpl->getValue('lang')['myview'];?>
</a></li>
		<li><a href="#tab_Logs"><?php echo $_smarty_tpl->getValue('lang')['logs'];?>
Logs</a></li>	
		<?php if ($_smarty_tpl->getValue('is_admin')) {?>
		<li><a href="/forum">Admin</a></li>	
		<?php }?>
	</ul>
	<div class="container"></div>
	<div style="text-align: right; position: absolute; right: 10px; top: -9px;">
	<?php echo '<script'; ?>
 type="text/javascript"><!--
	google_ad_client = "pub-7997884316793079";
	/* 468x60, ������������� 4/10/2010 */
	google_ad_slot = "9305113314";
	google_ad_width = 468;
	google_ad_height = 60;
	//-->
	<?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript"
	src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
	<?php echo '</script'; ?>
>
	</div>	
</div>

<div id="tab_generic">
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-page">
<tr>
	<td class="table-page-split">
		<?php $_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['node']),'content'=>$_smarty_tpl->getValue('t')), (int) 0, $_smarty_current_dir);
?>

		<?php ob_start();
$_smarty_tpl->renderSubTemplate("file:includes/pages/nodes/node_info.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('t1', ob_get_clean(), false, 0);
?>

		<?php if ($_smarty_tpl->getValue('edit_node')) {
ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('content'=>((string)$_smarty_tpl->getValue('lang')['edit_node']),'link'=>$_smarty_tpl->getValue('edit_node')), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('ed', ob_get_clean(), false, 0);
}?>
		<?php $_smarty_tpl->renderSubTemplate("file:generic/title3.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['node_info'])." ".((string)$_smarty_tpl->getValue('ed')),'content'=>((string)$_smarty_tpl->getValue('t1'))), (int) 0, $_smarty_current_dir);
?>
		<?php $_smarty_tpl->renderSubTemplate("file:generic/title4.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['db']['nodes__info']),'content'=>nl2br((string) htmlspecialchars((string)((string)$_smarty_tpl->getValue('node')['info']), ENT_QUOTES, 'UTF-8', true), (bool) 1)), (int) 0, $_smarty_current_dir);
?>
		<?php if ($_smarty_tpl->getValue('logged') == TRUE) {?>
		<?php $_smarty_tpl->renderSubTemplate("file:generic/title5.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['ip_ranges']),'content'=>((string)$_smarty_tpl->getValue('table_ip_ranges'))), (int) 0, $_smarty_current_dir);
?>
		<?php $_smarty_tpl->renderSubTemplate("file:generic/title5.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['dns_zones']),'content'=>((string)$_smarty_tpl->getValue('table_dns'))), (int) 0, $_smarty_current_dir);
?>
		<?php $_smarty_tpl->renderSubTemplate("file:generic/title5.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['dns_nameservers']),'content'=>((string)$_smarty_tpl->getValue('table_nameservers'))), (int) 0, $_smarty_current_dir);
?>
		<?php } else { ?>
		<table width="100%"  border="0" cellpadding="0" cellspacing="2" class="table-node">
		<tr>
		<td class="table-node-subinfo-title">Περισσότερα</td>
		</tr>
		<tr>
		<td class="table-node-info"><table class="table-form">
		<tr>
												
			<td class="table-node-key2">
						Για περισσότερες πληροφορίες για τον κόμβο αυτό θα  πρέπει πρώτα να <br /> συνδεθείτε με το 
						όνομα χρήστη και τον κωδικό που έχετε στο wna.gr
					</td>
													
			
				</tr>
		</table></td>
		</tr>
		</table>		
		<?php }?>
		<br />
		<div align="center"><?php $_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('content'=>((string)$_smarty_tpl->getValue('lang')['node_plot_link']),'onclick'=>"javascript: t = window.open('".((string)$_smarty_tpl->getValue('link_plot_link'))."', 'popup_plot_link', 'width=600,height=420,toolbar=0,resizable=1,scrollbars=1'); t.focus(); return false;"), (int) 0, $_smarty_current_dir);
?></div>
	</td>
	<td class="table-page-split" width="100%">
	<?php if ($_smarty_tpl->getValue('gmap_key_ok') !== "nomap") {?>
		<Br />
		<table bgcolor="#DBE0D7" cellpadding="0" cellspacing="2" width="100%">
			<tr>
				<td align="left" nowrap="nowrap"><?php $_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_gearth'),'content'=>"Google earth"), (int) 0, $_smarty_current_dir);
?></td>
				<td align="right" nowrap="nowrap"><?php $_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_fullmap'),'content'=>((string)$_smarty_tpl->getValue('lang')['new_window']),'target'=>"_blank"), (int) 0, $_smarty_current_dir);
?></td>
			</tr>
			<tr>
				<td style="font-size:12px; text-align:center; width: 100%; height: 500px" colspan="2">
					<?php if ($_smarty_tpl->getValue('gmap_key_ok')) {?>
					<div id="map" style="width: 100%; height: 500px"></div>
					<?php } else { ?>
					<?php echo nl2br((string) smarty_mb_wordwrap($_smarty_tpl->getValue('lang')['message']['error']['gmap_key_failed']['body'],40,"\n",false), (bool) 1);?>

					<?php }?>
				</td>
			</tr>
			<tr>
				<td style="font-size:12px;" colspan="2" nowrap="nowrap">
					<input type="checkbox" name="p2p" checked="checked" onclick="gmap_refresh();" /><?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_image')->handle(array('file'=>((string)$_smarty_tpl->getValue('img_dir'))."/gmap/mm_20_orange.png",'alt'=>$_smarty_tpl->getValue('lang')['backbone']), $_smarty_tpl);
echo $_smarty_tpl->getValue('lang')['backbone'];?>

					<input type="checkbox" name="aps" checked="checked" onclick="gmap_refresh();" /><?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_image')->handle(array('file'=>((string)$_smarty_tpl->getValue('img_dir'))."/gmap/mm_20_green.png",'alt'=>$_smarty_tpl->getValue('lang')['aps']), $_smarty_tpl);
echo $_smarty_tpl->getValue('lang')['aps'];?>

					<input type="checkbox" name="clients" checked="checked" onclick="gmap_refresh();" /><?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_image')->handle(array('file'=>((string)$_smarty_tpl->getValue('img_dir'))."/gmap/mm_20_blue.png",'alt'=>$_smarty_tpl->getValue('lang')['clients']), $_smarty_tpl);
echo $_smarty_tpl->getValue('lang')['clients'];?>

					<input type="checkbox" name="unlinked" onclick="gmap_refresh();" /><?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_image')->handle(array('file'=>((string)$_smarty_tpl->getValue('img_dir'))."/gmap/mm_20_red.png",'alt'=>$_smarty_tpl->getValue('lang')['unlinked']), $_smarty_tpl);
echo $_smarty_tpl->getValue('lang')['unlinked'];?>

				</td>
			</tr>
		</table>
	
	<?php }?>
	</td>
</tr>
</table>
</div>

	
<div id="tab_links">
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-page">
<tr>
<td colspan="2" class="table-page-pad">

<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('table_links_ap'), 'ap');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('ap')->value) {
$foreach0DoElse = false;
?>
	<?php $_smarty_tpl->assign('aps', ((string)$_smarty_tpl->getValue('aps')).((string)$_smarty_tpl->getValue('ap')), false, NULL);
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);
if ($_smarty_tpl->getValue('logged') == TRUE) {
$_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['links']),'content'=>((string)$_smarty_tpl->getValue('table_links_p2p')).((string)$_smarty_tpl->getValue('aps'))), (int) 0, $_smarty_current_dir);
} else {
echo $_smarty_tpl->getValue('lang')['adpl'];
}?>
</td>
</tr>
</table>
</div>


<div id="tab_mynetwork">
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-page">
<tr>
<td colspan="2" class="table-page-pad">
<?php if ($_smarty_tpl->getValue('logged') == TRUE) {
$_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['mynetwork']),'content'=>$_smarty_tpl->getValue('table_ipaddr_subnets')), (int) 0, $_smarty_current_dir);
} else {
echo $_smarty_tpl->getValue('lang')['adpl'];
}?>
</td>
</tr>
</table>
</div>

<div id="tab_service">
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-page">
<tr>
<td colspan="2" class="table-page-pad">
<?php if ($_smarty_tpl->getValue('logged') == TRUE) {
$_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['services']),'content'=>$_smarty_tpl->getValue('table_services')), (int) 0, $_smarty_current_dir);
} else {
echo $_smarty_tpl->getValue('lang')['adpl'];
}?>
</td>
</tr>
</table>
</div>

<div id="tab_view">
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-page">
<tr>
<td colspan="2" class="table-page-pad">
<?php if ($_smarty_tpl->getValue('logged') == TRUE) {
ob_start();
$_smarty_tpl->renderSubTemplate("file:includes/pages/nodes/myview.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('t', ob_get_clean(), false, 0);
$_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['myview']),'content'=>$_smarty_tpl->getValue('t')), (int) 0, $_smarty_current_dir);
} else {
echo $_smarty_tpl->getValue('lang')['adpl'];
}?>
</td>
</tr>
</table>
</div>

<div id="tab_Logs">

<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-page">
<tr>
<td colspan="2" class="table-page-pad">
<?php if ($_smarty_tpl->getValue('logged') == TRUE) {
$_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"Logs",'content'=>$_smarty_tpl->getValue('t')), (int) 0, $_smarty_current_dir);
} else {
echo $_smarty_tpl->getValue('lang')['adpl'];
}?>
</td>
</tr>
</table>
</div>
 <!-- end nodes_view_tpl --><?php }
}
