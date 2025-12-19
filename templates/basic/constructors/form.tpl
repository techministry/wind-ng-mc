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
{assign var=use_pickup value=false}
{assign var="form_action" value=$action_url|default:"?`$hidden_qs`"}
<form name="{$extra_data.FORM_NAME}" method="post" action="{$form_action}">
<input type="hidden" name="form_name" value="{$extra_data.FORM_NAME}" />
<input type="hidden" name="query_string" value="{$hidden_qs|escape}" />
<table class="table-form">
{assign var=row_num value=1}
{foreach from=$data item=field}
	{assign var=fullField value=$field.fullField}
	<tr class="table-form-row{if $row_num % 2 == 1}1{else}2{/if}">
		<td class="table-form-title">{$lang.db.$fullField}{if $field.Null != 'YES'}*{/if}:</td>
		<td class="table-form-field">
	{if $field.Type == 'caption'}
		{$field.Value|escape}
	{elseif $field.Type == 'datetime'}
		{html_select_date time=$field.value prefix="CONDATETIME_`$field.fullField`_"} - {html_select_time time=$field.value prefix="CONDATETIME_`$field.fullField`_"}
	{elseif $field.Type == 'text'}
		<textarea class="fld-form-input" name="{$field.fullField}">{$field.value|escape}</textarea>
	{elseif $field.Type == 'enum'}
		<select class="fld-form-input" name="{$field.fullField}">
			{if $field.Null == 'YES'}<option value="">---</option>{/if}
			{foreach from=$field.Type_Enums item=enum}
			<option value="{$enum.value|escape}"{if $enum.value == $field.value} selected="selected"{/if}>{include file="constructors/form_enum.tpl" fullField=$fullField value=$enum.output}</option>
			{/foreach}
		</select>
	{elseif $field.Type == 'enum_radio'}
		{if $field.Null == 'YES'}<input type="radio" name="{$field.fullField}" value="" /><br />{/if}
		{foreach from=$field.Type_Enums item=enum}
			<input type="radio" name="{$field.fullField}" value="{$enum.value|escape}"{if $enum.value == $field.value} checked="checked"{/if} />{include file="constructors/form_enum.tpl" fullField=$fullField value=$enum.output}<br />
		{/foreach}
	{elseif $field.Type == 'pickup'}
		{assign var=use_pickup value=true}
		<input type="hidden" name="{$field.fullField}" value="{$field.Type_Pickup.value|escape}" />
		<input type="text" disabled="disabled" class="fld-form-input-pickup" name="{$field.fullField}_output" value="{$field.Type_Pickup.output|escape}" />
		<a href="javascript: t = window.open('?page=pickup&subpage=users&object='+encodeURIComponent('{$extra_data.FORM_NAME}.elements[\'{$field.fullField}\']'), 'popup', 'width=640,height=480,scrollbars=yes,resizable=yes'); t.focus();">[{$lang.select}]</a>
		{if $field.Null == 'YES'}<a href="javascript: document.{$extra_data.FORM_NAME}.elements['{$field.fullField}'].value = ''; document.{$extra_data.FORM_NAME}.elements['{$field.fullField}_output'].value = '';">[{$lang.clear}]</a>{/if}
	{elseif $field.Type == 'pickup_multi'}
		{assign var=use_pickup value=true}
		<select class="fld-form-input" name="{$field.fullField}[]" size="5" multiple="multiple">
			{foreach from=$field.Type_Pickup item=pickupVal}
			<option value="{$pickupVal.value|escape}" selected="selected">{$pickupVal.output|escape}</option>
			{/foreach}
		</select>
		<a href="javascript: t = window.open('?page=pickup&subpage=users&object='+encodeURIComponent('{$extra_data.FORM_NAME}.elements[\'{$field.fullField}[]\']'), 'popup', 'width=640,height=480,scrollbars=yes,resizable=yes'); t.focus();">[{$lang.add}]</a>
		<a href="javascript: remove_selected(document.{$extra_data.FORM_NAME}.elements['{$field.fullField}[]']);">[{$lang.remove}]</a>
	{elseif $field.Field|substr:0:8 == 'password'}
		<input class="fld-form-input" name="{$field.fullField}" type="password" value="{$field.value|escape}" />
	{else}
		<input class="fld-form-input" name="{$field.fullField}" type="text" value="{$field.value|escape}" />
	{/if}
		</td>
	</tr>
	{assign var=row_num value=$row_num+1}
{/foreach}
	<tr>
		<td class="table-form-submit" colspan="2"><input class="fld-form-submit" type="submit" value="{$lang.submit}" /></td>
	</tr>
</table>
</form>
{if $use_pickup}<script type="text/javascript" src="{$js_dir}pickup.js"></script>{/if}
