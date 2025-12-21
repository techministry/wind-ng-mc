{* WiND Modern Material Theme Body Wrapper *}
<div class="container">
  {include file="includes/main_header.tpl"}
  <main>
    {if isset($message) && $message != ''}
      <div class="card elevation-1" style="margin-bottom:16px;">
        {$message}
        {if !$logged && isset($message_key) && $message_key == 'no_privilege'}
          <div class="login-message-action">
            <button type="button" class="button" data-login-open>
              <span class="material-icons" aria-hidden="true" style="font-size:20px;vertical-align:middle;margin-right:6px;">login</span>
              {$lang.log_in}
            </button>
          </div>
        {/if}
      </div>
    {/if}
    {$center}
    {if !$logged}
      <div id="login-overlay" class="login-overlay" aria-hidden="true">
        <div class="login-overlay__panel" role="dialog" aria-modal="true" aria-labelledby="login-title">
          <div class="login-overlay__header">
            <div id="login-title" class="mdc-typography--headline6">{$lang.log_in}</div>
            <button type="button" class="login-overlay__close material-icons" data-login-close aria-label="Close">close</button>
          </div>
          <div class="login-overlay__body">
            {$form_login}
          </div>
        </div>
      </div>
    {/if}
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
    function isSamePageAnchor(a) {
      var href = a.getAttribute('href');
      if (!href) return false;
      if (href.charAt(0) === '#') return true;
      try {
        var url = new URL(a.href, window.location.href);
        return url.pathname === window.location.pathname &&
          url.search === window.location.search &&
          url.hash;
      } catch (err) {
        return false;
      }
    }
    window.addEventListener('beforeunload', function() { showLoader(); });
    document.addEventListener('DOMContentLoaded', function() {
      document.addEventListener('click', function(e) {
        var a = e.target.closest('a');
        if (!a || isSafeLink(a) || isSamePageAnchor(a)) return;
        showLoader();
      });
      document.addEventListener('submit', function(e) {
        showLoader();
      });
    });
    // If user navigates back/forward, force a refresh so auth state is accurate
    window.addEventListener('pageshow', function(evt) {
      if (evt.persisted || (performance && performance.getEntriesByType('navigation')[0] && performance.getEntriesByType('navigation')[0].type === 'back_forward')) {
        window.location.reload();
      }
    });
  })();
  (function() {
    var overlay = document.getElementById('login-overlay');
    if (!overlay) return;
    var openers = document.querySelectorAll('[data-login-open]');
    var closeBtn = overlay.querySelector('[data-login-close]');

    function openLogin() {
      overlay.classList.add('is-visible');
      overlay.setAttribute('aria-hidden', 'false');
      document.body.classList.add('login-overlay-open');
      var firstInput = overlay.querySelector('input, select, textarea');
      if (firstInput) firstInput.focus();
    }

    function closeLogin() {
      overlay.classList.remove('is-visible');
      overlay.setAttribute('aria-hidden', 'true');
      document.body.classList.remove('login-overlay-open');
    }

    for (var i = 0; i < openers.length; i++) {
      openers[i].addEventListener('click', function(e) {
        e.preventDefault();
        openLogin();
      });
    }

    if (closeBtn) {
      closeBtn.addEventListener('click', function(e) {
        e.preventDefault();
        closeLogin();
      });
    }

    overlay.addEventListener('click', function(e) {
      if (e.target === overlay) closeLogin();
    });

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') closeLogin();
    });
  })();
  (function() {
    function initTabs() {
      var panels = document.querySelectorAll('.tab-panel[id^="tab_"]');
      if (!panels.length) return;
      var links = document.querySelectorAll('a.tab-link[href^="#tab_"]');
      if (!links.length) return;

      var panelById = {};
      for (var i = 0; i < panels.length; i++) {
        panelById[panels[i].id] = panels[i];
        panels[i].setAttribute('role', 'tabpanel');
      }

      function setActive(id) {
        if (!panelById[id]) return false;
        for (var i = 0; i < panels.length; i++) {
          var isActive = panels[i].id === id;
          panels[i].classList.toggle('is-active', isActive);
        }
        for (var i = 0; i < links.length; i++) {
          var href = links[i].getAttribute('href') || '';
          var targetId = href.charAt(0) === '#' ? href.slice(1) : '';
          var isLinkActive = targetId === id;
          links[i].classList.toggle('is-active', isLinkActive);
          links[i].setAttribute('aria-selected', isLinkActive ? 'true' : 'false');
          links[i].setAttribute('role', 'tab');
          if (targetId) links[i].setAttribute('aria-controls', targetId);
        }
        return true;
      }

      function activateFromHash() {
        var hash = window.location.hash ? window.location.hash.slice(1) : '';
        if (hash && setActive(hash)) return;
        var fallback = '';
        if (links.length) {
          var href = links[0].getAttribute('href') || '';
          if (href.charAt(0) === '#') fallback = href.slice(1);
        }
        if (!fallback && panels.length) fallback = panels[0].id;
        if (fallback) setActive(fallback);
      }

      document.body.classList.add('tabs-ready');
      activateFromHash();
      window.addEventListener('hashchange', activateFromHash);
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initTabs);
    } else {
      initTabs();
    }
  })();
</script>
{/literal}
