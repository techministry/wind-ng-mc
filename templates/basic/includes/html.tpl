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
<?xml version="1.0" encoding="{$lang.charset}"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$lang.iso639}" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$lang.charset}" />
<meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
{$head}
<link href="{$css_dir}styles.css" rel="stylesheet" type="text/css" />
{if $site_theme == 'dark'}
<link href="{$css_dir}dark.css" rel="stylesheet" type="text/css" id="dark-theme-css" />
{/if}
<script type="text/javascript" src="{$js_dir}overlib/overlib.js"><!-- overLIB (c) Erik Bosrup --></script>
<!-- tabs - wavesoft@wna.gr -->
<link href="{$css_dir}wavetabs.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{$js_dir}mootools-compact-1.3.1.js"></script>
<script type="text/javascript" src="{$js_dir}wavetabs.js"></script>
{* include_php removed - was hardcoded to production server path *}
</head>
<body{foreach from=$body_tags item=item key=key} {$key}="{$item}"{/foreach}>
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
{$body}
<script>
// Force reload on back/forward to keep auth state correct
window.addEventListener('pageshow', function(evt) {
  var nav = performance && performance.getEntriesByType ? performance.getEntriesByType('navigation')[0] : null;
  if (evt.persisted || (nav && nav.type === 'back_forward')) {
    window.location.reload();
  }
});
// Also disable bfcache on form submits by replacing history state
if (window.history && window.history.replaceState) {
  window.history.replaceState(null, document.title, window.location.href);
}
</script>
</body>
</html>
