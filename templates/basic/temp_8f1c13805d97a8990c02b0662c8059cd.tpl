{*
 * WiND - Wireless Nodes Database
 * Copyright (C) 2005-2014 by WiND Contributors
 * This program is free software
 *}

<div class="form-bs">
<form class="form-horizontal" name="{{ $extra_data['FORM_NAME'] }}" method="post" action="{{ $action_url }}">
<input type="hidden" name="form_name" value="{{ $extra_data['FORM_NAME'] }}" />
{% foreach from=$data item=_item key=d %}
	<div class="form-entry form-group">
	{% set fullField = $data[d].fullField %}
	<label class="control-label col-sm-3">{$lang.db.$fullField}{% if $$data[d].Null != 'YES' %}*{% endif %}:</label>
	<div class="col-sm-9">
	{% if $$data[d].Type == 'caption' %}
		{$data[d].Value|escape}
	{elseif $data[d].Type == 'datetime'}
		{html_select_date time="`$data[d].value`" prefix="CONDATETIME_`$data[d].fullField`_"} - {html_select_time time="`$data[d].value`" prefix="CONDATETIME_`$data[d].fullField`_"}
	{elseif $data[d].Type == 'text'}
		<textarea class="form-control" name="{{ $data[d].fullField }}">{$data[d].value|escape}</textarea>
	{elseif $data[d].Type == 'enum'}
		<select class="form-control" name="{{ $data[d].fullField }}">
			{% if $$data[d].Null == 'YES' %}<option value="">---</option>{% endif %}
			{% foreach from=$data[d].Type_Enums item=_item key=e %}
			<option value="{$data[d].Type_Enums[e].value|escape}"{% if $$data[d].Type_Enums[e].value == $$data[d].value %} selected="selected"{% endif %}>{% include "constructors/form_enum.tpl" fullField=fullField value=data %}</option>
			{% endforeach %}
		</select>
	{elseif $data[d].Type == 'enum_radio'}
		{% if $$data[d].Null == 'YES' %}<input type="radio" name="{{ $data[d].fullField }}" value="" /><br />{% endif %}
		{% foreach from=$data[d].Type_Enums item=_item key=e %}
			<input type="radio" name="{{ $data[d].fullField }}" value="{$data[d].Type_Enums[e].value|escape}"{% if $$data[d].Type_Enums[e].value == $$data[d].value %} checked="checked"{% endif %} />{% include "constructors/form_enum.tpl" fullField=fullField value=data %}<br />
		{% endforeach %}
	{elseif $data[d].Field|truncate:8:"":true == 'password'}
		<input class="form-control" name="{{ $data[d].fullField }}" type="password" value="{$data[d].value|escape}" />
	{% else %}
		<input class="form-control" name="{{ $data[d].fullField }}" type="text" value="{$data[d].value|escape}" />
	{% endif %}
	</div>
	</div>
{% endforeach %}
<div class="buttons">
<button class="btn btn-primary submit" type="submit">{{ $lang['submit'] }}</button>
</div>
</form>
</div>
