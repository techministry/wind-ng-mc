{* WiND - Modern Material Theme Table *}
{if $extra_data.MULTICHOICE[1] != ''}
<form name="{$extra_data.FORM_NAME}" method="post">
<input type="hidden" name="query_string" value="{$hidden_qs}" />
<input type="hidden" name="form_name" value="{$extra_data.FORM_NAME}" />
{/if}
<table class="mdc-data-table__table" style="width:100%;border-collapse:collapse;border-radius:8px;overflow:hidden;box-shadow:var(--md-shadow);">
{section name=row loop=$data}
  {if $smarty.section.row.index == 0 }
    <tr class="mdc-data-table__header-row" style="background:var(--md-primary);color:#fff;font-weight:600;">
      {foreach key=key item=itm from=$data[row]}
        {assign var="fullkey" value=$data.0.$key}
        {assign var="label" value=$lang.db.$itm}
        <td class="mdc-data-table__cell" style="padding:12px 14px;">{if $label != ''}{$label}{else}{$itm}{/if}</td>
      {/foreach}
    </tr>
  {else}
    <tr class="mdc-data-table__row" style="background:{cycle values='#f8f9fb,#ffffff'};">
      {foreach key=key item=itm from=$data[row]}
        {assign var="fullkey" value=$data.0.$key}
        <td class="mdc-data-table__cell" style="padding:12px 14px;">{$itm}</td>
      {/foreach}
    </tr>
  {/if}
{/section}
</table>
{if $extra_data.MULTICHOICE[1] != ''}
  <div style="margin-top:12px;text-align:right;">
    <button type="submit" class="button" style="padding:10px 18px;">{$extra_data.MULTICHOICE_LABEL|default:'Submit'}</button>
  </div>
</form>
{/if}
