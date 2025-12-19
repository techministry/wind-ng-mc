{*
 * WiND - Wireless Nodes Database
 * Basic HTML Template
 *
 * Copyright (C) 2005 Konstantinos Papadimitriou <vinilios@cube.gr>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 2 dated June, 1991.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 *}
{if $title != ''}
	<title>{$title}</title>
{/if}
{* <link type="text/css" href="http://www.wna.gr/forum/chat/cometchatcss.php" rel="stylesheet" charset="utf-8">
<script type="text/javascript" src="http://www.wna.gr/forum/chat/cometchatjs.php" charset="utf-8"></script> *} 

{foreach from=$base item=i}
	<base{foreach from=$i key=key item=value}{if $value != ''} {$key}="{$value}"{/if}{/foreach} />
{/foreach}
{foreach from=$link item=i}
	<link{foreach from=$i key=key item=value}{if $value != ''} {$key}="{$value}"{/if}{/foreach} />
{/foreach}
{foreach from=$meta item=i}
	<meta{foreach from=$i key=key item=value}{if $value != ''} {$key}="{$value}"{/if}{/foreach} />
{/foreach}
{foreach from=$script item=i}
	<script{foreach from=$i key=key item=value}{if $value != ''} {$key}="{$value}"{/if}{/foreach}></script>
{/foreach}
{if $extra != ''}
{$extra}
{/if}

{literal}
<script>
  (function() {
    // Persist site theme (light/dark) in localStorage and apply on load
    var THEME_KEY = 'site_theme';
    var defaultTheme = '{/literal}{$site_theme|default:"light"}{literal}';
    var COOKIE_KEY = 'site_theme';

    function setCookie(name, value, days) {
      var expires = "";
      if (days) {
        var d = new Date();
        d.setTime(d.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + d.toUTCString();
      }
      document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }
    function getCookie(name) {
      var nameEQ = name + "=";
      var ca = document.cookie.split(';');
      for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
      }
      return null;
    }

    function applyTheme(theme) {
      var darkLink = document.getElementById('dark-theme-css');
      // Ensure the dark stylesheet node exists once
      if (!darkLink) {
        darkLink = document.createElement('link');
        darkLink.rel = 'stylesheet';
        darkLink.type = 'text/css';
        darkLink.href = '{/literal}{$css_dir}{literal}dark.css';
        darkLink.id = 'dark-theme-css';
        document.head.appendChild(darkLink);
      }
      // Toggle it on/off
      darkLink.disabled = (theme !== 'dark');
    }

    // Expose helpers for other scripts (footer selector, admin preview)
    window.applySiteTheme = applyTheme;
    window.setSiteTheme = function(theme) {
      var val = (theme === 'dark') ? 'dark' : 'light';
      try { localStorage.setItem(THEME_KEY, val); } catch(e) {}
      setCookie(COOKIE_KEY, val, 365);
      applyTheme(val);
    };
    window.getSiteTheme = function() {
      var saved = null;
      try { saved = localStorage.getItem(THEME_KEY); } catch(e) { saved = null; }
      if (saved !== 'dark' && saved !== 'light') {
        var cookieVal = getCookie(COOKIE_KEY);
        if (cookieVal === 'dark' || cookieVal === 'light') {
          saved = cookieVal;
        }
      }
      if (saved === 'dark' || saved === 'light') return saved;
      return defaultTheme === 'dark' ? 'dark' : 'light';
    };

    // Apply on load using stored preference or default and ensure we persist a value
    var currentTheme = window.getSiteTheme();
    try {
      localStorage.setItem(THEME_KEY, currentTheme);
    } catch(e) {}
    setCookie(COOKIE_KEY, currentTheme, 365);
    applyTheme(currentTheme);

    // Hook color scheme selector if present
    document.addEventListener('DOMContentLoaded', function() {
      var sel = document.getElementById('color_scheme_selector') || document.getElementById('colorSchemeBasic');
      if (sel) {
        // Initialize selector value
        sel.value = window.getSiteTheme();
        sel.addEventListener('change', function() {
          window.setSiteTheme(sel.value);
        });
      }
    });
  })();
</script>
{/literal}

