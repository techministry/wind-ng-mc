{* WiND Modern Material Theme Footer *}
<footer class="card elevation-1" style="margin-top:32px;text-align:center;padding:16px 12px;color:var(--md-text-secondary);font-size:0.95rem;display:flex;flex-wrap:wrap;align-items:center;justify-content:center;gap:12px;">
  <span style="flex:1 1 auto;text-align:center;">&copy; {"now"|date_format:"%Y"} WiND - Wireless Nodes Database. All rights reserved.</span>
  {if $available_themes|@count > 1}
  <div style="display:flex;align-items:center;gap:6px;">
    <label for="themeSwitcher" style="font-size:0.9rem;color:var(--md-text-secondary);">Theme:</label>
    <select id="themeSwitcher" style="padding:6px 10px;border:1px solid var(--md-border);border-radius:6px;background:#fff;color:var(--md-text-primary);">
      {foreach from=$available_themes item=theme}
        <option value="{$theme}" {if $theme == $current_theme}selected{/if}>{$theme|capitalize}</option>
      {/foreach}
    </select>
  </div>
  {/if}
  {if isset($languages) && $languages|@count > 1}
  <div style="display:flex;align-items:center;gap:6px;">
    <label for="langSwitcher" style="font-size:0.9rem;color:var(--md-text-secondary);">{$lang.db.users__language|default:'Language'}:</label>
    <select id="langSwitcher" style="padding:6px 10px;border:1px solid var(--md-border);border-radius:6px;background:#fff;color:var(--md-text-primary);">
      {foreach from=$languages key=lang_key item=lang_item}
        <option value="{$lang_key}"{if isset($current_language) && $lang_key == $current_language} selected{/if}>{$lang_item.name|escape}</option>
      {/foreach}
    </select>
  </div>
  {/if}
</footer>
{if $available_themes|@count > 1}
{literal}
<script>
  (function() {
    var sel = document.getElementById('themeSwitcher');
    if (!sel) return;
    sel.addEventListener('change', function() {
      var params = new URLSearchParams(window.location.search);
      params.set('theme', sel.value);
      window.location.search = params.toString();
    });
  })();
</script>
{/literal}
{/if}
{if isset($languages) && $languages|@count > 1}
{literal}
<script>
  (function() {
    var sel = document.getElementById('langSwitcher');
    if (!sel) return;
    sel.addEventListener('change', function() {
      var value = sel.value;
      if (!value) return;
      var params = new URLSearchParams(window.location.search);
      params.delete('lang');
      params.set('session_lang', value);
      window.location.search = params.toString();
    });
  })();
</script>
{/literal}
{/if}
