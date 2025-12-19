{* WiND Modern Material Theme Node Info *}
<div class="card elevation-1" style="margin-bottom:24px;">
  <table style="width:100%;border:none;background:transparent;">
    <tr>
      <th style="width:180px;color:var(--md-text-primary);font-weight:600;background:#f0f4ff;">{$lang.db.nodes__id}</th>
      <td>{$node.id}</td>
    </tr>
    <tr>
      <th style="color:var(--md-text-primary);font-weight:600;background:#f0f4ff;">{$lang.db.nodes__name}</th>
      <td>{$node.name|escape}</td>
    </tr>
    <tr>
      <th style="color:var(--md-text-primary);font-weight:600;background:#f0f4ff;">{$lang.db.areas__name}</th>
      <td>{$node.area_name|escape}</td>
    </tr>
    <tr>
      <th style="color:var(--md-text-primary);font-weight:600;background:#f0f4ff;">{$lang.db.regions__name}</th>
      <td>{$node.region_name|escape}</td>
    </tr>
    <tr>
      <th style="color:var(--md-text-primary);font-weight:600;background:#f0f4ff;">{$lang.community}</th>
      <td>
        <a class="material-icons" style="color:var(--md-accent);text-decoration:none;vertical-align:middle;" title="{$lang.more_about_community}" href="../wiki/{$node.community_name|escape}">groups</a>
        <span style="margin-left:8px;">{$node.community_name|escape}</span>
      </td>
    </tr>
    {if $node.community_name!='WNA'}
    <tr>
      <th style="color:var(--md-text-primary);font-weight:600;background:#f0f4ff;">Local Community node page</th>
      <td>
        <a style="color:var(--md-primary);text-decoration:underline;" target="_blank" href="{$node.community_windURL}/?page=nodes&node={$node.com_wind_id}">{$node.com_wind_id}</a>
      </td>
    </tr>
    {/if}
    <tr>
      <th style="color:var(--md-text-primary);font-weight:600;background:#f0f4ff;">{$lang.db.nodes__date_in}</th>
      <td>{$node.date_in|date_format:"%x"}</td>
    </tr>
    {if $is_admin}
    <tr>
      <th style="color:var(--md-text-primary);font-weight:600;background:#f0f4ff;">ãà???? Internet {$lang.db.nodes__internetaccess}</th>
      <td>{$node.internetaccess|escape}</td>
    </tr>
    <tr>
      <th style="color:var(--md-text-primary);font-weight:600;background:#f0f4ff;">ã?????? Internet {$lang.db.nodes__internetprovider}</th>
      <td>{$node.internetprovider|escape}</td>
    </tr>
    {/if}
    <tr>
      <th style="color:var(--md-text-primary);font-weight:600;background:#f0f4ff;">{$lang.db.user_id_owner}</th>
      <td>
        <a href="/forum/userinfo.php?username={$node.owner_username}">{$node.owner_username|escape} (contact)</a>
        | <a href="/forum/searchnodes.php?username={$node.owner_username}">Other nodes</a>
      </td>
    </tr>
  </table>
</div>
