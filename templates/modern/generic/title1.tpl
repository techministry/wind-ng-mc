{* WiND - Modern Material Theme - Title1 *}
<div class="mdc-typography--subtitle1" style="margin: 16px 0 8px 0;display:flex;align-items:center;gap:12px;">
  <span>{$title}</span>
  {if $right != ''}<span style="margin-left:auto;">{$right}</span>{/if}
</div>
<div class="mdc-card mdc-card--outlined" style="padding: 0;">
  {$content}
</div>