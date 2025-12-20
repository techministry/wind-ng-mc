{* WiND Modern Theme - Node View Photos *}
{if $photosview|@count > 0}
<div class="card elevation-1" style="margin-bottom:16px;">
  <h3 style="color:var(--md-primary);font-size:1.1rem;font-weight:500;margin:0 0 12px 0;">{$lang.myview}</h3>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:8px;justify-items:center;align-items:center;">
    <div>{include file="generic/photosview_image.tpl" image=$photosview.NW}</div>
    <div>{include file="generic/photosview_image.tpl" image=$photosview.N}</div>
    <div>{include file="generic/photosview_image.tpl" image=$photosview.NE}</div>
    <div>{include file="generic/photosview_image.tpl" image=$photosview.W}</div>
    <div><img src="{$img_dir}compass.png" alt="Compass" style="max-width:72px;opacity:0.8;"></div>
    <div>{include file="generic/photosview_image.tpl" image=$photosview.E}</div>
    <div>{include file="generic/photosview_image.tpl" image=$photosview.SW}</div>
    <div>{include file="generic/photosview_image.tpl" image=$photosview.S}</div>
    <div>{include file="generic/photosview_image.tpl" image=$photosview.SE}</div>
  </div>
  {if $photosview.PANORAMIC}
    <div style="margin-top:12px;text-align:center;">
      <div style="font-weight:600;color:var(--md-text-secondary);margin-bottom:6px;">
        {$lang.db.photos__view_point-PANORAMIC|default:'Panoramic'}
      </div>
      {include file="generic/photosview_image.tpl" image=$photosview.PANORAMIC}
    </div>
  {/if}
</div>
{/if}
