{* WiND - Wireless Nodes Database *}
{* Modern Material Theme - Admin Communities *}
<div class="mdc-card mdc-card--outlined" style="margin: 24px auto; max-width: 900px;">
  <div class="mdc-card__primary-action" tabindex="0">
    <div class="mdc-typography--headline6" style="padding: 24px 24px 0 24px;">
      <span class="material-icons mdc-theme--primary" style="vertical-align: middle;">groups</span>
      {$lang.admin_panel} &gt; {$lang.communities}
    </div>
    <div style="padding: 0 24px 16px 24px;">
      <a href="{$link_communities_add}" class="mdc-button mdc-button--raised mdc-theme--secondary" style="margin: 12px 0;">
        <span class="material-icons mdc-button__icon" aria-hidden="true">add</span>
        {$lang.communities_add}
      </a>
      <div class="mdc-typography--subtitle2" style="margin-bottom: 8px;">{$lang.communities}</div>
      <div>{$table_communities}</div>
    </div>
  </div>
</div>
