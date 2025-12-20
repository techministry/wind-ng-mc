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
{include assign="help" file="generic/help.tpl" help="users_`$user_method`"}
{assign var=t value="user_`$user_method`"}



{include file="generic/page-title.tpl" title="`$lang.$t`" right="$help"}
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="table-page">
<tr>
<td class="table-page-pad">
{if $link_user_delete}{include assign="user_delete" file="generic/link.tpl" content="`$lang.delete`" link=$link_user_delete confirm="TRUE"}{/if}
{if $link_impersonate}{include assign="impersonate_link" file="generic/link.tpl" content="Impersonate this user" link=$link_impersonate confirm="TRUE"}{/if}
{assign var=title_actions value=""}
{if $user_delete}{$title_actions = $user_delete}{/if}
{if $impersonate_link}{$title_actions = "$title_actions $impersonate_link"}{/if}
{include file="generic/title1.tpl" title="`$lang.user_info`" right="$title_actions" content=$form_user}

{if $nodes_owner|@count > 0}
<table class="table-form" width="100%" cellpadding="2" cellspacing="2">
	<tr><th colspan="2" class="table-form-title">Nodes (owner) <span style="font-size:11px;color:#c00;">(admin only)</span></th></tr>
	{foreach from=$nodes_owner item=n}
	<tr>
		<td class="table-form-title"><img src="templates/basic/images/node-small.png" alt="node" /></td>
		<td class="table-form-body"><a href="{$n.url_view}">{$n.name|escape} (#{$n.id})</a></td>
	</tr>
	{/foreach}
</table>
{/if}

{if $nodes_coadmin|@count > 0}
<table class="table-form" width="100%" cellpadding="2" cellspacing="2">
	<tr><th colspan="2" class="table-form-title">Nodes (co-admin) <span style="font-size:11px;color:#c00;">(admin only)</span></th></tr>
	{foreach from=$nodes_coadmin item=n}
	<tr>
		<td class="table-form-title"><img src="templates/basic/images/node-small.png" alt="node" /></td>
		<td class="table-form-body"><a href="{$n.url_view}">{$n.name|escape} (#{$n.id})</a></td>
	</tr>
	{/foreach}
</table>
{/if}

{if $nodes_owner|@count > 0 || $nodes_coadmin|@count > 0}
<table class="table-form" width="100%" cellpadding="2" cellspacing="2" style="margin-top:10px;">
	<tr>
		<th class="table-form-title" width="20%">Admin/co-admin picker</th>
		<td class="table-form-body">
			<p style="margin:0 0 6px 0;font-size:11px;color:#555;">These fields are only visible to admins.</p>
			<label style="display:block;font-weight:bold;">Owner nodes</label>
			<select multiple="multiple" style="width:280px;height:70px;">
				{foreach from=$nodes_owner item=n}
				<option>{$n.name|escape} (#{$n.id})</option>
				{/foreach}
			</select>
			<br />
			<label style="display:block;font-weight:bold;margin-top:6px;">Co-admin nodes</label>
			<select multiple="multiple" style="width:280px;height:70px;">
				{foreach from=$nodes_coadmin item=n}
				<option>{$n.name|escape} (#{$n.id})</option>
				{/foreach}
			</select>
		</td>
	</tr>
</table>
{/if}
</td>
</tr>
</table>
