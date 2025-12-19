{* WiND - Modern Theme - Communities List *}
{include file="generic/page-title.tpl" title=$lang.communities}
<div class="mdc-card mdc-card--outlined table-card" style="margin:24px auto;max-width:1100px;padding:16px 24px 20px 24px;">
  <div class="card-header">
    <div>
      <div class="mdc-typography--headline6" style="margin:0;">{$lang.communities_registered}</div>
      <div class="mdc-typography--body2" style="color:var(--md-text-secondary);margin-top:4px;">
        {$lang.communities} across the network.
      </div>
    </div>
  </div>
  <div class="table-wrapper scroll-shadow">
    {$table_communities}
  </div>
</div>
