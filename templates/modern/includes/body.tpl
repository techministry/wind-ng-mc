{* WiND Modern Material Theme Body Wrapper *}
<div class="container">
  {include file="includes/main_header.tpl"}
  <main>
    {if isset($message) && $message != ''}
      <div class="card elevation-1" style="margin-bottom:16px;">
        {$message}
      </div>
    {/if}
    {if !$logged}
      <div class="card elevation-2" style="margin-bottom:24px;max-width:520px;margin-left:auto;margin-right:auto;padding:24px;">
        <div class="mdc-typography--headline6" style="margin-bottom:12px;">{$lang.log_in}</div>
        <div>{$form_login}</div>
      </div>
    {/if}
    {$center}
  </main>
  {include file="includes/main_footer.tpl"}
</div>
<div id="page-loader" class="page-loader" aria-label="Loading">
  <div class="page-loader__spinner" role="status"></div>
</div>
{literal}
<script>
  (function() {
    var loader = document.getElementById('page-loader');
    if (!loader) return;
    function showLoader() { loader.style.display = 'flex'; }
    function isSafeLink(a) {
      return a.target === '_blank' || a.hasAttribute('download') || a.href.indexOf('javascript:') === 0;
    }
    window.addEventListener('beforeunload', function() { showLoader(); });
    document.addEventListener('DOMContentLoaded', function() {
      document.addEventListener('click', function(e) {
        var a = e.target.closest('a');
        if (!a || isSafeLink(a)) return;
        showLoader();
      });
      document.addEventListener('submit', function(e) {
        showLoader();
      });
    });
  })();
</script>
{/literal}
