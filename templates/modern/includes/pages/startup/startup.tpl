{* WiND Modern Theme - Startup with Map *}
{include file="generic/page-title.tpl" title=$lang.welcome}
{if $startup_html != ''}
  <div class="card elevation-1" style="margin-bottom:16px;padding:12px 16px;">
    {$startup_html}
  </div>
{/if}

{if $gmap_key_ok}
  <div class="card elevation-2" style="padding:12px; margin-bottom:24px; position:relative;">
    <div style="display:flex;justify-content:flex-end;align-items:center;margin-bottom:8px;padding:0 4px;">
      {include file="generic/link.tpl" link=$link_fullmap content=$lang.new_window target="_blank"}
    </div>
    <div class="card elevation-1" style="position:absolute; bottom:16px; left:16px; z-index:1000; padding:8px 12px; display:flex; gap:12px; align-items:center; background:rgba(255,255,255,0.85); border-radius:6px;">
      <label style="display:flex;align-items:center;gap:6px;font-size:14px;"><input type="checkbox" name="p2p" checked onclick="gmap_refresh()"> {$lang.backbone|default:'Backbone'}</label>
      <label style="display:flex;align-items:center;gap:6px;font-size:14px;"><input type="checkbox" name="aps" checked onclick="gmap_refresh()"> {$lang.aps|default:'APs'}</label>
      <label style="display:flex;align-items:center;gap:6px;font-size:14px;"><input type="checkbox" name="clients" checked onclick="gmap_refresh()"> {$lang.clients|default:'Clients'}</label>
      <label style="display:flex;align-items:center;gap:6px;font-size:14px;"><input type="checkbox" name="unlinked" onclick="gmap_refresh()"> {$lang.unlinked|default:'Unlinked'}</label>
    </div>
    <div id="map" style="width:100%; height:500px; border-radius:8px; overflow:hidden;"></div>
  </div>
{else}
  <div class="card elevation-1" style="padding:12px; color:var(--md-error);">{$lang.message.error.gmap_key_failed.body|wordwrap:40|nl2br}</div>
{/if}
