{* WiND - Modern Material Theme Form *}
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
<div style="margin-top:12px;text-align:right;">
  <button type="submit" class="button">{$extra_data.SUBMIT_LABEL|default:$lang.submit}</button>
</div>
</form>
