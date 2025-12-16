<?php
/* Smarty version 5.7.0, created on 2025-12-16 21:01:43
  from 'file:includes\pages\mynodes/mynodes.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941c8b7a0c409_93083611',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '38f468b663efcd1bdfb563615ef26394ad26e46d' => 
    array (
      0 => 'includes\\pages\\mynodes/mynodes.tpl',
      1 => 1765902792,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:generic/help.tpl' => 2,
    'file:generic/link.tpl' => 11,
    'file:generic/page-title.tpl' => 1,
    'file:generic/title1.tpl' => 1,
    'file:generic/title2.tpl' => 9,
  ),
))) {
function content_6941c8b7a0c409_93083611 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes\\pages\\mynodes';
if ($_smarty_tpl->getValue('node_method') == 'add') {
ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/help.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('help'=>"mynodes_add"), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('help', ob_get_clean(), false, 0);
$_smarty_tpl->assign('t', ((string)$_smarty_tpl->getValue('lang')['node_add']), false, NULL);
} else {
ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/help.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('help'=>"mynodes"), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('help', ob_get_clean(), false, 0);
$_smarty_tpl->assign('t', htmlspecialchars((string)((string)$_smarty_tpl->getValue('lang')['node'])." ".((string)$_smarty_tpl->getValue('node_name'))." (#".((string)$_smarty_tpl->getValue('node_id')).")", ENT_QUOTES, 'UTF-8', true), false, NULL);
ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_node_view'),'content'=>((string)$_smarty_tpl->getValue('lang')['node_view'])), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('view', ob_get_clean(), false, 0);
if ($_smarty_tpl->getValue('link_node_delete')) {?>
	<?php ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_node_delete'),'content'=>((string)$_smarty_tpl->getValue('lang')['node_delete']),'confirm'=>"TRUE"), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('t1', ob_get_clean(), false, 0);
}
}
$_smarty_tpl->renderSubTemplate("file:generic/page-title.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('t')),'right'=>((string)$_smarty_tpl->getValue('help'))), (int) 0, $_smarty_current_dir);
?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-page">
<tr>
<td class="table-page-pad">
<?php ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('content'=>((string)$_smarty_tpl->getValue('lang')['find_coordinates']),'onclick'=>"javascript: t = window.open('".((string)$_smarty_tpl->getValue('link_gmap_pickup'))."', 'popup_gmap_pickup', 'width=500,height=500,toolbar=0,resizable=0,scrollbars=0'); t.focus(); return false;"), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('t2', ob_get_clean(), false, 0);
$_smarty_tpl->renderSubTemplate("file:generic/title1.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['node_info'])." ".((string)$_smarty_tpl->getValue('t2')),'right'=>((string)$_smarty_tpl->getValue('view'))." ".((string)$_smarty_tpl->getValue('t1')),'content'=>$_smarty_tpl->getValue('form_node')), (int) 0, $_smarty_current_dir);
?>
</td>
</tr>
<?php if ($_smarty_tpl->getValue('node') != 'add') {?>
<tr>
<td class="table-page-pad">
<?php ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_req_cclass'),'content'=>((string)$_smarty_tpl->getValue('lang')['ip_range_request'])), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('t1', ob_get_clean(), false, 0);
$_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['ip_ranges'])." ".((string)$_smarty_tpl->getValue('t1')),'content'=>$_smarty_tpl->getValue('table_ip_ranges')), (int) 0, $_smarty_current_dir);
?>
</td>
</tr>
<tr>
<td class="table-page-pad">
<?php ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_req_dns_for'),'content'=>((string)$_smarty_tpl->getValue('lang')['dnszone_request_forward'])), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('t1', ob_get_clean(), false, 0);
ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_req_dns_rev'),'content'=>((string)$_smarty_tpl->getValue('lang')['dnszone_request_reverse'])), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('t2', ob_get_clean(), false, 0);
$_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['dns_zones'])." ".((string)$_smarty_tpl->getValue('t1'))." ".((string)$_smarty_tpl->getValue('t2')),'content'=>$_smarty_tpl->getValue('table_dns')), (int) 0, $_smarty_current_dir);
?>
</td>
</tr>
<tr>
<td class="table-page-pad">
<?php ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_nameserver_add'),'content'=>((string)$_smarty_tpl->getValue('lang')['nameserver_add'])), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('t1', ob_get_clean(), false, 0);
$_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['dns_nameservers'])." ".((string)$_smarty_tpl->getValue('t1')),'content'=>$_smarty_tpl->getValue('table_nameservers')), (int) 0, $_smarty_current_dir);
?>
</td>
</tr>
<tr>
<td class="table-page-pad">
<?php ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_link_add'),'content'=>((string)$_smarty_tpl->getValue('lang')['link_add'])), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('t1', ob_get_clean(), false, 0);
$_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['links'])." ".((string)$_smarty_tpl->getValue('t1')),'content'=>$_smarty_tpl->getValue('table_links')), (int) 0, $_smarty_current_dir);
?>
</td>
</tr>
<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('table_links_ap'), 'item', false, 'key');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('key')->value => $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
<tr>
<td class="table-page-pad">
<?php $_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>htmlspecialchars((string)((string)$_smarty_tpl->getValue('lang')['ap'])." ".((string)$_smarty_tpl->getValue('key')), ENT_QUOTES, 'UTF-8', true),'content'=>$_smarty_tpl->getValue('item')), (int) 0, $_smarty_current_dir);
?>
</td>
</tr>
<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
<tr>
<td class="table-page-pad">
<?php ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_subnet_add'),'content'=>((string)$_smarty_tpl->getValue('lang')['subnet_add'])), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('t1', ob_get_clean(), false, 0);
$_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['subnets'])." ".((string)$_smarty_tpl->getValue('t1')),'content'=>$_smarty_tpl->getValue('table_subnets')), (int) 0, $_smarty_current_dir);
?>
</td>
</tr>
<tr>
<td class="table-page-pad">
<?php ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_ipaddr_add'),'content'=>((string)$_smarty_tpl->getValue('lang')['ip_address_add'])), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('t1', ob_get_clean(), false, 0);
$_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['ip_addresses'])." ".((string)$_smarty_tpl->getValue('t1')),'content'=>$_smarty_tpl->getValue('table_ipaddr')), (int) 0, $_smarty_current_dir);
?>
</td>
</tr>
<tr>
<td class="table-page-pad">
<?php ob_start();
$_smarty_tpl->renderSubTemplate("file:generic/link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('link'=>$_smarty_tpl->getValue('link_services_add'),'content'=>((string)$_smarty_tpl->getValue('lang')['services_add'])), (int) 0, $_smarty_current_dir);
$_smarty_tpl->assign('t1', ob_get_clean(), false, 0);
$_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['services'])." ".((string)$_smarty_tpl->getValue('t1')),'content'=>$_smarty_tpl->getValue('table_services')), (int) 0, $_smarty_current_dir);
?>
</td>
</tr>
<tr>
<td class="table-page-pad">
<?php $_smarty_tpl->renderSubTemplate("file:generic/title2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>((string)$_smarty_tpl->getValue('lang')['myview']),'content'=>$_smarty_tpl->getValue('table_photosview')), (int) 0, $_smarty_current_dir);
?>
</td>
</tr>
<?php }?>
</table><?php }
}
