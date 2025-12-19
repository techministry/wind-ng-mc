{* WiND - Modern Theme - Admin Nodes *}
{include file="generic/page-title.tpl" title="`$lang.admin_panel` > `$lang.nodes`"}
<div class="mdc-card mdc-card--outlined" style="margin: 24px auto; max-width: 900px;">
  <div class="mdc-card__primary-action" tabindex="0">
    <div class="mdc-typography--headline6" style="padding: 24px 24px 0 24px;">
      <span class="material-icons mdc-theme--primary" style="vertical-align: middle;">device_hub</span>
      {$lang.admin_panel} &gt; {$lang.nodes}
    </div>
    <div style="padding: 0 24px 16px 24px;">
      {include file="generic/title1.tpl" title="`$lang.nodes_search`" content=$form_search_nodes}
      {include file="generic/title2.tpl" title="`$lang.nodes_found`" content=$table_nodes}
    </div>
  </div>
</div>
