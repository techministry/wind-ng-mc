{* WiND Modern Material Theme - Node View *}
<div class="card elevation-2" style="margin-bottom:24px;">
  <h2 style="color:var(--md-primary);font-family:'Roboto',Arial,sans-serif;font-weight:500;">{$lang.node} {$node.name} (#{$node.id})</h2>
  <nav style="margin-bottom:16px;">
    <ul style="display:flex;gap:12px;list-style:none;padding:0;margin:0;flex-wrap:wrap;">
      <li><a href="#tab_generic" class="button material-icons">info</a></li>
      <li><a href="#tab_links" class="button material-icons">link</a></li>
      <li><a href="#tab_mynetwork" class="button material-icons">network_wifi</a></li>
      <li><a href="#tab_service" class="button material-icons">miscellaneous_services</a></li>
      <li><a href="#tab_view" class="button material-icons">visibility</a></li>
      <li><a href="#tab_Logs" class="button material-icons">history</a></li>
      {if $is_admin}
      <li><a href="/forum" class="button material-icons">admin_panel_settings</a></li>
      {/if}
    </ul>
  </nav>
  <div id="tab_generic">
    {include file="includes/pages/nodes/node_info.tpl"}
    <div style="margin:16px 0;">
      {if $edit_node}
        <a href="{$edit_node}" class="button material-icons" style="margin-bottom:8px;">edit</a>
      {/if}
    </div>
    <div class="card elevation-1" style="margin-bottom:16px;">
      <h3 style="color:var(--md-primary);font-size:1.1rem;font-weight:500;margin:0 0 8px 0;">{$lang.db.nodes__info}</h3>
      <div style="color:var(--md-text-secondary);white-space:pre-line;">{$node.info|escape|nl2br}</div>
    </div>

    <div style="text-align:center;margin:24px 0;">
      <a href="#" onclick="window.open('{$link_plot_link}','popup_plot_link','width=600,height=420,toolbar=0,resizable=1,scrollbars=1');return false;" class="button material-icons">alt_route</a>
    </div>

    {if $gmap_key_ok!=="nomap"}
      <div class="card elevation-1" style="margin-bottom:16px;">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;margin-bottom:12px;">
          <div style="display:flex;gap:8px;flex-wrap:wrap;align-items:center;">
            <a href="{$link_gearth}" class="button" style="padding:8px 14px;">Google Earth</a>
            <a href="{$link_fullmap}" target="_blank" class="button" style="padding:8px 14px;">{$lang.new_window}</a>
          </div>
          <span style="color:var(--md-text-secondary);font-size:0.95rem;">{$lang.mynetwork}</span>
        </div>
        {if $gmap_key_ok}
          <div id="map" style="width:100%;height:480px;border-radius:8px;overflow:hidden;border:1px solid var(--md-border);"></div>
          <div style="margin-top:12px;display:flex;gap:16px;align-items:center;flex-wrap:wrap;font-size:0.95rem;">
            <label style="display:flex;align-items:center;gap:6px;color:var(--md-text-primary);font-weight:500;">
              <input type="checkbox" name="p2p" checked="checked" onclick="gmap_refresh();" />
              {html_image file="`$img_dir`gmap/mm_20_orange.png" alt=$lang.backbone}
              {$lang.backbone}
            </label>
            <label style="display:flex;align-items:center;gap:6px;color:var(--md-text-primary);font-weight:500;">
              <input type="checkbox" name="aps" checked="checked" onclick="gmap_refresh();" />
              {html_image file="`$img_dir`gmap/mm_20_green.png" alt=$lang.aps}
              {$lang.aps}
            </label>
            <label style="display:flex;align-items:center;gap:6px;color:var(--md-text-primary);font-weight:500;">
              <input type="checkbox" name="clients" checked="checked" onclick="gmap_refresh();" />
              {html_image file="`$img_dir`gmap/mm_20_blue.png" alt=$lang.clients}
              {$lang.clients}
            </label>
            <label style="display:flex;align-items:center;gap:6px;color:var(--md-text-primary);font-weight:500;">
              <input type="checkbox" name="vpn" checked="checked" onclick="gmap_refresh();" />
              <span style="display:inline-block;width:18px;border-top:2px dotted #000;"></span>
              {$lang.vpn|default:'VPN'}
            </label>
            <label style="display:flex;align-items:center;gap:6px;color:var(--md-text-primary);font-weight:500;">
              <input type="checkbox" name="unlinked" onclick="gmap_refresh();" />
              {html_image file="`$img_dir`gmap/mm_20_red.png" alt=$lang.unlinked}
              {$lang.unlinked}
            </label>
          </div>
        {else}
          <div style="color:var(--md-error);font-weight:500;">{$lang.message.error.gmap_key_failed.body|wordwrap:40|nl2br}</div>
        {/if}
      </div>
    {/if}

    {if $logged==TRUE}
      <div class="card elevation-1" style="margin-bottom:16px;">
        <h4 style="color:var(--md-primary);font-size:1rem;font-weight:500;margin:0 0 8px 0;">{$lang.ip_ranges}</h4>
        {$table_ip_ranges}
      </div>
      <div class="card elevation-1" style="margin-bottom:16px;">
        <h4 style="color:var(--md-primary);font-size:1rem;font-weight:500;margin:0 0 8px 0;">{$lang.dns_zones}</h4>
        {$table_dns}
      </div>
      <div class="card elevation-1" style="margin-bottom:16px;">
        <h4 style="color:var(--md-primary);font-size:1rem;font-weight:500;margin:0 0 8px 0;">{$lang.dns_nameservers}</h4>
        {$table_nameservers}
      </div>
    {else}
      <div class="card elevation-1" style="margin-bottom:16px;">
        <h4 style="color:var(--md-primary);font-size:1rem;font-weight:500;margin:0 0 8px 0;">ãî??åå?çî?à</h4>
        <div style="color:var(--md-text-secondary);">
          â?à ãî??åå?çî?î? ã????í???î? ??à ç?? ??æá? à?ç? ?à ã??ãî? ã??çà ?à <br> å??ëî?î?çî æî ç? ???æà ???åç? ?à? ç?? ??ë??? ã?? ??îçî åç? wna.gr
        </div>
      </div>
    {/if}
  </div>
</div>

<div id="tab_view" class="card elevation-2" style="margin-bottom:24px;">
  {include file="includes/pages/nodes/myview.tpl"}
</div>
