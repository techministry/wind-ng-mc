{* WiND Modern Material Theme Header *}
<header class="card elevation-2" style="display:flex;align-items:center;gap:16px;justify-content:space-between;flex-wrap:wrap;">
  <a href="?page=startup" style="display:flex;align-items:center;gap:12px;text-decoration:none;">
    <img src="templates/modern/images/main_logo.png" alt="WiND Logo" style="height:48px;">
    <span style="font-size:2rem;font-weight:500;color:var(--md-primary);font-family:'Roboto',Arial,sans-serif;">WiND</span>
  </a>
  <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;justify-content:flex-end;">
    <nav style="display:flex;gap:12px;flex-wrap:wrap;justify-content:flex-end;">
      <a href="?page=nodes" class="button material-icons" title="Nodes">dns</a>
      <a href="?page=communities" class="button material-icons" title="Communities">groups</a>
      <a href="?page=services" class="button material-icons" title="Services">settings</a>
      {if $logged}
        <a href="?page=admin&subpage=users" class="button material-icons" title="Admin Users">person</a>
        <a href="?page=admin&subpage=nodes" class="button material-icons" title="Admin Nodes">device_hub</a>
        <a href="?page=admin&subpage=services" class="button material-icons" title="Admin Services">build</a>
        <a href="?page=admin&subpage=site" class="button material-icons" title="Site Config">admin_panel_settings</a>
      {else}
        <button type="button" class="button" data-login-open>
          <span class="material-icons" aria-hidden="true" style="font-size:20px;vertical-align:middle;margin-right:6px;">login</span>
          {$lang.log_in}
        </button>
      {/if}
    </nav>
    {if $logged}
      <div style="display:flex;align-items:center;gap:8px;padding-left:8px;border-left:1px solid var(--md-border);">
        <span style="font-weight:500;color:var(--md-text-secondary);">{$logged_username}</span>
        <a href="{$link_logged_profile}" class="button material-icons" title="Profile" style="padding:8px 12px;">account_circle</a>
        <form id="logout-form" action="?" method="get" style="display:none;">
          <input type="hidden" name="page" value="users" />
          <input type="hidden" name="action" value="logout" />
          <input type="hidden" name="redirect" value="?page=gmap" />
          <input type="hidden" name="ts" value="{$smarty.now}" />
        </form>
        <a id="logout-btn" href="{$link_logout}" class="button material-icons" title="Log out" style="padding:8px 12px;background:#e53935;">logout</a>
      </div>
    {/if}
  </div>
</header>
{literal}
<script>
  (function() {
    var btn = document.getElementById('logout-btn');
    var form = document.getElementById('logout-form');
    if (!btn) return;
    // Force full navigation and avoid cached redirects; submit via hidden form to ensure GET hits server
    btn.addEventListener('click', function (e) {
      // let middle-click etc. behave normally
      if (e.button !== 0 || e.metaKey || e.ctrlKey) return;
      e.preventDefault();
      if (form) {
        var tsField = form.querySelector('input[name="ts"]');
        if (tsField) tsField.value = Date.now();
        form.submit();
      } else {
        var url = new URL(btn.href, window.location.origin);
        url.searchParams.set('ts', Date.now());
        window.location.replace(url.toString());
      }
    });
  })();
</script>
{/literal}
