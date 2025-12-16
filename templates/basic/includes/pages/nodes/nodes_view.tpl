{*
 * WiND - Wireless Nodes Database
 * Basic HTML Template
 *
 * Copyright (C) 2005 Konstantinos Papadimitriou <vinilios@cube.gr>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 2 dated June, 1991.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 *}
 <!-- start nodes_view_tpl -->
{include file="generic/page-title.tpl" title="`$lang.node` `$node.name` (#`$node.id`)"|escape right="$help"}

<div class="wavetabs" style="position:relative">
	<ul class="tabs">
		<li><a href="#tab_generic" class="selected">{$lang.node}</a></li>
		<li><a href="#tab_links">{$lang.links}</a></li>
		<li><a href="#tab_mynetwork">{$lang.mynetwork}</a></li>	
		<li><a href="#tab_service">{$lang.services}</a></li>	
		<li><a href="#tab_view">{$lang.myview}</a></li>
		<li><a href="#tab_Logs">{$lang.logs}Logs</a></li>	
		{if $is_admin}
		<li><a href="/forum">Admin</a></li>	
		{/if}
	</ul>
	<div class="container"></div>
	<div style="text-align: right; position: absolute; right: 10px; top: -9px;">
	<script type="text/javascript"><!--
	google_ad_client = "pub-7997884316793079";
	/* 468x60, ������������� 4/10/2010 */
	google_ad_slot = "9305113314";
	google_ad_width = 468;
	google_ad_height = 60;
	//-->
	</script>
	<script type="text/javascript"
	src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
	</script>
	</div>	
</div>

<div id="tab_generic">
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-page">
<tr>
	<td class="table-page-split">
		{include file="generic/title2.tpl" title="`$lang.node`" content=$t}

		{include assign="t1" file="includes/pages/nodes/node_info.tpl"}

		{if $edit_node}{include assign="ed" file="generic/link.tpl" content="`$lang.edit_node`" link=$edit_node}{/if}
		{include file="generic/title3.tpl" title="`$lang.node_info` $ed" content="$t1"}
		{include file="generic/title4.tpl" title="`$lang.db.nodes__info`" content="`$node.info`"|escape|nl2br}
		{if $logged==TRUE}
		{include file="generic/title5.tpl" title="`$lang.ip_ranges`" content="`$table_ip_ranges`"}
		{include file="generic/title5.tpl" title="`$lang.dns_zones`" content="`$table_dns`"}
		{include file="generic/title5.tpl" title="`$lang.dns_nameservers`" content="`$table_nameservers`"}
		{else}
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
		{/if}
		<br />
		<div align="center">{include file="generic/link.tpl" content="`$lang.node_plot_link`" onclick="javascript: t = window.open('$link_plot_link', 'popup_plot_link', 'width=600,height=420,toolbar=0,resizable=1,scrollbars=1'); t.focus(); return false;"}</div>
	</td>
	<td class="table-page-split" width="100%">
	{if $gmap_key_ok!=="nomap"}
		<Br />
		<table bgcolor="#DBE0D7" cellpadding="0" cellspacing="2" width="100%">
			<tr>
				<td align="left" nowrap="nowrap">{include file="generic/link.tpl" link=$link_gearth content="Google earth"}</td>
				<td align="right" nowrap="nowrap">{include file="generic/link.tpl" link=$link_fullmap content="`$lang.new_window`" target="_blank"}</td>
			</tr>
			<tr>
				<td style="font-size:12px; text-align:center; width: 100%; height: 500px" colspan="2">
					{if $gmap_key_ok}
					<div id="map" style="width: 100%; height: 500px"></div>
					{else}
					{$lang.message.error.gmap_key_failed.body|wordwrap:40|nl2br}
					{/if}
				</td>
			</tr>
			<tr>
				<td style="font-size:12px;" colspan="2" nowrap="nowrap">
					<input type="checkbox" name="p2p" checked="checked" onclick="gmap_refresh();" />{html_image file="`$img_dir`/gmap/mm_20_orange.png" alt=$lang.backbone}{$lang.backbone}
					<input type="checkbox" name="aps" checked="checked" onclick="gmap_refresh();" />{html_image file="`$img_dir`/gmap/mm_20_green.png" alt=$lang.aps}{$lang.aps}
					<input type="checkbox" name="clients" checked="checked" onclick="gmap_refresh();" />{html_image file="`$img_dir`/gmap/mm_20_blue.png" alt=$lang.clients}{$lang.clients}
					<input type="checkbox" name="unlinked" onclick="gmap_refresh();" />{html_image file="`$img_dir`/gmap/mm_20_red.png" alt=$lang.unlinked}{$lang.unlinked}
				</td>
			</tr>
		</table>
	
	{/if}
	</td>
</tr>
</table>
</div>

	
<div id="tab_links">
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-page">
<tr>
<td colspan="2" class="table-page-pad">

{foreach from=$table_links_ap item=ap}
	{assign var=aps value="`$aps``$ap`"}
{/foreach}
{if $logged==TRUE}
{include file="generic/title2.tpl" title="`$lang.links`" content="`$table_links_p2p``$aps`"}
{else}{$lang.adpl}{/if}
</td>
</tr>
</table>
</div>


<div id="tab_mynetwork">
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-page">
<tr>
<td colspan="2" class="table-page-pad">
{if $logged==TRUE}
{include file="generic/title2.tpl" title="`$lang.mynetwork`" content=$table_ipaddr_subnets}
{else}{$lang.adpl}{/if}
</td>
</tr>
</table>
</div>

<div id="tab_service">
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-page">
<tr>
<td colspan="2" class="table-page-pad">
{if $logged==TRUE}
{include file="generic/title2.tpl" title="`$lang.services`" content=$table_services}
{else}{$lang.adpl}{/if}
</td>
</tr>
</table>
</div>

<div id="tab_view">
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-page">
<tr>
<td colspan="2" class="table-page-pad">
{if $logged==TRUE}
{include assign="t" file="includes/pages/nodes/myview.tpl"}
{include file="generic/title2.tpl" title="`$lang.myview`" content=$t}
{else}{$lang.adpl}{/if}
</td>
</tr>
</table>
</div>

<div id="tab_Logs">

<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-page">
<tr>
<td colspan="2" class="table-page-pad">
{if $logged==TRUE}
{include file="generic/title2.tpl" title="Logs" content=$t}
{else}{$lang.adpl}{/if}
</td>
</tr>
</table>
</div>
 <!-- end nodes_view_tpl -->