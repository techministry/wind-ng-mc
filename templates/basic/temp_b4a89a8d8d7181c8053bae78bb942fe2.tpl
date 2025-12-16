{*
 * WiND - Wireless Nodes Database
 * Basic HTML Template - Fixed for Smarty 3.x Compatibility
 *
 * Copyright (C) 2005 Konstantinos Papadimitriou <vinilios@cube.gr>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 2 dated June, 1991.
 *
 *}
<form name="{{ $extra_data['FORM_NAME'] }}" method="post" action="?">
<input type="hidden" name="query_string" value="{{ $hidden_qs }}" />
<input type="hidden" name="form_name" value="{{ $extra_data['FORM_NAME'] }}" />
<table class="table-form">
{% foreach from=$data item=field key=d %}
	{% if $$d is not even %}
	<tr class="table-form-row2">
	{% else %}
	<tr class="table-form-row1">
	{% endif %}
	{% set fullField = $field['fullField'] %}
	{% if $$field.Type == 'caption' %}
		<td class="table-form-title" colspan="2">{$field.Value|escape}</td>
	{elseif $field.Type == 'datetime'}
		<td class="table-form-title" >{$lang.db.$fullField}{% if $$field.Null != 'YES' %}*{% endif %}:</td><td class="table-form-field" >{html_select_date time=$field.value prefix="CONDATETIME_`$field.fullField`_"} - {html_select_time time=$field.value prefix="CONDATETIME_`$field.fullField`_"}</td>
	{elseif $field.Type == 'text'}
		<td class="table-form-title" >{$lang.db.$fullField}{% if $$field.Null != 'YES' %}*{% endif %}:</td><td class="table-form-field" ><textarea class="fld-form-input" name="{{ $field['fullField'] }}">{$field.value|escape}</textarea></td>
	{elseif $field.Type == 'enum'}
		<td class="table-form-title" >{$lang.db.$fullField}{% if $$field.Null != 'YES' %}*{% endif %}:</td>
		<td class="table-form-field" >
			<select class="fld-form-input" name="{{ $field['fullField'] }}">
				{% if $$field.Null == 'YES' %}<option value=""></option>{% endif %}
				{% foreach from=$field['Type_Enums'] item=enumVal %}
				<option value="{$enumVal.value|escape}"{% if $$enumVal.value == $$field.value %} selected="selected"{% endif %}>{$enumVal.output|escape}</option>
				{% endforeach %}
			</select>
		</td>	
	{elseif $field.Type == 'enum_multi'}
		<td class="table-form-title" >{$lang.db.$fullField}{% if $$field.Null != 'YES' %}*{% endif %}:</td>
		<td class="table-form-field" >
			<select class="fld-form-input" name="{{ $field['fullField'] }}[]" size="5" multiple="multiple">
				{% foreach from=$field['Type_Enums'] item=enumVal %}
				{% set value = $enumVal['value'] %}
				<option value="{{ $enumVal['value'] }}"{% if $$field.value.$$value == 'YES' %} selected="selected"{% endif %}>{$enumVal.output|escape}</option>
				{% endforeach %}
			</select>
		</td>	
	{elseif $field.Type == 'enum_radio'}
		<td class="table-form-title" >{$lang.db.$fullField}{% if $$field.Null != 'YES' %}*{% endif %}:</td>
		<td class="table-form-field" >
			{% if $$field.Null == 'YES' %}<input type="radio" name="{{ $field['fullField'] }}" value="" /><br />{% endif %}
			{% foreach from=$field['Type_Enums'] item=enumVal %}
			<input type="radio" name="{{ $field['fullField'] }}" value="{$enumVal.value|escape}"{% if $$enumVal.value == $$field.value %} checked="checked"{% endif %} />{$enumVal.output|escape}<br />
			{% endforeach %}
		</td>
	{elseif $field.Type == 'pickup'}
		{% set use_pickup = $TRUE %}
		<td class="table-form-title" >{$lang.db.$fullField}{% if $$field.Null != 'YES' %}*{% endif %}:</td>
		<td class="table-form-field" >
			<input type="hidden" name="{{ $field['fullField'] }}" value="{$field.Type_Pickup.value|escape}" />
			<input type="text" disabled="disabled" class="fld-form-input-pickup" name="{{ $field['fullField'] }}_output" value="{$field.Type_Pickup.output|escape}" />
			{% include "generic/link.tpl" onclick="javascript: t = window.open(" content=lang %}
			{% if $$field.Null == 'YES' %}{% include "generic/link.tpl" onclick="javascript: `$field.fullField`.value = " content=lang %}{% endif %}
		</td>	
	{elseif $field.Type == 'pickup_multi'}
		{% set use_pickup = $TRUE %}
		<td class="table-form-title" >{$lang.db.$fullField}{% if $$field.Null != 'YES' %}*{% endif %}:</td>
		<td class="table-form-field" >
			<select class="fld-form-input" name="{{ $field['fullField'] }}[]" size="5" multiple="multiple">
				{% foreach from=$field['Type_Pickup'] item=pickupVal %}
				{% set value = $pickupVal['value'] %}
				<option value="{$pickupVal.value|escape}" selected="selected">{$pickupVal.output|escape}</option>
				{% endforeach %}
			</select>
			{% include "generic/link.tpl" onclick="javascript: t = window.open(" content=lang %}
			{% include "generic/link.tpl" onclick="javascript: remove_selected(window.document.`$extra_data.FORM_NAME`.elements[" content=lang %}
		</td>	
	{elseif $field.Field|truncate:8:"":true == 'password'}
		<td class="table-form-title">{$lang.db.$fullField}{% if $$field.Null != 'YES' %}*{% endif %}:</td><td class="table-form-field" ><input class="fld-form-input" name="{{ $field['fullField'] }}" type="password" value="{$field.value|escape}" /></td>
	{% else %}
		<td class="table-form-title">{$lang.db.$fullField}{% if $$field.Null != 'YES' %}*{% endif %}:</td>
		<td class="table-form-field" >
		{% if $$field.Compare != '' %}
			<table class="table-main" cellpadding="0" cellspacing="0"><tr><td>
			<select name="{{ $field['fullField'] }}_compare">
				{% if $$field.Compare == 'full' || $$field.Compare == 'numeric' %}
				<option value="equal"{% if $$field.Compare_value == 'equal' %} selected="selected"{% endif %}>{{ $lang['compare_equal'] }}</option>
				<option value="greater_equal"{% if $$field.Compare_value == 'greater_equal' %} selected="selected"{% endif %}>{{ $lang['compare_greater_equal'] }}</option>
				<option value="less_equal"{% if $$field.Compare_value == 'less_equal' %} selected="selected"{% endif %}>{{ $lang['compare_less_equal'] }}</option>
				<option value="greater"{% if $$field.Compare_value == 'greater' %} selected="selected"{% endif %}>{{ $lang['compare_greater'] }}</option>
				<option value="less"{% if $$field.Compare_value == 'less' %} selected="selected"{% endif %}>{{ $lang['compare_less'] }}</option>
				{% endif %}
				{% if $$field.Compare == 'full' || $$field.Compare == 'text' %}
				<option value="starts_with"{% if $$field.Compare_value == 'starts_with' %} selected="selected"{% endif %}>{{ $lang['compare_starts_with'] }}</option>
				<option value="ends_with"{% if $$field.Compare_value == 'ends_with' %} selected="selected"{% endif %}>{{ $lang['compare_ends_with'] }}</option>
				<option value="contains"{% if $$field.Compare_value == 'contains' %} selected="selected"{% endif %}>{{ $lang['compare_contains'] }}</option>
				{% endif %}
			</select>
			</td><td width="100%">
		{% endif %}
		<input class="fld-form-input" name="{{ $field['fullField'] }}" type="text" value="{$field.value|escape}" />
		{% if $$field.Compare != '' %}</td></tr></table>{% endif %}
		</td>
	{% endif %}
	</tr>
{% endforeach %}
<tr><td class="table-form-submit" colspan="2"><input class="fld-form-submit" type="submit" name="submit" value="{{ $lang['submit'] }}" /></td></tr>
</table>
</form>
{% if $$use_pickup == TRUE %}<script language="JavaScript" type="text/javascript" src="{{ $js_dir }}pickup.js"></script>{% endif %}