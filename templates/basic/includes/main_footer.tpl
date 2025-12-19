{*
 * WiND - Wireless Nodes Database - Basic Footer
 * Simplified footer with theme selector
 *}
<div style="margin-top:16px;padding:12px;border:1px solid #e0e0e0;border-radius:6px;background:#fff;text-align:center;font-size:13px;color:#444;">
  <div style="margin-bottom:6px;">
    &copy; 2005-2025 <a href="http://www.wna.gr/trac/wiki/wind-wna/Team">WiND development team</a>
    &middot; PHP: {$php_time|round:3}s &middot; MySQL: {$mysql_time|round:3}s
    {if $debug_mysql}&middot; <a href="{$debug_mysql}" target="debug">Debug</a>{/if}
  </div>
  <div style="display:flex;justify-content:center;gap:12px;align-items:center;flex-wrap:wrap;">
    {if $available_themes|@count > 1}
      <label for="themeSwitcherBasic" style="font-weight:bold;">Theme:</label>
      <select id="themeSwitcherBasic" onchange="javascript: var p=new URLSearchParams(window.location.search); p.set('theme', this.value); window.location.search = p.toString();" style="margin-left:6px;padding:4px 8px;">
        {foreach from=$available_themes item=theme}
          <option value="{$theme}" {if $theme == $current_theme}selected="selected"{/if}>{$theme|capitalize}</option>
        {/foreach}
      </select>
    {/if}
    <label for="colorSchemeBasic" style="font-weight:bold;">Style:</label>
    <select id="colorSchemeBasic" style="margin-left:6px;padding:4px 8px;">
      <option value="light">Light</option>
      <option value="dark">Dark</option>
    </select>
  </div>
</div>
{literal}
<script>
  (function() {
    // Fallback helpers if head script failed to load for any reason
    function ensureHelpers() {
      if (!window.getSiteTheme) {
        window.getSiteTheme = function() { return 'light'; };
      }
      if (!window.setSiteTheme) {
        window.setSiteTheme = function(theme) {
          var dark = document.getElementById('dark-theme-css');
          if (theme === 'dark') {
            if (dark) dark.disabled = false;
          } else {
            if (dark && dark.parentNode) dark.parentNode.removeChild(dark);
          }
        };
      }
    }

    function initSelector() {
      var sel = document.getElementById('colorSchemeBasic');
      if (!sel) return;
      ensureHelpers();
      sel.value = window.getSiteTheme();
      sel.addEventListener('change', function() {
        window.setSiteTheme(sel.value);
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initSelector);
    } else {
      initSelector();
    }
  })();
</script>
{/literal}
