{* WiND - Modern Theme - Full Map *}
<div class="card elevation-2" style="padding:16px; margin-bottom:16px; position:relative;">
  <div class="card elevation-1" style="position:absolute; bottom:16px; left:16px; z-index:1000; padding:8px 12px; display:flex; gap:12px; align-items:center; background:rgba(255,255,255,0.85); border-radius:6px;">
    <label style="display:flex;align-items:center;gap:6px;font-size:14px;"><input type="checkbox" name="p2p" checked onclick="gmap_refresh()"> {$lang.backbone|default:'Backbone'}</label>
    <label style="display:flex;align-items:center;gap:6px;font-size:14px;"><input type="checkbox" name="aps" checked onclick="gmap_refresh()"> {$lang.aps|default:'APs'}</label>
    <label style="display:flex;align-items:center;gap:6px;font-size:14px;"><input type="checkbox" name="clients" checked onclick="gmap_refresh()"> {$lang.clients|default:'Clients'}</label>
    <label style="display:flex;align-items:center;gap:6px;font-size:14px;"><input type="checkbox" name="unlinked" onclick="gmap_refresh()"> {$lang.unlinked|default:'Unlinked'}</label>
  </div>
  <div id="map" style="width:100%; height:70vh; border-radius:8px; overflow:hidden;"></div>
</div>
