{* WiND - Modern Material Theme Form *}
{assign var=use_pickup value=false}
{assign var="form_action" value=$action_url|default:"?`$hidden_qs`"}
<form name="{$extra_data.FORM_NAME}" method="post" action="{$form_action}">
<input type="hidden" name="form_name" value="{$extra_data.FORM_NAME}" />
<input type="hidden" name="query_string" value="{$hidden_qs|escape}" />
<table class="mdc-data-table__table" style="width:100%;border-collapse:collapse;">
{assign var=row_num value=1}
{foreach from=$data item=field}
  {assign var=req_attr value=""}
  {assign var=force_required value=false}
  {if $field.Field|substr:0:8 == 'password'}{assign var=force_required value=true}{/if}
  {if $field.Null != 'YES' || $force_required}{assign var=req_attr value='required'}{/if}
  {assign var=fullField value=$field.fullField}
  <tr class="mdc-data-table__row">
    <td class="mdc-data-table__cell" style="font-weight:500;">{$lang.db.$fullField}{if $field.Null != 'YES' || $force_required}*{/if}:</td>
    <td class="mdc-data-table__cell">
      {if $field.Type == 'caption'}
        {$field.Value|escape}
      {elseif $field.Type == 'datetime'}
        {html_select_date time=$field.value prefix="CONDATETIME_`$field.fullField`_"} - {html_select_time time=$field.value prefix="CONDATETIME_`$field.fullField`_"}
      {elseif $field.Type == 'text'}
        <textarea class="mdc-text-field__input" name="{$field.fullField}" {$req_attr}>{$field.value|escape}</textarea>
      {elseif $field.Type == 'enum'}
        <select class="mdc-select__native-control" name="{$field.fullField}" {$req_attr}>
          {if $field.Null == 'YES'}<option value="">---</option>{/if}
          {foreach from=$field.Type_Enums item=enum}
            <option value="{$enum.value|escape}"{if $enum.value == $field.value} selected="selected"{/if}>
              {include file="constructors/form_enum.tpl" fullField=$fullField value=$enum.output}
            </option>
          {/foreach}
        </select>
      {elseif $field.Type == 'enum_multi'}
        <select class="mdc-select__native-control" name="{$field.fullField}[]" size="5" multiple="multiple" {$req_attr}>
          {foreach from=$field.Type_Enums item=enum}
            {assign var="value" value=$enum.value}
            <option value="{$enum.value|escape}"{if $field.value.$value == 'YES'} selected="selected"{/if}>
              {include file="constructors/form_enum.tpl" fullField=$fullField value=$enum.output}
            </option>
          {/foreach}
        </select>
      {elseif $field.Type == 'pickup'}
        {assign var=use_pickup value=true}
        <input type="hidden" name="{$field.fullField}" value="{$field.Type_Pickup.value|escape}" />
        <input class="mdc-text-field__input" type="text" disabled="disabled" name="{$field.fullField}_output" value="{$field.Type_Pickup.output|escape}" />
        <div>
          <a href="javascript: t = window.open('{$field.Pickup_url}', 'popup_pickup', 'width=700,height=600,toolbar=0,resizable=1,scrollbars=1'); t.focus(); return false;">[{$lang.select}]</a>
          {if $field.Null == 'YES'}
            <a href="javascript: document.{$extra_data.FORM_NAME}.elements['{$field.fullField}'].value = ''; document.{$extra_data.FORM_NAME}.elements['{$field.fullField}_output'].value = ''; return false;">[{$lang.clear}]</a>
          {/if}
        </div>
      {elseif $field.Type == 'pickup_multi'}
        {assign var=use_pickup value=true}
        <select class="mdc-select__native-control" name="{$field.fullField}[]" size="5" multiple="multiple">
          {foreach from=$field.Type_Pickup item=pickupVal}
            <option value="{$pickupVal.value|escape}" selected="selected">{$pickupVal.output|escape}</option>
          {/foreach}
        </select>
        <div>
          <a href="javascript: t = window.open('{$field.Pickup_url}', 'popup_pickup', 'width=700,height=600,toolbar=0,resizable=1,scrollbars=1'); t.focus(); return false;">[{$lang.add}]</a>
          <a href="javascript: remove_selected(document.{$extra_data.FORM_NAME}.elements['{$field.fullField}[]']); return false;">[{$lang.remove}]</a>
        </div>
      {elseif $field.Field|substr:0:8 == 'password'}
        <input class="mdc-text-field__input" type="password" name="{$field.fullField}" value="{$field.value|escape}" autocomplete="current-password" {$req_attr} />
      {else}
        <input class="mdc-text-field__input" type="text" name="{$field.fullField}" value="{$field.value|escape}" {$req_attr} />
      {/if}
    </td>
  </tr>
  {assign var=row_num value=$row_num+1}
{/foreach}
</table>
  <div style="text-align:left; margin-bottom:8px; color:#1976d2; font-size:0.85rem;">
    <span>Χρησιμοποιήστε τα ίδια στοιχεία σύνδεσης με το <b>wna.gr</b>.</span><br>
    <span>Please use the same credentials as <b>wna.gr</b>.</span>
  </div>
</div>
<div style="margin-top:12px;text-align:right;">
  <button type="submit" class="button">{$extra_data.SUBMIT_LABEL|default:$lang.submit}</button>
</div>
</form>
{if $use_pickup}<script type="text/javascript" src="{$js_dir}pickup.js"></script>{/if}
