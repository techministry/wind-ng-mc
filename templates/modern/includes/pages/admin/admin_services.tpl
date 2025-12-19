{* WiND - Modern Theme - Admin Services *}
{include file="generic/page-title.tpl" title="`$lang.admin_panel` > `$lang.services_categories`"}
<div class="mdc-card mdc-card--outlined" style="margin: 24px auto; max-width: 900px;">
  <div class="mdc-card__primary-action" tabindex="0">
    <div class="mdc-typography--headline6" style="padding: 24px 24px 0 24px;">
      <span class="material-icons mdc-theme--primary" style="vertical-align: middle;">build</span>
      {$lang.admin_panel} &gt; {$lang.services_categories}
    </div>
    <div style="padding: 0 24px 16px 24px;">
      {include assign="t1" file="generic/link.tpl" link=$link_services_categories_add content="`$lang.services_categories_add`"}
      {include file="generic/title2.tpl" title="`$lang.services_categories` $t1" content=$table_services}
    </div>
  </div>
</div>
