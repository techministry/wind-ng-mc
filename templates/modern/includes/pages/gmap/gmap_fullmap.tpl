{* WiND - Modern Theme - Full Map *}
<div class="card elevation-2" style="padding:16px; margin-bottom:16px; position:relative;">
  <div class="card elevation-1" style="position:absolute; bottom:16px; left:16px; z-index:1000; padding:8px 12px; display:flex; gap:12px; align-items:center; flex-wrap:wrap; background:rgba(255,255,255,0.85); border-radius:6px;">
    <label style="display:flex;align-items:center;gap:6px;font-size:14px;"><input type="checkbox" name="p2p" checked onclick="gmap_refresh()"> {$lang.backbone|default:'Backbone'}</label>
    <label style="display:flex;align-items:center;gap:6px;font-size:14px;"><input type="checkbox" name="aps" checked onclick="gmap_refresh()"> {$lang.aps|default:'APs'}</label>
    <label style="display:flex;align-items:center;gap:6px;font-size:14px;"><input type="checkbox" name="clients" checked onclick="gmap_refresh()"> {$lang.clients|default:'Clients'}</label>
    <label style="display:flex;align-items:center;gap:6px;font-size:14px;"><input type="checkbox" name="unlinked" onclick="gmap_refresh()"> {$lang.unlinked|default:'Unlinked'}</label>
    {if $community_sources|@count gt 0}
    <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;border-left:1px solid rgba(0,0,0,0.08);padding-left:10px;">
      <span style="font-weight:600;font-size:13px;">{$lang.communities|default:'Communities'}:</span>
      {foreach from=$community_sources item=community}
      <label style="display:flex;align-items:center;gap:6px;font-size:13px;white-space:nowrap;"{if $community.windURL} title="{$community.windURL|escape}"{/if}>
        <input type="checkbox" data-community-id="{$community.id}"{if $community.default_enabled} checked="checked"{/if} onclick="gmap_refresh()"> {$community.name|escape}
      </label>
      {/foreach}
    </div>
    {/if}
  </div>
  <div id="map" style="width:100%; height:70vh; border-radius:8px; overflow:hidden;"></div>
</div>
